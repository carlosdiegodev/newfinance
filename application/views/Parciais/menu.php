<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">                    
        <a class="navbar-brand" href="" style="font-size: 36px; color: #337ab7;">New Finance</a>
    </div> 
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">                        
                <li>
                    <?php echo anchor('Inicio/index', '<i class="fa fa-home fa-fw"></i> Início'); ?>                                
                </li>  
                <li>
                    <?php echo anchor('Despesa/novaDespesa', '<i class="fa fa-external-link-square fa-fw text-danger"></i> Nova Despesa'); ?>                                
                </li>  
                <li>
                    <?php echo anchor('Despesa/novaDespesaParcelada', '<i class="fa fa-external-link-square fa-fw text-danger"></i> Nova Despesa Parcelada'); ?>                                
                </li>
                <li>
                    <?php echo anchor('ContasAPagar/', '<i class="fa fa-clock-o fa-fw text-danger"></i> Contas à Pagar'); ?>                                
                </li>  
                <li>
                    <?php echo anchor('Faturamento/', '<i class="fa fa-money fa-fw text-success"></i> Faturamento'); ?>                                
                </li>  
                <li>
                    <a href="#"><i class="fa fa-pie-chart fa-fw"></i> Relatórios <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <?php echo anchor('Relatorios/consolidadoanual', '<i class="fa fa-line-chart fa-fw"></i> Despesas Consolidado Anual'); ?>                                
                        </li>
                        <li>
                            <?php echo anchor('Relatorios/parcelamentos', '<i class="fa fa-area-chart fa-fw"></i> Parcelamentos'); ?>                                
                        </li> 
                        <li>
                            <?php echo anchor('Relatorios/consolidadomensal', '<i class="fa fa-bar-chart-o fa-fw"></i> Despesas do Mês'); ?>                                
                        </li>                        
                        <li>
                            <?php echo anchor('Relatorios/lucroxdespesa', '<i class="fa fa-money fa-fw"></i>Lucro X Despesa (Natus)'); ?>                                
                        </li>
                        <li>
                            <?php echo anchor('Relatorios/evolucaovendas', '<i class="fa fa-money fa-fw"></i>Evolução de Vendas'); ?>                                
                        </li>
                        <li>
                            <?php echo anchor('Relatorios/resultadomensal', '<i class="fa fa-money fa-fw"></i>Resultado mensal'); ?>                                
                        </li>
                    </ul>
                </li>  

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>