<? require_once("troomguest.inc.php");

class Register extends DBCon{

	function __construct(){
		parent::__construct();
	}

	private function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from shared internet
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is passed from proxy
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
		  $ip=$_SERVER['REMOTE_ADDR'];
		
		return $ip;
	}
	
    function getDemoSlotsAvailableCount($demo_date,$tchid)
	{
		// Availble = Teacher Slots - Demo Requests accepted on that day
		// For current data Teacher Slots = Get Slots which are after current time only
		if($demo_date==date("Y-m-d"))
			$slots=$this->runQuery("select count(*) as tot from tbl_teacher_slots where tchid=$tchid and CURRENT_TIME() < TIME(slot_to)");					
		else
			$slots=$this->runQuery("select count(*) as tot from tbl_teacher_slots where tchid=$tchid");
		
		$booked=$this->runQuery("select count(*) as tot from demoschedules where teacherid=$tchid and DATE(demodate)='$demo_date' and slot_booked='Y'");
		if($slots[0]['tot'] > 0)
			return $slots[0]['tot']-$booked[0]['tot'];
		else
			return 0;
	}

	function getClassroomSchedulesByTeacher($schdate,$tchid)
	{

		$qry = "select slotid as scheduleid, first_name, classdate, teacherid ,  classname , subname , fromtime , totime from classschedules cs inner join tbl_users u on u.slno=cs.teacherid where classdate='$schdate' and teacherid=".intval($tchid);	
		return $this->runQuery($qry);
	 
	}
	
	function isTutorOnline($tid)
	{
		// allow session timeout duration - 24*60
		$qrys = "SELECT * FROM `tbl_userlog` WHERE userid = ".intval($tid)." and DATE(login_ts)=CURDATE() and TIMEDIFF(CURTIME(), 	TIME(lastpagevisit_timestamp)) < 1440 and logout_ts IS NULL ";  
		return $this->runQuery($qrys);
	}

	function getCity($cityid)
	{
	  return $this->runQuery("select * from tbl_cities where cityid=".intval($cityid));
	}
	
	function searchUsers($udet)
	{
		extract($udet);
		$usertype=($ucat=="Student")?"Teacher":"Student";
		
		$qry = "select * from tbl_users where usertype='$usertype' and subjects like '%{$subj}%' and location=".intval($area)." and isactive='T' and profileupdate='Y'";
		return $this->runQuery($qry);
	}
	
	function checkMobileDNDStatus($mobileno)
	{
		$fc=file_get_contents("http://checkdnd.com/api/check_dnd_no_api.php?mobiles={$mobileno}");
		// result JSON Format: {"msg":"success","msg_text":{"9704360436":"Y"}}
		$fdata=json_decode($fc);
		$res=(array)$fdata->msg_text;
		return $res["$mobileno"];		
	}

	function sendProfileViewSMSVerification($mobileno,$emailid,$tchid)
	{
 		
		$smscode=$this->generateSMSCode();
		
		$res=$this->runQuery("select count(*) as tot from tbl_otp_verify_profileview where tchid=$tchid and emailid='$emailid'");
		if($res[0]['tot']==0)		
			$this->executeQuery("insert into tbl_otp_verify_profileview set tchid=$tchid , emailid='$emailid', mobileno='$mobileno', gen_otp='$smscode'");
		else
			$this->executeQuery("update tbl_otp_verify_profileview set  gen_otp='$smscode' where tchid=$tchid and emailid='$emailid'");
		$sms_msg="Your Tuitionroom.com Mobile verification code is : {$smscode}";
		
		$dndstatus=$this->checkMobileDNDStatus($mobileno);
		if($dndstatus=="N")
			$this->smsUser($mobileno,$sms_msg);
		 $this->sendMail("support@tuitionroom.com",$emailid,"TuitionRoom.com - One Time Password",$sms_msg);
		return $dndstatus;
	}
	
	function verifyProfileViewSMSCode($vcode,$emailid,$tchid)
	{
		$qry = "select count(*) as tot from tbl_otp_verify_profileview where tchid=$tchid and emailid='$emailid' and gen_otp = binary '".mysql_real_escape_string($vcode)."'";	
		$res = $this->runQuery($qry);
		
		$result = ($res[0]['tot']>0)?"Y":"N";
		$qry = "update tbl_otp_verify_profileview set res_otp='$vcode', result_verify='$result' where tchid=$tchid and emailid='$emailid'";
		$this->executeQuery($qry);		
				
		return $result;
		
	}


	function sendMoblieVerificationSMS($mobileno,$uid,$utype)
	{
		$smscode=$this->generateSMSCode();
		
		$qry = "update tbl_otp_verify set gen_otp='$smscode' where userid=$uid";
		$this->executeQuery($qry);
		$msg = "Dear {$utype},welcome to tuitionroom.com.Please use the number : {$smscode} for your mobile number verification.";
		$this->smsUser($mobileno,$msg);
	}

	function checkEmailAvailability($emailid){
		$chqry = "select * from tbl_users where email_id='$emailid'";
		$res = $this->runQuery($chqry);
		if($res)
			return 0;
		else
			return 1;
	}
	function checkEmailId($email)
	{
		$qry = "select count(*) as tot from tbl_users where email_id='".mysql_real_escape_string($email)."'";
		$res = $this->runQuery($qry);
		return ($res[0]['tot'])?0:1;
	}
	
	function autoLoginUser($email)
	{
		$qry = "select slno, first_name, usertype,mobileno,email_id,isactive,profileupdate,mobileno_verified  from tbl_users where email_id='".mysql_real_escape_string($email)."'";
		$res = $this->runQuery($qry);
		session_name("{$res[0][usertype]}");
		session_start();	  						
		$_SESSION['uid']=$res[0]['slno'];
		$_SESSION['uname']=$res[0]['first_name'];
		$_SESSION['ucat']=$res[0]['usertype'];
		$_SESSION['mobno']=$res[0]['mobileno'];
		$_SESSION['email'] = $res[0]['email_id'];
		$_SESSION['isactive']=$res[0]['isactive'];
		$_SESSION['isprofilecomplete']=$res[0]['profileupdate']; 	
		$_SESSION['ismobileverified']=$res[0]['mobileno_verified'];					
		$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid={$res[0][slno]}, usertype='{$res[0][usertype]}',login_ts=CURRENT_TIMESTAMP(),datecreated=CURRENT_TIMESTAMP()";
		$this->executeQuery($logqry);
						
		// Store latest log record id
		$_SESSION['logrecid']=mysql_insert_id();
			
	}
	
   function updatePassword($pdet){
		
		$pdet=$this->escapeformdata($pdet);
		
		extract($pdet);
		
		$errmsg=array();
		
		if($opwd=='') $errmsg[]="Enter Old Password";	
		if($npwd=='') $errmsg[]="Enter New Password";	
		if($npwd!=$rnpwd) $errmsg[]="New Passwords Do Not Match";
		
		
		$updet=$this->getProfileById($_SESSION['uid'],$_SESSION['ucat']);
		
		if(base64_decode($updet[0]['password'])!=$opwd)
			$errmsg[]="Invalid Old Password! Try Again";

		if($errmsg) return $errmsg;
		
		$upqry="update tbl_users set password='".base64_encode($npwd)."' where slno=$_SESSION[uid] and usertype='".$_SESSION['ucat']."'";
		$this->executeQuery($upqry);
		return 1;
		
	}

	function checkUserLogin($udet){
		
		$udet=$this->escapeformdata($udet);
		extract($udet);

		// To handle social media users trying to login directly from tutionroom.com, 
		// get user det only by Email ID, as Social Media users will not have password
		$chqry = "select * from tbl_users where email_id='$userid'";
		$res = $this->runQuery($chqry);
		
		if(count($res)==1) // Uses Exists
		{ 		
		 if($res[0]['socialmedia']=='Y' && $res[0]['password']=='')  
		 { 
/*		 // Social media user first time direct login 
			  $random_pass=$this->generatePassword();
			  $this->executeQuery("update tbl_users set password = '".base64_encode($random_pass)."' where slno=".$res[0]['slno']);
			  $media=$this->runQuery("select media_name from tbl_users_socialmedia where uid=".$res[0]['slno']);
			  session_start();
			  $_SESSION['reg_smedia']=$media[0]['media_name'];
			  $msg="<p>Hello,</p><p>Your One Time Password to login at Tuitionroom.Com: ".$random_pass."</p>";
			  $msg .= "<p>Thank You, Team TuitionRoom.Com</p>";
			  $this->sendMail("support@tuitionroom.com",$res[0]['email_id'],"TuitionRoom.Com - One Time Password to Login",$msg);
*/			 
			// send message that registered via SM
			return 2;
		 }else
		 {
			// echo(base64_encode(strtolower(base64_decode($res[0]['password'])))."===".strtolower($res[0]['password']) . "====". base64_encode(strtolower($passwd)));
			// die();
					//if($res[0]['password']==base64_encode($passwd)) 
					if(base64_encode(strtolower(base64_decode($res[0]['password'])))==base64_encode(strtolower($passwd))) 						
					{ 
						// Check previous logout status
						$logdet=$this->getLastLoginDet($res[0]['slno']);
					
						if($logdet && $logdet[0]['logout_ts']=='')
						{ 
							$qry = "update tbl_userlog set logout_ts=CURRENT_TIMESTAMP(), logout_type='Multiple IP' where slno={$logdet[0][slno]}";
							$this->executeQuery($qry);				
						}
						
						$sesname=($res[0]['usertype']=="admin" || $res[0]['usertype']=="Sup_Admin")?"admin":$res[0]['usertype'];
						session_name($sesname);
						session_start();	  
						
						$_SESSION['uid']=$res[0]['slno'];
						$_SESSION['uname']=$res[0]['first_name'];
						
						$_SESSION['photo']=($res[0]['photoid']=='')?"nophotoavailable.png":$res[0]['photoid'];
						
						// Check If User Category Is Recored or not
						if($res[0]['usertype']=='')						 
							return "AccountType.php";
							 
						 
						
						$_SESSION['ucat']=$res[0]['usertype'];
						$_SESSION['mobno']=$res[0]['mobileno'];
						$_SESSION['email'] = $res[0]['email_id'];
						$_SESSION['isactive']=$res[0]['isactive'];
						$_SESSION['isprofilecomplete']=$res[0]['profileupdate']; 	
						$_SESSION['ismobileverified']=$res[0]['mobileno_verified'];				
						$_SESSION['isdemorecorded']=$res[0]['demo_recording'];				
						if($_POST['saveuser']=="Y")
						{
							setcookie("troom_uname",$userid,time()+3600*10);
							setcookie("troom_pwd",$passwd,time()+3600*10);
						}else
						{
							setcookie("troom_uname",$loginid,time()-3600*100);
							setcookie("troom_pwd",$passwd,time()-3600*100);				
						}
							
							
						$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid={$res[0][slno]}, usertype='{$res[0][usertype]}',login_ts=CURRENT_TIMESTAMP(),datecreated=CURRENT_TIMESTAMP()";
						$this->executeQuery($logqry);
						
						// Store latest log record id
						$_SESSION['logrecid']=mysql_insert_id();
						
						$redirect="index.php";
						if($res[0]['usertype']=='admin')
						{
		/*					if(!empty($logdet[0]['lastpagevisit']))
								$redirect="admin/{$logdet[0][lastpagevisit]}";
							else
		*/						$redirect="admintroom/AdminHome.php";
						}else if($res[0]['usertype']=='Teacher')
						{
							if(!empty($_SESSION['requested_page']))
								$redirect="teacher/".$_SESSION['requested_page']; // Code in teacher/coursedetails.php
							else
								$redirect="teacher/MyTHome.php";
						}
						else if($res[0]['usertype']=='Student')
						{
							// Check course access time restriction here itself
						/*	if(!empty($logdet[0]['lastpagevisit']))
								$redirect="student/{$logdet[0][lastpagevisit]}";
							else*/
								if($_POST['redirect']!='')
								{
									// Teacher-1
									$tdet=$this->getUserByProfileURL($_POST['redirect']);
									if(count($tdet)!=0 && $tdet[0]['profile_url']!='')
									{																	  
										$redirect="student/viewtutorprofile.php?tutorId=".$tdet[0]['slno'];
									}else
										$redirect="student/MySHome.php";
								}else
									$redirect="student/MySHome.php";
						
						}					
						return $redirect; //header("Location: $redirect");
						die();
							
					}else
						return 0;		
		 }
		}else
			return -1;
	}		
	
 	/* For Student Registration from Front End Teacher Profile View */
	// Only emailid and verified mobile number is available, 
	// Also record profile view of this teacher by this student
	
	function profileViewRegister($udet)
	{
		
		extract($udet);
		 
 
 	 	$random_pass=$this->generatePassword();
		$temp_pwd=base64_encode($random_pass);

		$msg="Dear Student, Thank you for Registering with tuitionroom.com. Your Login ID : {$stdemailid} Password :{$random_pass}";
		$this->smsUser($stdmobile,$msg);
 	        
		$classroom_plan=($plan=='')?"F":$plan;
			
			// Since we have verified mobile number of student , update mobile no. and mobileverification status also
			$qry1 = "insert into tbl_users set email_id='$stdemailid', password='$temp_pwd', mobileno='$stdmobile', mobileno_verified='Y',  usertype='Student', isactive='T' , classroom_plan='$classroom_plan'";
				
			$this->executeQuery($qry1);
			$userid=mysql_insert_id();
			
			// Generate and Store Email Verification ID to be sent in Welcome Mail
			
			$verifyid=md5($userid.$stdemailid);
			$qry = "update tbl_users set email_verification_id='$verifyid' where slno=$userid";
			$this->executeQuery($qry);
			
				 
			$wc=file_get_contents("student_welcome_mail.html");
			$wc=str_replace("{useremail}",$stdemailid,$wc);
				
			$verify_link="http://www.tuitionroom.com/verifyuser.php?{$verifyid}";
			$wc=str_replace("{verifylink}",$verify_link,$wc);
			// Send Mail
			$this->sendMail("support@tuitionroom.com",$stdemailid,"Welcome To TuitionRoom.Com",$wc);
			//$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","Welcome To TuitionRoom.Com",$wc);
			// Record profile view
			$qry = "insert into tbl_profile_views set viewed_by=".intval($userid).", profile_of=".intval($tchid).", view_date=CURDATE(), view_count=1";
			$this->executeQuery($qry);
 			return $userid;			 
	}

//	 To auto login student registered via front end teacher profile view(profilehandler.php)

	function autoLoginProfileViewStudent($uid)
	{
		$qry = "select slno, first_name,mobileno,email_id,isactive,profileupdate,mobileno_verified  from tbl_users where slno=".intval($uid);
		$res = $this->runQuery($qry);
		session_name("Student");
		session_start();	  						
		$_SESSION['uid']=$uid;
		$_SESSION['uname']=$res[0]['first_name'];
		$_SESSION['ucat']="Student";
		$_SESSION['mobno']=$res[0]['mobileno'];
		$_SESSION['email'] = $res[0]['email_id'];
		$_SESSION['isactive']=$res[0]['isactive'];
		$_SESSION['isprofilecomplete']="N"; 	
		$_SESSION['ismobileverified']="Y";
		$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid={$uid}, usertype='Student',login_ts=CURRENT_TIMESTAMP(),datecreated=CURRENT_TIMESTAMP()";
		$this->executeQuery($logqry);		
		$_SESSION['logrecid']=mysql_insert_id();
			
	}
		 

	function sendOfflineMsg($msgdata)
	{
		$msgdata=$this->escapeformdata($msgdata);
		extract($msgdata);
		$qry = "insert into tbl_offline_messages set from_id=".intval($stdid).", to_id=".intval($tchid).", message='".mysql_real_escape_string(strip_tags($msg))."'";	
		$this->executeQuery($qry);
		$tdet=$this->getProfileById($tchid);
		// At this point we dont have students profile info, so email id is used in message		
		$emailmsg = "Just Now you had received enquiry from ".$msgdata['stdemailid']." at Tuitionroom.com<br /><br />";
		$emailmsg .= "Message: <br/>".strip_tags($msg);
		$encoded = base64_encode("uid=".$tchid);
		$emailmsg .= "<br/> <a href='https://www.tuitionroom.com/verifymessage.php?".$encoded."' target='_blank'>Visit Now to Reply</a>";
	
		$this->sendMail("support@tuitionroom.com",$tdet[0]['email_id'],"New Enquiry from Student at Tuitionroom.com",$emailmsg);
		$this->smsUser($tdet[0]['mobileno'],"Just Now you had received enquiry from a student at www.tuitionroom.com. Please login immediately to reply.");
	}
	
	function addDemoScheduleRequest($req)
	{ 
			 
		    extract($req);
		 // Here schedule id will be zero. When tutor accepts this req, create a demo schedule
		 // with these details and assign that schedule ID to this Request ID
		 
		 $qry = "insert into schedulerequests set scheduleid=0, studentid=".intval($stdid).", teacherid={$tchid}, 
		 req_sch_date='".date("Y-m-d",strtotime($demoreq_date))."', req_from_time='$demoreq_from', req_to_time='$demoreq_to',
		 demo_class='', demo_subject=''";
		
		 $this->executeQuery($qry);
		 $tdet=$this->getProfileById($tchid,"Teacher");
		 if($tdet[0]['mobileno']!='')
		 {
			 $msg = "Just now you received a Demo Request from a student. Login to Tuitionroom.com to acknowledge the request.";
			 $this->smsUser($tdet[0]['mobileno'],$msg); 
		 }
		 
		 $user=base64_encode("user=".$tdet[0]['email_id']);
		 $msg = '<p>'.$msg.'</p><br/><br/><p><a href="https://www.tuitionroom.com/ackdemoreq.php?'.$user.'" style="color: #fff;    background-color: #5bc0de;    border-color: #46b8da; padding:10px; text-decoration:none; border-radius:5px;">Login Now</a></p>';
		 $this->sendMail('support@tuitionroom.com',$tdet[0]['email_id'],'Tuitionroom.com - Student Demo Request',$msg); 
		 
		
	}


/* Teacher Profile View Registration Ends */
	
	function tempRegister($udet)
	{
		$udet=$this->escapeformdata($udet);
		extract($udet);
		$errmsg=array();
		//if($fullname=='') $errmsg[]="Enter Full Name";
		if($upasswd=='' || strlen($upasswd)<6) $errmsg[]="Enter Valid Password (Min. 6 characters)";
		if($emailid=='' || !preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$emailid) || !$this->checkEmailAvailability($emailid)) 
			$errmsg[]="Email ID";
		//if(strlen($mobile) < 10) $errmsg[]="Enter Valid Mobile Number";
		
		if($errmsg)	return 0;
//		 	$random_pass=$this->generatePassword();
//			$temp_pwd=base64_encode("123456"); 
//			$temp_pwd=base64_encode($random_pass);

			$msg="Dear {$accept},Thankyou for Registering with tuitionroom.com.Your Login ID : {$emailid} Password :{$upasswd}";
			$this->smsUser($mobile,$msg);
 	        
			$classroom_plan=($plan=='')?"F":$plan;
			
			// Allowed special chars like ', " in Password and then encoded
			$temp_pwd=$upasswd;
			
			$qry1 = "insert into tbl_users set email_id='$emailid', password='".base64_encode($temp_pwd)."', usertype='$accept', classroom_plan='$classroom_plan'";
			if($accept=="Student")
				$qry1 .= ", isactive='T'";
			else
				$qry1 .= ", isactive='T'";  // Teacher also active by default
				
			$this->executeQuery($qry1);
			$userid=mysql_insert_id();
			
			// Generate and Store Email Verification ID to be sent in Welcome Mail
			
			$verifyid=md5($userid.$emailid);
			$qry = "update tbl_users set email_verification_id='$verifyid' where slno=$userid";
			$this->executeQuery($qry);
			
			// Create OTP Storing record
			// Temporarily disable mobile verification
/*			$qry = "insert into tbl_otp_verify set userid=$userid";
			$this->executeQuery($qry);
			$this->sendMoblieVerificationSMS($mobile,$userid,$accept);
*/			
			
			// Auto login user after registration
			if($accept == "Teacher")
			{	
				session_name("Teacher");
				session_start();				
				$_SESSION['uname'] = $_SESSION['email'] = $emailid;
				$_SESSION['uid'] = $userid;		
				$_SESSION['ucat'] = $accept;
				$_SESSION['isactive'] = 'T';
				$_SESSION['isprofilecomplete'] = 'N';
				$redirect = "teacher/MyTHome.php";
			}
			else
			{	
				session_name("Student");
				session_start();			
				$_SESSION['uname'] = $_SESSION['email'] = $emailid;
				$_SESSION['uid'] = $userid;	
				$_SESSION['ucat'] = $accept;
				$_SESSION['isactive'] = 'T'; // Student active by default
				$_SESSION['ismobileverified']=$_SESSION['isprofilecomplete'] = 'N';
				$redirect = "student/MySHome.php";
			}
			
			
			$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid=$userid, usertype='$accept',login_ts=CURRENT_TIMESTAMP(),datecreated=CURRENT_TIMESTAMP()";
			//echo $logqry;
				$this->executeQuery($logqry);
				$_SESSION['logrecid']=mysql_insert_id();
				 
				 
				if($accept=="Student")
					$wc=file_get_contents("student_welcome_mail.html");
				else
					$wc=file_get_contents("teacher_welcome_mail.html");
				$wc=str_replace("{useremail}",$emailid,$wc);
				
				$verify_link="http://www.tuitionroom.com/verifyuser.php?{$verifyid}";
				$wc=str_replace("{verifylink}",$verify_link,$wc);
				// Send Mail
				$this->sendMail("support@tuitionroom.com",$emailid,"Welcome To TuitionRoom.Com",$wc);
				$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","Welcome To TuitionRoom.Com",$wc);
 				

			 
			header("Location: {$redirect}");
			die();
		 
	}
	// Register user for schedule from schedule registration mail
	// called in registerforschedule.php
	function scheduleRegister($udet)
	{
		extract($udet);
		$errmsg=array();
		if($fullname=='') $errmsg[]="Enter Full Name";
		if($emailid=='' || !preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$emailid) || !$this->checkEmailAvailability($emailid)) 
			$errmsg[]="Email ID";
		if(strlen($mobile) < 10) $errmsg[]="Enter Valid Mobile Number";
		
		if($errmsg)	return $errmsg;
		 	$random_pass=$this->generatePassword();
			$msg="Dear Student,Thankyou for Registering with tuitionroom.com.Your Login ID : {$emailid} Password :{$random_pass}";
			$this->smsUser($mobile,$msg);

			$temp_pwd=base64_encode($random_pass);  	 
			$qry1 = "insert into tbl_users set first_name='$fullname', mobileno='$mobile', email_id='$emailid', password='".$temp_pwd."', usertype='$accept', isactive='T'";
				
			$this->executeQuery($qry1);
			$userid=mysql_insert_id();
			
			// Generate and Store Email Verification ID to be sent in Welcome Mail
			
			$verifyid=md5($userid.$emailid);
			$qry = "update tbl_users set email_verification_id='$verifyid' where slno=$userid";
			$this->executeQuery($qry);
			
			
			// Assign user to this schedule 
			$qry = "update demoschedules set studentid=$userid where  scheduleid=".intval($demoschid);
			$this->executeQuery($qry);

		// Create OTP Storing record
			
			$qry = "insert into tbl_otp_verify set userid=$userid";
			$this->executeQuery($qry);
			$this->sendMoblieVerificationSMS($mobile,$userid,$accept);
			
 				session_name("Student");
				session_start();			
				$_SESSION['email'] = $emailid;
				$_SESSION['uid'] = $userid;		
				$_SESSION['ucat']=$accept;
				$_SESSION['isactive']='T'; // Student active by default
				$_SESSION['isprofilecomplete']='N';
				$_SESSION['ismobileverified']="N";	
				$redirect = "student/MySHome.php";
 			
			
			$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid=$userid, usertype='$accept',login_ts=CURRENT_TIMESTAMP(),datecreated=CURRENT_TIMESTAMP()";
			//echo $logqry;
				$this->executeQuery($logqry);
				
				// Store latest log record id
				 
				
				$wc=file_get_contents("student_welcome_mail.html");
				$wc=str_replace("{useremail}",$emailid,$wc);
				
				$verify_link="http://www.tuitionroom.com/verifyuser.php?{$verifyid}";
				$wc=str_replace("{verifylink}",$verify_link,$wc);
				// Send Mail
				$this->sendMail("support@tuitionroom.com",$emailid,"Welcome To TuitionRoom.Com",$wc);
				$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","Welcome To TuitionRoom.Com",$wc);
 				

			 
			header("Location: {$redirect}");
		 
	}
	


	function verifyEmailId($verifyid)
	{
		$qry = "select slno, email_verified from tbl_users where email_verification_id='$verifyid'";	 
		$res = $this->runQuery($qry);
		
		if($res)
		{
			if($res[0]['email_verified']=="Y")
				return 2;
			else
			{
				$this->executeQuery("update tbl_users set email_verified='Y' where slno=".$res[0]['slno']);
				return 1;
			}
		}else
			return 0;
	}
	
	// For users whose FB login could not retrieve their Email ID, register as normal user
	function registerFBUser($u)
	{
			extract($u);
			session_destroy();
			session_name($usertype);
			session_start();
 			$random_pass=$this->generatePassword();
			$temp_pwd=base64_encode($random_pass);  
			
			$qry = "insert into tbl_users set  email_id='$userid', password='".$temp_pwd."', usertype='$usertype', isactive='T'";
			$this->executeQuery($qry);
			$uid=mysql_insert_id();
			
			// Generate and Store Email Verification ID to be sent in Welcome Mail
			
			$verifyid=md5($uid.$u['userid']);
			$qry = "update tbl_users set email_verification_id='$verifyid' where slno=$uid";
			$this->executeQuery($qry);
			
			// Create OTP Storing record			
			$qry = "insert into tbl_otp_verify set userid=$uid";
			$this->executeQuery($qry);
			
			$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid=$uid, usertype='$usertype', login_ts=CURRENT_TIMESTAMP(), datecreated=CURRENT_TIMESTAMP()";
				$this->executeQuery($logqry);
			// Store latest log record id
			$recsid=mysql_insert_id();
			
			$_SESSION['uid'] = $uid;
			$_SESSION['ucat'] = $usertype;
			$_SESSION['uname'] = '';
			$_SESSION['email'] = $u['userid'];
			$_SESSION['logrecid']=$recsid;
			$_SESSION['isactive']="T";
			$_SESSION['isprofilecomplete']="N"; 	
			$_SESSION['ismobileverified']="N";				
			
				if($usertype=="Student")
					$wc=file_get_contents("student_welcome_mail.html");
				else
					$wc=file_get_contents("teacher_welcome_mail.html");
				$wc=str_replace("{useremail}",$u['userid'],$wc);
				
				$verify_link="http://www.tuitionroom.com/verifyuser.php?{$verifyid}";
				$wc=str_replace("{verifylink}",$verify_link,$wc);
				// Send Mail
				$this->sendMail("support@tuitionroom.com",$u['userid'],"Welcome To TuitionRoom.Com",$wc);
				$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","Welcome To TuitionRoom.Com",$wc);
				
			if($usertype=="Student")
				header("Location: student/MySHome.php");
			else if($usertype=="Teacher")
				header("Location: teacher/MyTHome.php");
	}
	
	function trackFBAdVisitor($remoteaddr)
	{
		$qry = "insert into tbl_facebookad_visits set ipaddr='$remoteaddr'";
		$this->executeQuery($qry);	
		return mysql_insert_id();
	}

	function updateFBAdVisitor($fbadtrackid,$email)
	{
		$this->executeQuery("update tbl_facebookad_visits set emailid='$email' where slno=".intval($fbadtrackid));	
	}
	// Register FB & Gmail Users
	
	function registerSocialMediaUser($user,$media_type)
	{	
	 if($media_type=="FB")
	 { 
	 	if($user->fb_from!='')
		{
			$this->updateFBAdVisitor($user->fbadtrackid,$user->email);
		}
		
	 	if(!$this->checkEmailId($user->email))
		{
			// get learning uid of FB User
			$chqry ="select slno as uid,first_name,sur_name,email_id,usertype,isactive,profileupdate,mobileno_verified from tbl_users where email_id ='".$user->email."'";
			
			$udet = $this->runQuery($chqry);
					 
			// Check previous logout status
				$logdet=$this->getLastLoginDet($udet[0]['uid']);
			
				if($logdet && $logdet[0]['logout_ts']=='')
				{ 
					$qry = "update tbl_userlog set logout_ts=CURRENT_TIMESTAMP(), logout_type='Multiple IP' where slno={$logdet[0][slno]}";
					$this->executeQuery($qry);				
				}
				
				// Check If User Category Is Recored or not
				if($udet[0]['usertype']=='')
				{
					session_unset();
					session_destroy();
					session_name("guest");
					session_start();
					$_SESSION['uid'] = $udet[0]['uid'];
					$_SESSION['user_login_from']  = 'FB'; // detect user logging from FB
					header("Location: AccountType.php");
					die();
				}
				$sesname=$udet[0]['usertype'];
				session_name($sesname);
				session_start();				
					
								
			$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid={$udet[0][uid]}, usertype='{$udet[0][usertype]}', login_ts=CURRENT_TIMESTAMP(), datecreated=CURRENT_TIMESTAMP()";
				$this->executeQuery($logqry);
				// Store latest log record id
				$recsid=mysql_insert_id();
				
			$_SESSION['uid'] = $udet[0]['uid'];
			$_SESSION['ucat']=$udet[0]['usertype'];
			$_SESSION['logrecid']=$recsid;
			$_SESSION['uname'] = $user->name;
			$_SESSION['email'] = $user->email;
			$_SESSION['isactive']=$udet[0]['isactive'];
			$_SESSION['isprofilecomplete']=$udet[0]['profileupdate']; 	
			$_SESSION['ismobileverified']=$udet[0]['mobileno_verified'];				
			$_SESSION['user_login_from']  = 'FB'; // detect user logging from FB
			
			if($udet[0]['usertype']=="Teacher")
			{
				$redirect = "teacher/MyTHome.php";
			}
			else
			{
				$redirect = "student/MySHome.php";
			}
						
		}
		else
		{
			session_unset();
			session_destroy();
			session_name("guest");
			session_start();
			
			// Use $user->name 	 instead of $user->first_name from FB Object 
			$qry = "insert into tbl_users set email_id='".$user->email."' , socialmedia='Y', first_name='".$user->name."', sur_name='".$user->last_name."', isactive='T' ";
			if($user->gender!='')
			{
				if($user->gender=="male") 	
					$qry .= " , gender='M' ";
				else
					$qry .= " , gender='F' ";
			}
			$this->executeQuery($qry);
			
			$uid=mysql_insert_id();
			// Generate and Store Email Verification ID to be sent in Welcome Mail
			
			$verifyid=md5($uid.$user->email);
			$qry = "update tbl_users set email_verification_id='$verifyid' where slno=$uid";
			$this->executeQuery($qry);
			
			// Create OTP Storing record			
			$qry = "insert into tbl_otp_verify set userid=$uid";
			$this->executeQuery($qry);

			$qry = "insert into tbl_users_socialmedia  set media_name='$media_type', uid=$uid, fb_uid='".$user->id."', first_name='".$user->first_name."', last_name='".$user->last_name."', link='".$user->link."', gender='".$user->gender."', birthday='".$user->birthday."', locale='".$user->locale."'";
			$this->executeQuery($qry);
			
			$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid=$uid, usertype='',login_ts=CURRENT_TIMESTAMP(),datecreated=CURRENT_TIMESTAMP()";
			$this->executeQuery($logqry);
						
			// Store latest log record id
			$_SESSION['logrecid']=mysql_insert_id();
			$_SESSION['user_login_from']=$_SESSION['user_reg_from']  = 'FB'; // detect user registered from FB
			$_SESSION['uid'] = $uid;
			$_SESSION['uname'] = $user->name;
			$_SESSION['email'] = $user->email;
			$_SESSION['mymailid']=$user->email;
			$_SESSION['isactive']="T";
			$_SESSION['isprofilecomplete']="N"; 	
			$_SESSION['ismobileverified']="N";				
			
			$redirect = "AccountType.php";	
		}

		return $redirect;
	 }
	 else if($media_type=="GMAIL")
	 {
		if(!$this->checkEmailId($user['email']))
		{ 
			// get learning uid of Gmail User
			$chqry="select slno as uid,first_name,sur_name,email_id,usertype,isactive,profileupdate,mobileno_verified from tbl_users where email_id ='".$user['email']."'";
			 
			$udet = $this->runQuery($chqry);
			 
			// Check previous logout status
				$logdet=$this->getLastLoginDet($udet[0]['uid']);
			 
				if($logdet && $logdet[0]['logout_ts']=='')
				{ 
					$qry = "update tbl_userlog set logout_ts=CURRENT_TIMESTAMP(), logout_type='Multiple IP' where slno={$logdet[0][slno]}";
					$this->executeQuery($qry);				
				}
				
				// Check If User Category Is Recored or not
				if($udet[0]['usertype']=='')
				{
					session_unset();
					session_destroy();
					session_name("guest");
					session_start();
					$_SESSION['uid'] = $udet[0]['uid'];
					 
					header("Location: AccountType.php");
					die();
				}
				$sesname=$udet[0]['usertype'];
				 
				session_destroy();
				session_name($sesname);
				session_start();				
									
			$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid={$udet[0][uid]}, usertype='{$udet[0][usertype]}', login_ts=CURRENT_TIMESTAMP(), datecreated=CURRENT_TIMESTAMP()";
				$this->executeQuery($logqry);
				// Store latest log record id
				$recsid=mysql_insert_id();
				
			$_SESSION['uid'] = $udet[0]['uid'];
			$_SESSION['ucat'] = $udet[0]['usertype'];
			$_SESSION['logrecid']=$recsid;
			$_SESSION['uname'] = $user['name'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['isactive']=$udet[0]['isactive'];
			$_SESSION['isprofilecomplete']=$udet[0]['profileupdate']; 	
			$_SESSION['ismobileverified']=$udet[0]['mobileno_verified'];				
			
			 
			if($udet[0]['usertype']=="Teacher")
			{
				$redirect = "teacher/Socialredirect.php?".http_build_query($_SESSION);

			}
			else
			{
				$redirect = "student/Socialredirect.php?".http_build_query($_SESSION);
			}
			
		}
		else
		{
			session_unset();
			session_destroy();
			session_name("guest");
			session_start();
			$qry = "insert into tbl_users set email_id='".$user['email']."', socialmedia='Y', first_name='".$user['given_name']."', sur_name='".$user['family_name']."', isactive='T'";
			$this->executeQuery($qry);
			
			$uid=mysql_insert_id();  
			// Generate and Store Email Verification ID to be sent in Welcome Mail
			
			$verifyid=md5($uid.$user['email']);
			$qry = "update tbl_users set email_verification_id='$verifyid' where slno=$uid";
			$this->executeQuery($qry);
			
			// Create OTP Storing record			
			$qry = "insert into tbl_otp_verify set userid=$uid";
			$this->executeQuery($qry);
			
			$qry = "insert into tbl_users_socialmedia  set media_name='$media_type', uid=$uid, fb_uid='".$user['id']."', first_name='".$user['given_name']."', last_name='".$user['family_name']."', link='".$user['profile_url']."', gender='".$user['gender']."', birthday='".$user['birthday']."', locale='".$user['locale']."'";
		
			$this->executeQuery($qry);

			$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid=$uid, usertype='',login_ts=CURRENT_TIMESTAMP(),datecreated=CURRENT_TIMESTAMP()";
			$this->executeQuery($logqry);
						
			// Store latest log record id
			$_SESSION['logrecid']=mysql_insert_id();
			$_SESSION['uid'] = $uid;
			$_SESSION['uname'] = $user['given_name'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['isactive']="T";
			$_SESSION['isprofilecomplete']="N"; 	
			$_SESSION['ismobileverified']="N";				
			
			 
			$redirect = "AccountType.php";	
			header("Location: $redirect");	
			die();
		}
		
		return $redirect;
	 }
	 
	}


	// Registration from teachwithus.php
	function teachWithUsRegister($udet)
	{
		$udet=$this->escapeformdata($udet);
		extract($udet);
		$errmsg=array();
 		if($upasswd=='' || strlen($upasswd)<6) $errmsg[]="Enter Valid Password (Min. 6 characters)";
		if($emailid=='' || !preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$emailid) || !$this->checkEmailAvailability($emailid)) 
			$errmsg[]="Email ID";
 		
		if($errmsg)	return 0;
			$classroom_plan=($plan=='')?"F":$plan;
			
			// Allowed special chars like ', " in Password and then encoded
			$temp_pwd=$upasswd;
			
			$qry1 = "insert into tbl_users set email_id='$emailid', password='".base64_encode($temp_pwd)."', classroom_plan='$classroom_plan', isactive='T'";
				
			$this->executeQuery($qry1);
			$userid=mysql_insert_id();
			session_start();
			$_SESSION['uid']=$userid;
			
			// Generate and Store Email Verification ID to be sent in Welcome Mail
			
			$verifyid=md5($userid.$emailid);
			$qry = "update tbl_users set email_verification_id='$verifyid' where slno=$userid";
			$this->executeQuery($qry);
			
			// Create OTP Storing record
			// Temporarily disable mobile verification
/*			$qry = "insert into tbl_otp_verify set userid=$userid";
			$this->executeQuery($qry);
			$this->sendMoblieVerificationSMS($mobile,$userid,$accept);
*/			
			return 1;			
	}



	/** Setting Social Media User Type*/
	function setUserType($fdet)
	{
		extract($fdet);
		$userid = $_SESSION['uid'];
		$mymail = $_SESSION['email'];
		$mynames= $_SESSION['uname'];
		$user_login_from=$_SESSION['user_login_from'];
		$user_reg_from=$_SESSION['user_reg_from'];
 		
		$qry= "update tbl_users set usertype='$accesstype' where slno=$_SESSION[uid]";   
		$this->executeQuery($qry);
		
		$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid=$userid, usertype='$accessType',login_ts=CURRENT_TIMESTAMP(),datecreated=CURRENT_TIMESTAMP()";
				$this->executeQuery($logqry);
				
				// Store latest log record id
				$_SESSION['logrecid']=mysql_insert_id();
		
		if($accesstype=="Teacher")
		{
			$redirect = "teacher/Socialredirect.php";	
			session_name("Teacher");
	  		session_start();
			$_SESSION['uid']=$userid;
			$_SESSION['ucat']="Teacher";
			$_SESSION['uname']=$mynames;
			$_SESSION['email']=$mymail;
			$_SESSION['isprofilecomplete']="N"; 
		}
		else
		{
			$redirect = "student/Socialredirect.php";	
			session_name("Student");
	  		session_start();
			$_SESSION['uid']=$userid;
			$_SESSION['ucat']="Student";
			$_SESSION['uname']=$mynames;
			$_SESSION['email']=$mymail;
			$_SESSION['isprofilecomplete']="N"; 
			$_SESSION['user_login_from']=$user_login_from;
			$_SESSION['user_reg_from']=$user_reg_from;
		}
				if($accesstype=="Student")
					$wc=file_get_contents("student_welcome_mail.html");
				else
					$wc=file_get_contents("teacher_welcome_mail.html");
				$wc=str_replace("{useremail}",$mymail,$wc);
				
			$verifyid=md5($userid.$mymail);
			$qry = "update tbl_users set email_verification_id='$verifyid' where slno=$userid";
			$this->executeQuery($qry);
			
			$verify_link="http://www.tuitionroom.com/verifyuser.php?{$verifyid}";
			$wc=str_replace("{verifylink}",$verify_link,$wc);
			
			// Send Mail
			$this->sendMail("support@tuitionroom.com",$mymail,"Welcome To TuitionRoom.Com",$wc);
			$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","Welcome To TuitionRoom.Com",$wc);

		//print_r($_SESSION);
		header("Location: {$redirect}?".http_build_query($_SESSION));
	}
 	
	
	function activateUserAccount($newregid)
	{
		if(intval($newregid)!='')
		{
			$qry = "select email_id , isactive from tbl_users where slno=$newregid";
			$res = $this->runQuery($qry);
			if($res)
			{
				if($res[0]['isactive']=='F')
				{
					$qry= "update tbl_users set isactive='T' where slno=$newregid";
					$this->executeQuery($qry);
					return 1; // Successfull Activation
				}else
					return 0; // Account is Active
				
			}else
				return -1; // Invalid User Id
		}else
			return -1;	// Invalid User Id	
	}
	
	function getFeaturedTeachers()
	{
		$qry = "select slno as tchid, first_name, photoid from tbl_users where 
				 usertype='Teacher' and
				(first_name != '' || first_name IS NOT NULL) and
				(photoid != '' || photoid IS NOT NULL)
				order by createddate desc limit 0,10";	
		return $this->runQuery($qry);
	}
	
	function getUserByProfileURL($purl)
	{
		$qry = "select * from tbl_users where profile_url='".mysql_real_escape_string($purl)."'";
		return $this->runQuery($qry);
	}

	function getProfileById($uid)
	{
		$qry = "select * from tbl_users where slno=$uid";
		return $this->runQuery($qry);
	}
	
	function getSecurityQuestion($emid)
	{
		$qry = "select secq1, secq2 from tbl_users where email_id='$emid'";
		return $this->runQuery($qry);	
	}
	
	function checkSecurityAns($sq)
	{
		if($sq['index']==1)
			$qry = "select secq1ans from tbl_users where email_id='$sq[userid]'";
		else
			$qry = "select secq2ans from tbl_users where email_id='$sq[userid]'";		
		$sqans = $this->runQuery($qry);
		if($sqans[0]["secq{$sq[index]}ans"]==$sq['secqans'])
			return 1;
		else
			return 0;
	}
	
	function checkMultipleUsersFromSingleIP()
	{
		$qry = "select slno, logout_ts from tbl_userlog where ipaddress='".$this->getRealIpAddr()."' and DATE(login_ts)=CURDATE() order by login_ts desc limit 1"; 
		$res=$this->runQuery($qry);
		if($res && $res[0]['logout_ts']=='')
		{
			/*
				LOGOUT TYPE :
				Single IP - Two users trying to login from same pc
				Multiple IP - Single user tryig to login from different pcs
				Force Logout - Any of above two reasons
			*/
			// Logout the previous user
			$qry = "update tbl_userlog set logout_ts=CURRENT_TIMESTAMP(), logout_type='Single IP' where slno={$res[0][slno]}";
			$this->executeQuery($qry);			
		}
	
	}
	
	

	function getLastLoginDet($uid)
	{
		$qry = "select slno, login_ts, logout_ts, lastpagevisit from tbl_userlog where userid=$uid and DATE(login_ts)=CURDATE() order by login_ts desc limit 1";  
		return $this->runQuery($qry);
	}
	
	function mailUserPassword($userid){
		
 				
			$qry = "select first_name, password from tbl_users where email_id='$userid'";
			$res = $this->runQuery($qry);
			
			if(!$res)
				return 0;
			else
			{
				// SEND PASSWORD MAIL

				$wc=file_get_contents("forgot_password_mail.html");
				$wc=str_replace("{uname}",$res[0]['first_name'],$wc);
				$wc=str_replace("{loginid}",$userid,$wc);
				$wc=str_replace("{passwd}",base64_decode($res[0]['password']),$wc);				
				 
				$this->sendMail("support@tuitionroom.com",$userid,"Your Login Details @ TuitionRoom.Com",$wc);
				return 1;
			}
	}
	/* All requests for Contatct, Demo, Pricing, Launch are stored in single table
	  'UC'=User Contact,'DR'=Demo Request, 'LC'=Launch Class, 'PRT'=Pricing Request Teacher,'PRI'=Pricing Request Institute
	*/
	function mailUserContact($cdet)
	{ 			extract($cdet);
 				$wc=file_get_contents("contact_details_mail.html");
				$wc=str_replace("{uname}",$name,$wc);
				$wc=str_replace("{emailid}",$emailid,$wc);
				$wc=str_replace("{msg}",$query,$wc);				
				
				$qry = "insert into tbl_contact_request set req_type='UC', 
						username='".mysql_real_escape_string($name)."',
						from_emailid='$emailid',
						querymsg='".mysql_real_escape_string($query)."'";
				$this->executeQuery($qry);
				
				$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","New Contact Request",$wc);
	}

	function mailDemoRequest($cdet)
	{ 			extract($cdet);
 				$wc=file_get_contents("demoreq_details_mail.html");
				$wc=str_replace("{uname}",$name,$wc);
				$wc=str_replace("{emailid}",$emailid,$wc);
				$wc=str_replace("{msg}",$query,$wc);				
				$qry = "insert into tbl_contact_request set req_type='DR', 
						username='".mysql_real_escape_string($name)."',
						from_emailid='$emailid',
						querymsg='".mysql_real_escape_string($query)."'";
				$this->executeQuery($qry);
				 
				$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","New Demo Request",$wc);
	}

	function mailClassLaunch($cdet)
	{ 			extract($cdet);
 				$wc=file_get_contents("classlaunch_details_mail.html");
				$wc=str_replace("{uname}",$name,$wc);
				$wc=str_replace("{emailid}",$emailid,$wc);
				$wc=str_replace("{msg}",$query,$wc);				
				$qry = "insert into tbl_contact_request set req_type='LC', 
						username='".mysql_real_escape_string($name)."',
						from_emailid='$emailid',
						querymsg='".mysql_real_escape_string($query)."'";
				$this->executeQuery($qry);
				 
				$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","New Class Launch",$wc);
	}

	function mailPricingRequest($cdet)
	{ 			extract($cdet);
 				$wc=file_get_contents("pricingreq_details_mail.html");
				$wc=str_replace("{from}",$from,$wc);
				$wc=str_replace("{uname}",$name,$wc);
				$wc=str_replace("{emailid}",$emailid,$wc);
				$wc=str_replace("{msg}",$query,$wc);				
				$reqfrom=($from=="Teacher")?"PRT":"PRI";
				$qry = "insert into tbl_contact_request set req_type='$reqfrom', 
						username='".mysql_real_escape_string($name)."',
						from_emailid='$emailid',
						querymsg='".mysql_real_escape_string($query)."'";
				$this->executeQuery($qry);
				 
				$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","New Pricing Request",$wc);
	}


	function logout($logout_type="Success"){
		$logqry="update tbl_userlog set logout_ts=CURRENT_TIMESTAMP(), logout_type='$logout_type' where sessid='".session_id()."' and userid='$_SESSION[uid]'";
		$this->executeQuery($logqry);

		$_SESSION['uname']='';
		$_SESSION['uid']='';
		$_SESSION['ucat']='';
		$_SESSION['logrecid']='';
		$_SESSION['startlimit']='';
		$_SESSION['sucreg']='';
		$_SESSION['email']='';
		$_SESSION['mymailid']='';
		session_destroy();
	}	
	

	
}	
	

?>