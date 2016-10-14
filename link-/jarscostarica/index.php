<?php

//header("Location: http://www.costaricaraw.com/dev/index.php?cmd=redir&afid=15");

?>
<style>
body {
	margin:0 0 0 0;
}
</style>
<?php
//Este es el index.php donde se manerajá el Request
$permalinks = explode("/",$_SERVER['REQUEST_URI']);

print_r($permalinks);
?>