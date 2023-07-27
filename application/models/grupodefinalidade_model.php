<?php

if (!defined('BASEPATH'))
    exit('Acesso negado!');

class grupodefinalidade_model extends CI_Model {

    //Método para pegar grupo de finalidades
    public function listarGruposDeFinalidadesPorCentroDeCusto($idCentroCusto = null) {
        if ($idCentroCusto == null) {
            return FALSE;
        } else {
            $this->db->select("distinct f.id_grupodefinalidade, gf.nome", FALSE);
            $this->db->join('finalidade f', 'f.id_finalidade = cf.id_finalidade');
            $this->db->join('grupodefinalidade gf', 'gf.id_grupodefinalidade = f.id_grupodefinalidade');
            $this->db->where(array('cf.id_centrodecusto'=> $idCentroCusto, 'f.ativo'=>1));
            $this->db->order_by('gf.nome', 'ASC');
            //var_dump($this->db->get('centrodecusto_finalidade cf')->result());exit(0);
            //echo $this->db->last_query(); exit(0);            
            //echo $this->db->get('finalidade f')->result();exit(0);
            return $this->db->get('centrodecusto_finalidade cf')->result();
        }
    }
    //listarGruposDeFinalidadesPorCentroDeCusto
    public function listarGruposDeFinalidadesPorCentroDeCustoBackup($idCentroCusto = null) {
        if ($idCentroCusto == null) {
            return FALSE;
        } else {            
            $this->db->order_by('nome', 'ASC');
            //var_dump($this->db->get('centrodecusto_finalidade cf')->result());exit(0);
            //echo $this->db->last_query(); exit(0);            
            //echo $this->db->get('finalidade f')->result();exit(0);
            return $this->db->get('grupodefinalidade')->result();
        }
    }
    
    public function listarTodos(){
        $this->db->order_by('nome', 'ASC');
        return $this->db->get('grupodefinalidade')->result();        
    }

}
