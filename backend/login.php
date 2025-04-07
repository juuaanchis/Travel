<?php

session_start(); 

require_once './config.php';

class Auth
{
    private $db;

    public function __construct()
    {
        $dbConfig = new DbConfig();
        $this->db = $dbConfig->getConnection();
    }

    public function getDb()
    {
        return $this->db;
    }

    public function authenticate($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $hashedPassword = $row['password']; 

            if (password_verify($password, $hashedPassword)) {
                if ($row['status'] === 'Activo') {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $row['id_users'];
                    $_SESSION['role_id'] = $row['fk_role_id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['last_name'] = $row['last_name']; // Añadir last_name a la sesión
                    $_SESSION['username'] = $row['username']; // Añadir username a la sesión

                    return true; 
                } else {
                    return 'inactive';
                }
            } else {
                return 'invalid'; 
            }
        } else {
            return 'invalid'; 
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $auth = new Auth();
    $result = $auth->authenticate($email, $password);

    if ($result === true) {
        // Autenticación exitosa
        $response = array(
            'status' => 'success',
            'user_id' => $_SESSION['user_id'],
            'email' => $_SESSION['email'],
            'name' => $_SESSION['name'],
            'last_name' => $_SESSION['last_name'], // Añadir last_name a la respuesta
            'username' => $_SESSION['username'], // Añadir username a la respuesta
            'role_id' => $_SESSION['role_id'],
        );

        echo json_encode($response);
    } elseif ($result === 'inactive') {
        // Usuario inactivo
        $response = array(
            'status' => 'error',
            'message' => 'El usuario está inactivo'
        );
        echo json_encode($response);
    } elseif ($result === 'invalid') {
        // Credenciales inválidas
        $response = array(
            'status' => 'error',
            'message' => 'Verifique la información ingresada'
        );
        echo json_encode($response);
    }
}
?>