<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ContasAPagar extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('newfinance_helper');
        $this->load->model('centrodecusto_model', 'centrodecusto_model');
        $this->load->model('grupodefinalidade_model', 'grupodefinalidade_model');
        $this->load->model('finalidade_model', 'finalidade_model');
        $this->load->model('formadepagamento_model', 'formadepagamento_model');
        $this->load->model('lancamento_model', 'lancamento_model');
        $this->load->model('contasapagar_model', 'contasapagar_model');
    }

    public function index() {
        $dados = array(
            'contasapagar' => $this->contasapagar_model->listarContasAPagar(),
            'centrodecusto' => $this->centrodecusto_model->get_all()
        );
        //var_dump($dados);exit(0);
        $this->load->view('ContasAPagar/index.php', $dados);
    }
    
    public function alterar(){
        $result = $this->input->post();
        $retorno = array();
        $retorno['status'] = false;
        //Tratando campos de data
        $result['datadereferencia'] = tratarData($result['datadereferencia']);
        $result['datadevencimento'] = tratarData($result['datadevencimento']);
        $result['valor'] = tratarCampoValorMoeda($result['valor']);
        $retorno['status'] = $this->contasapagar_model->alterar($result);
        echo json_encode($retorno);        
    }
}
