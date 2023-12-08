<?php
$host = 'localhost';
$dbname = 'registerformdb';
$user = 'root';
$password = '';

// Debugging: Output the entire $_POST array
var_dump($_POST);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debugging: Output the entire $_POST array
    var_dump($_POST);

    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '';

    try {
        $stmt = $pdo->prepare("INSERT INTO users (position, first_name, last_name, middle_name, gender, email, phone_number, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([$position, $first_name, $last_name, $middle_name, $gender, $email, $phone_number, $username, $password]);

        header('Location: BRGY_SYSTEM.html');
        exit;
    } catch (PDOException $e) {
        echo "Error registering user: " . $e->getMessage();
    }
}
?>
