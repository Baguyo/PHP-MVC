<?php

class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // CHECK IF THE SUBMIT IS GET OR POST
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //PROCESS FORM

            // SANITIZE POST DATA
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // INIT DATA
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
            ];

            //VALIDATE EMAIL
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter email';
            } else {
                //CHECK EMAIL 
                if ($this->userModel->findByEmail($data['email'])) {
                    $data['email_error'] = 'Email is already exist.';
                }
            }

            //VALIDATE NAME
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter name';
            }

            //VALIDATE PASSWORD
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Please enter password greater than 6 characters';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_error'] = 'Password do not match';
                }
            }

            // die(var_dump($data));

            //MAKE SURE ERRORS ARE EMPTY
            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                //VALIDATED

                //HASH PASSWORD
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

                //REGISTER USER
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong. Please try again');
                }

            } else {
                //LOAD VIEW WITH ERRORS
                $this->view('users/register', $data);
            }

        } else {
            // LOAD FORM
            // INIT DATA
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
            ];

            // LOAD VIEW
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // CHECK IF THE SUBMIT IS GET OR POST
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //PROCESS FORM
            // SANITIZE POST DATA
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // INIT DATA
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];

            //VALIDATE EMAIL
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter email';
            }

            //VALIDATE PASSWORD
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            }

            //CHECK FOR USER/EMAIL
            if($this->userModel->findByEmail($data['email'])){
                //USER FOUND
            }else{
                $data['email_error'] = 'No user found';
            }

            //MAKE SURE ERROS ARE EMPTY
            if (empty($data['email_error']) && empty($data['password_error'])) {
                //CHECK AND SET LOGGED IN USER
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser){
                    // CREATE SESSION 
                    $this->createUserSession($loggedInUser);
                    
                }else{
                    $data['password_error'] = "Password Incorrect";
                    $this->view('users/login', $data);
                }

            } else {
                //LOAD VIEW WITH ERRORS
                $this->view('users/login', $data);
            }
        } else {
            // LOAD FORM
            // INIT DATA
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];

            // LOAD VIEW
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }

    
}
