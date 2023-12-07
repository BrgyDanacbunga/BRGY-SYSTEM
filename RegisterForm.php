<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $middle_name = isset($_POST["middle_name"]) ? $_POST["middle_name"] : "";
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "reagister";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the 'users' table
    $sql = "INSERT INTO users (first_name, last_name, middle_name, gender, email, phone_number, password) VALUES ('$first_name', '$last_name', '$middle_name', '$gender', '$email', '$phone_number', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the registration form if accessed directly
    header("Location: RegisterForm.html");
    exit();
}
?>
