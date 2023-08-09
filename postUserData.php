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

// Handle different HTTP methods
switch ($method) {

    case 'POST':
        // Get the Authorization header
     
        // Get the Authorization header using getallheaders()
        $headers = getallheaders();
        $authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';


        // Check if the header is present and starts with 'Bearer '
        if ($authHeader && strpos($authHeader, 'Bearer ') === 0) {
            $jwtToken = substr($authHeader, 7); // Remove 'Bearer ' from the header
         

            try {

                $decoded = JWT::decode($jwtToken, new Key($key, 'HS256'));

                // Extract data from JWT payload
                $username = $decoded->username;
                $password = $decoded->password;
                $datetime = $decoded->datetime;
                $sid = $decoded->sid;

                // Generate random aid
                $aid = generateRandomString();

                // Insert data into the database
                $query = "INSERT INTO users (username, password, datetime, sid, aid) VALUES (:user, :pass, :dt, :sid, :aid)";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':user', $username, PDO::PARAM_STR);
                $statement->bindParam(':pass', $password, PDO::PARAM_STR);
                $statement->bindParam(':dt', $datetime, PDO::PARAM_STR);
                $statement->bindParam(':sid', $sid, PDO::PARAM_STR);
                $statement->bindParam(':aid', $aid, PDO::PARAM_STR);

                if ($statement->execute()) {
                    http_response_code(200);
                    echo json_encode(['message' => 'F']);
                } else {
                    http_response_code(500);
                    echo json_encode(['message' => 'Item creation failed']);
                }
            } catch (Exception $e) {
                http_response_code(400);

                echo json_encode(['message' => ' verification failed']);
            }
        } else {
            http_response_code(400);

            echo json_encode(['message' => 'Invalid']);
        }
        break;
    }





function generateRandomString($length = 50)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

// }

?>