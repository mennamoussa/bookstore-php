<?php

session_start(); 
include 'db.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Prepare an SQL statement to fetch the user from the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user was found
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['user_email'] = $user['email']; 

           
            header("Location: home.php"); 
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    
    $stmt->close();
    $conn->close();
} else {
   
    header("Location: login.php");
    exit();
}
