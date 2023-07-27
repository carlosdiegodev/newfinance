<?php

if (!defined('BASEPATH'))
    exit('Acesso negado!');

class faturamento_model extends CI_Model {

    public function listar($id_centrodecusto) {
        $this->db->select("f.*, cc.nome as nomecentrodecusto, "
                . "DATE_FORMAT(f.data,'%d/%m/%Y') as data_formatada, "
                . "format(valor,2,'de_DE') as valor_formatado", FALSE);
        $this->db->join("centrodecusto cc", "cc.id_centrodecusto = f.id_centrodecusto");
        if($id_centrodecusto)
            $this->db->where("cc.id_centrodecusto",$id_centrodecusto);
        $this->db->order_by('f.data', 'DESC');
        return $this->db->get('faturamento f')->result();
    }
    
    public function cadastrar($dados = NULL) {
        if ($dados != NULL) {
            return $this->db->insert('faturamento', $dados);
        }
        return 0;
    }
    
    public function apagar($id_faturamento = NULL) {
        if ($id_faturamento != NULL) {
            return $this->db->delete('faturamento', array('id_faturamento'=>$id_faturamento));
        }
        return 0;
    }
    
    
    


}
