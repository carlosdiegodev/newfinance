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
                            <h1 id="titulo" class="page-header"><i class="fa fa-money fa-fw text-success"></i>Evolução das Vendas</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="columnchart_material" style="width: 900px; height: 500px;">
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
    var randomnb = function () {
        return Math.round(Math.random() * 300)
    };
</script>

<?php
//var_dump($script);exit(0);
echo $script;exit(0);
?>


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
