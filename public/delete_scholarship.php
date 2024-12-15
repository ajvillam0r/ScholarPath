<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "scholarpath";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id']; // ID passed via POST

if ($id) {
    $stmt = $conn->prepare("DELETE FROM manage_scholarships WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Scholarship deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Scholarship not found."]);
    }
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid ID."]);
}

$conn->close();
?>
