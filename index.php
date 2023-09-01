<?php

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imgp";


// $servername = "mysql-stranect-admin.alwaysdata.net";
// $username = "325498";
// $password = "kousic2211A!@";
// $dbname = "stranect-admin_1";





// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if (isset($_POST['submit'])) {
    $img_id = $_POST['img_id'];
    $img_url = $_POST['img_url']; // Convert to lowercase
    $category = strtolower($_POST['category']); // Convert to lowercase
    $tags = strtolower($_POST['tags']); // Convert to lowercase

    $sql = "INSERT INTO images (img_id, img_url, category, tags) VALUES ('$img_id', '$img_url', '$category', '$tags')";

    if ($conn->query($sql) === TRUE) {
        echo "Image uploaded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Query to count records in the 'images' table
$sql1 = "SELECT COUNT(*) as count FROM images";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $recordCount = $row["count"];
} else {
    $recordCount = 0;
}
// Close the database connection
$conn->close();
?>









<!DOCTYPE html>
<html>

<head>
    <title>Image Upload Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;800;900&family=Poppins:wght@500&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            font-family: 'Cinzel', serif;
            font-size: 60px;
            margin-top: 20px;
            text-align: center;
            color: #EA1179;
            font-weight: 900;
        }

        p {
            margin-top: -50px;
            text-align: center;
            font-family: 'Poppins', sans-serif;

        }
        p span {
            font-family: 'Ubuntu', sans-serif;

        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            font-family: 'Ubuntu', sans-serif;
        }
        input{
            font-family: 'Poppins', sans-serif;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            /* background-color: #007bff; */
            background-color:#241468;
            /* background-color: #EA1179; */

            font-weight: 800;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #3b2499;
            /* background-color:#241468; */
        }

        input[type="text"][readonly] {
            background-color: #f4f4f4;
            cursor: not-allowed;
        }

        .imgpr {
            height: 400px;
            width: 400px;

            /* background-color: green; */
            margin-top: 10px;
            margin-bottom: 10px;

            display: none;
        }
    </style>
</head>

<body>
    <h2>Stranect</h2>
    <p>Total Images in the Database : <span><?php echo($recordCount); ?></span></p>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="img_id">Image ID:</label>
        <input type="text" name="img_id" value="<?php echo generateRandomString12(30); ?>" readonly>

        <label for="img_url">Image URL:</label>
        <input type="text" placeholder="eg. : https://image.com/image.jpeg" id="imginp" name="img_url" required>
        <div class="imgpr" id="imgpr">

        </div>

        <label for="category">Category:</label>
        <input type="text" placeholder="eg. : Dark or Abstract or Emoji or Face etc.." name="category" required>

        <label for="tags">Tags (comma-separated):</label>
        <input type="text" placeholder="water, dark, face, wolf etc.." name="tags" required>

        <input type="submit" name="submit" value="Upload Image">
        <?php
        // Function to generate a random string of specified length
        function generateRandomString12($length)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }
        ?>
    </form>
</body>
<script>
    const imgpr = document.getElementById('imgpr');
    const inp = document.getElementById('imginp')
    // inp.addEventListener('blur', () => {
    //     imgpr.style.display = "block";
    //     const imgUrl = inp.value;

    //     if (imgUrl) {
    //         imgpr.innerHTML = `<img src="${imgUrl}" alt="Preview Image" style="max-width: 100%; max-height: 100%;">`;
    //     } else {
    //         imgpr.innerHTML = ''; // Clear the preview if no URL is provided
    //     }
    // });







    inp.addEventListener('blur', () => {
        // imgpr.style.display = "block";

        const imgUrl = inp.value;

        if (isValidUrl(imgUrl)) {
        imgpr.style.display = "block";

            imgpr.innerHTML = `<img src="${imgUrl}" alt="Preview Image" style="max-width: 100%; max-height: 100%;">`;
        } else {
            imgpr.innerHTML = ''; // Clear the preview if the URL is not valid
        }
    });

    // Function to check if a string is a valid URL
    function isValidUrl(url) {
        try {
            new URL(url);
            return true;
        } catch (error) {
            return false;
        }
    }
    
    
    
    


</script>

</html>