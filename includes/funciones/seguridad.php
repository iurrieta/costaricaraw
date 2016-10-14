<?php
//Funciones de Enctriptacion de Datos

function enc5($value){
	$data = md5($value);
	return $data;
}

function encsha($value){
	return sha1($value);
}

function enblowfish($value){
$cc = $value;
$key = '58b7d03c983c9e22cd3c772a846a89b6';
$iv = '69C79EC8';
$cipher = mcrypt_module_open(MCRYPT_BLOWFISH,'','cbc','');
mcrypt_generic_init($cipher, $key, $iv);
$encrypted = mcrypt_generic($cipher,$cc);
mcrypt_generic_deinit($cipher);
return $encrypted;
}
function deblowfish($value){
$cc = $value;
$key = '58b7d03c983c9e22cd3c772a846a89b6';
$iv = '69C79EC8';
$cipher = mcrypt_module_open(MCRYPT_BLOWFISH,'','cbc','');	
mcrypt_generic_init($cipher, $key, $iv);
$decrypted = mdecrypt_generic($cipher,$cc);
mcrypt_generic_deinit($cipher);
return $decrypted;
}

function encAES($value){
   $key = '58b7d03c983c9e22cd3c772a846a89b6';
   $text = $value;
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
   return $crypttext;
}

function desAES($value){
   $key = '58b7d03c983c9e22cd3c772a846a89b6';
   $crypttext = $value;
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
   return trim($decrypttext);
} 

function get_rnd_iv($iv_len)
{
   $iv = '';
   while ($iv_len-- > 0) {
       $iv .= chr(mt_rand() & 0xff);
   }
   return $iv;
}


function base64_encrypt($plain_text)
{
   $enc_text= base64_encode($plain_text);
	return $enc_text; 
}

function base64_decrypt($enc_text)
{
   $plain_text = base64_decode($enc_text);
    return $plain_text;
}

function encsha256($value){
  $hash = SHA256::hash($value);
  return $hash;
}
?> 

