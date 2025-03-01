<?php
    function connection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "ukhy_db";

        $conn = new mysqli($servername,$username,$password,$database);

        return $conn;
    }
?>    