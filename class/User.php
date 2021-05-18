<?php
require_once("mysql.php");
class User extends Connection
{
    public function __construct()
    {
        Connection::__construct();
    }

    public function register($full_name, $email, $plain_pw)
    {
        $password = password_hash($plain_pw, PASSWORD_BCRYPT, ['cost' => 10]);
        $query = "INSERT INTO users (fullname, email, password) VALUES (?,?,?)";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("sss", $full_name, $email, $password);
        return $stmt->execute();
    }

    public function login($email, $plain_pw)
    {
        $query = "SELECT id, password FROM users WHERE email = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = $res->fetch_assoc();
        if (password_verify($plain_pw, $rows['password'])) {
            return $rows['id'];
        } else {
            return null;
        }
    }
}
