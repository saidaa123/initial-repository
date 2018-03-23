<? require_once("troomguest.inc.php");

class Course extends DBCon
{
		
		function __construct()
		{
			parent::__construct();	
		}
		
		function getCourses()
		{
			// Later get subject wise fee for this course subject
			// Upcoming Courses
			$qry = "select c.*, u.first_name, u.profile_url, u.subjects, u.qualification, u.profession, u.teach_exp, u.photoid, u.segment, u.fees, u.profile_url
			 
				    from tbl_course c inner join tbl_users u 
					on u.slno=c.tchid where CURDATE() < end_date";	
			return $this->runQuery($qry);		
		}
	
}


	/*class Course extends DBCon 
	{
		function __construct()
		{
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

		function getRunningCourses()
		{
			$qry = "select u.first_name, u.email_id, u.mobileno, u.photoid, c.* from tbl_course c inner join tbl_users u on u.slno=c.tchid where CURRENT_DATE() between start_date and end_date";	  
			return $this->runQuery($qry);
		}

		function getUpcomingCourses()
		{
			$qry = "select u.first_name, u.email_id, u.mobileno, u.photoid, c.* from tbl_course c inner join tbl_users u on u.slno=c.tchid where CURRENT_DATE() < start_date and DATEDIFF(start_date,CURRENT_DATE()) <= 10";	  
			return $this->runQuery($qry);
		}
		
		
		function registerForCourse($udet)
		{
			extract($udet);
			$temp_pwd=base64_encode($upasswdcs);  	 
			$qry1 = "insert into tbl_users set email_id='$emailidcs', password='".$temp_pwd."', usertype='Student', isactive='T'";
				
			$this->executeQuery($qry1);
			$userid=mysql_insert_id();
						
			// Generate and Store Email Verification ID to be sent in Welcome Mail
			
			$verifyid=md5($userid.$emailidcs);
			$qry = "update tbl_users set email_verification_id='$verifyid' where slno=$userid";
			$this->executeQuery($qry);
			
			
			// Assign user to Course
			$qry = "insert into tbl_course_students set uid=$userid, csid=".intval($csid);
			$this->executeQuery($qry);

		 
			
 				session_name("Student");
				session_start();			
				$_SESSION['email'] = $emailidcs;
				$_SESSION['uid'] = $userid;		
				$_SESSION['ucat']="Student";
				$_SESSION['isactive']='T'; // Student active by default
				$_SESSION['isprofilecomplete']='N';
				$_SESSION['ismobileverified']="N";	
				$redirect = "student/MySHome.php";
 			
			
			$logqry="insert into tbl_userlog set sessid='".session_id()."', ipaddress='".$this->getRealIpAddr()."', userid=$userid, usertype='Student',login_ts=CURRENT_TIMESTAMP(), datecreated=CURRENT_TIMESTAMP()";
			//echo $logqry;
				$this->executeQuery($logqry);
				
				// Store latest log record id
				 
				
				$wc=file_get_contents("student_welcome_mail.html");
				$wc=str_replace("{useremail}",$emailidcs,$wc);
				$verify_link="https://www.tuitionroom.com/verifyuser.php?{$verifyid}";
				$wc=str_replace("{verifylink}",$verify_link,$wc);
				// Send Mail
				$this->sendMail("support@tuitionroom.com",$emailidcs,"Welcome To TuitionRoom.Com",$wc);
				$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","Welcome To TuitionRoom.Com",$wc);
			 
				header("Location: {$redirect}");
		 				
		}
	
	}*/
?>