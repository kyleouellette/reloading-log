<?php

require('db.php');
$db = new Database();
$db->create_load($_POST['caliber'], $_POST['charge'], $_POST['cc'], $_POST['col'], $_POST['report']);
header('location: index.php');