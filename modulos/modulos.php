<?php

switch($cmd){
	case "":
        include('modulos/home.php');
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
	      
   case "travel":
   if ( file_exists("modulos/travel.php")){
               include('modulos/travel.php');

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
	   
	case "location":
	if ( file_exists("modulos/location.php")){
               include('modulos/location.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
	break;	   
	
	case "redir":
	if ( file_exists("modulos/affiliate.php")){
               include('modulos/affiliate.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;
	
	case "search":
	if ( file_exists("modulos/search.php")){
               include('modulos/search.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;
	
	case "buy":
	if ( file_exists("modulos/reservation.php")){
               include('modulos/reservation.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;

	case "crmap":
	if ( file_exists("modulos/crmap.php")){
               include('modulos/crmap.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;
	
	case "thanks":
	if ( file_exists("modulos/thanks.php")){
               include('modulos/thanks.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;	
	
	case "paythanks":
	if ( file_exists("modulos/paythanks.php")){
               include('modulos/paythanks.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;	
	
	case "cart":
	if ( file_exists("modulos/carrito.php")){
               include('modulos/carrito.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;
	
	case "bus":
	if ( file_exists("modulos/bus.php")){
               include('modulos/bus.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
    break;	

	case "payment":
	if ( file_exists("modulos/payment.php")){
               include('modulos/payment.php');

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
	
	case "categories":
	if ( file_exists("modulos/categories.php")){
               include('modulos/categories.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
	break;	
	
	case "cancel":
	if ( file_exists("modulos/cancel.php")){
               include('modulos/cancel.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
	break;	
	
	case "book":
	if ( file_exists("modulos/book.php")){
               include('modulos/book.php');

        } else {
                echo ("<h2 align=\"center\">Module Disabled</h2>");
        }
	break;				
		

		
}
?>