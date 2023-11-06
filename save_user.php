<?php
// Connect to the database using PDO
$dsn = "mysql:host=localhost;dbname=user_information";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Define validation functions
function validateName($name) {
    return !empty($name);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Process the form data and insert it into the database after validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $city = $_POST["city"];

    // Perform input validation
    $errors = [];

    if (!validateName($name)) {
        $errors[] = "Name is required.";
    }

    if (!validateEmail($email)) {
        $errors[] = "Invalid email address.";
    }

    // If there are validation errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } else {
        // Insert data into the database
        $sql = "INSERT INTO users (name, email, gender, city) VALUES (:name, :email, :gender, :city)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':city', $city);
        $stmt->execute();

        header("Location: list_user.php"); // Redirect to the list page
        exit();
    }
}
?>
