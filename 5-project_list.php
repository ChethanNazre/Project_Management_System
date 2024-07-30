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

// Updated SQL query to order by team_number in ascending order
$sql = "SELECT team_number, project_id, project_title, academic_year, project_mentor FROM project_details ORDER BY team_number ASC";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}

// Fetch and display the results
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['team_number']) . "</td>";
    echo "<td>" . htmlspecialchars($row['project_id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['project_title']) . "</td>";
    echo "<td>" . htmlspecialchars($row['academic_year']) . "</td>";
    echo "<td>" . htmlspecialchars($row['project_mentor']) . "</td>";
    echo "<td><a href='6-project_details.html?id=" . htmlspecialchars($row['project_id']) . "' class='btn'>Click Here</a></td>";
    echo "</tr>";
}

// Close connection
$conn->close();
?>

