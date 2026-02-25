<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class MasyarakatAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika tidak ada session masyarakat, tendang ke login
        if (!session()->get('logged_in_mas')) {
            session()->setFlashdata('pesanlogindulu', 'Anda Harus Login');
            return redirect()->to(base_url('masuk_masyarakat'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
