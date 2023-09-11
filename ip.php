<?php
// Database connection information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imgp";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process user input (category and tag)
if (isset($_GET['category']) && isset($_GET['tag'])) {
    $category = $_GET['category'];
    $tag = $_GET['tag'];

    // Sanitize user input to prevent SQL injection (you should use prepared statements for production)
    $category = mysqli_real_escape_string($conn, $category);
    $tag = mysqli_real_escape_string($conn, $tag);

    // Construct the SQL query
    $sql = "SELECT * FROM images WHERE category = '$category' AND tags LIKE '%$tag%'";
    
    // Execute the query
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Display image information
            echo "Image ID: " . $row['img_id'] . "<br>";
            echo "Image URL: " . $row['img_url'] . "<br>";
            echo "Category: " . $row['category'] . "<br>";
            echo "Tags: " . $row['tags'] . "<br><br>";
        }
    } else {
        echo "No results found.";
    }
    
    // Close the database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Images</title>
</head>
<body>
    <h1>Search Images</h1>
    <form method="GET" action="">
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required><br><br>

        <label for="tag">Tag:</label>
        <input type="text" name="tag" id="tag" required><br><br>

        <input type="submit" value="Search">
    </form>
</body>
</html>
