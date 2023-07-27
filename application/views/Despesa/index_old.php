<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Aplicação para Controle de Finanças">
        <meta name="author" content="Carlos Diego">
        <title>Finance</title>
        <!-- Bootstrap Core CSS -->
        <?php
        echo link_tag('includes/bootstrap/css/bootstrap.min.css');
        echo link_tag('includes/metisMenu/css/metisMenu.min.css');
        echo link_tag('includes/sbAdmin/css/sb-admin-2.css');
        echo link_tag('includes/font-awesome/css/font-awesome.min.css');
        ?>   
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Finance - Gerenciador Financeiro</a>
                </div> 
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">                        
                            <li>
                                <?php echo anchor('Inicio/index', '<i class="fa fa-home fa-fw"></i> Início'); ?>                                
                            </li>  
                            <li>
                                <?php echo anchor('Despesa/index', '<i class="fa fa-external-link-square fa-fw text-danger"></i> Nova Despesa'); ?>                                
                            </li>  
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Nova Despesa</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        <script src="<?php echo base_url('includes/jquery/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('includes/metisMenu/js/metisMenu.min.js') ?>"></script>  
        <script src="<?php echo base_url('includes/sbAdmin/js/sb-admin-2.js') ?>"></script>
    </body>

</html>
