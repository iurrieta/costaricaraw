<?php
 
	if($_SESSION['CRR_Admin']){
		if( $_SESSION['CRR_AUserID']=="1"){
		 include('modulos/users.php');
		}
		
	}else{

?>
<form action="index.php" method="post" enctype="multipart/form-data" name="login" id="login">
              <input type="hidden" name="cmd" value="login" />
              <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                
                <tr>
                  <td align="left" valign="top"><table width="100%" height="10" border="0" align="center" cellpadding="0" cellspacing="8">
                    <tr>
                      <td width="165"><h3>Username</h3></td>
                    </tr>
                    <tr>
                      <td><input name="usuario" type="text" style="width:250px;" id="usuario" class="input_login"></td>
                    </tr>
                    <tr>
                      <td><h3>Password</h3></td>
                    </tr>
                    <tr>
                      <td><input name="clave" type="password" style="width:250px;" id="clave" class="input_login" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td align="center"><input type="submit" name="Submit" value="Login" class="boton"></td>
                    </tr>
                    
                  </table>
                  </td>
                </tr>
</table>
</form>
<?php

	}
?>