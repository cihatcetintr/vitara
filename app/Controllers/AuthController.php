<?php

namespace App\Controllers;

use Core\Controller;

class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $isUsernameValid = ($username === 'cihat');
            $isPasswordValid = ($password === '123456');
            
            // Her iki bilgi de hatalı
            if (!$isUsernameValid && !$isPasswordValid) {
                return $this->view('auth/login.php', [
                    'error' => 'Kullanıcı adı ve şifre hatalı!',
                    'username' => $username
                ]);
            }
            
            // Sadece kullanıcı adı hatalı
            if (!$isUsernameValid) {
                return $this->view('auth/login.php', [
                    'error' => 'Kullanıcı adı hatalı!',
                    'username' => $username
                ]);
            }
            
            // Sadece şifre hatalı
            if (!$isPasswordValid) {
                return $this->view('auth/login.php', [
                    'error' => 'Şifre hatalı!',
                    'username' => $username
                ]);
            }
            
            // Giriş başarılı
            $_SESSION['user_id'] = 1;
            header('Location: /');
            exit;
        }
        
        return $this->view('auth/login.php');
    }
    
    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
} 