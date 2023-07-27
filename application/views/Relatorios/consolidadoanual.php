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
                            <h1 id="titulo" class="page-header"><i class="fa fa-bar-chart-o fa-fw"></i>Despesas Consolidado Anual</h1>
                            <?php echo form_open('Relatorios/consolidadoanual', array('class' => '', 'id' => 'form_filtrar')); ?>
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
                                        //echo form_multiselect('id_centrodecusto', $opcoesCentroCusto, set_value('id_centrodecusto'), 'class="form-control" multiple id="id_centrodecusto" autofocus ="autofocus" tabindex="1"');
                                        echo form_multiselect('id_centrodecusto[]', $opcoesCentroCusto, '', array('class' => 'form-control', 'display' => 'block', 'id' => 'id_centrodecusto'));
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
                                        echo form_dropdown(['class' => 'form-control', 'id' => "ano", 'name' => "ano"], $anos, $anoatual);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    echo '<br/><button tabindex="4" id="btn_filtrar" type="button" class="btn"><i class="fa fa-search"></i> Filtrar</button>&nbsp;';
                                    echo form_close();
                                    ?>     
                                </div>      
                            </div>

                            <?php if (isset($resultados)) { ?>
                                <div class = "row" style = "line-height: 20px; font-size: 12px; ">
                                    <div class = "col-md-12">
                                        <h3>Total por Categoria</h3>
                                        <table class = "table table-hover table-condensed table-bordered" style = "height: 7px;">
                                            <thead>
                                                <tr>
                                                    <th style = "width: 350px;; text-align: center">Grupo</th>
                                                    <th>Jan</th>
                                                    <th>Fev</th>
                                                    <th>Mar</th>
                                                    <th>Abr</th>
                                                    <th>Mai</th>
                                                    <th>Jun</th>
                                                    <th>Jul</th>
                                                    <th>Ago</th>
                                                    <th>Set</th>
                                                    <th>Out</th>
                                                    <th>Nov</th>
                                                    <th>Dez</th>
                                                    <th>TOTAL ANUAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($resultados_agrupado)) {
                                                    $qtRegistros = count($resultados_agrupado);
                                                    for ($i = 0; $i < $qtRegistros; $i++) {
                                                        echo "<tr>";
                                                        echo "<td>" . $resultados_agrupado[$i]->nomegrupo . "(" . $resultados[$i]->id_grupodefinalidade . ")</td>";
                                                        echo "<td class='celula' data-finalidade='".$resultados[$i]->id_grupodefinalidade."' data-mes='1'>" . $resultados_agrupado[$i]->Jan . "</td>";
                                                        echo "<td class='celula'>" . $resultados_agrupado[$i]->Fev . "</td>";
                                                        echo "<td class='celula'>" . $resultados_agrupado[$i]->Mar . "</td>";
                                                        echo "<td>" . $resultados_agrupado[$i]->Abr . "</td>";
                                                        echo "<td>" . $resultados_agrupado[$i]->Mai . "</td>";
                                                        echo "<td>" . $resultados_agrupado[$i]->Jun . "</td>";
                                                        echo "<td>" . $resultados_agrupado[$i]->Jul . "</td>";
                                                        echo "<td>" . $resultados_agrupado[$i]->Ago . "</td>";
                                                        echo "<td>" . $resultados_agrupado[$i]->Set . "</td>";
                                                        echo "<td>" . $resultados_agrupado[$i]->Out . "</td>";
                                                        echo "<td>" . $resultados_agrupado[$i]->Nov . "</td>";
                                                        echo "<td>" . $resultados_agrupado[$i]->Dez . "</td>";
                                                        echo "<td>" . $resultados_agrupado[$i]->TotalAnual . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    echo "<tr>";
                                                    echo "<td>TOTAL MENSAL</td>";                                                    
                                                    echo "<td>".$totalizacoes['jan']."</td>";
                                                    echo "<td>".$totalizacoes['fev']."</td>";
                                                    echo "<td>".$totalizacoes['mar']."</td>";
                                                    echo "<td>".$totalizacoes['abr']."</td>";
                                                    echo "<td>".$totalizacoes['mai']."</td>";
                                                    echo "<td>".$totalizacoes['jun']."</td>";
                                                    echo "<td>".$totalizacoes['jul']."</td>";
                                                    echo "<td>".$totalizacoes['ago']."</td>";
                                                    echo "<td>".$totalizacoes['set']."</td>";
                                                    echo "<td>".$totalizacoes['out']."</td>";
                                                    echo "<td>".$totalizacoes['nov']."</td>";
                                                    echo "<td>".$totalizacoes['dez']."</td>";
                                                    echo "<td>".$totalizacoes['total']."</td>";
                                                    echo "</tr>";;
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>                            

                                <div class = "row" style="line-height: 20px; font-size: 12px; ">
                                    <div class="col-md-12">  
                                        <h3>Total por Finalidade</h3>
                                        <tbody>
                                            <?php
                                            if (isset($resultados)) {
                                                echo '
                                                    <table class = "table table-hover table-condensed table-bordered" style="height: 7px;">             
                                                        <thead>
                                                            <tr>                                                                
                                                                <th style="width: 210px; text-align: center">Finalidade</th>                                                                                                                    
                                                                <th style="width: 350px;; text-align: center">Grupo</th>                                                    
                                                                <th>Jan</th>
                                                                <th>Fev</th>
                                                                <th>Mar</th>
                                                                <th>Abr</th>
                                                                <th>Mai</th>
                                                                <th>Jun</th>
                                                                <th>Jul</th>
                                                                <th>Ago</th>
                                                                <th>Set</th>
                                                                <th>Out</th>
                                                                <th>Nov</th>
                                                                <th>Dez</th>      
                                                                <th>TOTAL</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                $qtRegistros = count($resultados);
                                                for ($i = 0; $i < $qtRegistros; $i++) {
                                                    echo "<tr>";
                                                    echo "<td>" . $resultados[$i]->nomefinalidade . "(" . $resultados[$i]->id_finalidade . ")</td>";
                                                    echo "<td>" . $resultados[$i]->nomegrupo . "(" . $resultados[$i]->id_grupodefinalidade . ")</td>";
                                                    //echo "<td>" . $resultados[$i]->nomegrupo ."</td>";
                                                    echo "<td>" . $resultados[$i]->Jan . "</td>";
                                                    echo "<td>" . $resultados[$i]->Fev . "</td>";
                                                    echo "<td>" . $resultados[$i]->Mar . "</td>";
                                                    echo "<td>" . $resultados[$i]->Abr . "</td>";
                                                    echo "<td>" . $resultados[$i]->Mai . "</td>";
                                                    echo "<td>" . $resultados[$i]->Jun . "</td>";
                                                    echo "<td>" . $resultados[$i]->Jul . "</td>";
                                                    echo "<td>" . $resultados[$i]->Ago . "</td>";
                                                    echo "<td>" . $resultados[$i]->Set . "</td>";
                                                    echo "<td>" . $resultados[$i]->Out . "</td>";
                                                    echo "<td>" . $resultados[$i]->Nov . "</td>";
                                                    echo "<td>" . $resultados[$i]->Dez . "</td>";
                                                    echo "<td>" . $resultados[$i]->TotalAnual . "</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            echo '</tbody></table>';
                                            ?>
                                    </div>
                                </div>
                            <?php }; ?>
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
                    //alert($('#id_centrodecusto').val());
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
            
            $(document).on('click','.celula', function(){
                var mes = $(this).data('mes');
                var ano = $('#ano').val();
                var idfinalidade = $(this).data('finalidade');
                
                alert(mes+'/'+ano+' - ID Finalidade'+idfinalidade);
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

</body>
</html>
