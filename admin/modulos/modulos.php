<?php

switch($cmd){
	
	case "":
        include('modulos/inicio.php');
	break;
		
    case "pages":
		if ( file_exists("modulos/pages.php")){
               include('modulos/pages.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
	break;
	   
	case "login":
       include('modulos/login.php');
	break;
	      
   case "facilities":
   if ( file_exists("modulos/facilities.php")){
               include('modulos/facilities.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
   break;
	   
	case "adventures":
	if ( file_exists("modulos/adventures.php")){
               include('modulos/adventures.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
	break;
	   
	case "locations":
	if ( file_exists("modulos/locations.php")){
               include('modulos/locations.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
	break;	   
	
	case "affiliates":
	if ( file_exists("modulos/affiliates.php")){
               include('modulos/affiliates.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;
	
	case "transport":
	if ( file_exists("modulos/transport.php")){
               include('modulos/transport.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;
	
	case "reservations":
	if ( file_exists("modulos/reservations.php")){
               include('modulos/reservations.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;

	case "configure":
	if ( file_exists("modulos/configure.php")){
               include('modulos/configure.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;
	
	case "invoice":
	if ( file_exists("modulos/invoice.php")){
               include('modulos/invoice.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;	
	
	case "reports":
	if ( file_exists("modulos/reports.php")){
               include('modulos/reports.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;
	
	case "gateway":
	if ( file_exists("modulos/gateway.php")){
               include('modulos/gateway.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;	
	
	case "gallery":
	if ( file_exists("modulos/gallery.php")){
               include('modulos/gallery.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;	
	
	case "categorie":
	if ( file_exists("modulos/categorie.php")){
               include('modulos/categorie.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;	
	
	case "sales":
	if ( file_exists("modulos/sales.php")){
               include('modulos/sales.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;
	
		case "usuarios":
	if ( file_exists("modulos/users.php")){
               include('modulos/users.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;	

	case "logout":
	
        include('modulos/logout.php');
	break;	
	
	case "banner":
	
        include('modulos/banner.php');
	break;		
		

		
}
?>