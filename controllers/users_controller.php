<?php
/**
 * Created by Borys Lemeshko.
 * Date: 6/11/18
 * Time: 1:15 AM
 */

class UsersController {
    public function register() {

        require_once ('views/users/register.php');

        if (isset($_POST['name'])
            && isset($_POST['email'])
            && isset($_POST['password'])
            && isset($_POST['password_confirm'])) {

            if ($_POST['password'] === $_POST['password_confirm']) {

                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                User::register($name, $email, $password);

                header("Location: ?controller=ads&action=index");
            } else {
                echo "<h5 style='color: red;'>Passwords are not identical</h5>";
            }
        }
    }

    public function login() {
        require_once ('views/users/login.php');
        if(isset($_POST['email']) && isset($_POST['password'])) {

            ob_clean();
            session_destroy();
            $email = $_POST['email'];
            $password = $_POST['password'];

            ob_start();
            session_start();

            $user = User::login($email, $password);

            if ($user) {
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $user->email;
                $_SESSION['user_id'] = $user->id;
            }

            header("Location: ?controller=ads&action=index");
        }
    }

    public function logout() {

        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        session_destroy();

        header("Location: ?controller=ads&action=index");

    }
}