<? require_once("troomguest.inc.php");

class TeacherApp extends DBCon
{
	function __construct()
	{
		parent::__construct();	
	}
	
	function getUserByEmail($emailid)
	{
		return $this->runQuery("select slno,email_id,first_name,fullname,photoid,usertype from tbl_users where email_id='$emailid'");
	}
	
	function getPendingScheduleRequests($tchid)
	{
		// Un Processed Schedule Requests
		
		// Demo
		$qry = "select sr.*, first_name, fullname from schedulerequests sr 
				inner join tbl_users u on u.slno=sr.studentid 
				where sr.teacherid=".intval($tchid)." and sr.req_sch_date >= CURRENT_DATE() 
				and sr.scheduleid=0 and sr.slotid=0 and sr.status is null and sr.std_req_confirm='Y'";
		$res1=$this->runQuery($qry);
		
		// Paid
		$qry = "select sr.*, s.slot_from, s.slot_to, first_name, fullname from schedulerequests sr 
				inner join tbl_users u on u.slno=sr.studentid 
				inner join tbl_slotmaster s on s.slno=sr.slotid 
				where sr.teacherid=".intval($tchid)." and sr.req_sch_date >= CURRENT_DATE() 
				and sr.scheduleid=0 and sr.slotid > 0 and sr.status is null and sr.std_req_confirm='Y'";
		$res2=$this->runQuery($qry);		
		
		return array($res1,$res2);
	}
	
	function processScheduleRequest($sreqid,$status,$tchname)
	{
			$schdet=$this->runQuery("select * from schedulerequests where scheduleid=0 and status is null and reqid=".intval($sreqid));
			if(count($schdet)==1)
			{
					if($schdet[0]['slotid']==0)
					{
						$from_time = $schdet[0]['req_from_time'];
						$to_time = $schdet[0]['req_to_time'];
						$demo_date = $schdet[0]['req_sch_date'];
						$schtype="Demo";
					}else
					{
						$res=$this->getSlotById($schdet[0]['slotid']);
						$from_time = $res[0]['slot_from'];
						$to_time = $res[0]['slot_to'];
						$demo_date = $schdet[0]['req_sch_date'];
						$schtype="Paid";
			   		}
			   if($status=="A")
			   {
					// slotid  default value = 0 , it is set in Table 
					
					if($schdet[0]['slotid']==0) // for free demo requests, slotid is not used
					{
						$qry = "select count(*) as tot from demoschedules where teacherid=".$schdet[0]['teacherid']." and 
							time_to_sec(fromtime) >= time_to_sec('$from_time') and 
							time_to_sec(fromtime) < time_to_sec('$to_time') and 
							date(demodate)='$demo_date'"; 
					}else
					{
							// For paid schedule use tbl_paidschedules table
						$qry = "select count(*) as tot from tbl_paidschedules where tchid=".$schdet[0]['teacherid']." and slotid=".$schdet[0]['slotid']." and  date(schedule_date)='$demo_date'"; 
					}
					$res = $this->runQuery($qry);
					if($res[0]['tot']>0)
					{
						return array("success"=>"","errmsg"=>"Schedule time clashes with another session on this date!");
					}else
					{
						if($schdet[0]['slotid']!=0)
						{
							// For now, session_type is OTO, later make dynamic
						 $qry = "insert into tbl_paidschedules set tchid={$schdet[0][teacherid]}, stdid={$schdet[0][studentid]}, 
							session_class='{$schdet[0][demo_class]}', session_subject='{$schdet[0][demo_subject]}',
							session_board='{$schdet[0][board]}', slotid={$schdet[0][slotid]}, schedule_date='{$schdet[0][req_sch_date]}', 
							session_type='OTO', session_topic='{$schdet[0][stdquery]}'";							
						}else
						{
						
						$qry = "INSERT INTO demoschedules (teacherid, studentid, ClassName, SubName, DemoDate, fromtime, totime, Description, status, session_type,slot_booked,createddate) VALUES ({$schdet[0][teacherid]}, {$schdet[0][studentid]}, '{$schdet[0][demo_class]}', '{$schdet[0][demo_subject]}', '{$schdet[0][req_sch_date]}', '$from_time', '$to_time', 'Teacher Cal Acceptance', NULL, 'S','Y',CURRENT_TIMESTAMP())";						
						}
						
						$this->executeQuery($qry);
						$schid=mysql_insert_id();
						// Assign schedule id for this demo request
						$qry = "update schedulerequests set status='A', scheduleid=".$schid." where reqid = $sreqid";	 
						$this->executeQuery($qry);							
						$this->sendScheduleRequestResponseMail($sreqid,$status,$schtype,$demo_date,$from_time,$to_time,$tchname);
						return array("success"=>"Schedule Created","errmsg"=>"");
					}
			   }else
			   {
					 
					$qry = "update schedulerequests set status='R' where reqid = $sreqid";	 
					$this->executeQuery($qry);							
				    $this->sendScheduleRequestResponseMail($sreqid,$status,$schtype,$demo_date,$from_time,$to_time,$tchname);
					return array("success"=>"Request Processed","errmsg"=>"");
			   }
							
			}	
	}



	function sendScheduleRequestResponseMail($schid,$status,$schtype,$schdate,$from,$to,$tchname)
	{
		
		$sdet=$this->runQuery("select u.first_name, u.email_id, u.mobileno from ScheduleRequests sr inner join tbl_users u on u.slno=sr.studentid where sr.reqid=$schid");	
		if($status=="A")
		{
			$msg ="<p>Hello ".$sdet[0]['first_name']."</p><p>Your request for {$schtype} Class with teacher ".$tchname." is accepted.</p>";
			$msg .= "<p>Your {$schtype} class is scheduled on ".$schdate." between ".$from." and ".$to."</p>";
			$sms_msg .= "Your {$schtype} class with teacher ".$tchname." is scheduled on ".$schdate." from ".$from." and ".$to;		
		}else
		{
			$msg ="<p>Hello ".$sdet[0]['first_name']."</p><p>Your request for {$schtype} Class with teacher ".$tchname." is not accepted.</p>";
			$sms_msg .= "Your request for {$schtype} class with teacher ".$tchname." is not accepted";
		}
		
		$this->sendMail("support@tuitionroom.com",$sdet[0]['email_id'],"Tuitionroom.com - Demo Class Schedule",$msg);
		if($sdet[0]['mobileno']!='')
		{
			 
			$this->smsUser($sdet[0]['mobileno'],$sms_msg);
		}
	}
	
	// App Notification Requests Count
	function getNewScheduleRequestsSinceLastRequestID($uid)
	{
		
		// To test request from APP, insert in sample table
		$this->executeQuery("insert into app_test set uid=$uid, msg='Test msg'");
		// Test code ends 
		
		$qry = "select lastreq_sreqid from tbl_app_schrequests where uid=$uid";
		$sreq = $this->runQuery($qry);
		
		$qry = "select reqid from schedulerequests where teacherid=$uid and reqid > ".$sreq[0]['lastreq_sreqid']." and req_sch_date >= CURRENT_DATE() 
				and scheduleid=0 and status is null and std_req_confirm='Y' order by reqid desc";
		$req = $this->runQuery($qry);
		$tot=count($req);
		
		if($tot>0)
		{
			// Update last reqid sent to app
			$this->executeQuery("update tbl_app_schrequests set lastreq_sreqid = ".$req[0]['reqid'])." where uid=$uid";	
		}
		
		return $tot;
		
	}
	
}

?>