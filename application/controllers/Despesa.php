<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Despesa extends CI_Controller {

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
        $dados = array(
            'centrodecusto' => $this->centrodecusto_model->get_all()
        );
        $this->load->view('Despesa/index.php', $dados);
    }

    public function novaDespesa() {
        if ($this->input->post()) {
            $result = $this->input->post();
            $dadosLancamento['id_lancamentopai'] = NULL;
            $dadosLancamento['id_centrodecusto'] = $result['id_centrodecusto'];
            $dadosLancamento['id_finalidade'] = $result['id_finalidade'];
            $dadosLancamento['id_formadepagamento'] = $result['id_formadepagamento'];
            $dadosLancamento['tipolancamento'] = 0;
            $dadosLancamento['despesaconfirmada'] = 1;
            $dadosLancamento['valor'] = tratarCampoValorMoeda($result['valor']);
            $dadosLancamento['datadoacontecimento'] = tratarData($result['dataFato']);
            $dadosLancamento['datareferencia'] = tratarData($result['dataReferencia']);
            $dadosLancamento['datapagamento'] = tratarData($result['dataPagamento']);
            $dadosLancamento['numerodocumento'] = $result['numeroDocumento'];
            $dadosLancamento['localdadespesa'] = $result['localDespesa'];
            $dadosLancamento['descricao'] = $result['descricao'];
            $dadosLancamento['descricaodetalhada'] = $result['descricaoDetalhada'];
            $dadosLancamento['ativo'] = 1;
            $dadosLancamento['numeroparcela'] = NULL;
            //$dadosLancamento['datacadastro'] = NULL;

            $this->lancamento_model->cadastrar($dadosLancamento, 1);
            redirect("Despesa/novaDespesa");
            //var_dump($dadosLancamento);exit(0);
            //var_dump($this->input->post());
            //exit(0);
        }
        $dados = array(
            'centrodecusto' => $this->centrodecusto_model->get_all(),
            'formasdepagamento' => $this->formadepagamento_model->listarFormasDePagamento(),
            'ultimosLancamentos' => $this->lancamento_model->ultimosLancamentosCadastrados(10),
            'gruposdefinalidades' => $this->grupodefinalidade_model->listarTodos()
        );
        $this->load->view('Despesa/novaDespesa.php', $dados);
    }
    
    public function novaDespesaParcelada() {
        if ($this->input->post()) {
            $result = $this->input->post();
            
            $dadosLancamento['id_lancamentopai'] = NULL;
            $dadosLancamento['id_centrodecusto'] = $result['id_centrodecusto'];
            $dadosLancamento['id_finalidade'] = $result['id_finalidade'];
            $dadosLancamento['id_formadepagamento'] = $result['id_formadepagamento'];
            $dadosLancamento['tipolancamento'] = 0;
            $dadosLancamento['despesaconfirmada'] = 1;
            $dadosLancamento['valor'] = tratarCampoValorMoeda($result['valor']);
            $dadosLancamento['datadoacontecimento'] = tratarData($result['dataFato']);
            $dadosLancamento['datareferencia'] = tratarData($result['dataReferencia']);
            $dadosLancamento['datapagamento'] = tratarData($result['dataPagamento']);
            $dadosLancamento['numerodocumento'] = $result['numeroDocumento'];
            $dadosLancamento['localdadespesa'] = $result['localDespesa'];
            $dadosLancamento['descricao'] = $result['descricao'];
            $dadosLancamento['descricaodetalhada'] = $result['descricaoDetalhada'];
            $dadosLancamento['ativo'] = 1;
            $dadosLancamento['numeroparcela'] = NULL;
            
            $dadosLancamento['qtParcelas'] = $result['qtParcelas'] != '' ? $result['qtParcelas'] : NULL;
            //var_dump($dadosLancamento);exit(0);

            $this->lancamento_model->cadastrar($dadosLancamento, $result['qtParcelas']);
            //var_dump($dadosLancamento);exit(0);
            //var_dump($this->input->post());
            //exit(0);
        }
        $dados = array(
            'centrodecusto' => $this->centrodecusto_model->get_all(),
            'formasdepagamento' => $this->formadepagamento_model->listarFormasDePagamento(),
            'ultimosLancamentos' => $this->lancamento_model->ultimosLancamentosCadastrados(10)
        );
        $this->load->view('Despesa/novaDespesaParcelada.php', $dados);
    }
    

    public function povoarGruposDeFinalidades($idCentroCusto = null) {
        if (isset($idCentroCusto)) {
            $grupos = $this->grupodefinalidade_model->listarGruposDeFinalidadesPorCentroDeCusto($idCentroCusto);
            $retorno = array();
            foreach ($grupos as $atual) {
                $retorno[] = array('id' => $atual->id_grupodefinalidade, 'nome' => $atual->nome);
            }
            //var_dump($retorno);exit(0);
            echo json_encode($retorno);
        }
    }

    public function povoarFinalidades($id_centrocusto = null, $id_grupo = null) {
        if (isset($id_centrocusto)) {
            $finalidades = $this->finalidade_model->listarFinalidadesPorCentroCusto($id_centrocusto, $id_grupo);
            $retorno = array();
            foreach ($finalidades as $atual) {
                $retorno[] = array('id' => $atual->id_finalidade, 'nomeFinalidade' => $atual->nome, 'nomeGrupo' => $atual->nomeGrupo);
            }
            //var_dump($retorno);exit(0);
            echo json_encode($retorno);
        }
    }

    public function pegarUltimaDescricao($id_centrodecusto = null, $id_finalidade = null) {
        if (isset($id_centrodecusto) and isset($id_finalidade)) {
            $descricao = $this->lancamento_model->ultimoLancamentoCentroDeCustoEFinalidade($id_centrodecusto, $id_finalidade);
            //$retorno = array();
            //var_dump();exit(0);
            //$retorno[] = array('descricao' => 'Pagamento de Funcionario');
            echo json_encode($descricao);
        }
    }

    public function pegarUltimosCadastrados($quantidade=null) {        
        $retorno = $this->lancamento_model->ultimosLancamentosCadastrados($quantidade);
        echo json_encode($retorno);
    }
    
    public function cadastrarFinalidade() {
        $dados = $this->input->post();        
        //var_dump($dados);exit(0);
        $retorno = $this->finalidade_model->cadastrarFinalidadeNovaDespesa($dados);
        //var_dump($retorno);exit(0);        
        echo json_encode($retorno);
    }
    
    

}
