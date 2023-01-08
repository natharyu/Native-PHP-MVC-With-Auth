<?php

namespace App\Controller;

use App\Model\Users;
use App\Model\Session;
use App\Controller\User;

class Dashboard
{
    // Return Dashboard main view if user is 'ADMIN'
    public function index(): void
    {
        if (isset($_SESSION['sessionKey'])) {
            if (Session::isAdmin($_SESSION['sessionKey'])) {
                $view = './App/Views/Dashboard/Homepage/Main.php';
                include_once './App/Views/Dashboard/Layout/Layout.php';
            } else {
                $error = "You are not allowed to go here ! You were redirect to the Home page";
                header("Location: /?error=" . $error);
                exit();
            }
        } else {
            header("Location: /404");
            exit();
        }
    }

    // Return Dashboard users manager view if user is 'ADMIN'
    public function usersView(): void
    {
        if (Session::isAdmin($_SESSION['sessionKey'])) {
            $users = Users::all();
            $view = './App/Views/Dashboard/Homepage/Users.php';
            include_once './App/Views/Dashboard/Layout/Layout.php';
        } else {
            $error = "You are not allowed to go here ! You were redirect to the Home page";
            header("Location: /?error=" . $error);
            exit();
        }
    }

    // Return Dashboard user modify view if user is 'ADMIN'
    public function userModifyView(): void
    {
        if (Session::isAdmin($_SESSION['sessionKey'])) {
            $user = Users::findById($_GET['id']);
            $view = './App/Views/Dashboard/Homepage/UserModify.php';
            include_once './App/Views/Dashboard/Layout/Layout.php';
        } else {
            $error = "You are not allowed to go here ! You were redirect to the Home page";
            header("Location: /?error=" . $error);
            exit();
        }
    }

    // Validate inputs for modify user info from dashboard user modify view
    public function userModifyValidate(): void
    {
        if (Session::isAdmin($_SESSION['sessionKey'])) {
            $users = Users::all();
            $user = Users::findById($_POST['id']);
            $currentValues = User::getCurrentValues($_POST['username'], $_POST['email'], null, $_POST['role']);
            $results = self::validateResults($users, $user, $_POST['username'], $_POST['email']);
            self::errorValidatation($results, $currentValues, $user);
        } else {
            $error = "You are not allowed to go here ! You were redirect to the Home page";
            header("Location: /?error=" . $error);
            exit();
        }
    }

    public static function validateResults(array $users, array $user, String $username = null, String $email = null): array
    {
        $results['username'] = self::usernameValidate($users, $user, $username);
        $results['email'] = self::emailValidate($users, $user, $email);
        return $results;
    }

    public static function usernameValidate(array $users, array $user, String $username): string
    {
        try {
            if (isset($username) && !empty($username)) {
                if ($username === $user['username']) {
                    return 'success';
                }
                $existingUser = [];
                foreach ($users as $user) {
                    $existingUser[] = $user['username'];
                }
                if (in_array($username, $existingUser)) {
                    throw new \Exception('This username already exist.');
                } else {
                    return 'success';
                }
            } else {
                throw new \Exception('Username field is required.');
            }
        } catch (\Exception $exeption) {
            return $exeption->getMessage();
        }
    }

    public static function emailValidate(array $users, array $user, String $email): string
    {
        try {
            if (isset($email) && !empty($email)) {
                if ($email === $user['email']) {
                    return 'success';
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception('Invalid email format.');
                }
                $existingEmail = [];
                foreach ($users as $user) {
                    $existingEmail[] = $user['email'];
                }
                if (in_array($email, $existingEmail)) {
                    throw new \Exception('This email is already taken.');
                } else {
                    return 'success';
                }
            } else {
                throw new \Exception('Email field is required.');
            }
        } catch (\Exception $exeption) {
            return $exeption->getMessage();
        }
    }

    public static function errorValidatation(array $results, array $currentValues, array $user): void
    {
        foreach ($results as $result => $value) {
            if ($value != "success") {
                $error[$result] = $value;
            }
        }
        if (!isset($error) || $error === null) {
            self::userModify($currentValues, $user);
        } else {
            $currentValues;
            $view = './App/Views/Dashboard/Homepage/UserModify.php';
            include_once './App/Views/Dashboard/Layout/Layout.php';
        }
    }

    public static function userModify(array $values, array $user): void
    {
        if (Session::isAdmin($_SESSION['sessionKey'])) {
            $data = [
                'username' => $values['username'],
                'email' => $values['email'],
                'role' => $values['role']
            ];
            Users::updateUser($data, $user['id']);

            $success = "User updated successfully !";
            header("Location: /dashboard/users?success=" . $success);
            exit();
        } else {
            $error = "You are not allowed to go here ! You were redirect to the Home page";
            header("Location: /?error=" . $error);
            exit();
        }
    }

    // Delete one user from Dashboard users manager view if user is 'ADMIN'
    public static function userDelete(): void
    {
        if (Session::isAdmin($_SESSION['sessionKey'])) {
            Users::deleteUser($_GET['id']);
            $success = "User deleted successfully !";
            header("Location: /dashboard/users?success=" . $success);
            exit();
        } else {
            $error = "You are not allowed to go here ! You were redirect to the Home page";
            header("Location: /?error=" . $error);
            exit();
        }
    }
}
