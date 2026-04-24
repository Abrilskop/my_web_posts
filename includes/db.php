<?php
$host = 'localhost'; 
$dbname = 'misposts_db';
$user = 'root';
$password = 'sopasinstantaneas'; // Tu contraseña correcta
$puerto = '3307';                // Tu puerto de XAMPP

try {
    // Usamos PDO con mysql para XAMPP
    $dsn = "mysql:host=$host;port=$puerto;dbname=$dbname;charset=utf8";
    
    // Aquí creamos la variable $pdo que index.php y crear_post.php están buscando
    $pdo = new PDO($dsn, $user, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>