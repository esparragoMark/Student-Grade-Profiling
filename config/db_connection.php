<?php

$servername =  "localhost";
$username = "root";
$password = "";
$db_name = "db_epsgp";

$conn = new mysqli($servername, $username, $password, $db_name);

if(!$conn)
{
    die("Connectin Failed:" .$conn->connect_error);
}
