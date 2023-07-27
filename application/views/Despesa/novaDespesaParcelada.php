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
                            <h1 id="titulo" class="page-header"><i class="fa fa-external-link-square fa-fw text-danger"></i>Nova Despesa Parcelada</h1>
                        </div>                        
                    </div>   
                    <?php echo form_open('Despesa/novaDespesaParcelada', array('class' => '', 'id' => 'formularioNovaDespesa')); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?php
                            //Centro de Custo
                            echo '<div class="form-group" >';
                            echo form_label('Centro de Custo<span class="text-danger"> *</span>', 'idCentroCusto', array('title' => 'A quem pertence o lançamento'));
                            $opcoesCentroCusto = array();
                            $opcoesCentroCusto[''] = 'Selecione';
                            foreach ($centrodecusto as $linha) {
                                $opcoesCentroCusto[$linha->id_centrodecusto] = $linha->nome . ' (' . $linha->id_centrodecusto . ')';
                            }
                            echo form_error('id_centrodecusto');
                            echo form_dropdown('id_centrodecusto', $opcoesCentroCusto, set_value('id_centrodecusto'), 'class="form-control" id="id_centrodecusto" autofocus ="autofocus" tabindex="1"');
                            echo '</div>';

                            //Campo Data do Fato
                            echo '<div class="form-group">';
                            echo form_label('Data do Acontecimento/Compra/Fato<span class="text-danger"> *</span>', 'dataFato', array('class' => 'control-label'));
                            echo form_input(array('tabindex' => '4', 'id' => 'dataFato', 'name' => 'dataFato', 'class' => 'form-control date', 'placeholder' => 'dd/mm/aaaa'), set_value('dataFato'));
                            echo '</div>';

                            //Campo Valor
                            echo '<div class="form-group">';
                            echo form_label('Valor R$<span class="text-danger"> *</span>', 'valor', array('class' => 'control-label control-label'));
                            echo form_input(array('tabindex' => '7', 'id' => 'valor', 'onkeypress' => 'return validateQty(event);', 'name' => 'valor', 'class' => 'form-control currency', 'placeholder' => 'Exemplo: 120,00', 'style' => 'color:red; background-color : #ffe6e7;'), set_value('valor'));
                            echo '</div>';
                            ?>                            
                        </div>
                        <div class="col-md-4">
                            <?php
                            //Campo Grupo de Finalidades
                            echo '<div class="form-group">';
                            echo form_label('Grupo de Finalidades<span class="text-danger"> *</span>', 'idGrupoFinalidade', array('class' => 'control-label'));
                            $opcoesGrupoFinalidade = array();
                            $opcoesGrupoFinalidade[''] = 'Selecione um centro de custo';
                            echo form_dropdown('id_grupodefinalidade', $opcoesGrupoFinalidade, set_value('id_grupodefinalidade'), 'class="form-control" id="id_grupodefinalidade" tabindex="2"');
                            echo '</div>';

                            //Campo Data de Referência
                            echo '<div class="form-group">';
                            echo form_label('Data de Referência<span class="text-danger"> *</span>', 'dataReferencia', array('class' => 'control-label'));
                            echo form_input(array('tabindex' => '5', 'id' => 'dataReferencia', 'name' => 'dataReferencia', 'class' => 'form-control date', 'placeholder' => 'dd/mm/aaaa'), set_value('dataReferencia'));
                            echo '</div>';

                            //Campo Formas de Pagamento---------------------------------------------------------------------------------------------------------                            
                            echo '<div class="form-group">';
                            echo form_label('Forma de Pagamento<span class="text-danger"> *</span>', '', array('class' => 'control-label'));
                            $opcoesFormaPagamento = array();
                            $opcoesFormaPagamento[''] = 'Selecione';
                            foreach ($formasdepagamento as $linha) {
                                $opcoesFormaPagamento[$linha->id_formadepagamento] = $linha->id_formadepagamento . '-' . $linha->nome;
                            }
                            echo form_error('id_formadepagamento');
                            echo form_dropdown('id_formadepagamento', $opcoesFormaPagamento, set_value('id_formadepagamento'), 'class="form-control" id="id_formadepagamento" tabindex="8"');
                            echo '</div>';
                            ?>
                        </div>

                        <div class="col-md-4">
                            <?php
//Campo Grupo de Finalidades
                            echo '<div class="form-group">';
                            echo form_label('Finalidade<span class="text-danger"> *</span>', 'id_finalidade', array('class' => 'control-label'));
                            $opcoesGrupoFinalidade = array();
                            $opcoesGrupoFinalidade[''] = 'Selecione um centro de custo';
                            echo form_dropdown('id_finalidade', $opcoesGrupoFinalidade, set_value('id_finalidade'), 'class="form-control" id="id_finalidade" tabindex="3"');
                            echo '</div>';

//Campo Data do Pagamento
                            echo '<div class="form-group">';
                            echo form_label('Data do Pagamento<span class="text-danger"> *</span>', 'dataPagamento', array('class' => 'control-label'));
                            echo form_input(array('tabindex' => '6', 'id' => 'dataPagamento', 'name' => 'dataPagamento', 'class' => 'form-control date', 'placeholder' => 'dd/mm/aaaa'), set_value('dataPagamento'));
                            echo '</div>';

//Campo Lugar da Despesa---------------------------------------------------------------------------------------------------------
                            echo '<div class="form-group">';
                            echo form_label('Local da Despesa<span class="text-danger"> *</span>', 'localDespesa', array('class' => 'control-label', 'id' => 'localDespesa'));
                            echo form_input(array('tabindex' => '9', 'id' => 'localDespesa', 'name' => 'localDespesa', 'class' => 'form-control', 'placeholder' => 'Lojas americanas em Palmas...'), set_value('localDespesa'));
                            echo '</div>';
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <?php
//Campo Descrição---------------------------------------------------------------------------------------------------------
                            echo '<div class="form-group">';
                            echo form_label('Descrição (Igual no extrato)<span class="text-danger"> *</span>', 'descricao', array('class' => 'control-label'));
                            echo form_input(array('tabindex' => '10', 'id' => 'descricao', 'name' => 'descricao', 'class' => 'form-control', 'placeholder' => 'Ex: PALMAS COLCHOES'), set_value('descricao'));
                            echo '</div>';
                            ?>
                        </div>   
                        <div class="col-md-4">
                            <?php
                            //Campo quantidade de parcelas---------------------------------------------------------------------------------------------------------
                            echo '<div class="form-group">';
                            echo form_label('Quantidade de Parcelas<span class="text-danger"> *</span>', 'numeroDocumento', array('class' => 'control-label'));
                            echo form_input(array('tabindex' => '11', 'id' => 'qtParcelas', 'onkeypress' => 'return (event.charCode >= 48  && event.charCode <= 57) || event.charCode <= 0','name' => 'qtParcelas', 'class' => 'form-control', 'placeholder' => 'Ex.: numero do cheque'), set_value('numeroDocumento'));
                            echo '</div>';
                            ?>   
                        </div>
                        <div class="col-md-4">
                            <?php
//Número do Documento---------------------------------------------------------------------------------------------------------
                            echo '<div class="form-group">';
                            echo form_label('Número do Documento<span class="text-danger"> *</span>', 'numeroDocumento', array('class' => 'control-label'));
                            echo form_error('numeroDocumento');
                            echo form_input(array('tabindex' => '11', 'id' => 'numeroDocumento', 'name' => 'numeroDocumento', 'class' => 'form-control', 'placeholder' => 'Ex.: numero do cheque'), set_value('numeroDocumento'));
                            echo '</div>';
                            ?>                            
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
//Campo Decrição detalhada/Demais informações---------------------------------------------------------------------------------------------------------
                            echo '<div class="form-group">';
                            echo form_label('Descrição Detalhada/Demais informações', 'descricaoDetalhada', array('class' => 'control-label'));
                            echo form_textarea(array('tabindex' => '12', 'id' => 'descricaoDetalhada', 'name' => 'descricaoDetalhada', 'class' => 'form-control', 'placeholder' => 'Caso queira, descreva detalhes sobre a despesa.', 'rows' => '2', 'style' => 'resize:none;'), set_value('descricaoDetalhada'));
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <?php
//Botão Salvar---------------------------------------------------------------------------------------------------------
                                    echo '<div class="form-group">';
                                    echo '<button tabindex="13" id="btn_salvar" type="button" class="btn btn-primary">Salvar</button>&nbsp;';
//Botão Voltar---------------------------------------------------------------------------------------------------------
                                    echo '&nbsp;';
                                    echo anchor('lancamento/index', 'Voltar', 'class="btn btn-default" tabindex="14"');
                                    echo '</div>'
                                    ?>   
                                </div>
                                <div class="col-sm-6">
                                    <?php
//Botão Nova Finalidade---------------------------------------------------------------------------------------------------------
                                    echo '<div class="form-group pull-right">';
                                    echo '<button tabindex="15" id="btnNovaFinalidade" type="button" class="btn btn-default"><i class="fa fa-plus fa-2"></i> Nova Finalidade</button>&nbsp;';
                                    ?>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>                    
                    <div class='row'>
                        <div class="col-lg-12">
                            <h3 id="titulo" class="page-header"><i class="fa fa-list fa-fw"></i>Últimos cadastrados</h3>                        
                            <table class="table table-hover table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="">Id</th>
                                        <th scope="">CentroCusto</th>
                                        <th scope="">Finalidade</th>
                                        <th scope="">FormaPagamento</th>
                                        <th scope="">Valor</th>
                                        <th scope="">Documento</th>
                                        <th scope="">Local</th>
                                        <th scope="">Data do Fato</th>
                                        <th scope="">Data Referência</th>
                                        <th scope="">Data Pagamento</th>                                    
                                        <th scope="">Descricao</th>
                                    </tr>
                                </thead>
                                <tbody id="corpo">
                                    <?php
                                    foreach ($ultimosLancamentos as $linha) {
                                        echo '<tr>';
                                        echo "<td>$linha->id_lancamento</td>";
                                        echo "<td>$linha->NomeCentroCusto ($linha->id_centrodecusto)</td>";
                                        echo "<td>$linha->NomeFinalidade ($linha->id_finalidade)</td>";
                                        echo "<td>$linha->NomeFormaDePagamento ($linha->id_formadepagamento)</td>";
                                        echo "<td>$linha->valor</td>";
                                        echo "<td>$linha->numerodocumento</td>";
                                        echo "<td>$linha->localdadespesa</td>";
                                        echo "<td>$linha->DatadoAcontecimento1</td>";
                                        echo "<td>$linha->datareferencia1</td>";
                                        echo "<td>$linha->datapagamento1</td>";
                                        echo "<td>$linha->descricao</td>";
                                        echo '</tr>';
                                        //$opcoesFormaPagamento[$linha->id_formadepagamento] = $linha->id_formadepagamento . '-' . $linha->nome;
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

            function validarFormularioParaInserir() {
                if ($("#id_centrodecusto").val() == '') {
                    alert('Por favor, selecione o centro de custo!');
                    return false;
                }
                if ($("#id_finalidade").val() == '') {
                    alert('Por favor, selecione a finalidade!');
                    return false;
                }
                if ($("#dataFato").val() == '') {
                    alert('Por favor, informe a data do fato!');
                    return false;
                }
                if ($("#dataReferencia").val() == '') {
                    alert('Por favor, informe a data de referência!');
                    return false;
                }
                if ($("#dataReferencia").val() == '') {
                    alert('Por favor, informe a data do pagamento!');
                    return false;
                }
                if ($("#valor").val() == '') {
                    alert('Por favor, informe o valor!');
                    return false;
                }
                if ($("#qtParcelas").val() == '') {
                    alert('Por favor, informe a quantidade de parcelas!');
                    return false;
                }
                if ($("#qtParcelas").val() > 400) {
                    alert('Não existe parcelamento maior que 400. Contacte o administrador do sistema.');
                    return false;
                }
                return true;
            }

            function myTrim(x) {
                return x.replace(/^\s+|\s+$/gm, '');
            }

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

            function povoarGrupos(idCentroCusto, idGrupo) {
                $("#id_grupodefinalidade").html("<option selected='selected' value=''>Todos</option>");
                $.ajax({
                    url: base_url + 'Despesa/povoarGruposDeFinalidades/' + idCentroCusto,
                    type: "GET",
                    dataType: "json"
                }).done(function (dados) {
                    var opcoes = "";
                    opcoes = "<option selected='selected' value=''>Todos</option>";
                    for (var x in dados) {
                        if (idGrupo != null) {
                            if (idGrupo == dados[x].id) {
                                opcoes += "<option selected='selected' value='" + dados[x].id + "'>" + dados[x].nome + ' (' + dados[x].id + ')' + "</option>";
                            } else {
                                opcoes += "<option value='" + dados[x].id + "'>" + dados[x].nome + ' (' + dados[x].id + ')' + "</option>";
                            }
                        } else {
                            opcoes += "<option value='" + dados[x].id + "'>" + dados[x].nome + ' (' + dados[x].id + ')' + "</option>";
                        }
                    }
                    $("#id_grupodefinalidade").html(opcoes);
                });
            }

            function povoarFinalidades(idCentroCusto, idGrupo, selectado) {
                $.ajax({
                    url: base_url + 'Despesa/povoarFinalidades/' + idCentroCusto + '/' + idGrupo,
                    type: "GET",
                    dataType: "json"
                }).done(function (dados) {
                    var opcoes = "";
                    opcoes = '<option selected="selected" value="">Selecione</option>';
                    for (var x in dados) {
                        //Significa que estamos querendo setar uma finalidade como selecionada
                        if (selectado != null) {
                            if (dados[x].id == selectado) {
                                opcoes += "<option selected='selected' value='" + dados[x].id + "'>" + dados[x].nomeFinalidade + " (" + dados[x].id + ")" + "</option>";
                            } else {
                                opcoes += "<option value='" + dados[x].id + "'>" + dados[x].nomeFinalidade + " (" + dados[x].id + ")" + "</option>";
                            }
                        } else {
                            opcoes += "<option value='" + dados[x].id + "'>" + dados[x].nomeFinalidade + " (" + dados[x].id + ")" + "</option>";
                        }
                    }
                    $("#id_finalidade").html(opcoes);
                });
            }
            $(document).ready(function () {

                $('.date').mask('00/00/0000');


                //Faz o trim no campo descricao
                $('#descricao').change(function () {
                    $('#descricao').val(($('#descricao').val()).trim());
                });
                //Faz o trim no campo detalhes
                $('#descricaoDetalhada').change(function () {
                    $('#descricaoDetalhada').val(($('#descricaoDetalhada').val()).trim());
                });

                //Formata campo valor
                $('#valor').change(function () {
                    $('#valor').val(mascaraValor($('#valor').val()));

                });

                //Captura finalidade e preenche a descrição
                $('#id_finalidade').change(function () {
                    var id_centrodecusto = $("#id_centrodecusto").val();
                    var id_finalidade = $("#id_finalidade").val();
                    if ($("#id_finalidade").val() != '') {
                        $.ajax({
                            url: base_url + 'Despesa/pegarUltimaDescricao/' + id_centrodecusto + '/' + id_finalidade,
                            type: "GET",
                            dataType: "json"
                        }).done(function (dados) {
                            for (var x in dados) {
                                $("#descricao").val(dados[x].descricao);
                            }
                        });
                    }
                });

                //Ação responsável por capturar a ação de select do centro de custo
                $('#id_centrodecusto').change(function () {
                    var idCentroCusto = $("#id_centrodecusto").val();
                    povoarGrupos(idCentroCusto);
                    povoarFinalidades(idCentroCusto, '');
                });

                //Caso mude o Grupo de Finalidades
                $('#id_grupodefinalidade').change(function () {
                    $("#id_grupodefinalidade").html();
                    var idCentroCusto = $("#id_centrodecusto").val();
                    var idGrupoDeFinalidade = $("#id_grupodefinalidade").val();
                    povoarFinalidades(idCentroCusto, idGrupoDeFinalidade);
                });


                //SALVAR Submeter formulário
                $('#btn_salvar').click(function () {
                    if (validarFormularioParaInserir())
                        $('#formularioNovaDespesa').submit();
                });

                //MODAL NOVA FINALIDADE                
                $('#btnNovaFinalidade').click(function () {
                    $('#novafinalidade_nomedocentrodecusto').val('');
                    $('#novafinalidade_nomedafinalidade').val('');
                    $('#novafinalidade_nomedogrupo').val('');
                    $("#novafinalidade_nomedogrupo").prop('disabled', false);
                    if ($("#id_centrodecusto").val() == '') {
                        alert('Por favor, primeiramente selecione o centro de custo!');
                    } else {

                        $('#novafinalidade_nomedocentrodecusto').val($("#id_centrodecusto option:selected").text());
                        $("#novafinalidade_nomedocentrodecusto").prop('disabled', true);
                        if ($("#id_grupodefinalidade").val() != '') {
                            $('#novafinalidade_nomedogrupo').val($("#id_grupodefinalidade option:selected").text());
                            $("#novafinalidade_nomedogrupo").prop('disabled', true);
                        }
                        $('#modalNovaFinalidade').modal('show');
                        $("#dataFato").focus();
                    }
                });
                $('#novafinalidade_btnsalvar').click(function () {
                    if ($('#novafinalidade_nomedafinalidade').val() == '') {
                        alert('Por gentileza, digite o nome da finalidade!');
                        return;
                    }
                    $.ajax({
                        url: base_url + 'Despesa/cadastrarFinalidade/',
                        data: {id_centrodecusto: $("#id_centrodecusto").val(), id_grupodefinalidade: $("#id_grupodefinalidade").val(), nomedonovogrupo: $("#novafinalidade_nomedogrupo").val(), nomedanovafinalidade: $("#novafinalidade_nomedafinalidade").val()},
                        type: "post",
                        dataType: "json"
                    }).done(function (dados) {
                        idCentroCusto = $("#id_centrodecusto").val();
                        povoarGrupos(idCentroCusto, dados.id_grupoinserido);
                        povoarFinalidades(idCentroCusto, dados.id_grupoinserido, dados.id_finalidadeinserida);
                        //function povoarFinalidades(idCentroCusto, idGrupo, selectado) {
                        //$('#id_finalidade option').removeAttr('selected').filter('[value='+dados.id_finalidadeinserida+']').attr('selected', true);                    
                        //setar o selectado
                        //$("#id_finalidade").val(dados.id_finalidadeinserida).change();
                        //$("#id_grupodefinalidade").val(dados.id_grupoinserido);
                        $('#modalNovaFinalidade').modal('toggle');
                        $("#dataFato").focus();
                    });
                });


                //ULTIMOS CADASTRADOS
                $('#btnUltimosCadastrados').click(function () {
                    $.ajax({
                        url: base_url + 'Despesa/pegarUltimosCadastrados/10',
                        type: "post",
                        dataType: "json"
                    }).done(function (dados) {
                        $("#corpo").html('');
                        for (var x in dados) {
                            var linha = '<tr>';
                            linha += '<td>' + dados[x].id_lancamento + '</td>';
                            linha += '<td>' + dados[x].NomeCentroCusto + ' (' + dados[x].id_centrodecusto + ')' + '</td>';
                            linha += '<td>' + dados[x].NomeFinalidade + ' (' + dados[x].id_finalidade + ')' + '</td>';
                            linha += '<td>' + dados[x].NomeFormaDePagamento + ' (' + dados[x].id_formadepagamento + ')' + '</td>';
                            linha += '<td>' + dados[x].valor + '</td>';
                            linha += '<td>' + dados[x].numerodocumento + '</td>';
                            linha += '<td>' + dados[x].localdadespesa + '</td>';
                            linha += '<td>' + dados[x].datadoacontecimento + '</td>';
                            linha += '<td>' + dados[x].datareferencia + '</td>';
                            linha += '<td>' + dados[x].datapagamento + '</td>';
                            linha += '<td>' + dados[x].descricao + '</td>';
                            linha += '</tr>'
                            $("#corpo").append(linha);
                        }
                        $('#modalUltimosCadastrados').modal('show');

                    });


                });


            });
        </script>
        <!-- Modal Pequena-->
        <div id="modalNovaFinalidade"class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Nova Finalidade</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="novafinalidade_nomedafinalidade" class="control-label">Nome do Centro de Custo</label>
                            <input type="text" class="form-control" id="novafinalidade_nomedocentrodecusto">
                            <label for="nomedogrupo" class="control-label">Nome do Grupo (Caso deseje criar novo grupo)</label>
                            <input type="text" class="form-control" id="novafinalidade_nomedogrupo">
                            <label for="novafinalidade_nomedafinalidade" class="control-label">Nome da finalidade</label>
                            <input type="text" class="form-control" id="novafinalidade_nomedafinalidade">                                                        
                        </div>   


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button id='novafinalidade_btnsalvar'name='novafinalidade_btnsalvar' type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Grande-->
        <div id="modalUltimosCadastrados" class="modal fade"  tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-lg" role="document" style='width:70%;height:100%;'>
                <div class="modal-content" style='height: 60%;'>
                    <div class="modal-body">  
                        <div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 id="tituloConfirmacao"class="modal-title text-center" id="myModalLabel">Confirmação dos Dados</h3>
                        </div><br/>
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th scope="">Id</th>
                                    <th scope="">CentroCusto</th>
                                    <th scope="">Finalidade</th>
                                    <th scope="">FormaPagamento</th>
                                    <th scope="">Valor</th>
                                    <th scope="">Documento</th>
                                    <th scope="">Local</th>
                                    <th scope="">Data do Fato</th>
                                    <th scope="">Data Referência</th>
                                    <th scope="">Data Pagamento</th>                                    
                                    <th scope="">Descricao</th>
                                </tr>
                            </thead>
                            <tbody id="corpo">                                
                            </tbody>
                        </table>
                    </div>
                    <div id="botoesDaModal" class="modal-footer">
                        <div class="pull-left">
                            <button type="button" class="btn btn-primary salvar">Salvar</button>
                            <button type="button " class="btn btn-danger" data-dismiss="modal">Corrigir</button>                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!--FIM DA MODAL!-->    
    </body>
</html>
