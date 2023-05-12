<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AuthFilter implements FilterInterface 
{
    private static $paths = [
        'user/' => 3,
        'user/admin' => 3,

        'user/pegawai' => 1,
        'pegawai/detailMutasi/(:num)' => 1,
    ];
    
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();
        $router = Services::router();
        $option = $router->getMatchedRouteOptions();
        if (isset($option['role'])) {
            # code...
            if ($session->has('username')) {
                # code...
                if (is_array($option['role'])) {
                    # code...
                    if (in_array($session->get('role'), $option['role'])) {
                        # code...
                        return true;
                    }
                } elseif ($session->get('role') == $option['role']) {
                    return true;
                }
            }
            if (isset($option['ajax']) && $option['ajax'] == true) {
                # code...
                return Services::response()->setStatusCode(401)->setJSON([
                    "message" => "Unauthorized."
                ]);
            }
            return redirect()->to($option['role'] == 1 ? '/login' : '/login');
        }
        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }

}