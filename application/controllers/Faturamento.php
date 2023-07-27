<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faturamento extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('newfinance_helper');
        $this->load->model('centrodecusto_model', 'centrodecusto_model');
        $this->load->model('grupodefinalidade_model', 'grupodefinalidade_model');
        $this->load->model('finalidade_model', 'finalidade_model');
        $this->load->model('formadepagamento_model', 'formadepagamento_model');
        $this->load->model('lancamento_model', 'lancamento_model');
        $this->load->model('faturamento_model', 'faturamento_model');
    }

    public function index($id_centrodecusto = null) {
        //var_dump($id_centrodecusto);exit(0);
        $dados = array(
            'faturamentos' => $this->faturamento_model->listar($id_centrodecusto),
            'centrodecusto' => $this->centrodecusto_model->get_all()
        );
        //var_dump($dados);exit(0);
        $this->load->view('faturamento/index.php', $dados);
    }

    public function cadastrar() {
        $dados = $this->input->post();
        $dados['data'] = tratarData($dados['data']);
        $dados['valor'] = tratarCampoValorMoeda($dados['valor']);
        //var_dump($this->faturamento_model->cadastrar($dados));exit(0);
        if ($this->faturamento_model->cadastrar($dados)) {
            redirect("Faturamento/");
        }
    }

    public function apagar($id_faturamento = NULL) {
        if ($id_faturamento != NULL) {
            $this->faturamento_model->apagar($id_faturamento);
            redirect("Faturamento/");
        }
        
    }

}
