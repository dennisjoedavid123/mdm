<?php
function connect()
{
    $host = "localhost";
    $username = "root";
    $password = "parul";
//    $database = "edetailing_7feb2014";
    $conn = mysql_connect($host, $username, $password);
    if (!$conn) {
        return null;
    } else {
        mysql_select_db('mosquittodb');
        return $conn;
    }
}
?>