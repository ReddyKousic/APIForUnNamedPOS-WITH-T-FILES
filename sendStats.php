<?php
require 'vendor/autoload.php';
require './sec.php';
require './enc.php';


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
                $sid = decrypt($decoded->sid);
                $profile = $decoded->profile;
                $interests = $decoded->interests;















                // Insert data into the database
                // $query = "INSERT INTO stats (sid, profile, interests) VALUES (:sid, :profile, :interests)";
                $query = "INSERT INTO stats (sid, profile, interests)
                            VALUES (:sid, :profile, :interests)
                            ON DUPLICATE KEY UPDATE
                                sid = VALUES(sid),
                                profile = VALUES(profile),
                                interests = VALUES(interests);
                        ";


                $statement = $pdo->prepare($query);
                $statement->bindParam(':sid', $sid, PDO::PARAM_STR);
                $statement->bindParam(':profile', $profile, PDO::PARAM_STR);
                $statement->bindParam(':interests', $interests, PDO::PARAM_STR);


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


// function findItemBySID($pdo, $username)
// {
//     $query = "SELECT username, sid, datetime FROM users WHERE username = :u";
//     $statement = $pdo->prepare($query);
//     $statement->bindParam(':u', $username, PDO::PARAM_STR);
//     $statement->execute();
//     $item = $statement->fetch(PDO::FETCH_ASSOC);
//     return $item ? $item : null;
// }



?>