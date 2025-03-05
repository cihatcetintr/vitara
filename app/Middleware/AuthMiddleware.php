<?php

namespace App\Middleware;

use Core\Middleware;

class AuthMiddleware implements Middleware
{
    public function handle()
    {
        // Burada auth kontrolü yapılabilir
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
    }
} 