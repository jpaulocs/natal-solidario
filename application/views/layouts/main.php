<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Natal Solidário</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/font-awesome.min.css');?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Datetimepicker -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap-datetimepicker.min.css');?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/AdminLTE.min.css');?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/_all-skins.min.css');?>">

    </head>
    
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">Heróis de Verdade</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">Heróis de Verdade</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation </span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo site_url('resources/img/logo-natalsolidario.png');?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $this->session->userdata('usuario_logado'); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo site_url('resources/img/logo-natalsolidario.png');?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?php echo $this->session->userdata('usuario_logado'); ?>
                                    </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo site_url('login/logout');?>" class="btn btn-default btn-flat">Sair</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo site_url('resources/img/logo-natalsolidario.png');?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>Natal Solidário</p>
                            <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MENU</li>
                        <li>
                            <a href="<?php echo site_url();?>">
                                <i class="fa fa-dashboard"></i> <span>Painel</span>
                            </a>
                        </li>

                        <?php
                        $grupos_usuario = $this->session->userdata('grupos_usuario');
                        
                        if($this->session->userdata('grupos_usuario'))
                            //echo print_r($grupos_usuario);
                            if (in_array("admin", $grupos_usuario, true)):
                        ?>
                            <li>
                                <a href="#">
                                    <i class="fa fa-address-card"></i> <span>Usuário</span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="active">
                                        <a href="<?php echo site_url('usuario/add');?>"><i class="fa fa-plus"></i> Novo</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('usuario/index');?>"><i class="fa fa-list-ul"></i> Listar</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-address-card"></i> <span>Programação </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="<?php echo site_url('palestra/index');?>"><i class="fa fa-list-ul"></i> Salas para palestra</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('entrega/index');?>"><i class="fa fa-list-ul"></i> Salas para entrega dos presentes</a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                            endif;
                        ?>

                        <li>
                            <a href="#">
                                <i class="fa fa-address-card"></i> <span>Responsável</span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active">
                                    <a href="<?php echo site_url('responsavel/add');?>"><i class="fa fa-plus"></i> Novo</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('responsavel/index');?>"><i class="fa fa-list-ul"></i> Listar</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-child"></i> <span>Beneficiado</span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active">
                                    <a href="<?php echo site_url('beneficiado/add');?>"><i class="fa fa-plus"></i> Novo</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('beneficiado/index');?>"><i class="fa fa-list-ul"></i> Listar</a>
                                </li>
                            </ul>
                        </li>
						<li>
                            <a href="#">
                                <i class="fa fa-envelope-open-o"></i> <span>Carta</span>
                            </a>
                            <ul class="treeview-menu">
								<li class="active">
                                    <a href="<?php echo site_url('carta/add');?>"><i class="fa fa-plus"></i> Novo</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url('carta/index');?>"><i class="fa fa-list-ul"></i> Listar</a>
                                </li>
                                <?php 
                                if($this->session->userdata('grupos_usuario'))
                                
                                    if (in_array("admin", $grupos_usuario, true)):
                                ?>
                                <li>
                                    <a href="<?php echo site_url('entrega/listagem_local_entrega');?>"><i class="fa fa-list-ul"></i> Acompanhamento</a>
                                </li>
                                <?php endif;?>
							</ul>
                        </li>

                        <?php
                        $grupos_usuario = $this->session->userdata('grupos_usuario');
                        
                        if($this->session->userdata('grupos_usuario'))
                            //echo print_r($grupos_usuario);
                            if (in_array("admin", $grupos_usuario, true) ||
                                in_array("representante-comunidade", $grupos_usuario, true) ||
                                in_array("representante-ong", $grupos_usuario, true) ||
                                in_array("mobilizador", $grupos_usuario, true)):
                        ?>
                            <li>
                                <a href="#">
                                    <i class="fa fa-gift"></i> <span>Presente</span>
                                </a>
                                <ul class="treeview-menu">
                                <li class="active">
                                    <a href="<?php echo site_url('presente/receberPresente');?>"><i class="fa fa-gift"></i> Recebimento</a>
                                </li>
                                <li class="active">
                                    <a href="<?php echo site_url('presente/conferencia');?>"><i class="fa fa-gift"></i> Conferência</a>
                                </li>
                                <li class="active">
                                    <a href="<?php echo site_url('presente/entrega');?>"><i class="fa fa-gift"></i> Entrega</a>
                                </li>
                            </ul>
                            </li>
                        <?php
                            endif;
                        ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php if($this->session->flashdata('message')): ?>
                    <div class="alert alert-danger" role="alert">
                        <strong><?php echo $this->session->flashdata('message'); ?> </strong>
                        <!-- <?php echo $this->session->flashdata('teste'); ?> -->
                        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php elseif($this->session->flashdata('message_ok')): ?>
                    <div class="alert alert-success" role="alert">
                        <strong><?php echo $this->session->flashdata('message_ok'); ?> </strong>
                        <!-- <?php echo $this->session->flashdata('teste'); ?> -->
                        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <!-- Main content -->
                <section class="content">
                    <?php                    
                    if(isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>                    
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Natal Solidário 2017</strong>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo site_url('resources/js/jquery-2.2.3.min.js');?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo site_url('resources/js/bootstrap.min.js');?>"></script>
        <!-- FastClick -->
        <script src="<?php echo site_url('resources/js/fastclick.js');?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo site_url('resources/js/app.min.js');?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo site_url('resources/js/demo.js');?>"></script>
        <!-- DatePicker -->
        <script src="<?php echo site_url('resources/js/moment.js');?>"></script>
        <script src="<?php echo site_url('resources/js/bootstrap-datetimepicker.min.js');?>"></script>
        <script src="<?php echo site_url('resources/js/jquery.mask.min.js');?>"></script>
        <script src="<?php echo site_url('resources/js/global.js');?>"></script>
    </body>
</html>
