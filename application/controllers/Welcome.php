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
        $this->load->helper('url');
        if (isset($_POST['nama']) && isset($_POST['nim']) && isset($_POST['umur'])) {
            $_SESSION['nama'] = $_POST['nama'];
            $_SESSION['nim'] = $_POST['nim'];
            $_SESSION['umur'] = $_POST['umur'];
            redirect('Welcome/tampil');
        }

        $blade = new Blade(VIEWPATH, APPPATH . 'cache');
        echo $blade->make('form', [])->render();
    }

    public function tampil()
    
    {
        $nama = $_SESSION['nama'];
        $nim = $_SESSION['nim'];
        $umur = $_SESSION['umur'];
        $status = '';

        if ($umur >= 0 && $umur <= 10) {
            $status = 'Anak';
        } elseif ($umur > 10 && $umur <= 20) {
            $status = 'Remaja';
        } elseif ($umur > 20 && $umur <= 30) {
            $status = 'Dewasa';
        } elseif ($umur > 30) {
            $status = 'Tua';
        }

        session_unset();
        session_destroy();
        $blade = new Blade(VIEWPATH, APPPATH . 'cache');
        echo $blade->make('tampil', ['nama' => $nama, 'nim' => $nim, 'umur' => $umur, 'status' => $status])->render();
    }
}
