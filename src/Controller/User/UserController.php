<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\AbstractController;
use App\Controller\Book\BookController;
use App\Request;

require_once('sessionhelper.php');
class UserController  extends BookController
{

    //Rejestracja
    public function registerAction()
    {

        if ($this->request->isPost()) {
            // dump($this->request->postData());
            $dataPost = $this->request->postData();
            $validation = $this->validRegister($dataPost);
            if ($validation['validation']) {
                //Dodać użytkownika do bazy danych
                $this->user_model->register(
                    $this->request->postParam('username'),
                    $this->request->postParam('email'),
                    $this->request->postParam('password')
                );
                header("Location:/?action=login");
            }
        }

        $this->view->renderLoginRegister('register', ['errorsEmpty' => $validation ?? '']);
    }
    //Logowanie
    public function loginAction()
    {

        if ($this->request->isPost()) {
            $postData = $this->request->postData();
            $validation = $this->validLogin($postData);
            if ($validation['validation']) {

                $login = $this->user_model->login(
                    $this->request->postParam('email'),
                    $this->request->postParam('password')
                );


                if ($login['type'] == false) {
                    $validation = $login;
                }
                if ($login['type'] == true) {
                    //sesja start
                    $this->sessionStart($login);
                    header("Location:/?action=list");
                }
            }
        }
        $this->view->renderLoginRegister('login', ['errorsEmpty' => $validation ?? []]);
    }


    //ustawienie sesji
    private function sessionStart(array $user)
    {

        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
    }
    //wylogowania
    public function logoutAction()
    {
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        session_destroy();
        header('Location:/?action=login');
    }

    //sprawdzenie zalogowania

    //sprawdzenia czy ktos jest zalogowany
    private function validLogin($formData)
    {
        foreach ($formData as $key => $input) {
            if (empty($input)) {
                switch ($key) {
                    case 'email':
                        $email = 'Pole email jest wymagany do zalogowania';
                        break;
                    case 'password':
                        $password = 'Pole hasło jest wymagane';
                        break;
                }
            }
        }
        if (!isset($email) && !isset($password)) {
            $valid_status = true;
        }
        return [
            'validation' => $valid_status ?? false,
            'emailError' => $email ?? '',
            'passwordError' => $password ?? ''
        ];
    }
    private function validRegister($formData)
    {
        foreach ($formData as $key => $input) {
            if (empty($input)) {
                switch ($key) {
                    case 'username':
                        $username = 'Pole username jest wymagane';
                        break;
                    case 'email':
                        dump('email test');
                        $email = 'Pole email jest wymagane';
                        break;
                    case 'password':
                        $password = 'Pole hasło jest wymagane';
                        break;
                    case 'password_confirm':
                        $password_confirm = 'Pole potwierdz hasło jest wymagane';
                        break;
                }
            }
            if (!empty($input)) {
                switch ($key) {
                    case 'username':
                        $checkDbName = $this->user_model->check($input, $key);
                        //Sprawdzić czy jest w bazie danych
                        if ($checkDbName) {
                            $username = 'Użytkownik o podanej nazwie już istnije';
                        }
                        break;
                    case 'email':
                        $checkDbEmail = $this->user_model->check($input, $key);
                        if ($checkDbEmail) {
                            $email = 'Użytkownik o podanym emailu istnieje';
                        }
                        break;
                    case 'password':
                        if (strlen($input) < 6) {
                            $password = 'Hasło musi mieć minimum 6 znaków';
                            break;
                        }

                        break;
                    case 'password_confirm':
                        if (strlen($input) < 6) {
                            $password_confirm = 'Hasło musi mieć minimum 6 znaków';
                            break;
                        }
                        if (!($input == $formData['password'])) {
                            $password_confirm = 'Hasło musi być identyczne';
                            break;
                        }
                        break;
                }
            }
        }

        if (!isset($username) && !isset($email) && !isset($password) && !isset($password_confirm)) {
            $valid_status = true;
        }
        return [
            'validation' => $valid_status ?? false,
            'nameError' => $username ?? '',
            'emailError' => $email ?? '',
            'passwordError' => $password ?? '',
            'password_confirmError' => $password_confirm ?? ''
        ];
    }
}
