<?php
session_start();

defined('BASEPATH') or exit('No direct script access allowed');

use Jenssegers\Blade\Blade;

class Welcome extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function index()
    {
        $blade = new Blade(VIEWPATH, APPPATH . 'cache');
        echo $blade->make('form', [])->render();
    }

    public function tampil()
    
    {
        $nama = $this->input->post('nama');
        $nim = $this->input->post('nim');
        $umur = $this->input->post('umur');
        $status = '';

        if ($umur < 10) {
            $status = 'Anak';
        } elseif ($umur < 20) {
            $status = 'Remaja';
        } elseif ($umur < 30) {
            $status = 'Dewasa';
        } else {
            $status = 'Tua';
        }

        $blade = new Blade(VIEWPATH, APPPATH . 'cache');
        $array_data = [
            'nama' => $nama,
            'nim'  => $nim,
            'umur' => $umur,
            'status' => $status,
        ];

        echo $blade->make('tampil', $array_data)->render();
    }
}
