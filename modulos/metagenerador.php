
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"

      xmlns:v="urn:schemas-microsoft-com:vml"

      lang="en"

      xml:lang="en">

 <head>

  <title>Geo Tag Generator</title>

<!-- next line is temporarily for IE8 marker bug -->

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

  <meta http-equiv="Content-Script-Type" content="text/javascript" />

 

 

  <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAGpEWenySjkI7QuRAy1fXBxQ9C6UIPEUyl5QKj9tlynWBI2uRZRSTkTEL0sMfbRCRE7oWkY3e8lhSCA" type="text/javascript"></script>

  <script src="../js/texten.js" type="text/javascript"></script>

  <script src="../js/geo.js" type="text/javascript"></script>

  


 </head>



<body onload="load()" onunload="GUnload()">

 <div id="content">

   <div id="kopf">

   

    <h1>&nbsp;</h1>
  </div>
<div id="generator">

  <form action="#" onsubmit="showAddress(this.address.value); return false">

     <div id="haddress" class="hinweis"></div>

     <input type="text" size="60" id="address" name="address" value="" />

     <input type="submit" value="Address Search" />

  </form>

    <div id="map" style="width: 770px; height: 400px;"></div>



  <form id="georegion" name="georegion" action="">

     <span class="inlinefloat" style="width:70px;">Latitude: </span>

     <input type="text" readonly="readonly" id="lati" onclick="this.focus(); this.select();" class="inlinefloat" style="width:80px; background-color:#c0e1f3;" />

     <span class="inlinefloat" style="width:90px;">&nbsp;&nbsp;Longitude: </span>

     <input type="text" readonly="readonly" id="longi" onclick="this.focus(); this.select();" class="inlinefloat" style="width:80px; background-color:#c0e1f3;" />

     <div style="clear: left;"></div>

    <div id="hgenau" class="hinweis"></div>
    </form>



</div>

</body>

</html>
