<?php

if (!defined('BASEPATH'))
    exit('Acesso negado!');

class vendas_model extends CI_Model {

    public function resultados($data0, $data1) {
        $lojadb = $this->load->database('lojadb', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.
        $lojadb->select("  year(v.data_venda) as ano,
                            month(v.data_venda) as mes,
                            sum(vr_total) as total,
                            format(sum(vr_dinheiro),2,'de_DE') as dinheiro,
                            format(sum(vr_cartao),2,'de_DE') as cartao,
                            format(sum(vr_ticket),2,'de_DE') as 'debito'");
        $lojadb->where('v.data_venda >= ', $data0);
        $lojadb->where('v.data_venda <= ', $data1);
        $lojadb->group_by(array("year(v.data_venda)", "month(v.data_venda)"));
        $lojadb->order_by('1 DESC', '2 ASC');
        return $lojadb->get('mv_vendas v')->result();
        //echo ($lojadb->get_compiled_select('mv_vendas v'));exit(0);
    }

    public function resultado_anual($ano) {
        $lojadb = $this->load->database('lojadb', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.
        $query = "select
            (select $ano) as 'ano',
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-01-01' and data_venda <= '$ano-01-31') as 'Jan', 
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-02-01' and data_venda <= '$ano-02-31') as 'Fev',
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-03-01' and data_venda <= '$ano-03-31') as 'Mar',
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-04-01' and data_venda <= '$ano-04-31') as 'Abr',
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-05-01' and data_venda <= '$ano-05-31') as 'Mai',
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-06-01' and data_venda <= '$ano-06-31') as 'Jun', 
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-07-01' and data_venda <= '$ano-07-31') as 'Jul', 
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-08-01' and data_venda <= '$ano-08-31') as 'Ago', 
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-09-01' and data_venda <= '$ano-09-31') as 'Set', 
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-10-01' and data_venda <= '$ano-10-31') as 'Out', 
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-11-01' and data_venda <= '$ano-11-31') as 'Nov', 
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-12-01' and data_venda <= '$ano-12-31') as 'Dez',
            (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-01-01' and data_venda <= '$ano-12-31') as 'Total'
        ";
        //echo $lojadb->get_compiled_select(); exit(0);
        $query = $lojadb->query($query);        
        //var_dump($query->result());exit(0); 
        return $query = $query->result();        
    }
    
    public function despesasate201612($ano){
        $oldlojadb = $this->load->database('oldlojadb', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.
        $query = "select
            (select $ano) as 'Ano',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-01-01' and dataLancamento <= '$ano-01-31') as 'Jan',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-02-01' and dataLancamento <= '$ano-02-31') as 'Fev',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-03-01' and dataLancamento <= '$ano-03-31') as 'Mar',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-04-01' and dataLancamento <= '$ano-04-31') as 'Abr',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-05-01' and dataLancamento <= '$ano-05-31') as 'Mai',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-06-01' and dataLancamento <= '$ano-06-31') as 'Jun',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-07-01' and dataLancamento <= '$ano-07-31') as 'Jul',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-08-01' and dataLancamento <= '$ano-08-31') as 'Ago',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-09-01' and dataLancamento <= '$ano-09-31') as 'Set',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-10-01' and dataLancamento <= '$ano-10-31') as 'Out',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-11-01' and dataLancamento <= '$ano-11-31') as 'Nov',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-12-01' and dataLancamento <= '$ano-12-31') as 'Dez',
            (select ifnull(sum(valor),0) from lancamento where (idCentroCusto = 6) and idFinalidade != 97 and dataLancamento >= '$ano-01-01' and dataLancamento <= '$ano-12-31') as 'Total'
        ";
        //echo $lojadb->get_compiled_select(); exit(0);
        $query = $oldlojadb->query($query);        
        //var_dump($query->result());exit(0); 
        return $query = $query->result();        
    }
    
    public function despesaspos201612($ano){
        $query = "
                    select
                    (select $ano) as 'Ano',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-01-01' and datapagamento <= '$ano-01-31') as 'Jan',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-02-01' and datapagamento <= '$ano-02-31') as 'Fev',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-03-01' and datapagamento <= '$ano-03-31') as 'Mar',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-04-01' and datapagamento <= '$ano-04-31') as 'Abr',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-05-01' and datapagamento <= '$ano-05-31') as 'Mai',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-06-01' and datapagamento <= '$ano-06-31') as 'Jun',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-07-01' and datapagamento <= '$ano-07-31') as 'Jul',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-08-01' and datapagamento <= '$ano-08-31') as 'Ago',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-09-01' and datapagamento <= '$ano-09-31') as 'Set',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-10-01' and datapagamento <= '$ano-10-31') as 'Out',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-11-01' and datapagamento <= '$ano-11-31') as 'Nov',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-12-01' and datapagamento <= '$ano-12-31') as 'Dez',
                    (select ifnull(sum(valor),0) from lancamento where (id_centrodecusto = 3) and despesaconfirmada = 1 and datapagamento >= '$ano-01-01' and datapagamento <= '$ano-12-31') as 'Total'
        ";
        //echo $lojadb->get_compiled_select(); exit(0);
        $query = $this->db->query($query);        
        //var_dump($query->result());exit(0); 
        return $query = $query->result();        
    }

}
