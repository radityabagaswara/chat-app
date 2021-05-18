<?php
include_once("API.php");

$API = new API();

echo (json_encode($API->getChat($_GET['senderId'], $_GET['receiveId'])));
