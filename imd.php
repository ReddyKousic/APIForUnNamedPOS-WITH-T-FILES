<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "imgp";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all images from the 'images' table in the latest-first order
$sql = "SELECT * FROM images ORDER BY id DESC";
$result = $conn->query($sql);


$sql1 = "SELECT COUNT(*) as count FROM images";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
    $recordCount = $row["count"];
} else {
    $recordCount = 0;
}


function deleteImage($conn, $imageId) {
    $sql = "DELETE FROM images WHERE id = $imageId";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Check if the delete button is clicked
if (isset($_POST['delete_image'])) {
    $imageIdToDelete = $_POST['image_id'];
    if (deleteImage($conn, $imageIdToDelete)) {
        echo "<p style='color: green;'>Image deleted successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error deleting image.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latest Image Grid</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;800;900&family=Poppins:wght@500&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            font-family: 'Cinzel', serif;
            font-size: 100px;
            margin-top: 10px;
            text-align: center;
            color: #EA1179;
            font-weight: 900;
            margin-bottom: -30px;
        }

        p {
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 30px;

        }
     
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 10px;
            padding: 20px;
            justify-content: center;
        }
        .image-card {
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 10px;
            display: flex;
            flex-direction: column;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        p {
            margin: 5px 0;
        }
        .image-id {
            font-weight: bold;
            color: #777;
        }
    </style> -->

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        h2 {
            font-family: 'Cinzel', serif;
            font-size: 100px;
            margin-top: 10px;
            text-align: center;
            color: #EA1179;
            font-weight: 900;
            margin-bottom: -30px;
        }

        #pp {
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 30px;

        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            justify-content: center;
        }
        .image-card {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            transition: transform 0.2s;
        }
        .image-card:hover {
            transform: scale(1.05);
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        p {
            margin: 10px 0;
            color: #777;
        }
        .image-id {
            font-weight: bold;
            color: #333;
        }
        .delete-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #f44336;
            font-size: 18px;
        }
    </style>
</head>
<body>
<h2>Stranect</h2>
    <p id="pp">Total Images in the Database : <span><?php echo($recordCount); ?></span></p>
    
    <div class="image-grid">
        <?php
        // Database connection configuration
        

        // Display the images
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='image-card'>";
                echo "<span class='image-id'>ID: " . $row['id'] . "</span>";
                echo "<span class='delete-icon' onclick='deleteImageConfirm(" . $row['id'] . ")'>&#10006;</span>";
                echo "<img src='" . $row['img_url'] . "' alt='" . $row['img_id'] . "'>";
                echo "<p>Category: " . $row['category'] . "</p>";
                echo "<p>Tags: " . $row['tags'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "No images found.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
 <!-- JavaScript function to confirm image deletion -->
 <script>
            function deleteImageConfirm(imageId) {
                if (confirm("Are you sure you want to delete this image?")) {
                    // Create a form to submit the image ID for deletion
                    var form = document.createElement("form");
                    form.method = "POST";
                    form.action = "";
                    var input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "image_id";
                    input.value = imageId;
                    form.appendChild(input);
                    // Create a submit button
                    var submitButton = document.createElement("input");
                    submitButton.type = "submit";
                    submitButton.name = "delete_image";
                    submitButton.style.display = "none"; // Hide the button
                    form.appendChild(submitButton);
                    // Append the form to the body and submit it
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        </script>
</html>
