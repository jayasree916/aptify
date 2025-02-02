<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        return view('content/login'); // Loads the login form
    }
    public function authenticate()
    {
       // $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Fetch user by username
        $user = $userModel->getUserByUsername($username);

        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Set session data
                $this->session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'name' => $user['name'],
                    'role_id' => $user['user_role'],
                    'is_logged_in' => true
                ]);

                return redirect()->to('/dashboard'); // Redirect to a protected area
            } else {
                return redirect()->back()->with('error', 'Invalid password.');
            }
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    public function logout()
    {
       // $session = session();
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
