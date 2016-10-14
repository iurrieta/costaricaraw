<?php
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
 require_once("..\visitor_common.php");
else
 require_once("../visitor_common.php");
 
header('Content-type: text/css');
?>
	html{	
		overflow:-moz-scrollbars-vertical;
	}	
	body{		
		padding-bottom:30px;	
	}
		
	#sp_logo {
		z-index: 5000;
		position: fixed;
		#position: absolute;
		top:expression(eval(document.compatMode &&
		document.compatMode=='CSS1Compat') ?
		documentElement.scrollTop
		+(documentElement.clientHeight-this.clientHeight) 
		: document.body.scrollTop
		+(document.body.clientHeight-this.clientHeight));
		overflow:hidden;
		margin:0px;
		bottom:0px;
		display:block;
		height:21px;
		width:25px;
		left:21px;
	}
	#socialpanel_bar{
		z-index: 500;
		position: fixed;
		#position: absolute;
		top:expression(eval(document.compatMode &&
		document.compatMode=='CSS1Compat') ?
		documentElement.scrollTop
		+(documentElement.clientHeight-this.clientHeight) 
		: document.body.scrollTop
		+(document.body.clientHeight-this.clientHeight));
		overflow:hidden;
		margin:0px;
		bottom:0;
		display:block;
		height:25px;
		width:200px;
		border:0px solid #ccc;
		left:15px;
		right:15px;
		border-left:0px solid #b5b5b5;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		font-size:11px;
	}
	.menu{
		position:relative;
		left:10px;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		font-size:11px;
	}
	.list{
		position:relative;
		left:18px;
		padding-bottom:5px;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		font-size:11px;
	}
	.buddylist a.friend {
		padding: 5px 15px 5px 10px;
	  background-color: #DFDFDF;
		color: #3b5998;
		border-top: 1px solid #D0D0D0;		
		display: block;
		text-decoration: none;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		font-size:11px;

	}
	.buddylist a.friend:hover {
		padding: 5px 15px 5px 10px;
	  background-color: #3b5998 !important;
		color: #FFFFFF;
	  border-top: 1px solid #D0D0D0;
		display: block;
		text-decoration: none;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		font-size:11px;
	}
	.changeStatus {
		background-image:url(<?php echo $CSLH_Config['s_webpath'] ?>insite/images/graybg.png);
		font-size:9px; 
		background-color:#A6A6A6; 
		padding-bottom:3px; 
		padding-top:2px;
		color:#FFFFFF;
	}

	.bartab{
		background-image:url(<?php echo $CSLH_Config['s_webpath'] ?>insite/images/bluebg.png);
		margin-top:1px;
		border-left:1px solid #ccc;
		border-right:1px solid #e5e5e5;
		float:right;
		padding-left:10px;
		padding-top:5px;
		display:block;
		cursor:pointer;
		font-weight:bold;
		width:160px;
		color:#444;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		font-size:11px;
	}
	.bartabPop{
		z-index: 1000;
		position: fixed;
		#position: absolute;
		top:expression(eval(document.compatMode &&
		document.compatMode=='CSS1Compat') ?
		documentElement.scrollTop
		+(documentElement.clientHeight-this.clientHeight) 
		: document.body.scrollTop
		+(document.body.clientHeight-this.clientHeight));
		background-image:url(<?php echo $CSLH_Config['s_webpath'] ?>insite/images/bluebg.png);
		margin-top:1px;
		height:20px;
		#height:25px;
		border-left:1px solid #ccc;
		border-right:1px solid #e5e5e5;
		padding-left:10px;
		padding-top:5px;
		display:block;
		cursor:pointer;
		font-weight:bold;
		width:160px;
		color:#444;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		font-size:11px;
	}
	.gotab{
		background-image:url(<?php echo $CSLH_Config['s_webpath'] ?>insite/images/bluebg.png);
		margin-top:1px;
		border-right:1px solid #ccc;
		border-left:1px solid #e5e5e5;
		float:left;
		padding-left:10px;
		padding-top:5px;
		display:block;
		cursor:pointer;
		font-weight:bold;
		width:160px;
		color:#444;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		font-size:11px;
	}

	.tabicons{
		background-image:url(<?php echo $CSLH_Config['s_webpath'] ?>insite/images/bluebg.png);
		border-right:1px solid #ccc;
		float:left;
		padding-top:5px;
		padding: auto;
		display:block;
		vertical-align: middle;
		cursor:pointer;
		font-weight:bold;
		width:25px;
		color:#444;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		font-size:11px;
	}
	.popupDiv {
		font-weight:bold;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		font-size:11px;
		background-color:#FFFFFF;
		position: fixed;
		#position: absolute;
		width:250px;
		top:expression(eval(document.compatMode &&
		document.compatMode=='CSS1Compat') ?
		(documentElement.scrollTop
		+(documentElement.clientHeight-this.clientHeight))-25 
		: (document.body.scrollTop
		+(document.body.clientHeight-this.clientHeight))-25);
    z-index:5000;
	}


	.popBar{
		background-color: rgb(82, 110, 166);
		cursor: pointer;
		font-size: 11px;
		font-weight: bold;
		position: relative;
		width: 100%;
		top: 0px;
	}
	.popBar span{
		display: block;
		padding: 3px 8px;
		font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
		color: white;
		font-size:11px;
		top: 0px;
		}
	.popBar .popMin {
		background-color: rgb(173, 190, 216);
		float: right;
		height: 2px;
		overflow: hidden;
		position: absolute;
		right: 5px;
		top: 10px;
		width: 9px;
	}
	.popBar .popOut {
		float: right;
		height: 21px;
		overflow: hidden;
		position: absolute;
		right: 15px;
		top: 0px;
		width: 25px;
	}
	.chatType {
		background: url(<?php echo $CSLH_Config['s_webpath'] ?>insite/images/lc2female.png) no-repeat;
		height:20px;
		width:227px;
		width:100%-10px;
		font-size: 13px;
		border-left: none;
		border-top: none;
		border-bottom: none;
		border-right: none;
		margin:0px;
		padding-left:15px;
		background-position:center left;
		font-size:11px
		padding: 4px 4px 4px 24px;
		white-space: pre-wrap;
		word-wrap: break-word;
		font-family: 'lucida grande', tahoma, verdana, arial, sans-serif;
	}

	.chatbox {
		border-right:1px solid #333;
		border-left:1px solid #333;
		border-bottom:1px solid #333;
		padding-top:3px;
		padding-bottom:3px;
		padding-left:3px;
		padding-right:3px;
		color:black;
		white-space: pre-wrap;
		word-wrap: break-word;
		//max-height: 227px;
		height:227px;
		overflow-y:auto;
		background-color:#fff;
		color:#333;
		z-index:999;
	}