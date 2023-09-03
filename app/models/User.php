<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * REGISTER USER
     */
    public function register(array $data): bool
    {
        $this->db->query('INSERT INTO users (name,email,password) VALUES(:name, :email, :password)');

        //BIND VALUES
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // EXECUTE 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * LOGIN USER
     * return bool
     */
    public function login(string $email, string $password)  {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
            return $row;
        }else{
            return false;
        }

    }

    /**
     * FIND USER BY EMAIL
     */
    public function findByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        //BIND VALUES
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // CHECK ROW
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //GET USER BY ID
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        //BIND VALUES
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
        
    }
}
