<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('newfinance_helper');
        $this->load->model('centrodecusto_model', 'centrodecusto_model');
        $this->load->model('grupodefinalidade_model', 'grupodefinalidade_model');
        $this->load->model('finalidade_model', 'finalidade_model');
        $this->load->model('formadepagamento_model', 'formadepagamento_model');
        $this->load->model('lancamento_model', 'lancamento_model');
        $this->load->model('faturamento_model', 'faturamento_model');
        $this->load->model('relatorios_model', 'relatorios_model');
    }

    public function evolucaovendas() {
        $jan = $this->relatorios_model->vendas_mensais_10_em_10(2017, 01);
        $fev = $this->relatorios_model->vendas_mensais_10_em_10(2017, 02);
        $mar = $this->relatorios_model->vendas_mensais_10_em_10(2017, 03);
        $abr = $this->relatorios_model->vendas_mensais_10_em_10(2017, 04);
        $mai = $this->relatorios_model->vendas_mensais_10_em_10(2017, 05);
        $jun = $this->relatorios_model->vendas_mensais_10_em_10(2017, 06);
        $jul = $this->relatorios_model->vendas_mensais_10_em_10(2017, 07);
        $ago = $this->relatorios_model->vendas_mensais_10_em_10(2017, 08);
        $set = $this->relatorios_model->vendas_mensais_10_em_10(2017, 09);
        $out = $this->relatorios_model->vendas_mensais_10_em_10(2017, 10);
        $nov = $this->relatorios_model->vendas_mensais_10_em_10(2017, 11);
        $dez = $this->relatorios_model->vendas_mensais_10_em_10(2017, 12);
        //var_dump($jan[0]);exit(0);
        $script = "
            <script type='text/javascript'>
                google.charts.load('current', {'packages': ['bar']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Mês',    '1 a 10',       '11 a 20',      '21 a 31',     'Total'],
                        ['Jan', " . $jan[0]->a . ", " . $jan[0]->b . ", " . $jan[0]->c . ", " . $jan[0]->t . "], 
                        ['Fev', " . $fev[0]->a . ", " . $fev[0]->b . ", " . $fev[0]->c . ", " . $fev[0]->t . "], 
                        ['Mar', " . $mar[0]->a . ", " . $mar[0]->b . ", " . $mar[0]->c . ", " . $mar[0]->t . "], 
                        ['Abr', " . $abr[0]->a . ", " . $abr[0]->b . ", " . $abr[0]->c . ", " . $abr[0]->t . "], 
                        ['Mai', " . $mai[0]->a . ", " . $mai[0]->b . ", " . $mai[0]->c . ", " . $mai[0]->t . "], 
                        ['Jun', " . $jun[0]->a . ", " . $jun[0]->b . ", " . $jun[0]->c . ", " . $jun[0]->t . "], 
                        ['Jul', " . $jul[0]->a . ", " . $jul[0]->b . ", " . $jul[0]->c . ", " . $jul[0]->t . "], 
                        ['Ago', " . $ago[0]->a . ", " . $ago[0]->b . ", " . $ago[0]->c . ", " . $ago[0]->t . "], 
                        ['Set', " . $set[0]->a . ", " . $set[0]->b . ", " . $set[0]->c . ", " . $set[0]->t . "], 
                        ['Out', " . $out[0]->a . ", " . $out[0]->b . ", " . $out[0]->c . ", " . $out[0]->t . "], 
                        ['Nov', " . $nov[0]->a . ", " . $nov[0]->b . ", " . $nov[0]->c . ", " . $nov[0]->t . "], 
                        ['Dez', " . $dez[0]->a . ", " . $dez[0]->b . ", " . $dez[0]->c . ", " . $dez[0]->t . "]
                    ]);
                    var options = {
                        chart: {
                            title: 'Comparativo de Vendas da Loja',
                            subtitle: 'Evolução das vendas 2017',
                            colors:['red','#009900']
                        }
                    };
                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                    chart.draw(data, options);
                }
            </script>";
        $dados = array('script' => $script);
        $this->load->view('relatorios/evolucaovendas', $dados);
    }

    public function resultadomensal() {
        $jan = $this->relatorios_model->vendas_mensais_10_em_10(2017, 01);
        $fev = $this->relatorios_model->vendas_mensais_10_em_10(2017, 02);
        $mar = $this->relatorios_model->vendas_mensais_10_em_10(2017, 03);
        $abr = $this->relatorios_model->vendas_mensais_10_em_10(2017, 04);
        $mai = $this->relatorios_model->vendas_mensais_10_em_10(2017, 05);
        $jun = $this->relatorios_model->vendas_mensais_10_em_10(2017, 06);
        $jul = $this->relatorios_model->vendas_mensais_10_em_10(2017, 07);
        $ago = $this->relatorios_model->vendas_mensais_10_em_10(2017, 08);
        $set = $this->relatorios_model->vendas_mensais_10_em_10(2017, 09);
        $out = $this->relatorios_model->vendas_mensais_10_em_10(2017, 10);
        $nov = $this->relatorios_model->vendas_mensais_10_em_10(2017, 11);
        $dez = $this->relatorios_model->vendas_mensais_10_em_10(2017, 12);
        //var_dump($jan[0]);exit(0);
        $script = "
            <script type='text/javascript'>
                google.charts.load('current', {'packages': ['bar']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Mês',    '1 a 10',       '11 a 20',      '21 a 31',     'Total'],
                        ['Jan', " . $jan[0]->a . ", " . $jan[0]->b . ", " . $jan[0]->c . ", " . $jan[0]->t . "], 
                        ['Fev', " . $fev[0]->a . ", " . $fev[0]->b . ", " . $fev[0]->c . ", " . $fev[0]->t . "], 
                        ['Mar', " . $mar[0]->a . ", " . $mar[0]->b . ", " . $mar[0]->c . ", " . $mar[0]->t . "], 
                        ['Abr', " . $abr[0]->a . ", " . $abr[0]->b . ", " . $abr[0]->c . ", " . $abr[0]->t . "], 
                        ['Mai', " . $mai[0]->a . ", " . $mai[0]->b . ", " . $mai[0]->c . ", " . $mai[0]->t . "], 
                        ['Jun', " . $jun[0]->a . ", " . $jun[0]->b . ", " . $jun[0]->c . ", " . $jun[0]->t . "], 
                        ['Jul', " . $jul[0]->a . ", " . $jul[0]->b . ", " . $jul[0]->c . ", " . $jul[0]->t . "], 
                        ['Ago', " . $ago[0]->a . ", " . $ago[0]->b . ", " . $ago[0]->c . ", " . $ago[0]->t . "], 
                        ['Set', " . $set[0]->a . ", " . $set[0]->b . ", " . $set[0]->c . ", " . $set[0]->t . "], 
                        ['Out', " . $out[0]->a . ", " . $out[0]->b . ", " . $out[0]->c . ", " . $out[0]->t . "], 
                        ['Nov', " . $nov[0]->a . ", " . $nov[0]->b . ", " . $nov[0]->c . ", " . $nov[0]->t . "], 
                        ['Dez', " . $dez[0]->a . ", " . $dez[0]->b . ", " . $dez[0]->c . ", " . $dez[0]->t . "]
                    ]);
                    var options = {
                        chart: {
                            title: 'Comparativo de Vendas da Loja',
                            subtitle: 'Evolução das vendas 2017',
                            colors:['red','#009900']
                        }
                    };
                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                    chart.draw(data, options);
                }
            </script>";
        $dados = array('script' => $script);
        $this->load->view('relatorios/evolucaovendas', $dados);
    }

    public function consolidadomensal() {
        $today = date("m") - 1;
        $anoatual = date("Y");
        if ($today == 0)
            $today = 12;

        if ($this->input->post()) {
            $parametros = $this->input->post();
            $centrosdecusto = $parametros['id_centrodecusto'];

            $dados = array(
                'centrodecusto' => $this->centrodecusto_model->get_all(),
                'mesatual' => $today,
                'anoatual' => $anoatual,
                'finalidades' => $this->relatorios_model->listar_finalidades($centrosdecusto, $parametros['ano'], $parametros['mes']),
                'categorias' => $this->relatorios_model->listar_categorias($centrosdecusto, $parametros['ano'], $parametros['mes']),
                'total' => $this->relatorios_model->listar_total($centrosdecusto, $parametros['ano'], $parametros['mes'])
            );
            //var_dump($dados);exit(0);
            $this->load->view('relatorios/consolidadomensal.php', $dados);
        } else {
            $dados = array(
                'centrodecusto' => $this->centrodecusto_model->get_all(),
                'mesatual' => $today,
                'anoatual' => $anoatual
            );
            $this->load->view('relatorios/consolidadomensal.php', $dados);
        }
    }

    public function consolidadoanual() {
        if ($this->input->post()) {
            $parametros = $this->input->post();

            //var_dump($parametros);exit(0);            
            //Transformando o array de centro de custo em string...
            $centrosdecusto = '';
            foreach ($parametros['id_centrodecusto'] as $atual) {
                if ($centrosdecusto == '')
                    $centrosdecusto = $atual;
                else {
                    $centrosdecusto = $centrosdecusto . ',' . $atual;
                }
            }

            //Preciso criar uma totalização anual
            $totalizacao['jan'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 01);
            $totalizacao['fev'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 02);
            $totalizacao['mar'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 03);
            $totalizacao['abr'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 04);
            $totalizacao['mai'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 05);
            $totalizacao['jun'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 06);
            $totalizacao['jul'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 07);
            $totalizacao['ago'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 08);
            $totalizacao['set'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 09);
            $totalizacao['out'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 10);
            $totalizacao['nov'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 11);
            $totalizacao['dez'] = $this->relatorios_model->listar_total($parametros['id_centrodecusto'], 2017, 12);
            $totalizacao['total'] = array_sum($totalizacao);


            $dados = array(
                'centrodecusto' => $this->centrodecusto_model->get_all(),
                'totalizacoes' => $this->relatorios_model->totalizacoes_do_consolidadoanual($parametros['id_centrodecusto'], $parametros['ano']),
                'anoatual' => $anoatual = date("Y"),
                'resultados' => $this->relatorios_model->novaconsolidadoanual($centrosdecusto, $parametros['ano']),
                'resultados_agrupado' => $this->relatorios_model->novaconsolidadoanual_agrupado($centrosdecusto, $parametros['ano']),
                'totalizacoes' => $totalizacao
            );
            $this->load->view('relatorios/consolidadoanual.php', $dados);
        } else {
            $dados = array(
                'centrodecusto' => $this->centrodecusto_model->get_all(),
                'anoatual' => $anoatual = date("Y")
            );
            $this->load->view('relatorios/consolidadoanual.php', $dados);
        }
    }

    public function parcelamentos($datadecorte = null) {
        $filtro = null;
        if (isset($datadecorte))
            $filtro = $datadecorte;


        $dados = array(
            'parcelamentos' => $this->relatorios_model->parcelamentos($datadecorte),
            'total' => $this->relatorios_model->parcelamentos_total($datadecorte)
        );
        //var_dump($dados);exit(0);
        $this->load->view('relatorios/parcelamentos.php', $dados);
    }

    public function lucroxdespesa() {
        $vendas = [];
        $vendas = array_merge($vendas, $this->relatorios_model->resultado_anual('2017'));
        $vendas = array_merge($vendas, $this->relatorios_model->resultado_anual('2016'));
        $vendas = array_merge($vendas, $this->relatorios_model->resultado_anual('2015'));

        $despesas = [];
        $despesas = array_merge($despesas, $this->relatorios_model->despesaspos201612('2017'));
        $despesas = array_merge($despesas, $this->relatorios_model->despesasate201612('2016'));
        $despesas = array_merge($despesas, $this->relatorios_model->despesasate201612('2015'));
        //var_dump($despesas);exit(0);         
        $dados = array(
            'vendas' => $vendas,
            'despesas' => $despesas
        );
        //var_dump($dados);exit(0);
        $this->load->view('relatorios/lucroxdespesa.php', $dados);
    }

}
