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
                            <h1 id="titulo" class="page-header"><i class="fa fa-money fa-fw text-danger"></i>Contas à Pagar</h1>
                            <table class="table table-hover table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 120px; text-align: center">Data de Vencimento</th>
                                        <th style="width: 150px; text-align: center">Data Referência</th>                                                                 
                                        <th style="width: 100px; text-align: center">CentroCusto</th>
                                        <th style="width: 150px; text-align: center">Descrição</th>                                        
                                        <th style="width: 100px; text-align: center">Valor R$</th>   
                                        <th style="width: 80px; text-align: center">Ações</th>
                                    </tr>                                    
                                </thead>
                                <tbody id="corpo">
                                    <?php
                                    foreach ($contasapagar as $linha) {
                                        if ($linha->pago == 1)
                                            echo '<tr class="success">';
                                        else
                                            echo '<tr class="danger">';
                                        echo "<td style='text-align: center;'>$linha->datadevencimento2</td>";
                                        echo "<td style='text-align: center;'>$linha->datadereferencia2</td>";
                                        echo "<td style='text-align: center;'>$linha->nomecentrodecusto ($linha->id_centrodecusto)</td>";
                                        echo "<td style='text-align: center;'>$linha->descricao</td>";
                                        echo "<td style='text-align: center;' id='td_valor'>$linha->valor2</td>";
                                        echo "<td style='text-align: center; cursor: pointer;' class='editar' "
                                        . "data-id_contasapagar='$linha->id_contasapagar'"
                                        . "data-id_centrodecusto='$linha->id_centrodecusto'"
                                        . "data-datadevencimento='$linha->datadevencimento2'"
                                        . "data-datadereferencia='$linha->datadereferencia2'"
                                        . "data-nomecentrodecusto='$linha->nomecentrodecusto'"
                                        . "data-descricao='$linha->descricao'"
                                        . "data-pago='$linha->pago'"
                                        . "data-valor='$linha->valor'>";

                                        echo "<i class='fa fa-pencil'></i>";
                                        echo " &nbsp;<i class='fa fa-check'></i>";
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
        <script src="<?php echo base_url('includes/jquery/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('includes/metisMenu/js/metisMenu.min.js') ?>"></script>  
        <script src="<?php echo base_url('includes/sbAdmin/js/sb-admin-2.js') ?>"></script>
        <script src="<?php echo base_url('includes/mask/js/jquery.mask.min.js') ?>"></script>
        <script type="text/javascript">
            function validateQty(event) {
                var key = window.event ? event.keyCode : event.which;

                if (event.keyCode == 8 || event.keyCode == 46
                        || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 36 || event.keyCode == 35 || event.keyCode == 9) {
                    return true;
                } else if (key < 48 || key > 57) {
                    return false;
                } else
                    return true;
            }

            function mascaraValor(valor) {
                valor = valor.toString().replace(/\D/g, "");
                valor = valor.toString().replace(/(\d)(\d{8})$/, "$1.$2");
                valor = valor.toString().replace(/(\d)(\d{5})$/, "$1.$2");
                valor = valor.toString().replace(/(\d)(\d{2})$/, "$1,$2");
                return valor
            }


            $(document).ready(function () {
                $('.date').mask('00/00/0000');


                $('#modal_valor').change(function () {
                    $('#modal_valor').val(mascaraValor($('#modal_valor').val()));
                });

                var id_contasapagar;
                $('.editar').click(function () {
                    //var id_contasapagar = $(this).data('id_contasapagar');
                    //alert(id_contasapagar);
                    id_contasapagar = $(this).data('id_contasapagar');
                    $('#modal_id_contasapagar').html($(this).data('id_contasapagar'));
                    $('#modal_datadevencimento').val($(this).data('datadevencimento'));
                    $('#modal_datadereferencia').val($(this).data('datadereferencia'));
                    $('#modal_id_centrodecusto').val($(this).data('id_centrodecusto'));
                    $('#modal_id_descricao').val($(this).data('descricao'));
                    $('#modal_valor').val(mascaraValor($(this).data('valor')));
                    $("#modal_pago").prop("checked", $(this).data('pago'));

                    $('#modal').modal('show');
                });
                $('#modal_btn_salvar').click(function () {
                    $.ajax({
                        url: base_url + 'ContasAPagar/alterar/',
                        data: {id_contasapagar: id_contasapagar, pago: $("#modal_pago").is(':checked') ? 1 : 0, datadevencimento: $('#modal_datadevencimento').val(), datadereferencia: $('#modal_datadereferencia').val(), id_centrodecusto: $('#modal_id_centrodecusto').val(), descricao: $('#modal_id_descricao').val(), valor: $('#modal_valor').val()},
                        type: "post",
                        dataType: "json"
                    }).done(function (dados) {
                        //window.location="index2.htm"; 
                        if (dados.status == true) {
                            location.href = '<?php echo base_url('contasapagar') ?>';
                        } else
                        {
                            alert("Aconteceu um erro ao tentar realizar a alteração. Tente novamente.");
                            $('#modal').modal('toggle');
                        }
                    });

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
