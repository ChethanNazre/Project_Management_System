<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the URL
$search_query = isset($_GET['query']) ? $_GET['query'] : '';

// Prepare the SQL query to search in the relevant fields
$sql = "SELECT project_id, project_title, academic_year, project_mentor 
        FROM project_details 
        WHERE project_id LIKE ? 
        OR project_title LIKE ? 
        OR project_mentor LIKE ? 
        OR academic_year LIKE ?
        OR student_1 LIKE ? OR usn_1 LIKE ?
        OR student_2 LIKE ? OR usn_2 LIKE ?
        OR student_3 LIKE ? OR usn_3 LIKE ?
        OR student_4 LIKE ? OR usn_4 LIKE ?
        OR student_5 LIKE ? OR usn_5 LIKE ?";

// Prepare and bind the parameters
$stmt = $conn->prepare($sql);
$search_param = "%$search_query%";
$stmt->bind_param('ssssssssssssss', $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Fetch and display the results
$rows = '';
while ($row = $result->fetch_assoc()) {
    $rows .= "<tr>";
    $rows .= "<td>" . htmlspecialchars($row['project_id']) . "</td>";
    $rows .= "<td>" . htmlspecialchars($row['project_title']) . "</td>";
    $rows .= "<td>" . htmlspecialchars($row['academic_year']) . "</td>";
    $rows .= "<td>" . htmlspecialchars($row['project_mentor']) . "</td>";
    $rows .= "<td><a href='6-project_details.html?id=" . htmlspecialchars($row['project_id']) . "' class='btn'>Click Here</a></td>";
    $rows .= "</tr>";
}

// Close connection
$stmt->close();
$conn->close();

// Output the entire HTML content
echo "
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='5-project_list.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200' />
    <title>Search Results</title>
</head>

<body>
    <div class='container'>
        <nav>
    <ul>
        <li><a href='#' class='logo'>
                <img id='im' src='profile.png' alt=''>
                <span class='nav-head'>Student Project Management System</span>
            </a></li>
        <li><a href='2-dashboard.html'>
                <!-- <i class='fas fa-home'></i> -->
                <img class='nav-icon' src='Home-button.png' alt='Home'>
                <span class='nav-item'>Home</span>
            </a></li>
        <li><a href='#' id='return-link'>
                <img class='nav-icon' src='Return-button.png' alt='Return'>
                <!-- <i class='fas fa-arrow-left'></i> -->
                <span class='nav-item'>Return</span></a></li>
        <li><a href='#'>
                <img class='nav-icon' src='Help-button.png' alt='help'>
                <!-- <i class='fas fa-question-circle'></i> -->
                <span class='nav-item'>Help</span></a></li>
        <li><a href='1-index.html' class='logout'>
                <img class='nav-icon' src='Log-out-button.png' alt='Logout'>
                <!-- <i class='fas fa-sign-out-alt'></i> -->
                <span class='nav-item'>Logout</span></a></li>
    </ul>
</nav>

        
        <section class='main'>
            <div class='search-container'>
                <form action='fetch_projects.php' id='bhu' method='GET'>
                    <div class='search'>
                    <span><img src='Search_Icon.png' class='nav-icon2' alt='error'></span>
                        
                        <input type='search' name='query' class='search-input' placeholder='Search' value='" . htmlspecialchars($search_query) . "'>
                    </div>
                </form>
            </div>
            <div class='project-container'>
                <table>
                    <thead>
                        <tr>
                            <th>Project ID</th>
                            <th>Project Title</th>
                            <th>Academic Year</th>
                            <th>Project Mentor</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id='project-list'>
                        $rows
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
<script>
        document.getElementById('return-link').addEventListener('click', function(event){event.preventDefault();window.history.back();});
    </script>

</html>";
?>
