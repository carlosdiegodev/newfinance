<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendas extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('newfinance_helper');
        $this->load->model('vendas_model', 'vendas_model');
    }

    public function index() {
        $vendas = [];
        $vendas = array_merge($vendas, $this->vendas_model->resultado_anual('2017'));
        $vendas = array_merge($vendas, $this->vendas_model->resultado_anual('2016'));
        $vendas = array_merge($vendas, $this->vendas_model->resultado_anual('2015'));
        
        $despesas = [];
        $despesas = array_merge($despesas, $this->vendas_model->despesaspos201612('2017'));
        $despesas = array_merge($despesas, $this->vendas_model->despesasate201612('2016'));
        $despesas = array_merge($despesas, $this->vendas_model->despesasate201612('2015'));
        //var_dump($despesas);exit(0);         
        $dados = array(
            'vendas' => $vendas,
            'despesas' => $despesas
        );
        //var_dump($dados);exit(0);
        $this->load->view('Vendas/index.php', $dados);
        
    }

}
