<?php
if(isset($_GET['file'])){
    //Please give the Path like this
    $file = 'flyer/'.urldecode(str_replace("%20"," ",$_GET['file']));

    if (file_exists($file)) {
		$FlyerName = str_replace(" ","_",$file);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($FlyerName));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}
?>