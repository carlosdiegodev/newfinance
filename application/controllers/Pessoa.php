<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa extends CI_Controller {

    public function index() {
        // Aqui você pode carregar a view associada a esta ação (método)
        $this->load->view('Pessoa/index');
    }
}