<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Finalidade extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('newfinance_helper');
        $this->load->model('centrodecusto_model', 'centrodecusto_model');
        $this->load->model('grupodefinalidade_model', 'grupodefinalidade_model');
        $this->load->model('finalidade_model', 'finalidade_model');
        $this->load->model('formadepagamento_model', 'formadepagamento_model');
        $this->load->model('lancamento_model', 'lancamento_model');
    }

    public function index() {        
    }

    public function listarFinalidadePorId($id_finalidade=null){
        $retorno = $this->finalidade_model->listarFinalidadePorId($id_finalidade);
        echo json_encode($retorno);        
    }
    
    

}
