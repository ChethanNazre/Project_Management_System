<?php
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "mini_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the project ID from the URL
$project_id = isset($_GET['id']) ? $_GET['id'] : '';

// Prepare the SQL query to fetch the project details
$sql = "SELECT * FROM project_details WHERE project_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $project_id);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Fetch the project details
$project = $result->fetch_assoc();

// Close connection
$stmt->close();
$conn->close();

// Return the project details as JSON
header('Content-Type: application/json');
echo json_encode($project);
?>
