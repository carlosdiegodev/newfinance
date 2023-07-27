<?php

if (!defined('BASEPATH'))
    exit('Acesso negado!');

class lancamento_model extends CI_Model {

    public function ultimoLancamentoCentroDeCustoEFinalidade($id_centrodecusto = null, $id_finalidade = null) {
        if ($id_centrodecusto == null || $id_finalidade == null) {
            return FALSE;
        } else {
            $this->db->select("*", FALSE);
            $this->db->where(array('id_centrodecusto' => $id_centrodecusto, 'ativo' => '1', 'id_finalidade' => $id_finalidade));
            $this->db->order_by('id_lancamento', 'DESC');
            $this->db->limit(1);
            //var_dump($this->db->get('lancamento')->result());exit(0);            
            return $this->db->get('lancamento')->result();
        }
    }

    public function ultimosLancamentosCadastrados($quantidade) {
        $this->db->select("l.*, 
date(l.datadoacontecimento) as DatadoAcontecimento1,
date(l.datareferencia) as datareferencia1,
date(l.datapagamento) as datapagamento1,
date(l.datacadastro) as datacadastro1,

cc.nome as NomeCentroCusto, 
f.nome as NomeFinalidade, 
fp.nome as NomeFormaDePagamento ", FALSE);
        $this->db->join('centrodecusto cc', 'cc.id_centrodecusto = l.id_centrodecusto');
        $this->db->join('finalidade f', 'f.id_finalidade = l.id_finalidade');
        $this->db->join('formadepagamento fp', 'fp.id_formadepagamento = l.id_formadepagamento');
        $this->db->where(array('l.ativo' => '1'));
        $this->db->order_by('l.id_lancamento', 'DESC');
        $this->db->limit($quantidade);
        //echo ($this->db->get_compiled_select('lancamento l'));exit(0);
//            var_dump($this->db->get('lancamento l')->result());exit(0);            
        return $this->db->get('lancamento l')->result();
    }

    public function cadastrar($dadosLancamento = NULL, $qtParcelas) {

        $this->db->trans_start();
        if ($dadosLancamento != NULL) {
            //Caso sejam despesas parceladas
            if ($qtParcelas > 1) {
                $aux = 1;
                $idPai = 0;
                for ($i = 1; $i <= $qtParcelas; $i++) {
                    if ($aux++ == 1) {
                        $dadosLancamento['numeroparcela'] = $i;
                        $this->db->insert('lancamento', $dadosLancamento);
                        $idPai = $this->db->insert_id();                        
                    } else {
                        $dataNova = date('Y-m-d', strtotime($dadosLancamento['datapagamento']. ' + 1 months'));
                        $dadosLancamento['datareferencia'] = $dataNova;
                        $dadosLancamento['datapagamento'] = $dataNova;
                        $dadosLancamento['numeroparcela'] = $i;
                        $dadosLancamento['id_lancamentopai'] = $idPai;
                        $this->db->insert('lancamento', $dadosLancamento);
                    }
                }
            } else {
                $this->db->insert('lancamento', $dadosLancamento);
            }
            $this->db->trans_complete();
            return $this->db->trans_status();
        }
    }

}
