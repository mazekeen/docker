<?php

$host = $_ENV['MONKEY_MYSQL_HOST'];
$db = $_ENV['MONKEY_MYSQL_DB'];
$user = $_ENV['MONKEY_MYSQL_USER'];
$password = $_ENV['MONKEY_MYSQL_PASSWORD'];

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

