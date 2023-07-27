<?php

if (!defined('BASEPATH'))
    exit('Acesso negado!');

class finalidade_model extends CI_Model {
    
    public function listarFinalidadePorId($id_finalidade){
        if($id_finalidade!=null){
            $this->db->where('id_finalidade', $id_finalidade);
            return $this->db->get('finalidade')->result();            
        }            
    }
    

    public function listarFinalidadesPorCentroCusto($idCentroCusto = null, $idGrupoFinalidade = null) {
        if ($idCentroCusto == null) {
            return FALSE;
        } else {
            $this->db->select("distinct f.id_finalidade, f.nome, gf.id_grupodefinalidade, gf.nome as nomeGrupo", FALSE);
            $this->db->join('finalidade f', 'f.id_finalidade = cf.id_finalidade');
            $this->db->join('grupodefinalidade gf', 'gf.id_grupodefinalidade = f.id_grupodefinalidade','left');
            $this->db->where('cf.id_centrodecusto', $idCentroCusto);
            if ($idGrupoFinalidade != null)
                if ($idGrupoFinalidade == 0)
                    $this->db->where('f.id_grupodefinalidade', null);
                else
                    $this->db->where('f.id_grupodefinalidade', $idGrupoFinalidade);

            $this->db->where('f.ativo', 1);
            $this->db->order_by('f.nome', 'ASC');
            //echo $this->db->get_compiled_select(); exit(0);
            //echo $this->db->last_query(); exit(0);   
            //var_dump($this->db->last_query());exit(0);                     
            //$this->db->get('centrodecusto_finalidade cf')->result();
            //var_dump($this->db->last_query());exit(0);                     
            return $this->db->get('centrodecusto_finalidade cf')->result();
        }
    }

    public function cadastrarFinalidadeNovaDespesa($dados) {
        if ($dados != NULL) {
            $retorno = array();
            $retorno['id_finalidadeinserida'] = NULL;
            $retorno['id_grupoinserido'] = NULL;
            $this->db->trans_start();

            //Cadastro uma finalidade sem grupo e após isso eu devo inserir o centro de custo para este grupo
            if ($dados['id_grupodefinalidade'] == '' and $dados['nomedonovogrupo'] == '') {
                $finalidade['id_grupodefinalidade'] = null;
                $finalidade['nome'] = $dados['nomedanovafinalidade'];
                $finalidade['ativo'] = 1;
                $this->db->insert('finalidade', $finalidade);
                $retorno['id_finalidadeinserida'] = $this->db->insert_id();                
            }

            //Cadastro uma finalidade com Grupo Existente
            if ($dados['id_grupodefinalidade'] != '') {
                $finalidade['id_grupodefinalidade'] = $dados['id_grupodefinalidade'];
                $finalidade['nome'] = $dados['nomedanovafinalidade'];
                $finalidade['ativo'] = 1;
                $this->db->insert('finalidade', $finalidade);
                $retorno['id_finalidadeinserida'] = $this->db->insert_id();
                $retorno['id_grupoinserido'] = $dados['id_grupodefinalidade'];
                
            }

            //Cadastrar primeiramente o grupo depois a finalidade
            if ($dados['id_grupodefinalidade'] == '' and $dados['nomedonovogrupo'] != '') {
                //Primeiro insere o grupo
                
                $grupo['nome'] = $dados['nomedonovogrupo'];
                $grupo['ativo'] = 1;
                $this->db->insert('grupodefinalidade', $grupo);
                $retorno['id_grupoinserido'] = $this->db->insert_id();

                //Agora insere a finalidade
                $finalidade['id_grupodefinalidade'] = $retorno['id_grupoinserido'];
                $finalidade['nome'] = $dados['nomedanovafinalidade'];
                $finalidade['ativo'] = 1;
                $this->db->insert('finalidade', $finalidade);
                $retorno['id_finalidadeinserida'] = $this->db->insert_id();
                
            }
            
            //Agora eu faço o vinculo, para cada centro de custo
            $vector = $dados['id_centrodecusto'];
            $centrodecusto_finalidade['id_finalidade'] = $retorno['id_finalidadeinserida'];
            $centrodecusto_finalidade['ativo'] = 1;
            foreach($vector as $atual){
                $centrodecusto_finalidade['id_centrodecusto'] = $atual;
                $this->db->insert('centrodecusto_finalidade', $centrodecusto_finalidade);
            }
            
            $this->db->trans_complete();     
            return $retorno;
        }
        return null;
    }

}
