<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('Parciais/head'); ?>
    <body>
        <div id="wrapper">
            <?php $this->load->view('Parciais/menu'); ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 id="titulo" class="page-header"><i class="fa fa-bar-chart-o fa-fw"></i>Relatório Mensal</h1>
                            <?php echo form_open('Relatorios/consolidadomensal', array('class' => '', 'id' => 'form_filtrar')); ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        //Centro de Custo                                    
                                        echo form_label('Centro de Custo<span class="text-danger"> *</span>', 'idCentroCusto', array('title' => 'Centro de Custo que você deseja filtrar'));
                                        $opcoesCentroCusto = array();
                                        $opcoesCentroCusto[''] = 'Selecione';
                                        foreach ($centrodecusto as $linha) {
                                            $opcoesCentroCusto[$linha->id_centrodecusto] = $linha->nome . ' (' . $linha->id_centrodecusto . ')';
                                        }
                                        //echo form_dropdown('id_centrodecusto', $opcoesCentroCusto, set_value('id_centrodecusto'), 'class="form-control" id="id_centrodecusto" autofocus ="autofocus" tabindex="1"');
                                        echo form_multiselect('id_centrodecusto[]', $opcoesCentroCusto, '', array('class' => 'form-control', 'display' => 'block', 'id' => 'id_centrodecusto'));
                                        ?>                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label title="Centro de Custo que você deseja filtrar">Mês de Pagamento</label>
                                        <?php
                                        $meses = [
                                            '01' => 'Janeiro',
                                            '02' => 'Fevereiro',
                                            '03' => 'Março',
                                            '04' => 'Abril',
                                            '05' => 'Maio',
                                            '06' => 'Junho',
                                            '07' => 'Julho',
                                            '08' => 'Agosto',
                                            '09' => 'Setembro',
                                            '10' => 'Outubro',
                                            '11' => 'Novembro',
                                            '12' => 'Dezembro'
                                        ];

                                        //echo form_dropdown(['class'=>'form-control', 'id'=>"mes", 'name'=>"mes"], $meses, set_value('mes',$mesatual));
                                        echo form_dropdown(['class' => 'form-control', 'id' => "mes", 'name' => "mes"], $meses, $mesatual);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label title="Ano Base">Ano de Pagamento</label>
                                        <?php
                                        $anos = [
                                            '2016' => '2016',
                                            '2017' => '2017'
                                        ];
                                        //echo form_dropdown(['class'=>'form-control', 'id'=>"mes", 'name'=>"mes"], $meses, set_value('mes',$mesatual));
                                        echo form_dropdown(['class' => 'form-control', 'id' => "ano", 'name' => "ano"], $anos, $anoatual);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <?php
                                    echo '<button tabindex="4" id="btn_filtrar" type="button" class="btn"><i class="fa fa-search"></i> Filtrar</button>&nbsp;';
                                    echo form_close();
                                    ?>     
                                </div>                                                              
                            </div>


                            <?php
                            if (isset($categorias)) {
                                echo '<div class="row">
                                                        <div class="col-md-6">
                                                            <h3>Totalizações</h3>                                    
                                                            <table class="table table-hover table-condensed table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Nome Categoria</th>
                                                                        <th>Valor Total</th>                                                
                                                                    </tr>                                            
                                                                </thead>
                                                                <tbody>';

                                foreach ($categorias as $categoriaatual) {
                                    echo "<tr>";
                                    echo "<td>$categoriaatual->nome</td>";
                                    echo "<td>$categoriaatual->Total</td>";
                                    echo "</tr>";
                                }
                                echo "
                                                <tr>
                                                    <td>TOTAL GERAL</td>
                                                    <td>$total</td>
                                                </tr>"
                                ;
                            
                            echo '</tbody></table></div></div>';
                            }
                            ?>     



                            <?php
                            if (isset($categorias))
                                foreach ($categorias as $categoriaatual) {
                                    echo '<div class="row">
                                <div class="col-md-12">
                                <h3>' . $categoriaatual->nome . '</h3>
                                    <table class="table table-hover table-condensed table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Finalidade(IdFinalidade)</th>
                                                <th style="text-align: center">Grupo(IdGrupo)</th>
                                                <th style="text-align: center">Total</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>';
                                    foreach ($finalidades as $atual) {
                                        if ($categoriaatual->nome == $atual->grupo) {
                                            echo "<tr>";
                                            echo "<td>$atual->nome($atual->id_finalidade)</td>";
                                            echo "<td width='60%'>$atual->grupo($atual->id_grupodefinalidade)</td>";
                                            echo "<td>$atual->Total</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    echo "<tr>";
                                    echo "<td colspan='2'>SUB TOTAL</td>";
                                    echo "<td>$categoriaatual->Total</td>";
                                    echo "</tr>";

                                    echo '</tbody>

                                        </table>
                                    </div>
                                </div>';
                                }
                            ?>                               




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
            $('#btn_filtrar').click(function () {
                if ($('#id_centrodecusto').val() == '') {
                    alert('Selecione o centro de custo!');
                    return;
                }
                $('#form_filtrar').submit();

            });
            //            $('#btn_filtrar').click(function () {
            //                var id_centrodecusto = $('#id_centrodecusto').val();
            //                if (id_centrodecusto == '') {
            //                    alert('Selecione o centro de custo!');
            //                    return;
            //                }
            //                location.href = '<?php echo base_url("Faturamento/index/") ?>' + id_centrodecusto;
            //            });

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
