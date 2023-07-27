<?php

if (!defined('BASEPATH'))
    exit('Acesso negado!');

class relatorios_model extends CI_Model {

    public function consolidadoanual($id_centrodecusto, $ano) {
        $this->db->select("
                            l.id_finalidade idfinalidade,
                            f.nome nomefinalidade,
                            f.id_grupodefinalidade,
                            gf.nome as nomegrupo,
                            sum(l.valor) valor,
                            date_format(l.datapagamento,'%Y-%m') as anomes,
                            year(l.datapagamento) as ano,
                            month(l.datapagamento) as mes,
                            count(l.id_lancamento) qtlancamentos", FALSE);
        $this->db->join("finalidade f", "f.id_finalidade = l.id_finalidade");
        $this->db->join("grupodefinalidade gf", "gf.id_grupodefinalidade = f.id_grupodefinalidade");
        $this->db->join("centrodecusto cc", "cc.id_centrodecusto=l.id_centrodecusto");
        $this->db->where_in('l.id_centrodecusto', $id_centrodecusto);
        $this->db->where("l.datapagamento >= '$ano-01-01'");
        $this->db->where("l.datapagamento <= '$ano-12-31'");
        $this->db->where("l.despesaconfirmada", 1);
        $this->db->group_by(array("l.id_finalidade", "f.nome", "f.id_grupodefinalidade", "gf.nome", "date_format(l.datapagamento,'%Y-%m')", "year(l.datapagamento)", "month(l.datapagamento)"));
        $this->db->order_by("gf.nome ASC, l.id_finalidade, date_format(l.datapagamento,'%Y-%m')");
        //echo ($this->db->get_compiled_select('lancamento l'));exit(0);
        return $this->db->get('lancamento l')->result();
    }
    public function novaconsolidadoanual($id_centrodecusto, $ano) {
        //Primeiramente crio uma tabela temporária com os registros
        //Os centros de custos devem ser separados por virgula, por exemplo: 3,5,1
        $query = "
                    CREATE TEMPORARY TABLE IF NOT EXISTS 
                    temp
                    ENGINE=MyISAM 
                    AS (
                    SELECT 
                    l.id_finalidade, 
                    f.nome as 'nomefinalidade', 
                    gf.nome as 'nomegrupo', 
                    gf.id_grupodefinalidade,
                    year(datapagamento) as 'ano', 
                    month(datapagamento) as 'mes', 
                    sum(l.valor) as 'totalmensal' 

                    FROM `lancamento` `l` 
                    JOIN `finalidade` `f` ON `f`.`id_finalidade` = `l`.`id_finalidade` 
                    JOIN `grupodefinalidade` `gf` ON `gf`.`id_grupodefinalidade` = `f`.`id_grupodefinalidade` 
                    JOIN `centrodecusto` `cc` ON `cc`.`id_centrodecusto`=`l`.`id_centrodecusto` 

                    WHERE 
                    `l`.`id_centrodecusto` IN(".$id_centrodecusto.") 
                    AND `l`.`datapagamento` >= '".$ano."-01-01' 
                    AND `l`.`datapagamento` <= '".$ano."-12-31' 
                    AND `l`.`despesaconfirmada` = 1 
                    GROUP BY `l`.`id_finalidade`, `f`.`nome`, `gf`.`nome`, gf.id_grupodefinalidade, year(datapagamento), month(datapagamento) ORDER BY `gf`.`nome`, `f`.`nome`, year(datapagamento), month(datapagamento)
                    );";
        $this->db->query($query);        
        $this->db->select("
                    nomefinalidade, 
                    nomegrupo,
                    id_finalidade,
                    id_grupodefinalidade,
                    SUM(CASE WHEN (mes = 1) THEN totalmensal ELSE 0 END) AS 'Jan',
                    SUM(CASE WHEN (mes = 2) THEN totalmensal ELSE 0 END) AS 'Fev',
                    SUM(CASE WHEN (mes = 3) THEN totalmensal ELSE 0 END) AS 'Mar',
                    SUM(CASE WHEN (mes = 4) THEN totalmensal ELSE 0 END) AS 'Abr',
                    SUM(CASE WHEN (mes = 5) THEN totalmensal ELSE 0 END) AS 'Mai',
                    SUM(CASE WHEN (mes = 6) THEN totalmensal ELSE 0 END) AS 'Jun',
                    SUM(CASE WHEN (mes = 7) THEN totalmensal ELSE 0 END) AS 'Jul',
                    SUM(CASE WHEN (mes = 8) THEN totalmensal ELSE 0 END) AS 'Ago',
                    SUM(CASE WHEN (mes = 9) THEN totalmensal ELSE 0 END) AS 'Set',
                    SUM(CASE WHEN (mes = 10) THEN totalmensal ELSE 0 END) AS 'Out',
                    SUM(CASE WHEN (mes = 11) THEN totalmensal ELSE 0 END) AS 'Nov',
                    SUM(CASE WHEN (mes = 12) THEN totalmensal ELSE 0 END) AS 'Dez',
                    SUM(totalmensal) as 'TotalAnual'");
        $this->db->group_by(array("nomefinalidade", "nomegrupo", "id_finalidade","id_grupodefinalidade"));
        $this->db->order_by("nomeGrupo, nomefinalidade");
        $retorno = $this->db->get('temp')->result();        
        $this->db->query("drop table temp");
        return $retorno;        
    }
    public function novaconsolidadoanual_agrupado($id_centrodecusto, $ano) {
        //Primeiramente crio uma tabela temporária com os registros
        //Os centros de custos devem ser separados por virgula, por exemplo: 3,5,1
        $query = "
                    CREATE TEMPORARY TABLE IF NOT EXISTS 
                    temp
                    ENGINE=MyISAM 
                    AS (
                    SELECT 
                    l.id_finalidade, 
                    f.nome as 'nomefinalidade', 
                    gf.nome as 'nomegrupo', 
                    gf.id_grupodefinalidade,
                    year(datapagamento) as 'ano', 
                    month(datapagamento) as 'mes', 
                    sum(l.valor) as 'totalmensal' 

                    FROM `lancamento` `l` 
                    JOIN `finalidade` `f` ON `f`.`id_finalidade` = `l`.`id_finalidade` 
                    JOIN `grupodefinalidade` `gf` ON `gf`.`id_grupodefinalidade` = `f`.`id_grupodefinalidade` 
                    JOIN `centrodecusto` `cc` ON `cc`.`id_centrodecusto`=`l`.`id_centrodecusto` 

                    WHERE 
                    `l`.`id_centrodecusto` IN(".$id_centrodecusto.") 
                    AND `l`.`datapagamento` >= '".$ano."-01-01' 
                    AND `l`.`datapagamento` <= '".$ano."-12-31' 
                    AND `l`.`despesaconfirmada` = 1 
                    GROUP BY `l`.`id_finalidade`, `f`.`nome`, `gf`.`nome`, gf.id_grupodefinalidade, year(datapagamento), month(datapagamento) ORDER BY `gf`.`nome`, `f`.`nome`, year(datapagamento), month(datapagamento)
                    );";
        $this->db->query($query);        
        $this->db->select("                     
                    nomegrupo,                    
                    id_grupodefinalidade,
                    SUM(CASE WHEN (mes = 1) THEN totalmensal ELSE 0 END) AS 'Jan',
                    SUM(CASE WHEN (mes = 2) THEN totalmensal ELSE 0 END) AS 'Fev',
                    SUM(CASE WHEN (mes = 3) THEN totalmensal ELSE 0 END) AS 'Mar',
                    SUM(CASE WHEN (mes = 4) THEN totalmensal ELSE 0 END) AS 'Abr',
                    SUM(CASE WHEN (mes = 5) THEN totalmensal ELSE 0 END) AS 'Mai',
                    SUM(CASE WHEN (mes = 6) THEN totalmensal ELSE 0 END) AS 'Jun',
                    SUM(CASE WHEN (mes = 7) THEN totalmensal ELSE 0 END) AS 'Jul',
                    SUM(CASE WHEN (mes = 8) THEN totalmensal ELSE 0 END) AS 'Ago',
                    SUM(CASE WHEN (mes = 9) THEN totalmensal ELSE 0 END) AS 'Set',
                    SUM(CASE WHEN (mes = 10) THEN totalmensal ELSE 0 END) AS 'Out',
                    SUM(CASE WHEN (mes = 11) THEN totalmensal ELSE 0 END) AS 'Nov',
                    SUM(CASE WHEN (mes = 12) THEN totalmensal ELSE 0 END) AS 'Dez',
                    SUM(totalmensal) as 'TotalAnual'");
        $this->db->group_by(array("nomegrupo","id_grupodefinalidade"));
        $this->db->order_by("nomegrupo");
        $retorno = $this->db->get('temp')->result();        
        $this->db->query("drop table temp");
        return $retorno;        
    }

    public function totalizacoes_do_consolidadoanual($id_centrodecusto, $ano) {
        $this->db->select("
                            l.id_finalidade idfinalidade,
                            f.nome nomefinalidade,
                            f.id_grupodefinalidade,
                            gf.nome as nomegrupo,
                            sum(l.valor) valor,                            
                            count(l.id_lancamento) qtlancamentos", FALSE);
        $this->db->join("finalidade f", "f.id_finalidade = l.id_finalidade");
        $this->db->join("grupodefinalidade gf", "gf.id_grupodefinalidade = f.id_grupodefinalidade");
        $this->db->join("centrodecusto cc", "cc.id_centrodecusto=l.id_centrodecusto");
        $this->db->where_in('l.id_centrodecusto', $id_centrodecusto);
        $this->db->where("l.datapagamento >= '$ano-01-01'");
        $this->db->where("l.datapagamento <= '$ano-12-31'");
        $this->db->where("l.despesaconfirmada", 1);
        $this->db->group_by(array("l.id_finalidade", "f.nome", "f.id_grupodefinalidade", "gf.nome"));
        $this->db->order_by("gf.ordem ASC, l.id_finalidade");
        //echo ($this->db->get_compiled_select('lancamento l'));exit(0);
        return $this->db->get('lancamento l')->result();
    }

    public function listar_total($id_centrodecusto, $ano, $mes) {
        $datainicial = "$ano-$mes-01";
        $datafinal = "$ano-$mes-31";
        $this->db->select("format(sum(l.valor),2,'de_DE') as total", FALSE);
        $this->db->where_in("l.id_centrodecusto", $id_centrodecusto);
        $this->db->where("l.despesaconfirmada", 1);
        $this->db->where("l.datapagamento >=", $datainicial);
        $this->db->where("l.datapagamento <=", $datafinal);
        
        //var_dump($this->db->get_compiled_select('lancamento l'));exit(0);
        $retorno = $this->db->get('lancamento l')->result();
        //var_dump($retorno);exit(0);
        if($retorno[0]->total == null)
            $retorno[0]->total = '0,00';
        
        return $retorno[0]->total;
    }

    public function listar_categorias($id_centrodecusto, $ano, $mes) {      
        //var_dump($id_centrodecusto);exit(0);
        $datainicial = "$ano-$mes-01";
        $datafinal = "$ano-$mes-31";
        $this->db->select("distinct gf.id_grupodefinalidade, gf.nome, format(sum(l.valor),2,'de_DE') as Total", FALSE);
        $this->db->join("finalidade f", "f.id_finalidade = l.id_finalidade");
        $this->db->join("grupodefinalidade gf", "gf.id_grupodefinalidade = f.id_grupodefinalidade");
        $this->db->where_in("l.id_centrodecusto", $id_centrodecusto);
        $this->db->where("l.datapagamento >=", $datainicial);
        $this->db->where("l.datapagamento <=", $datafinal);
        $this->db->group_by(array('gf.nome'));
        $this->db->order_by('gf.nome', 'ASC');
        //var_dump($this->db->get_compiled_select('lancamento l'));exit(0);
        return $this->db->get('lancamento l')->result();
    }

    public function listar_finalidades($id_centrodecusto, $ano, $mes) {
        $datainicial = "$ano-$mes-01";
        $datafinal = "$ano-$mes-31";
        $this->db->select("l.id_finalidade, f.nome, gf.nome as grupo, gf.id_grupodefinalidade, format(sum(l.valor),2,'de_DE') as Total", FALSE);
        $this->db->join("finalidade f", "f.id_finalidade = l.id_finalidade");
        $this->db->join("grupodefinalidade gf", "gf.id_grupodefinalidade = f.id_grupodefinalidade");
        //$this->db->where_in("l.id_centrodecusto", $id_centrodecusto);
        $this->db->where_in("l.id_centrodecusto", '1,2');
        $this->db->where("l.datapagamento >=", $datainicial);
        $this->db->where("l.datapagamento <=", $datafinal);
        $this->db->group_by(array('l.id_finalidade', 'f.nome', 'gf.nome', 'gf.id_grupodefinalidade'));
        $this->db->order_by('gf.nome', 'ASC');
        $this->db->order_by('f.nome', 'ASC');
        //var_dump($this->db->get_compiled_select('lancamento l'));exit(0);
        return $this->db->get('lancamento l')->result();
    }

    public function cadastrar($dados = NULL) {
        if ($dados != NULL) {
            return $this->db->insert('faturamento', $dados);
        }
        return 0;
    }

    public function apagar($id_faturamento = NULL) {
        if ($id_faturamento != NULL) {
            return $this->db->delete('faturamento', array('id_faturamento' => $id_faturamento));
        }
        return 0;
    }

    public function parcelamentos($datadecorte = null) {
        $filtro = "";
        if ($datadecorte)
            $filtro = " and l.datapagamento <= '" . $datadecorte . "'";
        //var_dump($filtro);exit(0);
        $query = "
            select 
            l.id_centrodecusto as 'id_centrodecusto', 
            cc.nome as 'nome_centrodecusto', 
            l.descricao as 'descricao_lancamento', 
            l.id_finalidade as 'id_finalidade', 
            f.nome as 'nome_finalidade', 
            l.id_formadepagamento as 'id_formadepagamento', 
            fp.nome as 'nome_formadepagamento',
            DATE_FORMAT(min(l.datareferencia),'%d/%m/%Y') as proximovencimento, 
            DATE_FORMAT(max(l.datareferencia),'%d/%m/%Y') as ultimovencimento, 
            format(l.valor,2,'de_DE') as valor,
            count(l.valor) as qtrestantes,             
            format(l.valor * count(l.valor),2,'de_DE') as total
            from lancamento l
            inner join centrodecusto cc on cc.id_centrodecusto = l.id_centrodecusto
            inner join finalidade f on f.id_finalidade = l.id_finalidade
            inner join formadepagamento fp on fp.id_formadepagamento = l.id_formadepagamento
            where numeroparcela is not null and despesaconfirmada = 0 " . $filtro . " 
            group by  l.id_centrodecusto, cc.nome, l.descricao,l.id_finalidade, l.id_formadepagamento, l.valor
            order by count(l.valor) ASC, cc.nome
        ";
        $query = $this->db->query($query);
        //echo $this->db->get_compiled_select(); exit(0);
        return $query = $query->result();
        //var_dump($query->result());exit(0);        
    }

    public function parcelamentos_total($datadecorte = null) {
        $this->db->select("format(sum(l.valor),2,'de_DE') as valor", FALSE);
        $this->db->where("l.numeroparcela is not null");
        $this->db->where("l.despesaconfirmada = 0");
        if ($datadecorte)
            $this->db->where("l.datapagamento <= ", $datadecorte);
        $this->db->from("lancamento l");
        //echo $this->db->get_compiled_select(); exit(0);
        return $this->db->get()->result();
        //var_dump($query);exit(0);        
    }

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

    public function despesasate201612($ano) {
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

    public function despesaspos201612($ano) {
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

    public function vendas_mensais_10_em_10($ano,$mes) {
        $lojadb = $this->load->database('lojadb', TRUE); 
        $query = "
                    select 
                    (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-$mes-01' and data_venda <= '$ano-$mes-10') as 'a',
                    (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-$mes-11' and data_venda <= '$ano-$mes-20') as 'b',
                    (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-$mes-21' and data_venda <= '$ano-$mes-31') as 'c',
                    (select ifnull(sum(vr_total),0) from mv_vendas where data_venda >= '$ano-$mes-01' and data_venda <= '$ano-$mes-31') as 't'
        ";        
        $query = $lojadb->query($query);
        //var_dump($query->result());exit(0); 
        return $query = $query->result();
    }
    
    public function resultadomensal($ano, $mes){
        
    }

}
