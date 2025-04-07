<?php

session_start();
require_once './config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit();
    }

    try {
        $dbConfig = new DbConfig();
        $db = $dbConfig->getConnection();

        $sql = "UPDATE users SET name = :name, last_name = :last_name, username = :username, email = :email";
        if (!empty($new_password)) {
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $sql .= ", password = :password";
        }
        $sql .= " WHERE id_users = :user_id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        if (!empty($new_password)) {
            $stmt->bindParam(':password', $hashedPassword);
        }
        $stmt->bindParam(':user_id', $user_id);

        $stmt->execute();

        // Actualizar los datos en la sesión
        $_SESSION['name'] = $name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>