<?php
// db.php
$host = '127.0.0.1';
$db   = 'ensadb';            // nom de la base (voir SQL)
$username = "root";
$password = "";
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);

} catch (PDOException $e) {
    // En dev afficher l'erreur ; en prod logger et afficher message générique
    die('DB Connection failed: ' . $e->getMessage());
}