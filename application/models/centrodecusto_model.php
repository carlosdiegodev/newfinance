<?php

if (!defined('BASEPATH'))
    exit('Acesso negado!');

class centrodecusto_model extends CI_Model {   
    public function get_all() {
        //var_dump($this->db->get('centrodecusto')->result());exit(0);
        $this->db->where('ativo',1);
        return $this->db->get('centrodecusto')->result();   
        
    }
}
