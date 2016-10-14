<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Costa Rica Raw | <?php echo $_REQUEST['text']; ?></title>
<meta name="DC.Title" content="Costa Rica Raw | <?php echo $_REQUEST['text']; ?>">
<script type="text/javascript">
function popup(url,ancho,alto) {
var posicion_x; 
var posicion_y; 
posicion_x=(screen.width/2)-(ancho/2); 
posicion_y=(screen.height/2)-(alto/2); 
window.open(url, "costaricaraw.com/dev", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
</script> 
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ra-51106bbc75b90833"});</script>
</head>

<body>
<span class='st_googleplus_large' displayText='Google +' st_url="http://www.costaricaraw.com/dev/flyer/<?php echo $_REQUEST['flyer']; ?>" st_title="<?php echo $_REQUEST['text']; ?>"></span>
<span class='st_facebook_large' displayText='Facebook' st_url="http://www.costaricaraw.com/dev/flyer/<?php echo $_REQUEST['flyer']; ?>" st_title="<?php echo $_REQUEST['text']; ?>"></span>
<span class='st_twitter_large' displayText='Tweet' st_url="http://www.costaricaraw.com/dev/flyer/<?php echo $_REQUEST['flyer']; ?>" st_title="<?php echo $_REQUEST['text']; ?>"></span>
<span class='st_email_large' displayText='Email' st_url="http://www.costaricaraw.com/dev/flyer/<?php echo $_REQUEST['flyer']; ?>" st_title="<?php echo $_REQUEST['text']; ?>"></span>


<?php if($_REQUEST['type']=="doc"){ ?>
<div style="padding:5px; text-align:left; font-size:12px;">
<br />Share this &nbsp;&nbsp;|&nbsp;&nbsp;<a href="download.php?file=<?php echo $_REQUEST['flyer']; ?>">Download	</a>
</div>

<br />
<iframe src="http://docs.google.com/viewer?url=http://www.costaricaraw.com/dev/flyer/<?php echo $_REQUEST['flyer']; ?>&#038;hl=es&#038;embedded=true" class="gde-frame" style="width:650px; height:400px; border: none;" scrolling="no"></iframe>


<?php } ?>
<?php if($_REQUEST['type']=="img"){ ?>
<div style="padding:5px; text-align:left;font-size:12px;">
<br />Share this &nbsp;&nbsp;|&nbsp;&nbsp;<a href="download.php?file=<?php echo $_REQUEST['flyer']; ?>">Download	</div>
<br />
<img src="flyer/<?php echo $_REQUEST['flyer']; ?>" alt="<?php echo $_REQUEST['text']; ?>" style="max-width:650px;" />


<?php } ?>	
</body>
</html>