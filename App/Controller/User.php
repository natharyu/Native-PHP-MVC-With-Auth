<?php namespace App\Controller;

use App\Model\Users;
use App\Model\Session;

class User
{
    public static function registerValidate()
    {
        $users = Users::all();
        $currentValues = self::getCurrentValues($_POST['username'], $_POST['email'], $_POST['password']);
        $results= self::validateResults($users, $_POST['username'], $_POST['email'], $_POST['password'], $_POST['password-confirm']);

        if(isset( $_POST['agree']))
        {
            $results['agree'] = "success";
        }
        else
        {
            $results['agree'] = "Please accept the agreement.";
        }
        self::errorValidatation($results, $currentValues, 'register');

    }

    public static function getCurrentValues(String $username = null, String $email = null, String $password = null, String $role = null)
    {
        $currentValues['username'] = $username;
        $currentValues['email'] = $email;
        if($password != null)
        {
            $currentValues['password'] = password_hash( $password, PASSWORD_BCRYPT );
        }
        $currentValues['role'] = $role;
        return $currentValues;
    }

    public static function validateResults(Array $users, String $username = null, String $email = null, String $password = null, String $passwordConfirm = null)
    {
        $results['username'] = self::usernameValidate($users, $username);
        $results['email'] = self::emailValidate($users, $email);
        $results['password'] = self::passwordValidate($password);
        $results['password-confirm'] = self::passwordConfirmValidate($password, $passwordConfirm);
        return $results;
    }

    public static function errorValidatation(Array $results, Array $currentValues, String $route)
    {
        foreach($results as $result => $value)
        {
            if($value != "success")
            {
                $error[$result] = $value;
            }
        }
        if(!isset($error) || $error === null)
        {
            switch($route)
            {
                case 'register':
                    self::addUser($currentValues);
                    break;
                case  'login':
                    self::userLogin($currentValues);
                    break;
            }
        }
        else{
            switch($route)
            {
                case 'register':
                    array_pop($currentValues);
                    $view = './App/Views/Home/Session/Register.php';
                    include_once './App/Views/Home/Layout/layout.php';
                    break;
                case  'login':
                    array_pop($currentValues);
                    $view = './App/Views/Home/Session/Login.php';
                    include_once './App/Views/Home/Layout/layout.php';
                    break;
            }
        }
    }

    public static function usernameValidate(Array $users, String $username)
    {
        try
        {
            if(isset( $username ) && !empty( $username ))
            {
                $existingUser =[];           
                foreach ($users as $user){
                    $existingUser[] = $user['username'];
                }
                if(in_array($username, $existingUser))
                {
                    throw new \Exception( 'This username already exist.');
                }
                else
                {
                    return 'success';
                }
            }
            else
            {
                throw new \Exception( 'Username field is required.');
            }
        }
        catch( \Exception $exeption )
        {
            return $exeption->getMessage();
        }
    }

    public static function emailValidate(Array $users, String $email)
    {
        try
        {
            if(isset( $email ) && !empty( $email ))
            {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    throw new \Exception('Invalid email format.');
                }
                $existingEmail =[];
                foreach ($users as $user){
                    $existingEmail[] = $user['email'];
                }
                if(in_array($email, $existingEmail))
                {
                    throw new \Exception('This email is already taken.');
                }
                else
                {
                    return 'success';
                }
            }
            else
            {
                throw new \Exception( 'Email field is required.');
            }
        }
        catch( \Exception $exeption )
        {
            return $exeption->getMessage();
        }
    }

    public static function passwordValidate(String $password)
    {
        try
        {
            if(isset( $password ) && !empty( $password ))
            {
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)
                {
                    throw new \Exception('Password may have 8 min characters, an uppercase, a lowercase, a number & a special character.');
                }
                else
                {
                    return 'success';
                }
            }
            else
            {
                throw new \Exception( 'Password field is required.');
            }
        }
        catch( \Exception $exeption )
        {
            return $exeption->getMessage();
        }
    }

    public static function passwordConfirmValidate(String $password, String $passwordConfirm)
    {
        try
        {
        if(isset( $passwordConfirm ) && !empty( $passwordConfirm ))
        {
            if($password === $passwordConfirm)
            {
                return 'success';
            }
            else
            {
                throw new \Exception( 'Passwords does not match');
            }
        }
        else
        {
            throw new \Exception( 'Password confirm field is required.');
        }
        }
        catch( \Exception $exeption )
        {
            return $exeption->getMessage();
        }
    }

    public static function addUser($values)
    {
        $sessionKey = sha1(uniqid());
        Users::add([$values['username'], $values['email'], $values['password'], $sessionKey, 'USER']);

        $success = "Account created successfully ! You can connect yourself now.";
        header("Location: /login?success=". $success);
        exit();
    }

    public static function loginValidate()
    {
        if( isset( $_POST['username'] ) && !empty( $_POST['username'] ) &&
            isset( $_POST['password'] ) && !empty( $_POST['password'] ))
        {
            $user = Users::findByUsername($_POST['username']);
            if($user)
            {
                $results['username'] = 'success';

                if( password_verify( $_POST['password'], $user['password'] ))
                        {
                            
                        }
                        else
                        {
                            $results['password'] = 'Wrong password.';
                        }
            }
            else
            {
                $results['username'] = 'No user found with this username.';
            }
        }
        else
        {
            $results['username'] = 'Username field is required';
            $results['password'] = 'Password field is required';
        }

        $currentValues = self::getCurrentValues($_POST['username'], null, $_POST['password']);
        self::errorValidatation($results, $currentValues, 'login');
    }

    public static function userLogin($currentValues)
    {
        $user = Users::findByUsername($currentValues['username']);
        $sessionKey = sha1(uniqid());
        
        $newUserData = [
            'session_key' => $sessionKey,
            'username' => $user['username'],
        ];
        Users::updateUser( $newUserData, $user['id'] );
        Session::setSession($currentValues['username'], $user['id'], $sessionKey);

        header('Location: /');
        exit();
    }

    
    public static function logout()
    {
        Session::closeSession();

        header('Location: /');
        exit();
    }
}