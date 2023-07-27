<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('Parciais/head'); ?>
    <body>
        <div id="wrapper">
            <?php $this->load->view('Parciais/menu'); ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row"
                         <div class="col-lg-12">                            
                            <h1 id="titulo" class="page-header"><i class="fa fa-money fa-fw text-success"></i>Vendas da Loja</h1>
                        </div>
                    </div>
                    <div class="row">
                        <h3>Resultados Anuais</h3>
                        <div class="col-lg-12">
                            <table class="table table-hover table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th  style="width: 100px; text-align: center; vertical-align:middle">Ano</th>
                                        <th  style="width: 150px; text-align: center" bgcolor="#f2f4f7">Jan</th>
                                        <th  style="width: 150px; text-align: center">Fev</th> 
                                        <th  style="width: 150px; text-align: center" bgcolor="#f2f4f7">Mar</th>                                        
                                        <th  style="width: 150px; text-align: center">Abr</th>
                                        <th  style="width: 150px; text-align: center" bgcolor="#f2f4f7">Mai</th>
                                        <th  style="width: 150px; text-align: center">Jun</th>
                                        <th  style="width: 150px; text-align: center" bgcolor="#f2f4f7">Jul</th>
                                        <th  style="width: 150px; text-align: center">Ago</th>
                                        <th  style="width: 150px; text-align: center" bgcolor="#f2f4f7">Set</th>
                                        <th  style="width: 150px; text-align: center">Out</th>
                                        <th  style="width: 150px; text-align: center" bgcolor="#f2f4f7">Nov</th>
                                        <th  style="width: 150px; text-align: center">Dez</th>
                                        <th  style="width: 150px; text-align: center" bgcolor="#f2f4f7">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($vendas)) {
                                        for ($i = 0; $i < count($vendas); $i++) {
                                            echo "<tr>";
                                            echo "<td style='width: 100px; text-align: center; vertical-align:middle'>" . $vendas[$i]->ano . "</th>";
                                            //Jan
                                            $color = (($vendas[$i]->Jan - $despesas[$i]->Jan) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($vendas[$i]->Jan - $despesas[$i]->Jan), 2, ",", ".") . "</td>";

                                            //Fev
                                            $color = (($vendas[$i]->Fev - $despesas[$i]->Fev) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;'>" . number_format(($vendas[$i]->Fev - $despesas[$i]->Fev), 2, ",", ".") . "</td>";

                                            //Mar
                                            $color = (($vendas[$i]->Mar - $despesas[$i]->Mar) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($vendas[$i]->Mar - $despesas[$i]->Mar), 2, ",", ".") . "</td>";

                                            //Abr
                                            $color = (($vendas[$i]->Abr - $despesas[$i]->Abr) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' >" . number_format(($vendas[$i]->Abr - $despesas[$i]->Abr), 2, ",", ".") . "</td>";

                                            //Mai
                                            $color = (($vendas[$i]->Mai - $despesas[$i]->Mai) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($vendas[$i]->Mai - $despesas[$i]->Mai), 2, ",", ".") . "</td>";

                                            //Jun
                                            $color = (($vendas[$i]->Jun - $despesas[$i]->Jun) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' >" . number_format(($vendas[$i]->Jun - $despesas[$i]->Jun), 2, ",", ".") . "</td>";

                                            //Jul
                                            $color = (($vendas[$i]->Jul - $despesas[$i]->Jul) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($vendas[$i]->Jul - $despesas[$i]->Jul), 2, ",", ".") . "</td>";

                                            //Ago
                                            $color = (($vendas[$i]->Ago - $despesas[$i]->Ago) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' >" . number_format(($vendas[$i]->Ago - $despesas[$i]->Ago), 2, ",", ".") . "</td>";

                                            //Set
                                            $color = (($vendas[$i]->Set - $despesas[$i]->Set) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($vendas[$i]->Set - $despesas[$i]->Set), 2, ",", ".") . "</td>";

                                            //Out
                                            $color = (($vendas[$i]->Out - $despesas[$i]->Out) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' >" . number_format(($vendas[$i]->Out - $despesas[$i]->Out), 2, ",", ".") . "</td>";

                                            //Nov
                                            $color = (($vendas[$i]->Nov - $despesas[$i]->Nov) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($vendas[$i]->Nov - $despesas[$i]->Nov), 2, ",", ".") . "</td>";

                                            //Dez
                                            $color = (($vendas[$i]->Dez - $despesas[$i]->Dez) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' >" . number_format(($vendas[$i]->Dez - $despesas[$i]->Dez), 2, ",", ".") . "</td>";
                                                                                        
                                            //Total
                                            $color = (($vendas[$i]->Total - $despesas[$i]->Total) > 0) ? 'Green' : 'red';
                                            echo "<td style='width: 100px; text-align: center; color: $color;' >" . number_format(($vendas[$i]->Total - $despesas[$i]->Total), 2, ",", ".") . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="row">

                        <h3>Vendas X Despesas</h3>
                        <table class="table table-hover table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 100px; text-align: center; vertical-align:middle">Ano</th>
                                    <th colspan="3" style="width: 150px; text-align: center" bgcolor="#f2f4f7">Jan</th>
                                    <th colspan="3"style="width: 150px; text-align: center">Fev</th> 
                                    <th colspan="3" style="width: 150px; text-align: center" bgcolor="#f2f4f7">Mar</th>                                        
                                    <th colspan="3" style="width: 150px; text-align: center">Abr</th>

                                </tr>                         
                                <tr>                                           
                                    <td style="width: 150px; text-align: center" bgcolor="#f2f4f7">Receita</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Despesa</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Resultado</td>
                                    <td style="width: 150px; text-align: center">Receita</td><td style="width: 150px; text-align: center">Despesa</td><td style="width: 150px; text-align: center">Resultado</td>
                                    <td style="width: 150px; text-align: center" bgcolor="#f2f4f7">Receita</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Despesa</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Resultado</td>
                                    <td style="width: 150px; text-align: center">Receita</td><td style="width: 150px; text-align: center">Despesa</td><td style="width: 150px; text-align: center">Resultado</td>                                        
                                </tr>
                            </thead>
                            <tbody id="corpo">
                                <?php
                                if (isset($vendas)) {
                                    for ($i = 0; $i < count($vendas); $i++) {
                                        echo "<tr>";
                                        $atual = $vendas[$i];
                                        $atual2 = $despesas[$i];
                                        echo "<td style='width: 100px; text-align: center'>$atual->ano</td>";
                                        //Jan                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;' bgcolor='#f2f4f7'>" . number_format($atual->Jan, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;' bgcolor='#f2f4f7'>" . number_format($atual2->Jan, 2, ",", ".") . "</td>";
                                        $color = (($atual->Jan - $atual2->Jan) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($atual->Jan - $atual2->Jan), 2, ",", ".") . "</td>";
                                        //Fev                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;'>" . number_format($atual->Fev, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;'>" . number_format($atual2->Fev, 2, ",", ".") . "</td>";
                                        $color = (($atual->Fev - $atual2->Fev) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;'>" . number_format(($atual->Fev - $atual2->Fev), 2, ",", ".") . "</td>";
                                        //Mar                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;' bgcolor='#f2f4f7'>" . number_format($atual->Mar, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;' bgcolor='#f2f4f7'>" . number_format($atual2->Mar, 2, ",", ".") . "</td>";
                                        $color = (($atual->Mar - $atual2->Mar) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($atual->Mar - $atual2->Mar), 2, ",", ".") . "</td>";
                                        //Abr                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;'>" . number_format($atual->Abr, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;'>" . number_format($atual2->Abr, 2, ",", ".") . "</td>";
                                        $color = (($atual->Jan - $atual2->Jan) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;'>" . number_format(($atual->Abr - $atual2->Abr), 2, ",", ".") . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <table class="table table-hover table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 100px; text-align: center; vertical-align:middle">Ano</th>
                                    <th colspan="3" style="width: 150px; text-align: center" bgcolor="#f2f4f7">Mai</th>
                                    <th colspan="3"style="width: 150px; text-align: center">Jun</th> 
                                    <th colspan="3" style="width: 150px; text-align: center" bgcolor="#f2f4f7">Jul</th>                                        
                                    <th colspan="3" style="width: 150px; text-align: center">Ago</th>

                                </tr>                         
                                <tr>                                           
                                    <td style="width: 150px; text-align: center" bgcolor="#f2f4f7">Receita</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Despesa</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Resultado</td>
                                    <td style="width: 150px; text-align: center">Receita</td><td style="width: 150px; text-align: center">Despesa</td><td style="width: 150px; text-align: center">Resultado</td>
                                    <td style="width: 150px; text-align: center" bgcolor="#f2f4f7">Receita</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Despesa</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Resultado</td>
                                    <td style="width: 150px; text-align: center">Receita</td><td style="width: 150px; text-align: center">Despesa</td><td style="width: 150px; text-align: center">Resultado</td>                                        
                                </tr>
                            </thead>
                            <tbody id="corpo">
                                <?php
                                if (isset($vendas)) {
                                    for ($i = 0; $i < count($vendas); $i++) {
                                        echo "<tr>";
                                        $atual = $vendas[$i];
                                        $atual2 = $despesas[$i];
                                        echo "<td style='width: 100px; text-align: center'>$atual->ano</td>";
                                        //Mai                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;' bgcolor='#f2f4f7'>" . number_format($atual->Mai, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;' bgcolor='#f2f4f7'>" . number_format($atual2->Mai, 2, ",", ".") . "</td>";
                                        $color = (($atual->Jan - $atual2->Jan) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($atual->Mai - $atual2->Mai), 2, ",", ".") . "</td>";
                                        //Jun                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;'>" . number_format($atual->Jun, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;'>" . number_format($atual2->Jun, 2, ",", ".") . "</td>";
                                        $color = (($atual->Jan - $atual2->Jan) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;'>" . number_format(($atual->Jun - $atual2->Jun), 2, ",", ".") . "</td>";
                                        //Jul                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;' bgcolor='#f2f4f7'>" . number_format($atual->Jul, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;' bgcolor='#f2f4f7'>" . number_format($atual2->Jul, 2, ",", ".") . "</td>";
                                        $color = (($atual->Jan - $atual2->Jan) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($atual->Jul - $atual2->Jul), 2, ",", ".") . "</td>";
                                        //Ago                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;'>" . number_format($atual->Ago, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;'>" . number_format($atual2->Ago, 2, ",", ".") . "</td>";
                                        $color = (($atual->Jan - $atual2->Jan) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;'>" . number_format(($atual->Ago - $atual2->Ago), 2, ",", ".") . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>




                        <table class="table table-hover table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 100px; text-align: center; vertical-align:middle">Ano</th>
                                    <th colspan="3" style="width: 150px; text-align: center" bgcolor="#f2f4f7">Set</th>
                                    <th colspan="3"style="width: 150px; text-align: center">Out</th> 
                                    <th colspan="3" style="width: 150px; text-align: center" bgcolor="#f2f4f7">Nov</th>                                        
                                    <th colspan="3" style="width: 150px; text-align: center">Dez</th>

                                </tr>                         
                                <tr>                                           
                                    <td style="width: 150px; text-align: center" bgcolor="#f2f4f7">Receita</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Despesa</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Resultado</td>
                                    <td style="width: 150px; text-align: center">Receita</td><td style="width: 150px; text-align: center">Despesa</td><td style="width: 150px; text-align: center">Resultado</td>
                                    <td style="width: 150px; text-align: center" bgcolor="#f2f4f7">Receita</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Despesa</td><td style="width: 150px; text-align: center"  bgcolor="#f2f4f7">Resultado</td>
                                    <td style="width: 150px; text-align: center">Receita</td><td style="width: 150px; text-align: center">Despesa</td><td style="width: 150px; text-align: center">Resultado</td>                                        
                                </tr>
                            </thead>
                            <tbody id="corpo">
                                <?php
                                if (isset($vendas)) {
                                    for ($i = 0; $i < count($vendas); $i++) {
                                        echo "<tr>";
                                        $atual = $vendas[$i];
                                        $atual2 = $despesas[$i];
                                        echo "<td style='width: 100px; text-align: center'>$atual->ano</td>";
                                        //Set                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;' bgcolor='#f2f4f7'>" . number_format($atual->Set, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;' bgcolor='#f2f4f7'>" . number_format($atual2->Set, 2, ",", ".") . "</td>";
                                        $color = (($atual->Jan - $atual2->Jan) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($atual->Set - $atual2->Set), 2, ",", ".") . "</td>";
                                        //Out                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;'>" . number_format($atual->Out, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;'>" . number_format($atual2->Out, 2, ",", ".") . "</td>";
                                        $color = (($atual->Jan - $atual2->Jan) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;'>" . number_format(($atual->Out - $atual2->Out), 2, ",", ".") . "</td>";
                                        //Nov                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;' bgcolor='#f2f4f7'>" . number_format($atual->Nov, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;' bgcolor='#f2f4f7'>" . number_format($atual2->Nov, 2, ",", ".") . "</td>";
                                        $color = (($atual->Jan - $atual2->Jan) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;' bgcolor='#f2f4f7'>" . number_format(($atual->Nov - $atual2->Nov), 2, ",", ".") . "</td>";
                                        //Dez                                            
                                        echo "<td style='width: 100px; text-align: center; color: green;'>" . number_format($atual->Dez, 2, ",", ".") . "</td>";
                                        echo "<td style='width: 100px; text-align: center; color: #e552db;'>" . number_format($atual2->Dez, 2, ",", ".") . "</td>";
                                        $color = (($atual->Jan - $atual2->Jan) > 0) ? 'blue' : 'red';
                                        echo "<td style='width: 100px; text-align: center; color: $color;'>" . number_format(($atual->Dez - $atual2->Dez), 2, ",", ".") . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>       


            </div>                    
        </div>                
    </div>
</div>

<?php $this->load->view('Parciais/scripts'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        //Formata campo data
        $('.date').mask('00/00/0000');

        //Formata campo valor
        $('.currency').maskMoney({
            allowNegative: true,
            thousands: '.',
            decimal: ',',
            affixesStay: false
        });

        //Salvar o faturamento
        $('#btn_salvar').click(function () {
            if ($('#id_centrodecusto').val() == '') {
                alert('Selecione o centro de custo!');
                return;
            }
            if ($('#data').val() == '') {
                alert('Por favor, digite a data do faturamento!');
                return;
            }
            if ($('#valor').val() == '') {
                alert('Por favor, digite o valor!');
                return;
            }
            $('#form_cadastra').submit();

        });
        $('#btn_filtrar').click(function () {
            var id_centrodecusto = $('#id_centrodecusto').val();
            if (id_centrodecusto == '') {
                alert('Selecione o centro de custo!');
                return;
            }
            location.href = '<?php echo base_url("Faturamento/index/") ?>' + id_centrodecusto;
        });

        var id_faturamento;
        var confirmacao;
        $('.editar').click(function () {
            id_faturamento = $(this).data('id_faturamento');
            confirmacao = confirm("tem certeza?");
            if (confirmacao) {
                location.href = '<?php echo base_url("Faturamento/apagar/") ?>' + id_faturamento;
            }
        });
    });
</script>
<!-- Modal Pequena-->
<div id="modal"class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Editar Conta à Pagar (Id: <span id='modal_id_contasapagar'></span>)</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="novafinalidade_nomedafinalidade" class="control-label">Data de Vencimento</label>
                    <input type="text" class="form-control date" id="modal_datadevencimento">
                    <label for="nomedogrupo" class="control-label">Data de Referência</label>
                    <input type="text" class="form-control date" id="modal_datadereferencia">
                    <label for="novafinalidade_nomedafinalidade" class="control-label">Centro de Custo</label>
                    <?php
                    $opcoesCentroCusto = array();
                    $opcoesCentroCusto[''] = 'Selecione';
                    foreach ($centrodecusto as $linha) {
                        $opcoesCentroCusto[$linha->id_centrodecusto] = $linha->nome . ' (' . $linha->id_centrodecusto . ')';
                    }
                    echo form_dropdown('modal_id_centrodecusto', $opcoesCentroCusto, set_value('modal_id_centrodecusto'), 'class="form-control" id="modal_id_centrodecusto"');
                    ?>                            
                    <label for="novafinalidade_nomedafinalidade" class="control-label">Descrição</label>
                    <input type="text" class="form-control" id="modal_id_descricao">     
                    <label for="novafinalidade_nomedafinalidade" class="control-label">Valor</label>
                    <input type="text" class="form-control" id="modal_valor" onkeypress="return validateQty(event);">  
                    <label for="novafinalidade_nomedafinalidade" class="control-label">Despesa paga<input type="checkbox" class="form-control" id= "modal_pago" name="modal_pago" value="true"></label>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button id='modal_btn_salvar' name='modal_btn_salvar' type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
</div>
</div>

<?php $this->load->view('Parciais/scripts'); ?>

<script type="text/javascript">


    $(document).ready(function () {
        //Formata campo data
        $('.date').mask('00/00/0000');

        //Formata campo valor
        $('.currency').maskMoney({
            allowNegative: true,
            thousands: '.',
            decimal: ',',
            affixesStay: false
        });

        //Salvar o faturamento
        $('#btn_salvar').click(function () {
            if ($('#id_centrodecusto').val() == '') {
                alert('Selecione o centro de custo!');
                return;
            }
            if ($('#data').val() == '') {
                alert('Por favor, digite a data do faturamento!');
                return;
            }
            if ($('#valor').val() == '') {
                alert('Por favor, digite o valor!');
                return;
            }
            $('#form_cadastra').submit();

        });






    });
</script>



<!-- Modal Pequena-->
<div id="modal"class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Editar Conta à Pagar (Id: <span id='modal_id_contasapagar'></span>)</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="novafinalidade_nomedafinalidade" class="control-label">Data de Vencimento</label>
                    <input type="text" class="form-control date" id="modal_datadevencimento">
                    <label for="nomedogrupo" class="control-label">Data de Referência</label>
                    <input type="text" class="form-control date" id="modal_datadereferencia">
                    <label for="novafinalidade_nomedafinalidade" class="control-label">Centro de Custo</label>
                    <?php
                    $opcoesCentroCusto = array();
                    $opcoesCentroCusto[''] = 'Selecione';
                    foreach ($centrodecusto as $linha) {
                        $opcoesCentroCusto[$linha->id_centrodecusto] = $linha->nome . ' (' . $linha->id_centrodecusto . ')';
                    }
                    echo form_dropdown('modal_id_centrodecusto', $opcoesCentroCusto, set_value('modal_id_centrodecusto'), 'class="form-control" id="modal_id_centrodecusto"');
                    ?>                            
                    <label for="novafinalidade_nomedafinalidade" class="control-label">Descrição</label>
                    <input type="text" class="form-control" id="modal_id_descricao">     
                    <label for="novafinalidade_nomedafinalidade" class="control-label">Valor</label>
                    <input type="text" class="form-control" id="modal_valor" onkeypress="return validateQty(event);">  
                    <label for="novafinalidade_nomedafinalidade" class="control-label">Despesa paga<input type="checkbox" class="form-control" id= "modal_pago" name="modal_pago" value="true"></label>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button id='modal_btn_salvar' name='modal_btn_salvar' type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
