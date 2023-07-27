<?php

if (!defined('BASEPATH'))
    exit('Acesso negado!');

class contasapagar_model extends CI_Model {

    public function listarContasAPagar() {
        $this->db->select("ca.*, cc.nome as nomecentrodecusto, "
                . "DATE_FORMAT(datadereferencia,'%d/%m/%Y') as datadereferencia2, "
                . "DATE_FORMAT(datadevencimento,'%d/%m/%Y') as datadevencimento2,"
                . "format(valor,2,'de_DE') as valor2", FALSE);
        $this->db->join("centrodecusto cc", "cc.id_centrodecusto = ca.id_centrodecusto");
        $this->db->order_by('ca.datadevencimento', 'ASC');
        return $this->db->get('contasapagar ca')->result();
    }

    public function alterar($dados) {
        $this->db->set('id_centrodecusto', $dados['id_centrodecusto']);
        $this->db->set('descricao', $dados['descricao']);
        $this->db->set('pago', $dados['pago']);
        $this->db->set('datadereferencia', $dados['datadereferencia']);
        $this->db->set('datadevencimento', $dados['datadevencimento']);
        $this->db->set('valor', $dados['valor']);
        $this->db->where('id_contasapagar', $dados['id_contasapagar']);
        return $this->db->update('contasapagar');
        //exit(0); // gives UPDATE mytable SET field = field+1 WHERE id = 2        
    }

}
