<?php

require('db.php');

$db = new Database();
$db->delete_by_id($_GET['id']);
header('location: index.php');