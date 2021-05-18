<?php
include_once("API.php");

$API = new API();

echo (json_encode($API->sendChat($_GET["msg"], $_GET["senderId"], $_GET["receiveId"])));
