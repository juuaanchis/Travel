<?php

include_once './config.php';
$conn = new DbConfig();

$name = $_POST['name'];
$last_name = $_POST['last_name'];   
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$fk_role_id = 2; 
$status="Activo";

try {
    $sql = "INSERT INTO users (name, last_name, username, email, password, fk_role_id,status) VALUES (:name, :last_name, :username, :email, :password, :fk_role_id, :status)";
    $stmt = $conn->getConnection()->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':fk_role_id', $fk_role_id);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        echo "Registro exitoso";
        header("Location: ../index.html");
    } else {
        echo "Error al registrar";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>