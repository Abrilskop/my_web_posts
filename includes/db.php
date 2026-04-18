<?php
$host = 'db'; // Nombre del contenedor Docker
$port = '5432';
$dbname = 'misposts_db';
$user = 'root';
$password = 'password123';

try {
    // Fíjate que dice "pgsql", esto es clave para PostgreSQL
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>