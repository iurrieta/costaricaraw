<?php
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
 require_once("..\visitor_common.php");
else
 require_once("../visitor_common.php");

 require_once("panel_functions.php");
 
	$user_id=$identity['SESSIONID'];
	// get the info of this user.. 
  $query = "SELECT * FROM livehelp_users WHERE sessionid='".$identity['SESSIONID']."'";	
  $people = $mydatabase->query($query);
  $people = $people->fetchRow(DB_FETCHMODE_ASSOC);  
  $myid = $people['user_id'];
  $channel = $people['onchannel'];
  $isnamed = $people['isnamed'];
  $user_name=$people['username'];
  $displayname=$people['displayname'];
  $sessionid=$people['sessionid'];
  $sessiondata=$people['sessiondata'];
  
  $aminute = mktime ( date("H"), date("i")-1, date("s")-30, date("m"), date("d"), date("Y")+1 );
  $expires = date("YmdHis",$aminute);
	$lastaction = date("YmdHis");


// Get the Session :
$mysession = getsession($sessiondata);
   

//sessionSet
//-----------------------------------------------------------------------------------------------
if($_POST[func]=="sessionSet") {

   $mysession['tab'] = $mysession['tab'] . "," . $_POST['tabID'];
   $tab = $_POST['tabID'];
	 $mysession[$tab] = $_POST['tabTitle'];
	
	//Popup session set on popup calls
	savesession($mysession);
	exit;
}


//-----------------------------------------------------------------------------------------------
if($_POST[func]=="sessionGet") {
//if(1==1){
 
	$tabArray = split(",", $mysession['tab']);
	for($i=0; $i<sizeof($tabArray); $i++) {
		  $tabs=$tabs . "," . $mysession[$tabArray[$i]];
	}
	

   
	$tabs=trim($tabs, ",");
	//Disable because session are not getting destroyed for some odd reason.
  echo json_encode(array("tab"=>"$tabs", "openPop"=>"$mysession[openPop]"));

 
	
  //echo '-';
  exit;
}

//-----------------------------------------------------------------------------------------------
if($_POST[func]=="sessionKill") {
	unset($mysession[$_POST['elementID']]);
	savesession($mysession); 
	stopchat($sessionid);
  
	exit;
}



//removePopsSession
//-----------------------------------------------------------------------------------------------
if($_POST[func]=="removePopsSession") {
	unset($mysession['openPop']);
	savesession($mysession);
	exit;
}

if($_POST[func]=="updateBar") {
			
			//Check for waiting chats
			$query = "SELECT * FROM livehelp_users WHERE user_id='".intval($myid)."'";
      $result = $mydatabase->query($query); 
	    $row = $result->fetchRow(DB_FETCHMODE_ASSOC);
			
			if($row['sessiondata'] != "") {
        $sdata_split = split('=', $row['sessiondata']);
        if($sdata_split[0]=="invite" && $row['status']!='chat') {
          $query3="SELECT username,displayname FROM livehelp_users WHERE user_id='".intval($sdata_split[1])."'";
          $result3 =$mydatabase->query($query3);
  			  $row3 = $result3->fetchRow(DB_FETCHMODE_ASSOC);
          $RemoveSessiondata = "1";
        }
      }
			
			//Check for new text
			$query = "SELECT saidfrom FROM livehelp_messages WHERE saidto='$myid' AND timeof>'".$row['chataction']."'";
			$result2 =  $mydatabase->query($query); 
		  $row2 = $result2->fetchRow(DB_FETCHMODE_ASSOC);
			
			$TabID = GetUser($row2['saidfrom']);
        
			$flashTab="EmptyData";
				$tabArray = split(",", $mysession['tab']);
				for($i=0; $i<sizeof($tabArray); $i++) {
					if($mysession[$tabArray[$i]]==$TabID) {
						$flashTab=$tabArray[$i];
						//$flashTab= $tabArray[$i]."-".$flashtab;
					}
					//$flashTab= 'test';
				}



			//get if operator is available or not
			$status = "Live Help Offline ";
			$op_count=0;
			$query = "SELECT * FROM livehelp_users WHERE isoperator='Y' AND status='chat'";
			$result = $mydatabase->query($query);
	    while($row = $result->fetchRow(DB_FETCHMODE_ASSOC)) {
        $status="LIVE SUPPORT ONLINE !";
        $op_count=$op_count+1;
      }
      
      $tabsopen = count($tabArray);
			$thisuser = $row3['username'];
			echo json_encode(array("status"=>"$status ($op_count)","tabsopen"=>"$tabsopen","waiting"=>"$thisuser", "flash"=>"$flashTab", "flashWho"=>"$TabID"));
			
			//Update that user is still active
			if($RemoveSessiondata==1){
			   $query="UPDATE livehelp_users SET lastaction='$lastaction', sessiondata='sp_status=invited', chataction='$lastaction' WHERE user_id='$myid'";
      }else{
			   $query="UPDATE livehelp_users SET lastaction='$lastaction', chataction='$lastaction' WHERE user_id='$myid'";
			}
	    $mydatabase->query($query); 
 

			savesession($mysession);
		exit;
}

//getChat
//-----------------------------------------------------------------------------------------------
if($_POST[func]=="getChat") {

	 $query="SELECT * FROM livehelp_messages WHERE typeof='' AND channel='$channel' ORDER by timeof DESC";
	 $result = $mydatabase->query($query); 
	 while ($row = $result->fetchRow(DB_FETCHMODE_ASSOC)) {
	  if($row['saidfrom']==$myid){$saidfrom="<span style='color: blue;'><b style='font-weight: bold; text-transform: uppercase;'>Me:</b> ";}else{$saidfrom="<span style='color: red;'><b style='font-weight: bold; text-transform: uppercase;'>".GetUser($row['saidfrom']).":</b> ";}
    $message = "$saidfrom ". $row['message'] . "<br />".$message."</span>";
   }
	
	echo json_encode(array("html"=>"$message", "newChat"=>"new"));
    	savesession($mysession);
		exit;
}


//clearChat
//-----------------------------------------------------------------------------------------------
if($_POST[func]=="clearChat") {
	//$query="UPDATE sp_chat SET expire='".time()."', chat='' WHERE user1='$_POST[spanel_user]' AND user2 = '$_POST[user2]'";
	//		$result = QueryMysql($query);
			exit;
}


//sendChat
//-----------------------------------------------------------------------------------------------
if($_POST[func]=="sendChat") {
			$_POST[text] = trim($_POST[text], "<br />");
			$_POST[text] = trim($_POST[text], "\n");
			$_POST[text] = trim($_POST[text], "\r");
      $SendText = htmlspecialchars($_POST[text]);
      
      //GetAdminID
      $query = "SELECT user_id FROM livehelp_users WHERE username='".$_POST['user2']."'";
      $result = $mydatabase->query($query); 
	    $row = $result->fetchRow(DB_FETCHMODE_ASSOC);
 
      
      //message	channel	timeof	saidfrom	saidto
      $query = "INSERT INTO livehelp_messages (message,channel,timeof,saidfrom,saidto) VALUES ('$SendText', '$channel', '$lastaction', '$myid', '".$row['user_id']."')";
      $mydatabase->query($query); 
	 

	exit;
}



//updateStatus
//-----------------------------------------------------------------------------------------------
if($_POST[func]=="updateStatus") {
			//$query="UPDATE sp_user SET timestamp='".time()."', status='$_POST[status]' WHERE user='$_POST[spanel_user]'";
			//$result = QueryMysql($query);
			exit;
}


//-----------------------------------------------------------------------------------------------
if($_POST['func']=="goTab") {
	$mysession['openPop'] = "goTab";
	include('menu.inc');
	$dispHTML="<span style='padding-left:15px'>Change Username<br />$MenuInc</span>";
	  
	
	
	$leftPop = $_POST['leftTab'];
	$width= "150";
	$height= "auto";
	$justify="left";
}
 

//-----------------------------------------------------------------------------------------------
if($_POST['func']=="dynamicPop") {
//if(1==1) {
	//Get Operators ID
	$query = "SELECT * FROM livehelp_users WHERE username='".$_POST['tabTitle']."' AND isoperator='Y'";
 
	      $result = $mydatabase->query($query); 
	    $row = $result->fetchRow(DB_FETCHMODE_ASSOC);
	    
 
	 $op_id = $row[0];
	 
	 //initiate chat  CSLH needs updating for this.
	 //TODO: if sessiondata if sp_status=invited then activate chat
	 //$query="SELECT sessiondata FROM livehelp_users WHERE user_id='$myid'";
	 //$result3 = QueryMysql($query);
	 //$row3 = mysql_fetch_row($result3);
	 //if($row3[0]=="sp_status=invited"){
	 //id	user_id	channel	userid	statusof	startdate	bgcolor	txtcolor	channelcolor	txtcolor_alt
    //  //39	1	152	3001	 	0	000000	600642	FEFDCD	206222
    //  $query = "INSERT INTO livehelp_operator_channels (user_id,channel,	userid,	startdate,	bgcolor,	txtcolor,	channelcolor,	txtcolor_alt) VALUES ('0','$channel','$myid','0','000000','600642','FEFDCD','206222')";
		//	$result = QueryMysql($query);	  
      
   //}
	 
	 $channel = createchannel($myid);
	 $query="UPDATE livehelp_users SET isnamed='Y', jsrn='2', chattype='', department='".intval($_POST['cslhDept']) ."', onchannel='".intval($channel)."', askquestions='N', lastaction='$lastaction', chataction='$lastaction', status='chat' WHERE user_id='".intval($myid)."'";
   $mydatabase->query($query); 

	 
	 //$op_id $channel $myid
	 $query2="SELECT * FROM livehelp_messages WHERE channel='$channel' AND typeof='' ORDER by timeof DESC";
   $result2 = $mydatabase->query($query2); 
	  while($row2 = $result2->fetchRow(DB_FETCHMODE_ASSOC)){
	  if($row['saidfrom']==$myid){
	  	 $saidfrom="<span style='color: blue;'><b style='font-weight: bold; text-transform: uppercase;'>Me:</b> ";
	  }else{
	  	 $saidfrom="<span style='color: red;'><b style='font-weight: bold; text-transform: uppercase;'>".GetUser($row['saidfrom']).":</b> ";
	  }
    $message = "$saidfrom ".$row['message']."<br />".$message."</span>";
   }
	    
	$dispHTML="<div class='chatbox' id='".$_POST['ChatBoxID']."' >$message</div><center><textarea class='chatType' onkeyup=\"sendChat(event, this, '$_POST[tabTitle]', '$_POST[ChatBoxID]'); \"></textarea></center><div class='popBar' style=\"font-weight:bold; color:white;\" -onClick=\"clearChat('$_POST[tabTitle]', '$_POST[ChatBoxID]')\"><center>$_POST[tabTitle]</center></div>";


	$leftPop = $_POST['leftTab'];
	$width= "250";
	$height= "auto";
	$rightPop = $_POST['rightTab'] - $width -3;
	$justify="right";
	$mysession['openPop'] = $_POST['tabTitle'];
}



//-----------------------------------------------------------------------------------------------
if($_POST['func']=="getBuddyList") {
//if(1==1) {


	 //$_POST[spanel_user]

	
	$dispHTML="<center class='changeStatus' >$user_name</center>";



// select all Departments:
$query = "SELECT * FROM livehelp_departments WHERE visible=1 ORDER by ordering";
$data_d = $mydatabase->query($query);
$default = 0;
$onhtml="";
$offhtml="";
while($department_a = $data_d->fetchRow(DB_FETCHMODE_ASSOC)){
  $department = $department_a['recno'];
  $name = $department_a['nameof'];
 
  // see if anyone in this department is online:
    $sqlquery = "SELECT livehelp_users.username FROM livehelp_users,livehelp_operator_departments WHERE livehelp_users.user_id=livehelp_operator_departments.user_id AND livehelp_users.isonline='Y' AND livehelp_users.isoperator='Y' AND livehelp_operator_departments.department=".intval($department);
    $data = $mydatabase->query($sqlquery);  
    if($data->numrows() != 0){
        $onhtml=$onhtml . "<span style='cursor:pointer;'  ><a href='javascript:CSLHDept=".$department.";createTab(\"".$name."\", \"open\")'; class=friend>".$name."</a></span>"; 
        while($opts = $data->fetchRow(DB_FETCHMODE_ASSOC)){
             $username = $opts['username'];            
            // $onhtml=$onhtml . "<li class='list'><span onClick='CSLHDept=".$department.";createTab(\"".$username."\", \"open\")';  style='cursor:pointer;'>".$username."</span></li>";      
        }    
    } else {
        $offhtml=$offhtml . "<span style='cursor:pointer;'><a href='javascript:opencontactform($department)' class=friend>".$name."</a></span>"; 
     }  
}

if($onhtml!="")
	$dispHTML =$dispHTML .  "<div class=buddylist><center>Departments Online:</center><hr /> $onhtml ";

if($offhtml!="")	
	$dispHTML =$dispHTML .  "<div class=buddylist><center>Departments Offline:</center><hr /> $offhtml ";

	$dispHTML=$dispHTML . "</div><br />";


	$leftPop = $_POST['leftTab'] - 50;
	$width= "180";
	$height= "auto";
	$rightPop = $_POST['rightTab'] - $width + 48;
	$justify="right";

	$mysession['openPop'] = "onlineTab";

}

	savesession($mysession);



// Sent the results :
	echo json_encode(array("html"=>"$dispHTML","width"=>"$width","height"=>"$height","leftPop"=>"$leftPop", "rightPop"=>"$rightPop", "justify"=>"$justify"));

 ?>