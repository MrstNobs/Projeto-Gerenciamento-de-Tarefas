<?php 
    $host = 'localhost';
    $dbname = 'gerenciamento';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Erro na conexão. <br>". $e->getMessage());
        return false;
    }
?>