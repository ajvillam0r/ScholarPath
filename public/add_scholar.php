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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $studentId = $_POST['studentId'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $course = $_POST['course'];
    $yearLevel = $_POST['yearLevel'];
    $gpa = isset($_POST['gpa']) ? $_POST['gpa'] : null;
    $category = $_POST['category'];
    $scholarshipType = $_POST['scholarshipType'];

    // Validate required fields
    if (!empty($studentId) && !empty($lastName) && !empty($firstName) && !empty($course) && !empty($yearLevel)) {
        // Prepare and bind the statement
        $stmt = $conn->prepare("INSERT INTO manage_scholarships 
            (student_id, last_name, first_name, middle_name, course, year_level, gpa, category, scholarship_type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssidss", $studentId, $lastName, $firstName, $middleName, $course, $yearLevel, $gpa, $category, $scholarshipType);

        // Execute and check the query
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Scholar added successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Please fill in all required fields."]);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Scholar</title>
</head>
<body>
    <h2>Add Scholar</h2>

    <!-- Display success or error messages -->
    <div id="message"></div>

    <!-- Form -->
    <form id="scholarForm" action="add_scholar.php" method="POST">
        <label for="studentId">Student ID:</label><br>
        <input type="text" id="studentId" name="studentId" required><br><br>

        <label for="lastName">Last Name:</label><br>
        <input type="text" id="lastName" name="lastName" required><br><br>

        <label for="firstName">First Name:</label><br>
        <input type="text" id="firstName" name="firstName" required><br><br>

        <label for="middleName">Middle Name:</label><br>
        <input type="text" id="middleName" name="middleName"><br><br>

        <label for="course">Course:</label><br>
        <input type="text" id="course" name="course" required><br><br>

        <label for="yearLevel">Year Level:</label><br>
        <input type="number" id="yearLevel" name="yearLevel" required><br><br>

        <label for="gpa">GPA:</label><br>
        <input type="number" step="0.01" id="gpa" name="gpa"><br><br>

        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category"><br><br>

        <label for="scholarshipType">Scholarship Type:</label><br>
        <input type="text" id="scholarshipType" name="scholarshipType" required><br><br>

        <button type="submit">Add Scholar</button>
    </form>

    <!-- Success Popup (hidden by default) -->
    <div id="successPopup" class="hidden" style="background-color: green; color: white; padding: 10px;">
        Scholar added successfully!
    </div>

    <!-- JavaScript -->
    <script>
        // Submit form using fetch API
        function submitForm(event) {
            event.preventDefault();  // Prevent default form submission

            const formData = new FormData(document.getElementById('scholarForm'));
            
            // Log the form data to check if it's correctly populated
            console.log([...formData]);

            fetch('add_scholar.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const messageElement = document.getElementById('message');
                if (data.success) {
                    // Show success message
                    messageElement.style.color = 'green';
                    messageElement.textContent = data.message;

                    document.getElementById('successPopup').classList.remove('hidden');
                    setTimeout(() => {
                        document.getElementById('successPopup').classList.add('hidden');
                    }, 2000);
                } else {
                    messageElement.style.color = 'red';
                    messageElement.textContent = data.message;  // Show error message
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting the form.');
            });
        }

        // Add event listener to the form
        document.getElementById('scholarForm').addEventListener('submit', submitForm);
    </script>
</body>
</html>
