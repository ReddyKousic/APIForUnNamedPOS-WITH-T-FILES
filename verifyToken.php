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
                http_response_code(200);
                echo json_encode(['message' => JWT::encode($item , $key, 'HS256')]);
            } else {
              
                http_response_code(404);
                echo json_encode(['message' => '0000']);
            }
            break;
        } else {
            echo json_encode(['message' => '00000'], 404);
        }
        
        
}

function findItemByToken($pdo, $username, $token, $aid)
{   
    $query = "SELECT valid FROM tokens WHERE username = :u AND token = :t AND aid = :a";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':u', $username, PDO::PARAM_STR);
    $statement->bindParam(':t', $token, PDO::PARAM_STR);
    $statement->bindParam(':a', $aid, PDO::PARAM_STR);
    $statement->execute();
    $item = $statement->fetch(PDO::FETCH_ASSOC);
    return $item ? $item : null;
}
