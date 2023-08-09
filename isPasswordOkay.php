<?php
require 'vendor/autoload.php';
require './sec.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;



$key = $_ENV['key'];
header('Content-Type: application/json');

// Database configuration
$host = $_ENV['host'];
$username = $_ENV['username'];
$password = $_ENV['password'];
$database = $_ENV['database'];

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Get the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

// Extract the request parameters
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uriSegments = explode('/', $uri);
$id = isset($uriSegments[3]) ? $uriSegments[3] : null;

switch ($method) {
    case 'GET':
        $u = isset($_SERVER['HTTP_U']) ? $_SERVER['HTTP_U'] : '';
        $p = isset($_SERVER['HTTP_P']) ? $_SERVER['HTTP_P'] : '';

        if ($p == $_ENV['getp']) {
            // Retrieve a specific item
            $item = findItemByUsername($pdo, $u);
            if ($item) {
                echo json_encode(['message' => JWT::encode($item , $key, 'HS256')]);
            } else {
                echo json_encode(['message' => 'Item not found'], 404);
            }
            break;
        } else {
            echo json_encode(['message' => 'Fuck Youself mf bitch'], 404);
        }
        
        
}

function findItemByUsername($pdo, $username)
{
    $query = "SELECT id,username, sid, aid, datetime, password FROM users WHERE username = :u limit 1";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':u', $username, PDO::PARAM_STR);
    $statement->execute();
    $item = $statement->fetch(PDO::FETCH_ASSOC);
    return $item ? $item : null;
}
