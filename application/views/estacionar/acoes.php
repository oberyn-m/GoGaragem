

<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">

    <?php $this->load->view('layout/sidebar'); ?>    

    <div class="main-content">		
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="<?php echo $icone_view; ?> bg-blue"></i>
                            <div class="d-inline">
                                <h5><?php echo $titulo; ?></h5>
                                <span><?php echo $sub_titulo; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a title="Home" href="<?php echo base_url('/'); ?>"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><?php echo $titulo; ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <?php if ($message = $this->session->flashdata('sucesso')): ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert bg-success alert-success text-white alert-dismissible fade show" role="alert">
                            <strong><?php echo $message ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ik ik-x"></i>
                            </button>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <div class="row">
                <div class="col-xl-4 col-md-12">
                    <div class="card comp-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="mb-25">Impressão do Ticket</h6>
                                    <a target="_blank" class="btn bg-blue text-white" href="<?php echo base_url($this->router->fetch_class() . '/pdf/' . $estacionado->estacionar_id); ?>">Imprimir</a>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-print bg-blue"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card comp-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="mb-25">Listar Ticket's</h6>
                                    <a class="btn bg-green text-white" href="<?php echo base_url($this->router->fetch_class()); ?>">Listar</a>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list-ol bg-green"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card comp-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="mb-25">Novo Ticket</h6>
                                    <a class="btn bg-yellow text-white" href="<?php echo base_url($this->router->fetch_class() . '/core/'); ?>">Novo</a>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-plus bg-yellow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        </div>

        <footer class="footer">
            <div class="w-100 clearfix">
                <span class="text-center text-sm-left d-md-inline-block">Copyright © <?php echo date('Y'); ?> <a href='/estacionamento'>Go Garagem</a> Todos Direitos Reservados.</span>
                <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Criado <i class="fas fa-code"></i> por <a href="https://github.com/oberyn-m" class="text-dark" target="_blank">ICM</a></span>
            </div>
        </footer>

    </div>



