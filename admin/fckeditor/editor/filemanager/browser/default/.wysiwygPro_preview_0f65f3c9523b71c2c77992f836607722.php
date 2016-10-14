<?php
if ($_GET['randomId'] != "qXAFULD8D_YNXf0JHT3XNWc1YrPi390bB524cCaJJDxjwu0wgV0NmyqReNXGBkPq") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
