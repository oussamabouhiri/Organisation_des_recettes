<?php
session_start();
class AuthController {
    private $userModel;

    public function __construct($db) {
              $this->userModel = new User($db);
    }


    public function handleRegister() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->userModel->setUsername($_POST['username']);
            $this->userModel->setEmail($_POST['email']);
            $this->userModel->setPassword($_POST['password']);

                if ($this->userModel->register($_POST['username'], $_POST['email'], $_POST['password'])) {
                        header('Location: index.php?page=login');
                        exit;
                } else {
                    echo "Erreur : L'username ou l'email existe déjà.";
                }
        }
      
    }

    public function handleLogin() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
            header("Location: index.php?page=dashboard");
            exit();
  }else{
    echo "Email ou mot de passe incorrect.";
  }

}
 
}
}