<?php

function getsession($sessiondata){
	  $datapairs = explode("&",$sessiondata);
    for($l=0;$l<count($datapairs);$l++){
        $dataset = explode("=",$datapairs[$l]);
        $key = $dataset[0];
        if(!(empty($dataset[1]))){
           $value = $dataset[1];
           $mysession[$key]= $value;
        }
    }
return $mysession;
}

function savesession($mysession){
	global $identity,$mydatabase;
	
	$sessiondata = "";
  while (list($key, $val) = each($mysession)) {
  		$sessiondata .= $key . "=" . $val . "&";
  }
  $query = "UPDATE livehelp_users SET sessiondata='$sessiondata' WHERE sessionid='".$identity['SESSIONID']."'";		
  $mydatabase->query($query);
  
}


// Generate a random character string
function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
{
    // Length of character list
    $chars_length = (strlen($chars) - 1);

    // Start our string
    $string = $chars{rand(0, $chars_length)};
    
    // Generate random string
    for ($i = 1; $i < $length; $i = strlen($string))
    {
        // Grab a random character from our list
        $r = $chars{rand(0, $chars_length)};
        
        // Make sure the same two characters don't appear next to each other
        if ($r != $string{$i - 1}) $string .=  $r;
    }
    
    // Return the string
    return $string;
}

function GetUser($user_id) {
  global $mydatabase;
		   
  $query="SELECT username,displayname FROM livehelp_users WHERE user_id='".intval($user_id)."'";
  $result = $mydatabase->query($query); 
	$row = $result->fetchRow(DB_FETCHMODE_ASSOC);  
	$user = $row['username'];
	if(!(empty($row['displayname']))){ 	$user = $row['displayname']; }
  return $user;
}

function QueryMysql($query) {
	   global $mydatabase;
        $result = $mydatabase->query($query); 
        return $result;  
}
?>