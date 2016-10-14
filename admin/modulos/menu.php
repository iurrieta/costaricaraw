<h5>Administrative Menu</h5>
<ul id="navi">
    <?php
    $db = new MySQL();
    $query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
    $sql = $db->fetch_array($query);

    if( $_SESSION['CRR_AUserID']=="1" && $sql['m1'] == '1'){ ?>
        <li><a href="index.php?cmd=usuarios">Administrators</a></li>
    <?php } if($sql['m2'] == '1') {?>
        <li><a href="index.php?cmd=categorie">Categories</a></li>
    <?php } if($sql['m3'] == '1') {?>
        <li><a href="index.php?cmd=adventures">Adventures</a></li>
    <?php } if($sql['m4'] == '1') {?>
        <li><a href="index.php?cmd=banner">Banner</a></li>
    <?php } if($sql['m5'] == '1') {?>
        <li><a href="index.php?cmd=gallery">Gallery</a></li>
    <?php } if($sql['m6'] == '1') {?>
        <li><a href="index.php?cmd=facilities">Facilities</a></li>
    <?php } if($sql['m7'] == '1') {?>
        <li><a href="index.php?cmd=locations">Locations</a></li>
    <?php } if($sql['m8'] == '1') {?>
        <li><a href="index.php?cmd=affiliates">Affiliates</a></li>
    <?php } if($sql['m9'] == '1') {?>
        <li><a href="index.php?cmd=reservations">Reservations</a></li>
    <?php } if($sql['m10'] == '1') {?>
        <li><a href="index.php?cmd=sales">Sales Report</a></li>
    <?php } if($sql['m11'] == '1') {?>
        <li><a href="index.php?cmd=pages">Pages</a></li>
    <?php } if($sql['m12'] == '1') {?>
        <li><a href="index.php?cmd=transport">Bus Schedules</a></li>
    <?php } if($sql['m13'] == '1') {?>
        <li><a href="index.php?cmd=configure">Configure Site</a></li>
    <?php } ?>
    <li><a href="logout.php">Logout</a></li>
</ul>

