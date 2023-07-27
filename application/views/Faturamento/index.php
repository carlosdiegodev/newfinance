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
                            <h1 id="titulo" class="page-header"><i class="fa fa-money fa-fw text-success"></i>Faturamentos</h1>
                            <h3>Novo Faturamento</h3>
                            <?php echo form_open('Faturamento/cadastrar', array('class' => '', 'id' => 'form_cadastra')); ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        //Centro de Custo                                    
                                        echo form_label('Centro de Custo<span class="text-danger"> *</span>', 'idCentroCusto', array('title' => 'A quem pertence o faturamento'));
                                        $opcoesCentroCusto = array();
                                        $opcoesCentroCusto[''] = 'Selecione';
                                        foreach ($centrodecusto as $linha) {
                                            $opcoesCentroCusto[$linha->id_centrodecusto] = $linha->nome . ' (' . $linha->id_centrodecusto . ')';
                                        }
                                        echo form_dropdown('id_centrodecusto', $opcoesCentroCusto, set_value('id_centrodecusto'), 'class="form-control" id="id_centrodecusto" autofocus ="autofocus" tabindex="1"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        //Data                                                                            
                                        echo form_label('Data do Faturamento<span class="text-danger"> *</span>', '', array('class' => 'control-label'));
                                        echo form_input(array('tabindex' => '2', 'id' => 'data', 'name' => 'data', 'class' => 'form-control date', 'placeholder' => 'dd/mm/aaaa'));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        //Data                                                                            
                                        echo form_label('Descrição do Faturamento<span class="text-danger"> *</span>', '', array('class' => 'control-label'));
                                        echo form_input(array('tabindex' => '2', 'id' => 'descricao', 'name' => 'descricao', 'class' => 'form-control', 'placeholder' => 'Salário REF 01/2017'));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        //Campo Valor
                                        echo form_label('Valor R$<span class="text-danger"> *</span>', 'valor', array('class' => 'control-label'));
                                        echo form_input(array('tabindex' => '3', 'id' => 'valor', 'name' => 'valor', 'class' => 'form-control currency', 'placeholder' => 'Exemplo: 120,00', 'style' => 'color:#137c2c; background-color : #effff4;'), set_value('valor'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <?php
                                    echo '<button tabindex="4" id="btn_salvar" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>&nbsp;';
                                    echo '<button tabindex="4" id="btn_filtrar" type="button" class="btn btn-info"><i class="fa fa-search"></i> Filtrar</button>&nbsp;';
                                    echo form_close();
                                    ?>     
                                </div>                                                              
                            </div>
                            <h3>Faturamentos Cadastrados</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <?php
                                    echo form_close();
                                    echo "</div>";
                                    ?>     
                                </div>                                    
                            </div>
                            <table class="table table-hover table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 120px; text-align: center">Id</th>
                                        <th style="width: 100px; text-align: center">CentroCusto</th>
                                        <th style="width: 150px; text-align: center">Data</th>
                                        <th style="width: 150px; text-align: center">Descrição</th>
                                        <th style="width: 100px; text-align: center">Valor R$</th>   
                                        <th style="width: 80px; text-align: center">Ações</th>
                                    </tr>                                    
                                </thead>
                                <tbody id="corpo">
                                    <?php
                                    foreach ($faturamentos as $linha) {
                                        echo '<tr class="">';
                                        echo "<td style='text-align: center;'>$linha->id_faturamento</td>";
                                        echo "<td style='text-align: center;'>$linha->nomecentrodecusto (Id: $linha->id_centrodecusto)</td>";
                                        echo "<td style='text-align: center;'>$linha->data_formatada</td>";
                                        echo "<td style='text-align: center;'>$linha->descricao</td>";
                                        echo "<td style='text-align: center;'>$linha->valor_formatado</td>";
                                        echo "<td style='text-align: center; cursor: pointer;' class='editar' "
                                        . "data-id_faturamento='$linha->id_faturamento'"
                                        . "data-id_centrodecusto='$linha->id_centrodecusto'"
                                        . "data-data='$linha->data_formatada'"
                                        . "data-valor='$linha->valor_formatado'>";

                                        echo "<i class='fa fa-trash text-danger'></i>";
                                        echo "</td>";
                                        echo "</tr>";
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
                if(confirmacao){
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
