<?php

class Users

{​​

    private $conn;

    private $table = 'User';



    public $id;

    public $username;

    public $password;

    public $name;

    public $email;



    public function __construct($db)

    {​​

        $this->conn = $db;

    }​​



    public function getUsers()

    {​​

        $query  = 'SELECT * FROM ' . $this->table . '';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();



        return $stmt;

    }​​



    public function signIn()

    {​​

        $query = "SELECT * FROM User WHERE username='$this->username' AND password='$this->password'";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();



        return $stmt;

    }​​

}​​