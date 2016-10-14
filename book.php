<script type="text/javascript">
<!--//

function autoResize(id){
    var newheight;
    var newwidth;

    if(document.getElementById){
        newheight=document.getElementById(id).contentWindow.document .body.scrollHeight;
        newwidth=document.getElementById(id).contentWindow.document .body.scrollWidth;
    }

    document.getElementById(id).height= (newheight) + "px";
    document.getElementById(id).width= (newwidth) + "px";
}

//-->
</script>
<iframe src="calendar.php?adv=<?php echo $_REQUEST['adventure']; ?>" frameborder="0" scrolling="no" id="iframe1" width="500" height="300" name="iframe1" onLoad="autoResize('iframe1');" ></iframe>