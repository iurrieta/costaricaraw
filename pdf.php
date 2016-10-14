<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Costa Rica Raw Adventures | <?php echo $_REQUEST['name']; ?> Bus Schedules</title>
<link rel="icon" href="favicon.png" type="image/png" />
<link rel="bookmark" href="favicon.ico" />
<link rel="shortcut icon" href="favicon.ico" />
<meta property="og:title" content="Costa Rica Raw | Bus Schedules <?php echo $_REQUEST['name']; ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="https://www.costaricaraw.com/dev/doc/transp/<?php echo $_REQUEST['image']; ?>.jpg" />
<meta property="og:url" content="https://www.costaricaraw.com/dev/doc/transp/<?php echo $_REQUEST['image']; ?>.jpg" />
<meta property="og:description" content="Costa Rica Raw Adventures | <?php echo $_REQUEST['name']; ?> Bus Schedules" />
</head>

<body>
<iframe src="pdf-read.php?pdf=<?php echo $_GET['pdf']; ?>&name=<?php echo $_REQUEST['name']; ?>&image=<?php echo $_REQUEST['image']; ?>" frameborder="0" scrolling="no" width="450" height="520"></iframe>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style" align="right">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4df9232e7115649c"></script>
<!-- AddThis Button END -->
</body>
</html>
