<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m8'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();
if ($act=="") {



?>
<form action="index.php?cmd=affiliates&act=" method="post" name="categoria">
<br><table   border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr><td width="239" align="center" valign="top"><br />
<input name="act" type="submit" value="Add" class="boton"><br /><br /><input name="act" type="submit" value="Edit" class="boton"><br /><br /><input  name="act" type="submit" value="Remove" class="boton"></td>
  <td width="281" align="center" valign="top">
    <select name="id" size="10" multiple style="width:280px;">
<option selected disabled="disabled">--- Affiliates ---</option>	
<?               
$sql = $db->consulta("SELECT * FROM `affiliates` WHERE `referral`='0' ORDER By `name`");
while($Pages=$db->fetch_array($sql)){
?>
		  
 <option value="<?=$Pages['id']?>">
                <?=$Pages['name']?>&nbsp&nbsp;[Visitor: <?=$Pages['counter']?>]
          </option>
<? }  ?>    
<option selected disabled="disabled">--- Affiliates Referrals ---</option>	
  <?               
$sql = $db->consulta("SELECT * FROM `affiliates` WHERE `referral`='1' ORDER By `name`");
while($Pages=$db->fetch_array($sql)){
?>
		  
 <option value="<?=$Pages['id']?>">
                <?=$Pages['name']?>&nbsp&nbsp;[Visitor: <?=$Pages['counter']?>]
          </option>
<? }  ?>   
	
 

</select></td>
  </tr>
</table></form>

<?

}

///////////////////////EDITAR USUARIOS///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($act=="Edit") {

$query = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$id."'");
$query1 = $db->consulta("SELECT * FROM `special` WHERE `id`='".$id."'");
$Page = $db->fetch_array($query);
$Page1 = $db->fetch_array($query1);
$SelectBanner1="";
$SelectBanner2="";

if($Page['referral']=="1"||$Page1['referral']=="1"){
$HideOpen = "<!--";
$HideClose = "-->";

}
?>

<form action="index.php?cmd=affiliates" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?=$Page['id']?>" name="id">
<input type="hidden" value="<?=$Page['logo']?>" name="actual">
<input type="hidden" value="update" name="act">
<table width="80%"  border="0" align="center" cellpadding="1" cellspacing="4" class="main">
<tr>
<td height="35" colspan="2" align="center" ><h2>Edit <span class="titulos">Affiliate</span></h2></td>
</tr><tr>
<td colspan="2" class="text"><strong>Affiliate Name:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input name="name" type="text" id="name" value="<?=$Page['name']?>" size="40" disabled="disabled" /></td>
  </tr>
  <? echo $HideOpen; ?>
<tr>
<td colspan="2" class="text"><strong>Affiliate Link:</strong></td>
</tr>

<tr>
  <td colspan="2" class="text"><input type="text" value="<?=$Page['url']?>" size="80" /></td>
  </tr><? echo $HideClose; ?>
  <tr>
    <td colspan="2" class="text"><strong>Affiliate Code Sales:</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><label for="code"></label>
      <input type="text" name="code" id="code" value="<?=$Page['code']?>" maxlength="50" /></td>
  </tr>
  <td colspan="2" class="text"><strong>Affiliate Counter:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input type="text" value="<?=$Page['counter']?>" size="10" readonly="readonly" disabled="disabled" /></td>
  </tr>
 
 <tr>
 <td colspan="2" class="text"><strong>Email:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="email" id="email" value="<?=$Page['email']?>" /></td>
  </tr> 
  
    <tr>
  <td colspan="2" valign="top" class="text"><strong>Logo or Banner:</strong></td>
  </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><label for="logo"></label>
    <input type="file" name="logo" id="logo"></td>
     </tr>
  <tr>
  <td colspan="2" class="text"><img src="../images/affiliates/<?=$Page['logo']?>" border="0" alt="<?=$Page['name']?>" title="<?=$Page['name']?>" width="150"><br /><a href="modulos/removeLogo.php?picture=<?=$Page['logo']?>&aff=<?=$Page['id']?>" target="_new">Remove Logo</a></td>
  </tr>
  
   <? echo $HideOpen; ?>  
   <tr>
     <td class="text">&nbsp;</td>
     <td class="text">&nbsp;</td>
   </tr>
   <tr>
     <td class="text"><strong>Position Top Adventure </strong></td>
     <td class="text">
       <select name="tbl_1" id="tbl_1">
         <option value="1" <?php if($Page['tbl_1']==1){ echo "selected=\"selected\""; } ?>>1</option>
         <option value="2" <?php if($Page['tbl_1']==2){ echo "selected=\"selected\""; } ?>>2</option>
         <option value="3" <?php if($Page['tbl_1']==3){ echo "selected=\"selected\""; } ?>>3</option>
      </select></td>
   </tr>
   <tr>
     <td class="text"><strong>Position Specials</strong></td>
     <td class="text"><select name="tbl_2" id="tbl_2">
         <option value="1" <?php if($Page['tbl_2']==1){ echo "selected=\"selected\""; } ?>>1</option>
         <option value="2" <?php if($Page['tbl_2']==2){ echo "selected=\"selected\""; } ?>>2</option>
         <option value="3" <?php if($Page['tbl_2']==3){ echo "selected=\"selected\""; } ?>>3</option>
     </select></td>
   </tr>
   <tr>
     <td class="text"><strong>Position Top RAW </strong></td>
     <td class="text"><select name="tbl_3" id="tbl_3">
         <option value="1" <?php if($Page['tbl_3']==1){ echo "selected=\"selected\""; } ?>>1</option>
         <option value="2" <?php if($Page['tbl_3']==2){ echo "selected=\"selected\""; } ?>>2</option>
         <option value="3" <?php if($Page['tbl_3']==3){ echo "selected=\"selected\""; } ?>>3</option>
     </select></td>
   </tr>
   <tr>
     <td class="text">&nbsp;</td>
     <td class="text">&nbsp;</td>
   </tr>
   <tr>
     <td class="text"><strong>Top RAW </strong></td>
     <td class="text">&nbsp;</td>
   </tr>
   <tr>
     <td class="text"><label>
       <input type="radio" name="raw" value="1" id="raw_1" <?php if($Page['raw']==1){ echo "checked"; } ?>/>
       <strong>Yes</strong></label>
       <strong>&nbsp;&nbsp;
       <label>
         <input name="raw" type="radio" id="raw_2" value="0" <?php if($Page['raw']==0){ echo "checked"; } ?>/>
         No</label>
      </strong></td>
     <td class="text">&nbsp;</td>
   </tr>
   <tr>
     <td class="text"><strong>Show Note </strong></td>
     <td class="text"><strong>Show Specials Note </strong></td>
    </tr>
   <tr>
     <td class="text"><label>
       <input type="radio" name="show_note" value="1" id="show_note_3" <?php if($Page['show_note']==1){ echo "checked"; } ?>/>
       <strong>Yes</strong></label>
       <strong>&nbsp;&nbsp;
         <label>
           <input name="show_note" type="radio" id="show_note_4" value="0" <?php if($Page['show_note']==0){ echo "checked"; } ?>/>
           No</label>
       </strong></td>
     <td class="text"><label>
       <input type="radio" name="special_show_note" value="1" id="special_show_note_3" <?php if($Page1['special_show_note']==1){ echo "checked"; } ?>/>
       <strong>Yes</strong></label>
       <strong>&nbsp;&nbsp;
         <label>
           <input name="special_show_note" type="radio" id="special_show_note_4" value="0" <?php if($Page1['special_show_note']==0){ echo "checked"; } ?>/>
           No</label>
       </strong></td>
    </tr>
   <tr>
     <td class="text"><strong>Note:</strong></td>
     <td class="text"><strong>Specials Note:</strong></td>
    </tr>
   <tr>
     <td class="text">
       <textarea name="note" id="note" cols="30" rows="3"><?=$Page['note']?></textarea></td>
     <td class="text"><textarea name="special_note" id="special_note" cols="30" rows="3"><?=$Page1['special_note']?></textarea></td>
    </tr>
   <tr>
     <td width="50%" class="text"><strong>Top Adventure </strong></td>
     <td width="50%" class="text"><strong>Specials </strong></td>
   </tr>
<tr>
  <td class="text">
    <label>
      <input type="radio" name="top" value="1" id="top_0" <?php if($Page['top']==1){ echo "checked"; } ?>/>
      <strong>Yes</strong></label>
    <strong>&nbsp;&nbsp;
      <label>
        <input name="top" type="radio" id="top_1" value="0" <?php if($Page['top']==0){ echo "checked"; } ?> />
        No</label>
    </strong></td>
  <td class="text"><label>
    <input type="radio" name="special" value="1" id="special_0" <?php if($Page1['special']==1){ echo "checked"; } ?>/>
    <strong>Yes</strong></label>
    <strong>&nbsp;&nbsp;
      <label>
        <input name="special" type="radio" id="special_1" value="0" <?php if($Page1['special']==0){ echo "checked"; } ?> />
        No</label>
    </strong></td>
  </tr> 
  
       <tr>
       <td valign="top" class="text"><strong>Adventure 1</strong></td>
       <td valign="top" class="text"><strong>Adventure 1</strong></td>
     </tr>
       <tr>
         <td valign="top" class="text">
         <label for="top1"></label>
           <select name="top1" id="top1">
            
             
<?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
 <option value="<?=$Adventure['id']?>" <?php if($Page['1']==$Adventure['id']){ echo "selected"; } ?>><?=$Adventure['name']?></option>
<?php } ?>  
           <option <?php if($Page['1']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
        
         </select></td>
         <td valign="top" class="text"><label for="special1"></label>
           <select name="special1" id="special1">
             <?php
$sqlSP = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($AdventureSP=$db->fetch_array($sqlSP)){
?><!-- <?=$Page1['1']?> -->
             <option value="<?=$AdventureSP['id']?>" <?php if($Page1['1']==$AdventureSP['id']){ echo "selected"; } ?>><?=$AdventureSP['name']?></option>
             <?php } ?>
             <option <?php if($Page1['1']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
           </select></td>
       </tr>
        <tr>
       <td valign="top" class="text"><strong>Adventure 2</strong></td>
       <td valign="top" class="text"><strong>Adventure 2</strong></td>
      </tr>
       <tr>
         <td valign="top" class="text"> <label for="top2"></label>
           <select name="top2" id="top2">
           <option selected="selected" value="">Select Adventure</option>
          
            
             
<?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
 <option value="<?=$Adventure['id']?>" <?php if($Page['2']==$Adventure['id']){ echo "selected"; } ?>><?=$Adventure['name']?></option>
<?php } ?>     
 <option <?php if($Page['2']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>     
         </select></td>
         <td valign="top" class="text"><label for="special2"></label>
           <select name="special2" id="special2">
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>" <?php if($Page1['2']==$Adventure['id']){ echo "selected"; } ?>><?=$Adventure['name']?></option>
             <?php } ?>
             <option value="0" <?php if($Page1['2']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
           </select></td>
       </tr>
        <tr>
       <td valign="top" class="text"><strong>Adventure 3</strong></td>
       <td valign="top" class="text"><strong>Adventure 3</strong></td>
      </tr>
       <tr>
         <td valign="top" class="text"> <label for="top3"></label>
           <select name="top3" id="top3">
            
             
<?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
 <option value="<?=$Adventure['id']?>" <?php if($Page['3']==$Adventure['id']){ echo "selected"; } ?>><?=$Adventure['name']?></option>
<?php } ?>   
           <option <?php if($Page['3']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
       
         </select></td>
         <td valign="top" class="text"><label for="special3"></label>
           <select name="special3" id="special3">
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>" <?php if($Page1['3']==$Adventure['id']){ echo "selected"; } ?>>
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
             <option <?php if($Page1['3']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
           </select></td>
       </tr>
        <tr>
       <td valign="top" class="text"><strong>Adventure 4</strong></td>
       <td valign="top" class="text"><strong>Adventure 4</strong></td>
      </tr>
       <tr>
         <td valign="top" class="text"> <label for="top4"></label>
           <select name="top4" id="top4">
           
            
             
<?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
 <option value="<?=$Adventure['id']?>" <?php if($Page['4']==$Adventure['id']){ echo "selected"; } ?>><?=$Adventure['name']?></option>
<?php } ?>     
<option <?php if($Page['4']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>     
         </select></td>
         <td valign="top" class="text"><label for="special4"></label>
           <select name="special4" id="special4">
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>" <?php if($Page1['4']==$Adventure['id']){ echo "selected"; } ?>>
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
             <option <?php if($Page1['4']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
           </select></td>
       </tr>
       <tr>
       <td valign="top" class="text"><strong>Adventure 5</strong></td>
       <td valign="top" class="text"><strong>Adventure 5</strong></td>
     </tr>
       <tr>
         <td valign="top" class="text"> <label for="top4"></label>
           <select name="top5" id="top5">
            
             
<?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
 <option value="<?=$Adventure['id']?>" <?php if($Page['5']==$Adventure['id']){ echo "selected"; } ?>><?=$Adventure['name']?></option>
<?php } ?>     
           <option <?php if($Page['5']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
     
         </select></td>
         <td valign="top" class="text"><label for="top4"></label>
           <select name="special5" id="special5">
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>" <?php if($Page1['5']==$Adventure['id']){ echo "selected"; } ?>>
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
             <option <?php if($Page1['5']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
           </select></td>
       </tr>
  <? echo $HideClose; ?>
   
  <tr>
    <td valign="top" class="text"><strong>Adventure 6</strong></td>
    <td valign="top" class="text"><strong>Adventure 6</strong></td>
    </tr>
  <tr>
    <td valign="top" class="text">
      <select name="top6" id="top6">
        <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
        <option value="<?=$Adventure['id']?>" <?php if($Page['6']==$Adventure['id']){ echo "selected"; } ?>>
          <?=$Adventure['name']?>
          </option>
        <?php } ?>
        <option <?php if($Page['6']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
      </select></td>
    <td valign="top" class="text"><select name="special6" id="special6">
      <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
      <option value="<?=$Adventure['id']?>" <?php if($Page1['6']==$Adventure['id']){ echo "selected"; } ?>>
        <?=$Adventure['name']?>
        </option>
      <?php } ?>
      <option <?php if($Page1['6']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
    </select></td>
    </tr>
  <tr>
    <td valign="top" class="text"><strong>Adventure 7</strong></td>
    <td valign="top" class="text"><strong>Adventure 7</strong></td>
    </tr>
  <tr>
    <td valign="top" class="text"><select name="top7" id="top7">
      <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
      <option value="<?=$Adventure['id']?>" <?php if($Page['7']==$Adventure['id']){ echo "selected"; } ?>>
        <?=$Adventure['name']?>
        </option>
      <?php } ?>
      <option <?php if($Page['7']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
    </select></td>
    <td valign="top" class="text"><select name="special7" id="special7">
      <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
      <option value="<?=$Adventure['id']?>" <?php if($Page1['7']==$Adventure['id']){ echo "selected"; } ?>>
        <?=$Adventure['name']?>
        </option>
      <?php } ?>
      <option <?php if($Page1['7']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
    </select></td>
    </tr>
  <tr>
    <td valign="top" class="text"><strong>Adventure 8</strong></td>
    <td valign="top" class="text"><strong>Adventure 8</strong></td>
    </tr>
  <tr>
    <td valign="top" class="text"><select name="top8" id="top8">
      <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
      <option value="<?=$Adventure['id']?>" <?php if($Page['8']==$Adventure['id']){ echo "selected"; } ?>>
        <?=$Adventure['name']?>
        </option>
      <?php } ?>
      <option <?php if($Page['8']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
    </select></td>
    <td valign="top" class="text"><select name="special8" id="special8">
      <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
      <option value="<?=$Adventure['id']?>" <?php if($Page1['8']==$Adventure['id']){ echo "selected"; } ?>>
        <?=$Adventure['name']?>
        </option>
      <?php } ?>
      <option <?php if($Page1['8']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
    </select></td>
    </tr>
  <tr>
    <td valign="top" class="text"><strong>Adventure 9</strong></td>
    <td valign="top" class="text"><strong>Adventure 9</strong></td>
    </tr>
  <tr>
    <td valign="top" class="text"><select name="top9" id="top9">
      <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
      <option value="<?=$Adventure['id']?>" <?php if($Page['9']==$Adventure['id']){ echo "selected"; } ?>>
        <?=$Adventure['name']?>
        </option>
      <?php } ?>
      <option <?php if($Page['9']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
    </select></td>
    <td valign="top" class="text"><select name="special9" id="special9">
      <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
      <option value="<?=$Adventure['id']?>" <?php if($Page1['9']==$Adventure['id']){ echo "selected"; } ?>>
        <?=$Adventure['name']?>
        </option>
      <?php } ?>
      <option <?php if($Page1['9']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
    </select></td>
    </tr>
  <tr>
    <td valign="top" class="text"><strong>Adventure 10</strong></td>
    <td valign="top" class="text"><strong>Adventure 10</strong></td>
    </tr>
  <tr>
    <td valign="top" class="text"><select name="top10" id="top10">
      <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
      <option value="<?=$Adventure['id']?>" <?php if($Page['10']==$Adventure['id']){ echo "selected"; } ?>>
        <?=$Adventure['name']?>
        </option>
      <?php } ?>
      <option <?php if($Page['10']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
    </select></td>
    <td valign="top" class="text"><select name="special10" id="special10">
      <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
      <option value="<?=$Adventure['id']?>" <?php if($Page1['10']==$Adventure['id']){ echo "selected"; } ?>>
        <?=$Adventure['name']?>
        </option>
      <?php } ?>
      <option <?php if($Page1['10']=="0"){ echo "selected"; } ?>>Disabled Adventure</option>
    </select></td>
    </tr>
  <tr>
    <td colspan="2" class="text"><strong>Categories</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><?php
		$sqlCat = $db->consulta("SELECT * FROM `categories` Order by `name` ASC");
		$contador = 1;
		while($Categories=$db->fetch_array($sqlCat)){
		
		$selx = mysql_query("SELECT `menu` FROM `affiliates_menu` WHERE `affiliate`='".$Page['id']."' AND `menu`='".$Categories['id']."'");
		list($Finded)=mysql_fetch_array($selx);
		
		   if ($contador > 5) { 
		   echo "<br>";
		   $contador = 1; 
		   }
		   ?>
            <input type="checkbox" name="categories[]" value="<?=$Categories['id']?>" id="categories_<?=$Categories['id']?>" <? if($Categories['id']==$Finded){ echo "checked"; }?>><?=$Categories['name']?>
          
        <?php 
		$contador++;
		} 
		?> </td>
  </tr>
  <tr>
    <td colspan="2" class="text">&nbsp;</td>
  </tr>
 <!-- Charlie -->
  <tr>
  <td>
  <strong>Banners's Selection</strong>
  </td>
  </tr>
  <tr>
 
  	<td>
    <div style="float:left">
    Banner:
    </div>
   
    <?
	$query = $db->consulta("SELECT `title` FROM `banner_title` WHERE `id`='1'");
	$Title1 = $db->fetch_array($query);
	
	$query1 = $db->consulta("SELECT `title` FROM `banner_title` WHERE `id`='2'");
	$Title2 = $db->fetch_array($query1);
	?>
     <div style="float:left">
    <select onchange="Bannerchange(this.selectedIndex);">
     	<option value="1"  >
        <? echo $Title1['title']?>
        </option>
        <option value="2"  >
        <? echo $Title2['title']?>
        </option>
        </select>
        </div>
    </td>
  </tr>
  <tr>
  <td>
  <div id="divbanner1">
  <select multiple="multiple" id="chkmulBanner1">
  
  <? $sqlbanner1 = $db->consulta("Select B.`id`, B.`name` , IFNULL(AC.`count`, 0)  as count, B.`order` from `banner` B 
									left join  `affiliate_banner_counter` AC on B.`id` = AC.`idbanner` 
									where B.`pos` = 1 and B.`status` = 1 and AC.`idaffiliates` =".$Page["id"]."
									Union
									
									Select `id`, `name` , 0, `order` from `banner` where `pos` = 1 and `status` = 1 and id not in (Select B.`id` from `banner` B 
									left join  `affiliate_banner_counter` AC on B.`id` = AC.`idbanner` 
									where B.`pos` = 1 and B.`status` = 1 and AC.`idaffiliates` =".$Page["id"].")

       								 Order by `order` ASC");


		while($Banner1=$db->fetch_array($sqlbanner1)){
		?>	
     	<option value=" <? echo $Banner1['id'] ?> " <? 
		$sqlselebanner1 = $db->consulta("SELECT `idbanner` FROM `affiliates_banner` where `idaffiliate` =".$Page["id"]);
		while($SeleBanner1=$db->fetch_array($sqlselebanner1)){
		
				if( $Banner1['id'] == $SeleBanner1['idbanner'])
				{
					echo('selected'); 
					if ($SelectBanner1 == "")
					{
					$SelectBanner1 .= $SeleBanner1['idbanner'];
					}
					else
					{
						$SelectBanner1 .= ";".$SeleBanner1['idbanner'];
						}
					}
		}
		
		?>  >
        <? echo $Banner1['name'] ?> Clicks[<?= $Banner1['count'] ?>]
        </option>
        <? } ?>
        </select>
  </div>
  <div id="divbanner2" >
  <select multiple="multiple" id="chkmulBanner2">
     	  <? $sqlbanner2 = $db->consulta("Select B.`id`, B.`name` , IFNULL(AC.`count`, 0)  as count, B.`order` from `banner` B 
									left join  `affiliate_banner_counter` AC on B.`id` = AC.`idbanner` 
									where B.`pos` = 2 and B.`status` = 1 and AC.`idaffiliates` =".$Page["id"]."
									Union
									
									Select `id`, `name` , 0, `order` from `banner` where `pos` = 2 and `status` = 1 and id not in (Select B.`id` from `banner` B 
									left join  `affiliate_banner_counter` AC on B.`id` = AC.`idbanner` 
									where B.`pos` = 2 and B.`status` = 1 and AC.`idaffiliates` =".$Page["id"].")

       								 Order by `order` ASC");
		 
		while($Banner2=$db->fetch_array($sqlbanner2)){
		?>	
     	<option value=" <? echo $Banner2['id'] ?>  "<?
		 $sqlselebanner2 = $db->consulta("SELECT `idbanner` FROM `affiliates_banner` where `idaffiliate` =".$Page["id"]);
        	while($SeleBanner2=$db->fetch_array($sqlselebanner2)){
				if($Banner2['id'] == $SeleBanner2['idbanner'])
				{
					
					echo 'selected'; 
					if ($SelectBanner2 == "")
					{
					$SelectBanner2 .= $SeleBanner2['idbanner'];
					}
					else
					{
						$SelectBanner2 .= ";".$SeleBanner2['idbanner'];
						}
					}
		}
		?>
         >
        <? echo $Banner2['name'] ?> Clicks[<?= $Banner2['count'] ?>]
        </option>
        <? } ?>
        </select>
  </div>
  
  </td>
  <td>
 <input type="text" name="Banner1" id="Banner1" style="display:none" value="<? echo $SelectBanner1 ?>"  />
  <input type="text" name="Banner2" id="Banner2" style="display:none"  value="<? echo $SelectBanner2 ?>" />
  </td>
  </tr>
       <tr>
         <td colspan="2" valign="top" class="text">&nbsp;</td>
       </tr>
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>

<tr align="center">
  <td height="35" class="standard"><input name="submit" type="submit" class="boton" value="Update">&nbsp;&nbsp;</td>
  <td class="standard"><input name="Cancelar" type="button" id="Cancelar" value="Cancel" onClick="self.location='index.php?cmd=affiliates'" class="boton"/></td>
  </tr>
</table>

</form>
<script language="javascript">
<!--
 
	function Bannerchange(dato)
	{
		if (dato === 0)
		{
			var el = document.getElementById("divbanner2");
			el.style.display = "none";
			var el = document.getElementById("divbanner1");
			el.style.display = "";
			
			}
		if (dato === 1)
		{
			var el = document.getElementById("divbanner1");
			el.style.display = "none";
			var el = document.getElementById("divbanner2");
			el.style.display = "";
			
			}
		}
	
        $(document).ready(function () {
                     $("#chkmulBanner1").dropdownchecklist({ width: 200, maxDropHeight:150,
                         onComplete: function (selector) {
                             var values = "";
                             for (i = 0; i < selector.options.length; i++) {
                                 if (selector.options[i].selected && (selector.options[i].value != "")) {
                                     if (values != "") values += ";";
                                     values += selector.options[i].value;
                                 }
                             }
                             document.getElementById("Banner1").value = values;
                         }, textFormatFunction: function (options) {
                             var selectedOptions = options.filter(":selected");
                             var countOfSelected = selectedOptions.length;
                             var size = options.length;
                             switch (countOfSelected) {
                                 case 0: return "<i>None<i>";
                                 case 1: return selectedOptions.text();
                                 case options.length: return "<b>All</b>";
                                 default: return countOfSelected + " Banners";
                             }
                         }

                     });
                 });
				 
				 
				 $(document).ready(function () {
                     $("#chkmulBanner2").dropdownchecklist({ width: 200, maxDropHeight:150,
                         onComplete: function (selector) {
                             var values = "";
                             for (i = 0; i < selector.options.length; i++) {
                                 if (selector.options[i].selected && (selector.options[i].value != "")) {
                                     if (values != "") values += ";";
                                     values += selector.options[i].value;
                                 }
                             }
                             document.getElementById("Banner2").value = values;
                         }, textFormatFunction: function (options) {
                             var selectedOptions = options.filter(":selected");
                             var countOfSelected = selectedOptions.length;
                             var size = options.length;
                             switch (countOfSelected) {
                                 case 0: return "<i>None<i>";
                                 case 1: return selectedOptions.text();
                                 case options.length: return "<b>All</b>";
                                 default: return countOfSelected + " Banners";
                             }
                         }

                     });
                 });
				 
				 $(document).ready(function () {
	 var el = document.getElementById("divbanner2");
			el.style.display = "none";
 });
//-->
</script>
<?
}
//////////////UPDATE USUARIO/////////////////////////////////////////////////////////////////////////////
if ($act=="update"){

//$name = $_POST['name'];  special
$logo = $_FILES['logo'];
$actual = $_POST['actual'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$top = $_POST['top'];
$top1 = $_POST['top1'];
$top2 = $_POST['top2'];
$top3 = $_POST['top3'];
$top4 = $_POST['top4'];
$top5 = $_POST['top5'];
$top6 = $_POST['top6'];
$top7 = $_POST['top7'];
$top8 = $_POST['top8'];
$top9 = $_POST['top9'];
$top10 = $_POST['top10'];
$code = $_POST['code'];
$raw = $_POST['raw'];

$tbl_1 = $_POST['tbl_1'];
$tbl_2 = $_POST['tbl_2'];
$tbl_3 = $_POST['tbl_3'];

$show_note = $_POST['show_note'];
$note = $_POST['note'];
//special
$special = $_POST['special'];
$special1 = $_POST['special1'];
$special2 = $_POST['special2'];
$special3 = $_POST['special3'];
$special4 = $_POST['special4'];
$special5 = $_POST['special5'];
$special6 = $_POST['special6'];
$special7 = $_POST['special7'];
$special8 = $_POST['special8'];
$special9 = $_POST['special9'];
$special10 = $_POST['special10'];

//Banners's Selection


$Value1 = explode(';',$_POST['Banner1']);
$Value2 = explode(';',$_POST['Banner2']);


$special_show_note = $_POST['special_show_note'];
$special_note = $_POST['special_note'];


if($logo==""){
	$imagen = $actual;
}else{
	if (move_uploaded_file($_FILES['logo']['tmp_name'], "../images/affiliates/".$name."_".$_FILES['logo']['name']))
	{
		$imagen = $name."_".$_FILES['logo']['name'];
	} 
	else
	{
		$imagen = $actual;
	}
}
        $update = $db->consulta("UPDATE `affiliates` SET `email`='".$email."',`top`='$top',`1`='$top1',`2`='$top2',`3`='$top3',`4`='$top4',`5`='$top5',`6`='$top6',`7`='$top7',`8`='$top8',`9`='$top9',`10`='$top10',`code`='$code',`logo`='$imagen',`show_note`='$show_note',`note`='$note',`raw`='$raw',`tbl_1`='$tbl_1',`tbl_2`='$tbl_2',`tbl_3`='$tbl_3' WHERE `id`='".$id."'");
		

//special
        $update1 = $db->consulta("UPDATE `special` SET `email`='".$email."',`top`='$top',`1`='$special1',`2`='$special2',`3`='$special3',`4`='$special4',`5`='$special5',`6`='$special6',`7`='$special7',`8`='$special8',`9`='$special9',`10`='$special10',`code`='$code',`logo`='$imagen',`special`='$special',`special_show_note`='$special_show_note',`special_note`='$special_note' WHERE `id`='".$id."'");


//categories
$delete = $db->consulta("DELETE FROM `affiliates_menu` WHERE `affiliate` = '".$id."'"); 	  
$categories = $_REQUEST['categories'];	
for ($i = 0; $i < count($categories); $i++)
  {

$Categories = $categories[$i];
if($Categories==""){
	
}else{

$sqlAddCategories = mysql_query("INSERT INTO `affiliates_menu`(`affiliate`,`menu`)VALUES('".$id."','".$Categories."')");

}


}
$delete1 = $db->consulta("DELETE FROM `affiliates_banner` WHERE `idaffiliate` = '".$id."'");

if(count($Value1) > 0)
{
foreach( $Value1 as $i => $banners){
	
 $ejecutar =  $db->consulta("INSERT INTO `affiliates_banner` (`idaffiliate`,`idbanner`) values ('".$id."','".$Value1[$i]."')");

}
}

	  
if(count($Value2) > 0)
{
foreach( $Value2 as $y => $banners2){
	
 $ejecutar =  $db->consulta("INSERT INTO `affiliates_banner` (`idaffiliate`,`idbanner`) values ('".$id."','".$Value2[$y]."')");

}
} 

?>

<script language="javascript">
<!--
       document.location='index.php?cmd=affiliates';
//-->
</script>
<?
}

/////////////////Nuevo Usuario//////////////////////////////////////////////////////

if($act=="Add"){
	
?>


<form action="index.php?cmd=affiliates&act=save" method="post" enctype="multipart/form-data">
<input name="act" value="save" type="hidden">
<table width="80%" border="0" align="center" cellpadding="1" cellspacing="4" class="main">
<tr>
          <td height="35" colspan="2" align="center" ><h2>New <span class="titulos">Affiliate</span></h2></td>
</tr>
<tr>
 <td colspan="2" class="text"><strong>Affiliate Name:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="name" id="name" /></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><strong>Affiliate Code Sales:</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text"><label for="code"></label>
      <input type="text" name="code" id="code" value="" maxlength="50" /></td>
  </tr>
 <tr>
 <td colspan="2" class="text"><strong>Email:</strong></td>
</tr>
<tr>
  <td colspan="2" class="text"><input type="text" class="cajas" size="40" name="email" id="email" /></td>
  </tr>   
 <tr>
  <td colspan="2" valign="top" class="text"><strong>Logo or Banner:</strong></td>
  </tr>
     <tr>
       <td colspan="2" valign="top" class="text"><label for="logo"></label>
    <input type="file" name="logo" id="logo"></td>
     </tr>
    <tr>
       <td class="text">&nbsp;</td>
       <td class="text">&nbsp;</td>
    </tr>
    <tr>
      <td class="text"><strong>Position Top Adventure </strong></td>
      <td class="text"><select name="tbl_1" id="tbl_1">
        <option value="1" selected="selected">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select></td>
    </tr>
    <tr>
      <td class="text"><strong>Position Specials</strong></td>
      <td class="text"><select name="tbl_2" id="tbl_2">
        <option value="1">1</option>
        <option value="2" selected="selected">2</option>
        <option value="3">3</option>
      </select></td>
    </tr>
    <tr>
      <td class="text"><strong>Position Top RAW </strong></td>
      <td class="text"><select name="tbl_3" id="tbl_3">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3" selected="selected">3</option>
      </select></td>
    </tr>
    <tr>
       <td class="text">&nbsp;</td>
       <td class="text">&nbsp;</td>
    </tr>
    <tr>
       <td class="text"><strong>Top RAW</strong></td>
       <td class="text">&nbsp;</td>
    </tr>
    <tr>
       <td class="text"><label>
         <input type="radio" name="raw" value="1" id="raw_1" />
         <strong>Yes</strong></label>
         <strong>&nbsp;&nbsp;
         <label>
           <input name="raw" type="radio" id="raw_2" value="0" checked="checked" />
           No</label>
       </strong></td>
       <td class="text">&nbsp;</td>
    </tr>
    <tr>
       <td class="text"><strong>Show Note </strong></td>
       <td class="text"><strong>Show Specials Note </strong></td>
    </tr>
    <tr>
       <td class="text"><label>
         <input type="radio" name="show_note" value="1" id="show_note_2" />
         <strong>Yes</strong></label>
         <strong>&nbsp;&nbsp;
         <label>
           <input name="show_note" type="radio" id="show_note_3" value="0" checked="checked" />
           No</label>
       </strong></td>
       <td class="text"><label>
         <input type="radio" name="special_show_note" value="1" id="special_show_note_3" />
         <strong>Yes</strong></label>
         <strong>&nbsp;&nbsp;
           <label>
             <input name="special_show_note" type="radio" id="special_show_note_4" value="0" checked="checked" />
             No</label>
         </strong></td>
    </tr>
    <tr>
       <td class="text"><strong>Note:</strong></td>
       <td class="text"><strong>Specials Note:</strong></td>
    </tr>
     <tr>
       <td class="text">
         <textarea name="note" id="note" cols="30" rows="3"></textarea></td>
       <td class="text"><textarea name="special_note" id="special_note" cols="30" rows="3"></textarea></td>
     </tr>
    <tr>
      <td class="text"><strong>Top Adventure </strong></td>
      <td class="text"><strong>Specials </strong></td>
    </tr>
<tr>
  <td class="text">
    <label>
      <input type="radio" name="top" value="1" id="top_0" />
      <strong>Yes</strong></label>
    <strong>&nbsp;&nbsp;
      <label>
        <input name="top" type="radio" id="top_1" value="0" checked="checked" />
        No</label>
    </strong></td>
  <td class="text"><label>
    <input type="radio" name="special" value="1" id="special_0" />
    <strong>Yes</strong></label>
    <strong>&nbsp;&nbsp;
      <label>
        <input name="special" type="radio" id="special_1" value="0" checked="checked" />
        No</label>
    </strong></td>
  </tr> 
  
       <tr>
       <td width="50%" valign="top" class="text"><strong>Adventure 1</strong></td>
       <td width="50%" valign="top" class="text"><strong>Adventure 1</strong></td>
     </tr>
       <tr>
         <td valign="top" class="text">
         <label for="top2"></label>
           <select name="top1" id="top1">
           <option selected="selected" value="">Select Adventure</option>
            
             
<?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
 <option value="<?=$Adventure['id']?>"><?=$Adventure['name']?></option>
<?php } ?>          
         </select></td>
         <td valign="top" class="text"><label for="special1"></label>
           <select name="special1" id="special1">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
       </tr>
        <tr>
       <td valign="top" class="text"><strong>Adventure 2</strong></td>
       <td valign="top" class="text"><strong>Adventure 2</strong></td>
      </tr>
       <tr>
         <td valign="top" class="text"> <label for="top2"></label>
           <select name="top2" id="top2">
           <option selected="selected" value="">Select Adventure</option>
            
             
<?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
 <option value="<?=$Adventure['id']?>"><?=$Adventure['name']?></option>
<?php } ?>          
         </select></td>
         <td valign="top" class="text"><label for="special2"></label>
           <select name="special2" id="special2">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
       </tr>
        <tr>
       <td valign="top" class="text"><strong>Adventure 3</strong></td>
       <td valign="top" class="text"><strong>Adventure 3</strong></td>
      </tr>
       <tr>
         <td valign="top" class="text"> <label for="top3"></label>
           <select name="top3" id="top3">
           <option selected="selected" value="">Select Adventure</option>
            
             
<?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
 <option value="<?=$Adventure['id']?>"><?=$Adventure['name']?></option>
<?php } ?>          
         </select></td>
         <td valign="top" class="text"><label for="special3"></label>
           <select name="special3" id="special3">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
       </tr>
        <tr>
       <td valign="top" class="text"><strong>Adventure 4</strong></td>
       <td valign="top" class="text"><strong>Adventure 4</strong></td>
      </tr>
       <tr>
         <td valign="top" class="text"> <label for="top4"></label>
           <select name="top4" id="top4">
           <option selected="selected" value="">Select Adventure</option>
            
             
<?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
 <option value="<?=$Adventure['id']?>"><?=$Adventure['name']?></option>
<?php } ?>          
         </select></td>
         <td valign="top" class="text"><label for="special4"></label>
           <select name="special4" id="special4">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
       </tr>
       <tr>
       <td valign="top" class="text"><strong>Adventure 5</strong></td>
       <td valign="top" class="text"><strong>Adventure 5</strong></td>
     </tr>
       <tr>
         <td valign="top" class="text"> <label for="top5"></label>
           <select name="top5" id="top5">
           <option selected="selected" value="">Select Adventure</option>
            
             
<?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
 <option value="<?=$Adventure['id']?>"><?=$Adventure['name']?></option>
<?php } ?>          
         </select></td>
         <td valign="top" class="text"><label for="special5"></label>
           <select name="special5" id="special5">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
       </tr>
       <tr>
         <td valign="top" class="text"><strong>Adventure 6</strong></td>
         <td valign="top" class="text"><strong>Adventure 6</strong></td>
       </tr>
       <tr>
         <td valign="top" class="text"><label for="top6"></label>
           <select name="top6" id="top6">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
         <td valign="top" class="text"><label for="special6"></label>
           <select name="special6" id="special6">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
       </tr>
       <tr>
         <td valign="top" class="text"><strong>Adventure 7</strong></td>
         <td valign="top" class="text"><strong>Adventure 7</strong></td>
       </tr>
       <tr>
         <td valign="top" class="text"><label for="top7"></label>
         <select name="top7" id="top7">
           <option selected="selected" value="">Select Adventure</option>
           <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
           <option value="<?=$Adventure['id']?>">
             <?=$Adventure['name']?>
           </option>
           <?php } ?>
         </select></td>
         <td valign="top" class="text"><label for="special7"></label>
           <select name="special7" id="special7">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
       </tr>
       <tr>
         <td valign="top" class="text"><strong>Adventure 8</strong></td>
         <td valign="top" class="text"><strong>Adventure 8</strong></td>
       </tr>
       <tr>
         <td valign="top" class="text"><label for="top8"></label>
         <select name="top8" id="top8">
           <option selected="selected" value="">Select Adventure</option>
           <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
           <option value="<?=$Adventure['id']?>">
             <?=$Adventure['name']?>
           </option>
           <?php } ?>
         </select></td>
         <td valign="top" class="text"><label for="special8"></label>
           <select name="special8" id="special8">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
       </tr>
       <tr>
         <td valign="top" class="text"><strong>Adventure 9</strong></td>
         <td valign="top" class="text"><strong>Adventure 9</strong></td>
       </tr>
       <tr>
         <td valign="top" class="text"><label for="top9"></label>
         <select name="top9" id="top9">
           <option selected="selected" value="">Select Adventure</option>
           <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
           <option value="<?=$Adventure['id']?>">
             <?=$Adventure['name']?>
           </option>
           <?php } ?>
         </select></td>
         <td valign="top" class="text"><label for="special9"></label>
           <select name="special9" id="special9">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
       </tr>
       <tr>
         <td valign="top" class="text"><strong>Adventure 10</strong></td>
         <td valign="top" class="text"><strong>Adventure 10</strong></td>
       </tr>
       <tr>
         <td valign="top" class="text"><label for="top10"></label>
         <select name="top10" id="top10">
           <option selected="selected" value="">Select Adventure</option>
           <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
           <option value="<?=$Adventure['id']?>">
             <?=$Adventure['name']?>
           </option>
           <?php } ?>
         </select></td>
         <td valign="top" class="text"><label for="special10"></label>
           <select name="special10" id="special10">
             <option selected="selected" value="">Select Adventure</option>
             <?php
$sql = $db->consulta("SELECT * FROM `adventures` WHERE `status`='1' OR `status`='5' ORDER By `name`");
while($Adventure=$db->fetch_array($sql)){
?>
             <option value="<?=$Adventure['id']?>">
               <?=$Adventure['name']?>
             </option>
             <?php } ?>
           </select></td>
       </tr>
       <tr>
         <td colspan="2" valign="top" class="text"><strong>Categories</strong></td>
       </tr>
       <tr>
         <td colspan="2" valign="top" class="text">
        <?php
		$sqlCat = $db->consulta("SELECT * FROM `categories` Order by `name` ASC");
		$contador = 1;
		while($Categories=$db->fetch_array($sqlCat)){
		?>	
           <?php
		   if ($contador > 5) { 
		   echo "<br>";
		   $contador = 1; 
		   }
		   ?>
            <input type="checkbox" name="categories[]" value="<?=$Categories['id']?>" id="categories_<?=$Categories['id']?>"><?=$Categories['name']?>
          
        <?php 
		$contador++;
		} 
		?> 
        
        </td>
       </tr>
        <!-- Charlie -->
  <tr>
  <td>
  <strong>Banners's Selection</strong>
  </td>
  </tr>
  <tr>
 
  	<td>
    <div style="float:left">
    Banner:
    </div>
   
    <?
	$query = $db->consulta("SELECT `title` FROM `banner_title` WHERE `id`='1'");
	$Title1 = $db->fetch_array($query);
	
	$query1 = $db->consulta("SELECT `title` FROM `banner_title` WHERE `id`='2'");
	$Title2 = $db->fetch_array($query1);
	?>
     <div style="float:left">
    <select onchange="Bannerchange(this.selectedIndex);">
     	<option value="1"  >
        <? echo $Title1['title']?>
        </option>
        <option value="2"  >
        <? echo $Title2['title']?>
        </option>
        </select>
        </div>
    </td>
  </tr>
  <tr>
  <td>
  <div id="divbanner1">
  <select multiple="multiple" id="chkmulBanner1">
  
  <? $sqlbanner1 = $db->consulta("SELECT `id`,`name` FROM `banner` where `pos` = 1 and `status` = 1 Order by `order` ASC");
		while($Banner1=$db->fetch_array($sqlbanner1)){
		?>	
     	<option value=" <? echo $Banner1['id'] ?> " >
        <? echo $Banner1['name'] ?>
        </option>
        <? } ?>
        </select>
  </div>
  <div id="divbanner2" >
  <select multiple="multiple" id="chkmulBanner2">
     	  <? $sqlbanner2 = $db->consulta("SELECT `id`,`name` FROM `banner` where `pos` = 2 and `status` = 1 Order by `order` ASC");
		while($Banner2=$db->fetch_array($sqlbanner2)){
		?>	
     	<option value=" <? echo $Banner2['id'] ?> " >
        <? echo $Banner2['name'] ?>
        </option>
        <? } ?>
        </select>
  </div>
  
  </td>
  <td>
 <input type="text" name="Banner1" id="Banner1" style="display:none"  />
  <input type="text" name="Banner2" id="Banner2" style="display:none"  />
  </td>
  </tr>
       <tr>
         <td colspan="2" valign="top" class="text">&nbsp;</td>
       </tr>
     <tr>
       <td colspan="2" valign="top" class="text">&nbsp;</td>
     </tr>

    <tr align="center">
      <td height="35" align="center" class="standard"><input type="submit" value="Save" class="boton"></td>
      <td height="35" align="center" class="standard"><input name="Cancelar2" type="button" id="Cancelar2" value="Cancel" onClick="self.location='index.php?cmd=affiliates'" class="boton"/></td>
    </tr>
</table>

</form>
<script language="javascript">
<!--
 
	function Bannerchange(dato)
	{
		if (dato === 0)
		{
			var el = document.getElementById("divbanner2");
			el.style.display = "none";
			var el = document.getElementById("divbanner1");
			el.style.display = "";
			
			}
		if (dato === 1)
		{
			var el = document.getElementById("divbanner1");
			el.style.display = "none";
			var el = document.getElementById("divbanner2");
			el.style.display = "";
			
			}
		}
	
        $(document).ready(function () {
                     $("#chkmulBanner1").dropdownchecklist({ width: 200, maxDropHeight:150,
                         onComplete: function (selector) {
                             var values = "";
                             for (i = 0; i < selector.options.length; i++) {
                                 if (selector.options[i].selected && (selector.options[i].value != "")) {
                                     if (values != "") values += ";";
                                     values += selector.options[i].value;
                                 }
                             }
                             document.getElementById("Banner1").value = values;
                         }, textFormatFunction: function (options) {
                             var selectedOptions = options.filter(":selected");
                             var countOfSelected = selectedOptions.length;
                             var size = options.length;
                             switch (countOfSelected) {
                                 case 0: return "<i>None<i>";
                                 case 1: return selectedOptions.text();
                                 case options.length: return "<b>All</b>";
                                 default: return countOfSelected + " Banners";
                             }
                         }

                     });
                 });
				 
				 
				 $(document).ready(function () {
                     $("#chkmulBanner2").dropdownchecklist({ width: 200, maxDropHeight:150,
                         onComplete: function (selector) {
                             var values = "";
                             for (i = 0; i < selector.options.length; i++) {
                                 if (selector.options[i].selected && (selector.options[i].value != "")) {
                                     if (values != "") values += ";";
                                     values += selector.options[i].value;
                                 }
                             }
                             document.getElementById("Banner2").value = values;
                         }, textFormatFunction: function (options) {
                             var selectedOptions = options.filter(":selected");
                             var countOfSelected = selectedOptions.length;
                             var size = options.length;
                             switch (countOfSelected) {
                                 case 0: return "<i>None<i>";
                                 case 1: return selectedOptions.text();
                                 case options.length: return "<b>All</b>";
                                 default: return countOfSelected + " Banners";
                             }
                         }

                     });
                 });
				 
				 $(document).ready(function () {
	 var el = document.getElementById("divbanner2");
			el.style.display = "none";
 });
//-->
</script>
<?
}
///////////////CHECK Contacto/////////////////////////////////////
if($act=="save"){


$name = $_POST['name'];
$logo = $_FILES['logo'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$top = $_POST['top'];
$top1 = $_POST['top1'];
$top2 = $_POST['top2'];
$top3 = $_POST['top3'];
$top4 = $_POST['top4'];
$top5 = $_POST['top5'];
$top6 = $_POST['top6'];
$top7 = $_POST['top7'];
$top8 = $_POST['top8'];
$top9 = $_POST['top9'];
$top10 = $_POST['top10'];
$code = $_POST['code'];
$raw = $_POST['raw'];


$tbl_1 = $_POST['tbl_1'];
$tbl_2 = $_POST['tbl_2'];
$tbl_3 = $_POST['tbl_3'];


$show_note = $_POST['show_note'];
$note = $_POST['note'];


//special
$special = $_POST['special'];
$special1 = $_POST['special1'];
$special2 = $_POST['special2'];
$special3 = $_POST['special3'];
$special4 = $_POST['special4'];
$special5 = $_POST['special5'];
$special6 = $_POST['special6'];
$special7 = $_POST['special7'];
$special8 = $_POST['special8'];
$special9 = $_POST['special9'];
$special10 = $_POST['special10'];

$special_show_note = $_POST['special_show_note'];
$special_note = $_POST['special_note'];

//Banners's Selection


$Value1 = explode(';',$_POST['Banner1']);
$Value2 = explode(';',$_POST['Banner2']);





//special_show_note


if($logo==""){
	$imagen = "blank.gif";
}else{
	if (move_uploaded_file($_FILES['logo']['tmp_name'], "../images/affiliates/".$name."_".$_FILES['logo']['name']))
	{
		$imagen = $name."_".$_FILES['logo']['name'];
	} 
	else
	{
		$imagen = "blank.gif";
	}
}


//        $update = $db->consulta("UPDATE `affiliates` SET `email`='".$email."',`top`='$top',`1`='$top1',`2`='$top2',`3`='$top3',`4`='$top4',`5`='$top5',`6`='$top6',`7`='$top7',`8`='$top8',`9`='$top9',`10`='$top10',`code`='$code',`logo`='$imagen',`show_note`='$show_note',`note`='$note',`raw`='$raw' WHERE `id`='".$id."'");
		

//special
 //       $update1 = $db->consulta("UPDATE `special` SET `email`='".$email."',`top`='$top',`1`='$special1',`2`='$special2',`3`='$special3',`4`='$special4',`5`='$special5',`6`='$special6',`7`='$special7',`8`='$special8',`9`='$special9',`10`='$special10',`code`='$code',`logo`='$imagen',`special`='$special',`special_show_note`='$special_show_note',`special_note`='$special_note' WHERE `id`='".$id."'");   tbl_1






      $ejecutar =  $db->consulta("INSERT INTO `affiliates` (`name`,`email`,`counter`,`top`,`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`,`9`,`10`,`code`,`logo`,`show_note`,`note`,`raw`,`tbl_1`,`tbl_2`,`tbl_3`) VALUES ('".$name."','".$email."','0','$top','$top1','$top2','$top3','$top4','$top5','$top6','$top7','$top8','$top9','$top10','$code','$imagen','$show_note','$note','$raw','$tbl_1','$tbl_2','$tbl_3')");
	  
	   $AffiliateID = $db->getLastID();	
	  
//special
      $ejecutar =  $db->consulta("INSERT INTO `special` (`id`,`name`,`email`,`counter`,`top`,`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`,`9`,`10`,`code`,`logo`,`special`,`special_show_note`,`special_note`) VALUES ('". $AffiliateID."','".$name."','".$email."','0','$top','$special1','$special2','$special3','$special4','$special5','$special6','$special7','$special8','$special9','$special10','$code','$imagen','$special','$special_show_note','$special_note')");
	  
if(count($Value1) > 0)
{
foreach( $Value1 as $i => $banners){
	
 $ejecutar =  $db->consulta("INSERT INTO `affiliates_banner` (`idaffiliate`,`idbanner`) values ('".$AffiliateID."','".$Value1[$i]."')");

}
}

	  
if(count($Value2) > 0)
{
foreach( $Value2 as $y => $banners2){
	
 $ejecutar =  $db->consulta("INSERT INTO `affiliates_banner` (`idaffiliate`,`idbanner`) values ('".$AffiliateID."','".$Value2[$y]."')");

}
} 

$search = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,&,&amp;,',.,Ô");
$replace = explode(",","a,e,i,o,u,n,A,E,I,O,U,N,a,e,i,o,u,n,A,E,I,O,U,N,,,,,o");
$correccion= str_replace($search, $replace, $name);
$nombrecorto = ereg_replace(",", "", $correccion);
$nombreAfiliado =  strtolower($nombrecorto);
$ruta = str_replace(' ', '', $nombreAfiliado );

/*@mkdir("../link/".$ruta,0755);

$contenido = "<?php\n";
$contenido .= "header(\"HTTP/1.1 301 Moved Permanently\");\n";
$contenido .= "header(\"Location: https://www.costaricaraw.com/dev/index.php?cmd=redir&afid=".$AffiliateID."\");\n";
$contenido .= "exit();\n";
$contenido .= "?>"; 
$archivo="../link/".$ruta."/index.php"; 
$fp=fopen($archivo,'w+'); 
fwrite($fp,$contenido); 
fclose($fp);
*/	

	 $update = $db->consulta("UPDATE `affiliates` SET `url`='https://www.costaricaraw.com/dev/home/".$ruta."',`contact`='".$ruta."' WHERE `id`='".$AffiliateID."'");

//categories

$categories = $_REQUEST['categories'];	
for ($i = 0; $i < count($categories); $i++)
  {

$Categories = $categories[$i];
if($Categories==""){
	
}else{

$sqlAddCategories = mysql_query("INSERT INTO `affiliates_menu`(`affiliate`,`menu`)VALUES('".$AffiliateID."','".$Categories."')");

}
}

	
?>
        
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><h2>URL Affiliate</h2></td>
  </tr>
  <tr>
    <td height="40" align="center"><strong>https://www.costaricaraw.com/dev/home/<?=$ruta?>/
    </strong></td>
  </tr>
  <tr>
    <td height="50" align="center"><input name="Cancelar2" type="button" id="Cancelar2" value="Continue" onClick="self.location='index.php?cmd=affiliates'" class="boton"/></td>
  </tr>
</table>

<script language="javascript">
                <!--
				       
                //   document.location='index.php?cmd=affiliates';
                //-->
                </script>
        <?
}



//////////////////BORRAR USUARIO/////////////////////
if($act=="Remove"){


$resp = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);

if (!IsSet($page)) {
        $page = "confirm";
}

if ($page == "confirm") {

?>
<center>
        <br><br>
<span class="titulos">This action will remove Affiliate <em><strong><? echo $Page['name']; ?></strong></em>.</span><br><font color="#FF0000"><em>You sure?</em></font><br>

<br>
<input name="SI" type="button" id="YES" value="  Yes  " onClick="self.location='index.php?cmd=affiliates&act=Remove&page=Remove&id=<? echo $Page['id']; ?>'" class="boton"/>
&nbsp;&nbsp;&nbsp;
<input name="NO" type="button" id="NO" value="  No  " onClick="self.location='index.php?cmd=affiliates'" class="boton"/></center>
<?


}
if ($_REQUEST["page"] == "Remove") {

$resp = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$id."'");
$Page = $db->fetch_array($resp);

$search = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,&,&amp;,',.,Ô");
$replace = explode(",","a,e,i,o,u,n,A,E,I,O,U,N,a,e,i,o,u,n,A,E,I,O,U,N,,,,,o");
$correccion= str_replace($search, $replace, $Page['name']);
$nombrecorto = ereg_replace(",", "", $correccion);
$nombreAfiliado =  strtolower($nombrecorto);
$ruta = str_replace(' ', '', $nombreAfiliado );
//@unlink("../affiliates/".$ruta."/index.php"); 
//@rmdir("../affiliates/".$ruta);

	$delete2 = $db -> consulta("DELETE FROM `affiliates_banner` WHERE `idaffiliate`='".$id."'");
  	$delete1 = $db->consulta("DELETE FROM `special` WHERE `id`='".$id."'");
        $delete = $db->consulta("DELETE FROM `affiliates` WHERE `id`='".$id."'");
      
        ?>
<script language="javascript">
                <!--
                        document.location='index.php?cmd=affiliates';
                //-->
                </script>
<?
}
}
?>
<?php endif;
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

?>