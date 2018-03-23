<?php

/*define("HOSTNAME","localhost");
define("USERNAME","tuitionroom_user");
define("PASSWORD","tutionroom");
define("DBNAME","tuitionroom_db");
*/
define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DBNAME","tuitionroom_db");


define("SMTP","localhost");
define("SMTP_PORT","25");
define("SENDMAIL_FROM","idaateam@idaa.in");

class DBCon{
	
	function __construct(){
		
		$con=mysql_connect(HOSTNAME,USERNAME,PASSWORD);
		if($con)
			mysql_select_db(DBNAME);
		else
			die(mysql_error());
	}
	
 // Two Template Functions
 
 // Runs a select Query

 function runQuery($sql){ 
//print $sql;
 	$res=mysql_query($sql); 
	$i=0;
	
	$results=array();

	while($row=mysql_fetch_assoc($res))
		$results[$i++]=$row;
	
	mysql_free_result($res);
	
	return $results;
 }
 
 
// Runs an UPDATE, INSERT or DELETE

 function executeQuery($sql){ 
	
		//print $sql;
		if (!($rsinfo=mysql_query($sql))) {
			$this->displayError("An error occurred while updating the database: $sql");
			die();
		}
		return mysql_affected_rows();
}


function displayError($msg) {
		print "<br><br>";
		print "<table align=center bgcolor=#000000 cellspacing=1 cellpadding=10>\n";
		print "<tr bgcolor=#ff9900><td><font size=4 color=#ff0000>$msg<br>Please click 'Back' on your browser and retry</font>";
		print "<br><br>".mysql_error()."</td></tr>\n";
		print "</table>\n";
}

function getNumRows($qry){

 	if(!($res=mysql_query($qry))){
		$this->displayError("There is an error in your Query: $qry");
		die();
	}
	
	return mysql_num_rows($res);
}

	
function escapeformdata($fdata){
	
 		
		foreach($fdata as $key=>$val)
		{
			if(!is_array($val))
				$fdata[$key]=mysql_real_escape_string(trim(strip_tags($val)));
		}
 	return $fdata;
}			

function fixQuote($str){
	$cstr=$str;
	$invalid=array("'",";","=","&","!","#","$","%","^","(",")");
	$tot=count(str_split($str)); 
	for($i=0;$i<$tot;$i++){ 
		if(in_array($str[$i],$invalid))
			$cstr=str_replace($str[$i],"",$cstr); 
	}
	return $cstr;
}



function ValidateEmail($EmlStr)
{
	$Str = $EmlStr;
	if($EmlStr = "" || strlen($EmlStr) < 5)
		return 0;
	else
	{
		$OffSet = explode("@",$Str);
		if(count($OffSet) != 2)
			return 0;
		else
		{
			$HigherOffSet = $OffSet[1];
			$ExploHgrOst = explode(".",$HigherOffSet);
			if(count($ExploHgrOst) > 1)
			{
				return 1;
			}
			else
				return 0;
		}
	}
}

 // Two Template Functions End	
 
function generatePassword(){

	$randpasswd="aBbCc8AdW@9E$7XeDfG#gYIhFiZJjHkKl!mOnPo1pQq2rRs%3tuS4vTw5Ux6VyzLMNOPQ";
	$maxlen=strlen($randpasswd);
	for($i=0;$i<8;$i++)
		$randstr.=$randpasswd[rand($i,$maxlen)];
	return $randstr;
}

function generateSMSCode(){

	$randpasswd="0123456789";
	$maxlen=strlen($randpasswd)-1;
	for($i=0;$i<4;$i++)
		$randstr.=$randpasswd[rand($i,$maxlen)];
	return $randstr;
}
 
 
    function sendMail($from,$to,$subj,$msg)
 {
	 require_once('D:/hshome/idaalearning/idaalearning.com/PHPMailer_v5.1/class.phpmailer.php');
	 
	$mail             = new PHPMailer();
	//$body             = file_get_contents('test.html');
	//$body             = eregi_replace("[\]",'',$body);
	 
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPAuth   = true;                  		// enable SMTP authentication
	// $mail->SMTPSecure = "ssl";                 		// sets the prefix to the servier
	$mail->Host       = "mail.tuitionroom.com";      		// sets MAIL as the SMTP server
	$mail->Port       = 25;                  	 	// set the SMTP port for the GMAIL server
	$mail->Username   = "support@tuitionroom.com";  	// GMAIL username
	//$mail->Password   = 'icall_123\$';		// GMAIL password
	$mail->Password   = "Hf8ux*90";		// GMAIL password 
	 
	$mail->SetFrom($from, 'TuitionRoom.Com');
	 
	$mail->Subject    = $subj;
	 
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	 
	$mail->MsgHTML($msg);
	 
	$address = $to;
	$mail->AddAddress($address, "To Name");
	// Disable mail error messages
	ob_start();
	$mail->Send();
	ob_end_clean();
	
/*	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  echo "Message sent!";
	}
*/

 }

function smsUser($cont,$msg)
 {
			$param="User=idaalearning&passwd=bestidaa&mobilenumber={$cont}&message={$msg}&sid=ICALL&
mtype=N&DR=Y";			
			
			
			$url ="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
			
			$ch = curl_init($url);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$param);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			
			$curl_scraped_page = curl_exec($ch);
			
			curl_close($ch);
}


}

 

class Hits extends DBCon{

function __construct(){
		parent::__construct();
	}
	
function inserthits()
{
			$qry = "replace into tbl_pagecounter set hitip='$_SERVER[REMOTE_ADDR]'"; 
			$this->executeQuery($qry);
}

function gethitcount()
{
	$hqry = "select count(*) as hit from tbl_pagecounter";	
		return $this->runQuery($hqry);
}	
}

 
// GENERAL CLASS 

class Contact extends DBCon{

	function __construct(){
		parent::__construct();
	}
	
 
	function addContactReq($cdet){
		$cdet=$this->escapeformdata($cdet);
		
		extract($cdet);
		
		$errmsg=array();
		
		if($uname=='') $errmsg[]="Name";	
		if(!$this->ValidateEmail($emailid) or ! preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$emailid)) $errmsg[]="Email Id";
		if($msg=='') $errmsg[]="Query";		

		if($errmsg) return $errmsg;
		
			
			// MySQL INJECTION HANDLER
			$uname=$this->fixQuote($uname);
			$msg=$this->fixQuote($msg);
			
			$qry = "insert into tbl_contact_request set username='$uname', from_emailid='$emailid', contactno='$contno', querymsg='$msg'";
			$this->executeQuery($qry);
			
		// SEND WELCOME MAIL
		
		$wc=file_get_contents("mailcontact.html");
		$wc=str_replace("{uname}",$uname,$wc);
		
		ini_set("SMTP",SMTP);
		ini_set("smtp_port",SMTP_PORT);
		ini_set("sendmail_from",SENDMAIL_FROM);
		
		$headers="Content-Type: text/html\r\n";
		@mail($emailid,"Welcome to Live ClassRoom",$wc,$headers);		
		
		return 1;
 
 	}
	
		 function addFeedback()
	 {
	 	foreach($_POST as $key=>$val)
			$_POST[$key]=$this->fixQuote($val);
		extract($_POST);
		$query=nl2br($query); 

		//$qry = "select count(*) as tot from tbl_feedback where  emailid='$emailid' or contactno='$phone'";	
		//$res=$this->runQuery($qry);
		//if($res[0]['tot']==0)
		//{
		
		$qry = "insert into tbl_feedback set username='$fbkuname', emailid='$fbkemailid', contactno='$fbkmobile', feedback='$fbkquery'";	
		$this->executeQuery($qry);
$msg=<<<HTML
		<p>Mr/Mrs/Ms. {$fbkuname},</p>
		<p>Thank you for submitting Feedback at Tuitionroom.Com. Our team will work on the Feedback and reply you.</p>
		<p>Feel free to email us to 
		<a href='mailto:support@tuitionroom.com'>support@tuitionroom.com</a> or contact us at 040-66361791,040-23418604.<br><br>Regards,<br>The TuitionRoom Team<br><a href='http://www.tuitionroom.com' target='_blank'>http://www.tuitionroom.com</a> </p>
HTML;

$fb=<<<HTML
		<p><strong>Name:</strong> {$fbkuname},</p>
		<p><strong>Email ID:</strong> {$fbkemailid}</p>
		<p><strong>Contact No:</strong> {$fbkmobile}</p>
		<p><strong>Feedback:</strong> {$fbkquery}</p>
HTML;
// Mail feedback details
		
		$this->sendMail("support@tuitionroom.com","support@tuitionroom.com","Tuitionroom.com  Feedback",$fb);
		$this->sendMail("support@tuitionroom.com",$fbkemailid,"Tuitionroom.com  Feedback",$msg);
/*		$this->sendMail("sales@idaalearning.com","rama@idaalearning.com","idaalearning.com  Feedback",$fb);		
		$this->sendMail("sales@idaalearning.com","stocks@idaalearning.com","idaalearning.com  Feedback",$fb);		
*/
	// SMS User		
		//$msg = $name.",".$phone.",".$query;			
		//$this->smsUser("9392440243",$msg);
		
		
		//}
		
	 }



}

class Search extends DBCon
{
	
	
		function getBoardInfo($board)
		{
			// get all possible subjects and classes for this board
			
			$qry1 = "select CHAR_LENGTH(segment) as slen, segment from tbl_users where usertype='Teacher' and board like '%$board%' order by slen desc limit 0,1";	
			$qry2 = "select CHAR_LENGTH(subjects) as slen, subjects from tbl_users where usertype='Teacher' and board like '%$board%' order by slen desc limit 0,1";	
			$res=array();
			$res1=$this->runQuery($qry1);
			$res2=$this->runQuery($qry2);
			return array($res1[0]['segment'],$res2[0]['subjects']);
		}
		// FT - should be choosen by teacher and also admin
		
		function getFeaturedTeachers()
		{
			$qry = "select city_name, profile_url, first_name, photoid,subjects,qualification from tbl_users u inner join tbl_cities c on u.location=c.cityid where photo_app = 'Y' and photoid IS NOT NULL and photoid != '' and is_featured_teacher = 'Y' and featured_teacher_approval='Y'  order by ft_approved_on desc limit 0,30";	 
			return $this->runQuery($qry);
		}
		
		function isTutorOnline($tid)
		{
			// allow session timeout duration - 24*60
			$qrys = "SELECT * FROM `tbl_userlog` WHERE userid = ".intval($tid)." and DATE(login_ts)=CURDATE() and TIMEDIFF(CURTIME(), 	TIME(lastpagevisit_timestamp)) < 1440 and logout_ts IS NULL ";  
			return $this->runQuery($qrys);
		}
		function getTotalRowsInSearch()
		{
			// This query must be called immediately after your search query 
			
			$res = $this->runQuery("select FOUND_ROWS() as tot");
			return $res[0]['tot'];
		}
	
		// currently running code
		function searchTeachersTest($key='',$subj='',$sclass='',$board='')
		{
				$qry = "select CHAR_LENGTH(u.about_user) as userlen,  u.slno as tchid, photo_app, aboutuser_app, profile_url, about_user, first_name, segment, subjects, qualification, teach_exp, tut_option, fees,  photoid ";
				$qry .= " from tbl_users u ";
				$qry .= " where u.slno != 220 and u.usertype='Teacher' and isactive='T' and profileupdate='Y' ";
			if($key!='')
			{
				$key=$this->fixQuote($key);
				$keys1=$keys2=array();
				 
				if(strpos($key,",") !== false) $keys1=explode(",",$key);
				if(strpos($key," ") !== false) $keys2=explode(" ",$key);
				if(count($keys1)>0 || count($keys2)>0)
					$keys=array_unique(array_merge($keys1,$keys2));
				else if($key!='')
					$keys[]=$key;
	
				$ktot=count($keys);
				
	
		
				if($ktot)
				{
					//$qry .= " and Match(segment, subjects) Against('".implode(",",$keys)."')";
					$seg=$subj=array();
					for($k=0;$k<$ktot;$k++)
					{
						$seg[]="segment like '%".$keys[$k]."%'";
						$subj[]="subjects like '%".$keys[$k]."%'";
					}
	
					$qry .= " and (".implode(" or ",$seg)." OR ".implode(" or ",$subj).")";
				} 
					
					
			}else if($subj != '' || $sclass != '' || $board != '')
			{
				if($subj!='')
					$qry .= " and subjects like '%$subj' ";
				if($sclass!='')
					$qry .= " and segment like '%$sclass' ";
				if($board!='')
					$qry .= " and board like '%$board' ";
			}
				
				$qry .= " order by  modifieddate desc";
				//echo $qry;
				return $this->runQuery($qry);
		}

		function getMinFee($tchid)
		{
			$fee=$this->runQuery("select MIN(fees_persession) as fees from tbl_fees_subjects where tchid=$tchid group by tchid");
			return $fee[0]['fees'];
		}
		
		
		function filterSearchTest($subj,$board,$grade)
		{
		  // Active Login Users on top -- only with photo
		  $qry = "select CHAR_LENGTH(u.about_user) as userlen, u.slno as tchid, photo_app, aboutuser_app, profile_url, about_user, first_name, 
				segment, subjects, qualification, teach_exp, tut_option, fees, photoid , Max(ul.login_ts) logints, Max(ul.lastpagevisit_timestamp) lastpagets
				from tbl_users u inner join tbl_userlog ul on ul.userid=u.slno
				where u.slno != 220 and u.usertype='Teacher' and isactive='T' and profileupdate='Y' and photoid is not null and photoid != '' "; 
				
			if(count($subj)>0)
			{
				$qry .= " and (subjects like '%".implode("%' or subjects like '%",$subj)."%')";
			} 
			if(count($board)>0)
			{
				$qry .= " and (board like '%".implode("%' or board like '%",$board)."%')";
			} 
			if(count($grade)>0)
			{
				$qry .= " and (segment like '%".implode("%' or segment like '%",$grade)."%')";
			} 
				
				$qry .= " group by ul.userid order by logints  DESC ";
				
			// New reg. users on top
/*			$qry = "select CHAR_LENGTH(u.about_user) as userlen,  u.slno as tchid, photo_app, aboutuser_app, profile_url, about_user, first_name, segment, subjects, qualification, teach_exp, tut_option, fees,  photoid ";
				$qry .= " from tbl_users u ";
				$qry .= " where u.slno != 220 and u.usertype='Teacher' and isactive='T' and profileupdate='Y' ";
			if(count($subj)>0)
			{
				$qry .= " and (subjects like '%".implode("%' or subjects like '%",$subj)."%')";
			} 
			if(count($board)>0)
			{
				$qry .= " and (board like '%".implode("%' or board like '%",$board)."%')";
			} 
			if(count($grade)>0)
			{
				$qry .= " and (segment like '%".implode("%' or segment like '%",$grade)."%')";
			} 
				
				$qry .= " order by  modifieddate desc";
*/				//echo $qry;
				return $this->runQuery($qry);
		}

	
	
	
		function searchTeachers($key)
		{
			$key=$this->fixQuote($key);
			$keys1=$keys2=array();
			 
			if(strpos($key,",") !== false) $keys1=explode(",",$key);
			if(strpos($key," ") !== false) $keys2=explode(" ",$key);
			
			//print_r($keys1); print_r($keys2);
			if(count($keys1)>0 || count($keys2)>0)
				$keys=array_unique(array_merge($keys1,$keys2));
			else if($key!='')
				$keys[]=$key;

			$ktot=count($keys);
			
			// Exclude Demo Teacher from search results(teacher@idaa.in , Userid: 220)
			// SQL_CALC_FOUND_ROWS to store the total num of rows without limit 
			
//			$qry = "select  slno as tchid, profile_url, about_user, first_name, segment, subjects, qualification, teach_exp, tut_option, fees,  photoid from tbl_users where slno != 220 and usertype='Teacher' and isactive='T' and profileupdate='Y' and ";
			$qry = "select CHAR_LENGTH(u.about_user) as userlen,  u.slno as tchid, photo_app, aboutuser_app, profile_url, about_user, first_name, segment, subjects, qualification, teach_exp, tut_option, fees,  photoid ";
			$qry .= " , MAX(g.slno) as logid, MAX(g.lastpagevisit_timestamp) as visit_ts ";
			$qry .= " from tbl_users u ";
			$qry .= " inner join tbl_userlog g on u.slno=g.userid ";
			$qry .= " where u.slno != 220 and u.usertype='Teacher' and isactive='T' and profileupdate='Y' ";
			
			/*if($_POST['srchcat']!='all')
				$qry .= " cid=$_POST[srchcat] and ";*/

		// The fulltext index(in table structure) should contain exactly the same number of columns, in same order as mentioned in MATCH clause.
		// With Query Expansion, it performs a search again but based on the relevant words instead the original keywords provided by the users.
			if($ktot)
			{
//				$qry .= " and Match(profile_url, about_user,  first_name, segment, subjects, qualification, board) Against('".implode(",",$keys)."' WITH QUERY EXPANSION)";
				//$qry .= " and Match(profile_url, about_user,  first_name, segment, subjects, qualification, board, email_id) Against('".implode(",",$keys)."')";
				$qry .= " and Match(segment, subjects) Against('".implode(",",$keys)."')";
/*			    $qry .= "(";
				for($i=0;$i<$ktot;$i++)
				{
					$qry .= "segment like '%{$keys[$i]}%' or subjects like '%{$keys[$i]}%' or board like '%{$keys[$i]}%'";
				    if($i!=($ktot-1))
						$qry .= " or ";
				}
				$qry .= ")";
*/			} 
				
				$qry .= " group by g.userid order by  visit_ts desc, userlen desc , photoid desc";
				//$qry .= "order by userlen desc ";
				//echo $qry;
				return $this->runQuery($qry);
		}

		function newSearchTeachers1($key)
		{	
			// get latest logged in users without searching in about_user field
			$key=$this->fixQuote($key);
			$keys1=$keys2=array();
			 
			if(strpos($key,",") !== false) $keys1=explode(",",$key);
			if(strpos($key," ") !== false) $keys2=explode(" ",$key);
			
			//print_r($keys1); print_r($keys2);
			if(count($keys1)>0 || count($keys2)>0)
				$keys=array_unique(array_merge($keys1,$keys2));
			else if($key!='')
				$keys[]=$key;

			$ktot=count($keys);
			$qry = "select CHAR_LENGTH(u.about_user) as userlen,  u.slno as tchid, photo_app, aboutuser_app, profile_url, about_user, first_name, segment, subjects, qualification, teach_exp, tut_option, fees,  photoid ";
			$qry .= " , MAX(g.slno) as logid, MAX(g.lastpagevisit_timestamp) as visit_ts ";
			$qry .= " from tbl_users u ";
			$qry .= " inner join tbl_userlog g on u.slno=g.userid ";
			$qry .= " where u.slno != 220 and u.usertype='Teacher' and isactive='T' and profileupdate='Y' ";
			
 			if($ktot)
			{
 				$qry .= " and Match(profile_url, first_name, segment, subjects, qualification, board) Against('".implode(",",$keys)."')";
 			} 
				
				$qry .= " group by g.userid order by visit_ts desc, userlen desc ";
				return $this->runQuery($qry);
		}

		function newSearchTeachers2($key,$exclude_uids)
		{	
			// searching only in about_user field excluding users from prev search results 
			$key=$this->fixQuote($key);
			$keys1=$keys2=array();
			 
			if(strpos($key,",") !== false) $keys1=explode(",",$key);
			if(strpos($key," ") !== false) $keys2=explode(" ",$key);
			
			//print_r($keys1); print_r($keys2);
			if(count($keys1)>0 || count($keys2)>0)
				$keys=array_unique(array_merge($keys1,$keys2));
			else if($key!='')
				$keys[]=$key;

			$ktot=count($keys);
			$qry = "select   u.slno as tchid, photo_app, aboutuser_app, profile_url, about_user, first_name, segment, subjects, qualification, teach_exp, tut_option, fees,  photoid ";
			$qry .= " from tbl_users u ";
			$qry .= " where u.slno != 220 and u.usertype='Teacher' and isactive='T' and profileupdate='Y' ";
	
	       for($i=0;$i<$ktot;$i++)
			$qry .= " and about_user like '%".$keys[$i]."%'";
				
			$qry .= " group by g.userid order by visit_ts desc, userlen desc ";
				return $this->runQuery($qry);
		}

		function filterTeachers($sdet)
		{
			// Exclude Demo Teacher from search results(teacher@idaa.in , Userid: 220)
			extract($sdet);
			$qry = "select CHAR_LENGTH(u.about_user) as userlen,  u.slno as tchid, photo_app, aboutuser_app, profile_url, about_user, first_name, segment, subjects, qualification, teach_exp, tut_option, fees,  photoid ";
			$qry .= " , MAX(g.slno) as logid, MAX(g.lastpagevisit_timestamp) as visit_ts ";
			$qry .= " from tbl_users u ";
			$qry .= " inner join tbl_userlog g on u.slno=g.userid ";
			$qry .= " where u.slno != 220 and u.usertype='Teacher' and isactive='T' and profileupdate='Y' ";

/*		$qry = "select  u.slno as tchid, photo_app, aboutuser_app, profile_url, about_user, first_name, segment, subjects, qualification, teach_exp, tut_option, fees,  photoid, MAX(g.slno) as logid, MAX(g.lastpagevisit_timestamp) as visit_ts from tbl_users u 
			inner join tbl_userlog g on u.slno=g.userid
			where  u.slno != 220 and u.usertype='Teacher' and isactive='T' and profileupdate='Y' ";
*/ 			
			if($stdclass!='') 
				$qry .= " and segment like '%$stdclass%' ";
				
			if($subject !='')		
				$qry .= " and subjects like '%$subject%' ";		
			
			if($board !='')		
				$qry .= " and board like '%$board%' ";			
			 			
			$qry .= " group by g.userid order by  visit_ts desc, userlen desc , userlen desc";
			
			//echo $qry;
				return $this->runQuery($qry);
		}


}


?>