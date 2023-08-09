<?php
require 'vendor/autoload.php';
require './sec.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$skc = $_ENV['skc'];


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
        $mainjwt = isset($headers['token']) ? $headers['token'] : '';


        // Check if the header is present and starts with 'Bearer '
        if ($mainjwt && strpos($mainjwt, 'Bearer ') === 0) {
            $jwtToken = substr($mainjwt, 7); // Remove 'Bearer ' from the header
            

            try {

                $decoded = JWT::decode($jwtToken, new Key($skc, 'HS256'));

                // Extract data from JWT payload
                $id = $decoded->id;
                $username = $decoded->username;
                $token = $decoded->token;
                $valid = $decoded->valid;

                $aid = $decoded->aid;


                // Insert data into the database
                $query = "INSERT INTO tokens (id, username, token, valid, aid) VALUES (:id, :user, :token, :valid, :aid)";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':id', $id, PDO::PARAM_STR);
                $statement->bindParam(':user', $username, PDO::PARAM_STR);
                $statement->bindParam(':token', $token, PDO::PARAM_STR);
                $statement->bindParam(':valid', $valid, PDO::PARAM_STR);
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



// }

?>