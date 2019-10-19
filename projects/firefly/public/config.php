<?php

$host = $_ENV['FIREFLY_MYSQL_HOST'];
$db = $_ENV['FIREFLY_MYSQL_DB'];
$user = $_ENV['FIREFLY_MYSQL_USER'];
$password = $_ENV['FIREFLY_MYSQL_PASSWORD'];

$charset = 'utf8mb4';

$options = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new \PDO(
        "mysql:host=$host;dbname=$db;charset=$charset",
        $user,
        $password,
        $options
    );
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$stmt = $pdo->query("
    SELECT u.id, u.name, m.name, m.year FROM users u 
    JOIN user_movie um ON u.id = um.user_id 
    JOIN movies m ON um.movie_id = m.id
    ORDER BY u.name
");

$data = $stmt->fetchAll();