<?php

include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    if ($password !== $confirm_password) {
       
        echo "<p style='color:red; text-align:center;'>Passwords do not match. Please try again.</p>";
        exit();
    }
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement to insert the user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    
    if ($stmt->execute()) {
       
        echo "Registration successful! You can now <a href='login.php'>login</a>.";
    } else {
        
        echo "Error: " . $stmt->error;
    }

   
    $stmt->close();
    $conn->close();
} else {
   
    header("Location: register.php");
    exit();
}
?>
