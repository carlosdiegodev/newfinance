<?php

if (!defined('BASEPATH'))
    exit('Acesso negado!');

class formadepagamento_model extends CI_Model {
    public function listarFormasDePagamento() {      
        $this->db->select('*');
        $this->db->from('formadepagamento');
        $this->db->where('ativo',1);
        $this->db->order_by('codigo', 'ASC');
        //var_dump($this->db->get()->result());exit(0); 
        return $this->db->get()->result();        
    }
}
