<?php

require_once 'db.php';

class Auth
{
    private $db;
    private $db_table = "users";
    private $connection = null;

    // Constructor
    public function __construct()
    {
        // check if the connection is already established
        if ($this -> connection == null) {
            // create a new connection
            $this -> db = new DBConnection();
            $this -> connection = $this -> db -> connect();
        }

        // check if session is already started
        if (session_status() == PHP_SESSION_NONE) {
            // start the session
            session_start();
        }
    }


    public function __destruct()
    {
        //close pdo connection
        $this -> connection = null;
    }


    // Function to check if the user is logged in
    public function isLoggedIn()
    {
        // check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }

    public function getUserID()
    {
        if ($this->isLoggedIn()) {
            return $_SESSION['user_id'];
        }
        return false;
    }

    // create function isUsernameExists
    public function isUsernameExists($username)
    {
        $query = "SELECT * FROM " . $this -> db_table . " WHERE username = ?";
        $stmt = $this -> connection -> prepare($query);
        $stmt -> execute(array($username));
        if ($stmt -> rowCount() > 0) {
            return true;
        }
        return false;
    }

    // create function for user registration
    public function register($username, $email, $password)
    {
        // check if the username already exists
        if ($this -> isUsernameExists($username)) {
            return false;
        } else {
            // if the username does not exist, create a new user
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO " . $this -> db_table . " (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this -> connection -> prepare($query);
            $stmt -> bindParam(":username", $username);
            $stmt -> bindParam(":email", $email);
            $stmt -> bindParam(":password", $password);
            $stmt -> execute();
            return true;
        }
    }

    // create functin for user login
    public function login($username, $password)
    {
        // check if the username exists
        if (!$this -> isUsernameExists($username)) {
            return false;
        } else {
            // if the username exists, check if the password is correct
            $query = "SELECT * FROM " . $this -> db_table . " WHERE username = :username";
            $stmt = $this -> connection -> prepare($query);
            $stmt -> bindParam(":username", $username);
            $stmt -> execute();
            if ($stmt -> rowCount() == 1) {
                $row = $stmt->fetch();
                if (password_verify($password, $row['password'])) {
                    // if the password is correct, set the session
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['message'] = "You are now logged in";
                    return true;
                }
                $_SESSION['message'] = "You have entered wrong password, try again!";
            } else {
                return false;
            }
        }
    }

    // create function for user logout
    public function logout()
    {
        // remove all session variables
        session_unset();
        // destroy the session
        session_destroy();
    }
}
