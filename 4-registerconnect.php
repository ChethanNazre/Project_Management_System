<?php
    // Include the PHP logic here

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
        // Capture the input from the form
        $name = $_POST['username']; 
        $pass = $_POST['password'];

        // Sanitize input
        $name = $conn->real_escape_string($name);
        $pass = $conn->real_escape_string($pass);

        // Hash the password
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Insert data into the table
        $sql = "INSERT INTO uandp (username, password) VALUES ('$name','$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('New record created successfully');
                    window.location.href = '1-index.html'; // Change this to your login page
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . addslashes($sql . "<br>" . $conn->error) . "');
                    window.location.href = window.location.href;
                  </script>";
        }
    }

    $conn->close();
    ?>