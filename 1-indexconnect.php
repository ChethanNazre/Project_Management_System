<?php
session_start();
// Database connection details
$servername = "localhost";
$username = "root";  // Use your database username
$password = "";  // Use your database password
$dbname = "mini_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usn = $_POST['username'];
    $pass = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM uandp WHERE username = ?");
    $stmt->bind_param("s", $usn);

    // Execute the statement 
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any records were found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
       

        // Verify the password
        if (password_verify($pass, $hashed_password)) {
            // Credentials are valid, redirect to dashboard
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $usn;
            header("Location:2-dashboard.html");
            exit();
        } else {
            // Invalid credentials, show error message
            echo "Invalid username or password";
        }
    } else {
        // No user found with that username, show error message
        echo "Invalid username or password";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
