<?php
    $host = "localhost"; 
    $username = "root";  
    $database = "job"; 
    
    
    $conn = new mysqli($host, $username, '', $database);
    
    
    if ($conn->connect_error) {
        die("Error: " . $conn->connect_error);
    }
?>