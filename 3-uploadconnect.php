<?php
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "mini_project"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a unique 5-character project_id
function generateUniqueId($conn) {
    $isUnique = false;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    while (!$isUnique) {
        $project_id = '';
        for ($i = 0; $i < 5; $i++) {
            $project_id .= $characters[rand(0, strlen($characters) - 1)];
        }
        $sql = "SELECT project_id FROM project_details WHERE project_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 0) {
            $isUnique = true;
        }
        $stmt->close();
    }
    return $project_id;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to check and handle file upload
    function handleFileUpload($conn, $project_id) {
        $target_dir = "uploads/";  // Directory where uploads will be stored
        $target_file = $target_dir . basename($_FILES["report_file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is a pdf
        if($fileType != "pdf") {
            echo "<script>
                    alert('Only PDF files are allowed.');
                    window.location.href = window.location.href;
                  </script>";
            $uploadOk = 0;
        }

        // Check file size (adjust max file size as needed)
        if ($_FILES["report_file"]["size"] > 5000000) {
            echo "<script>
                    alert('Sorry, your file is too large.');
                    window.location.href = window.location.href;
                  </script>";
            $uploadOk = 0;
        }

        // If everything is ok, try to upload file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["report_file"]["tmp_name"], $target_file)) {
                return $target_file;  // Return the file path if upload successful
            } else {
                echo "<script>
                        alert('Sorry, there was an error uploading your file.');
                        window.location.href = window.location.href;
                      </script>";
            }
        }
        return null;  // Return null if upload failed
    }

    // Generate unique project ID
    $project_id = generateUniqueId($conn);

    // Retrieve other form inputs
    $project_title = $_POST['project_title'];
    $project_mentor = $_POST['project_mentor'];
    $academic_year = $_POST['academic_year'];
    $problem_statement = $_POST['problem_statement'];
    $team_number = $_POST['team_number'];
    $student_1 = $_POST['student1'];
    $usn_1 = $_POST['usn1'];
    $student_2 = $_POST['student2'];
    $usn_2 = $_POST['usn2'];
    $student_3 = $_POST['student3'];
    $usn_3 = $_POST['usn3'];
    $student_4 = $_POST['student4'];
    $usn_4 = $_POST['usn4'];
    $student_5 = $_POST['student5'];
    $usn_5 = $_POST['usn5'];

    // Handle file upload
    $report_file = handleFileUpload($conn, $project_id);

    // Prepare SQL statement for inserting data into database
    $sql = "INSERT INTO project_details (
                project_id, 
                project_title, 
                project_mentor, 
                academic_year, 
                problem_statement,
                team_number, 
                student_1, 
                usn_1, 
                student_2, 
                usn_2, 
                student_3, 
                usn_3, 
                student_4, 
                usn_4, 
                student_5, 
                usn_5,
                report_file
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssssssssss", 
        $project_id, 
        $project_title, 
        $project_mentor, 
        $academic_year, 
        $problem_statement,
        $team_number, 
        $student_1, 
        $usn_1, 
        $student_2, 
        $usn_2, 
        $student_3, 
        $usn_3, 
        $student_4, 
        $usn_4, 
        $student_5, 
        $usn_5,
        $report_file
    );

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "<script>
                alert('New record created successfully with Project_ID: " . $project_id . "');
                window.location.href = '3-upload.html';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . addslashes($stmt->error) . "');
                window.location.href = window.location.href;
              </script>";
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
