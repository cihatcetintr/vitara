<?php

namespace App\Controllers;

use Core\Controller;

class UserController extends Controller
{
    public function show($id)
    {
        // JSON response örneği
        if (isset($_GET['format']) && $_GET['format'] === 'json') {
            return $this->json([
                'id' => $id,
                'name' => 'Test User'
            ]);
        }
        
        // View response örneği
        return $this->view('user/show.php', [
            'user_id' => $id
        ]);
    }
} 