<?php
/**
 * Created by Borys Lemeshko.
 * Date: 6/11/18
 * Time: 1:09 AM
 */

/**
 * Class User
 * @author Borys Lemeshko
 */
class User {

    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($id, $name, $email, $password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function register($name, $email, $password) {
        $password = sha1($password);

        $db = Db::getInstance();
        $req = $db->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
    }

    public static function login($email, $password) {
        $db = Db::getInstance();
        $password = sha1($password);
        $req = $db->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
        $user = $req->fetch();

        return new User(
            $user['id'],
            $user['name'],
            $user['email'],
            $user['password']
        );
    }
}