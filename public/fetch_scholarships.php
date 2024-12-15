<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "scholarpath";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch scholarships from the updated table
$sql = "SELECT * FROM manage_scholarships";
$result = $conn->query($sql);

$scholarships = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $scholarships[] = $row;
    }
}

echo json_encode($scholarships);

$conn->close();
?>
