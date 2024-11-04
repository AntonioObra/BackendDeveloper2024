<?php

// * Ucitaj sve klase
require_once "autoloader.php";

// * Stvori novi db connection
$db = Database::get_instance()->get_connection();

// * Kreiraj tablicu
try {
    $stmt = $db->prepare(
        "CREATE TABLE users (user_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255), email VARCHAR(255) UNIQUE)"
    );
    $stmt->execute();
} catch (PDOException $e) {
    var_dump($e);
}

// * Dodaj u tablicu 2 korisnika
$stmt = $db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
$stmt->execute([
    ":name" => "Antonio",
    ":email" => "antonio@obradovic.dev",
]);

$stmt = $db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
$stmt->execute([
    ":name" => "Algebra",
    ":email" => "algebra@algebra.hr",
]);

// * Dobi sve korisnike
$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($users);
echo "</pre>";

// * Izbrisi tablicu
try {
    $stmt = $db->prepare("DROP TABLE IF EXISTS users");
    $stmt->execute();
} catch (PDOException $e) {
    var_dump($e);
}
