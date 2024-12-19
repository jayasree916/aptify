<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Http\RequestInterface;
use CodeIgniter\Http\ResponseInterface;

class SidebarFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = $request->getUri();

        // Check if the current route is home or login and disable the sidebar
        $firstSegment = $uri->getSegment(1); 

        if ($firstSegment == '' || $firstSegment == 'home' || $firstSegment == 'login') {
            // Set a session variable or pass data to view to hide sidebar
            session()->set('hide_sidebar', true);
        } else {
            // Ensure the session variable is not set for other routes
            session()->remove('hide_sidebar');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // This method can be left empty if not needed
    }
}
