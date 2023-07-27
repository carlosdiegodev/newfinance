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
                            <h1 id="titulo" class="page-header"><i class="fa fa-bar-chart-o fa-fw"></i>Parcelamentos restantes</h1>
                            <?php echo form_open('Relatorios/parcelados', array('class' => '', 'id' => 'form_filtrar')); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class='table table-hover table-condensed table-bordered'>
                                        <thead>
                                            <tr>
                                                <th style='width: 30px; text-align: center'>CentroCusto</th>
                                                <th style='width: 250px; text-align: center'>Descrição</th>
                                                <th style='width: 150px; text-align: center'>Finalidade</th>                                        
                                                <th style='width: 150px; text-align: center'>FormaPgto</th>    
                                                <th style='width: 150px; text-align: center'>ProxParcela</th>                                        
                                                <th style='width: 150px; text-align: center'>UltimaParcela</th>                                        
                                                <th style='width: 150px; text-align: center'>ValorParcela</th> 
                                                <th style='width: 150px; text-align: center'>QtRestante</th>   
                                                <th style='width: 150px; text-align: center'>ValorTotal</th>   
                                            </tr>                                    
                                        </thead>
                                        <tbody>
                                            <?php                                            
                                                foreach ($parcelamentos as $atual) {                                                
                                                    echo "<tr>";
                                                    echo "<td>$atual->nome_centrodecusto($atual->id_centrodecusto)</td>";
                                                    echo "<td>$atual->descricao_lancamento</td>";
                                                    echo "<td>$atual->nome_finalidade($atual->id_finalidade)</td>";
                                                    echo "<td>$atual->nome_formadepagamento($atual->id_formadepagamento)</td>";
                                                    echo "<td>$atual->proximovencimento</td>";
                                                    echo "<td>$atual->ultimovencimento</td>";
                                                    echo "<td>$atual->valor</td>";
                                                    echo "<td>$atual->qtrestantes</td>";
                                                    echo "<td>$atual->total</td>";
                                                    echo "</tr>";
                                                }
                                                $valor = $total[0]->valor;
                                                echo "<tr bgcolor='#efbfbf'><td colspan='8' align='right'>Total</td><td>$valor</td></tr>";
                                                echo form_close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
