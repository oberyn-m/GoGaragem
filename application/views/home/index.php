

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

            <?php if ($message = $this->session->flashdata('error')): ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert bg-danger alert-danger text-white alert-dismissible fade show" role="alert">
                            <strong><?php echo $message ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ik ik-x"></i>
                            </button>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
            
            <?php if ($message = $this->session->flashdata('info')): ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert bg-info alert-info text-white alert-dismissible fade show" role="alert">
                            <strong><?php echo $message ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ik ik-x"></i>
                            </button>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <div class="row">
                <div class="col-xl-3 col-md-12">
                    <div class="card proj-t-card">
                        <div class="card-body text-navy">
                            <div class="row align-items-center mb-30">
                                <div class="col-auto">
                                    <i class="fas fa-warehouse text-navy f-40"></i>
                                </div>
                                <div class="col pl-0">
                                    <h6 class="mb-5">Total Vagas</h6>
                                    <h6 class="mb-5 font-weight-bold"><?php echo $numero_total_vagas->precificacao_numero_vagas; ?></h6>
                                </div>
                            </div>
                            <div class="row align-items-center text-center">
                                <div class="col">
                                    <span>Livre</span>
                                    <h6 class="mb-0 badge badge-pill badge-navy text-white"><?php echo $numero_total_vagas->precificacao_numero_vagas - $total_estacionados_agora; ?></h6></div>
                                <div class="col"><i class="fas fa-exchange-alt text-navy f-18"></i></div>
                                <div class="col">
                                    <span>Ocupadas</span>
                                    <h6 class="mb-0 badge badge-pill badge-navy text-white"><?php echo $total_estacionados_agora; ?></h6></div>
                            </div>
                            <h6 class="pt-badge bg-navy small">Go Garage</h6>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-12">
                    <div class="card proj-t-card">
                        <div class="card-body text-blue">
                            <div class="row align-items-center mb-30">
                                <div class="col-auto">
                                    <i class="fas fa-hand-holding-usd text-blue f-40"></i>
                                </div>
                                <div class="col pl-0">
                                    <h6 class="mb-5">Mensais</h6>
                                    <h6 class="mb-5 font-weight-bold"><?php echo 'RS&nbsp;'.$total_mensalidades->total_mensalidades ?></h6>
                                </div>
                            </div>
                            <div class="row align-items-center text-center">
                                <div class="col">
                                    <span>Pagas</span>
                                    <h6 class="mb-0 badge badge-pill badge-blue text-white"><?php echo $total_mensalidades_pagas ?></h6></div>
                                <div class="col"><i class="fas fa-exchange-alt text-blue f-18"></i></div>
                                <div class="col">
                                    <span>Abertas</span>
                                    <h6 class="mb-0 badge badge-pill badge-blue text-white"><?php echo $total_mensalidades_abertas ?></h6></div>
                            </div>
                            <h6 class="pt-badge bg-blue small">Go Garage</h6>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-12">
                    <div class="card proj-t-card">
                        <div class="card-body text-yellow">
                            <div class="row align-items-center mb-30">
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-alt text-yellow f-40"></i>
                                </div>
                                <div class="col pl-0">
                                    <h6 class="mb-5">Avulsos</h6>
                                    <h6 class="mb-5 font-weight-bold"><?php echo 'RS&nbsp;'.$total_avulsos->total_avulsos ?></h6>
                                </div>
                            </div>
                            <div class="row align-items-center text-center">
                                <div class="col">
                                    <span>Pagas</span>
                                    <h6 class="mb-0 badge badge-pill badge-yellow text-dark"><?php echo $total_avulsos_pagos ?></h6></div>
                                <div class="col"><i class="fas fa-exchange-alt text-yellow f-18"></i></div>
                                <div class="col">
                                    <span>Abertas</span>
                                    <h6 class="mb-0 badge badge-pill badge-yellow text-dark"><?php echo $total_avulsos_abertos ?></h6></div>
                            </div>
                            <h6 class="pt-badge bg-yellow small text-dark">Go Garage</h6>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-12">
                    <div class="card proj-t-card">
                        <div class="card-body text-success">
                            <div class="row align-items-center mb-30">
                                <div class="col-auto">
                                    <i class="fas fa-users text-success f-30"></i>
                                </div>
                                <div class="col pl-0">
                                    <h6 class="mb-5">Mensalistas</h6>
                                    <h6 class="mb-5 font-weight-bold"><?php echo $total_mensalistas ?></h6>
                                </div>
                            </div>
                            <div class="row align-items-center text-center">
                                <div class="col">
                                    <span>Ativos</span>
                                    <h6 class="mb-0 badge badge-pill badge-success text-white"><?php echo $total_mensalistas_ativos ?></h6></div>
                                <div class="col"><i class="fas fa-exchange-alt text-success f-18"></i></div>
                                <div class="col">
                                    <span>Inativos</span>
                                    <h6 class="mb-0 badge badge-pill badge-success text-white"><?php echo $total_mensalistas_inativos ?></h6></div>
                            </div>
                            <h6 class="pt-badge bg-success small">Go Garage</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-block text-center">SITUAÇÃO VAGAS</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-6">
                                    <p class="text-center text-uppercase small">Veículo Pequeno <?php echo ($numero_vagas_pequeno->precificacao_ativa == 0 ? '<span class="text-danger font-weight-bold"> <i class="fas fa-ban"></i> Desativada</span>' : ''); ?></p>  
                                    <div class="widget social-widget">
                                        <div class="widget-body text-center">
                                            <div class="content">
                                                <i class="fas fa-car fa-3x text-primary"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="list-inline mt-15 text-center">
                                                <?php
                                                $ocupadas = array(); // Armazena as vagas
                                                $placas = array(); // Armazena as placas

                                                foreach ($vagas_ocupadas_pequeno as $vaga) {
                                                    $ocupadas[] = $vaga->estacionar_numero_vaga;
                                                    $placas[$vaga->estacionar_numero_vaga] = $vaga->estacionar_placa_veiculo;
                                                }
                                                ?>
                                                <?php for ($i = 1; $i <= $numero_vagas_pequeno->vagas; $i++): ?>
                                                    <li class="list-inline-item">
                                                        <?php if (in_array($i, $ocupadas)): ?>
                                                            <div class="widget social-widget bg-warning vaga">
                                                                <div class="widget-body">
                                                                    <div data-toggle="tooltip" data-placement="bottom" title="Placa: <?php echo $placas[$i] ?>" class="content">
                                                                        <i class="fas fa-car fa-lg"></i>
                                                                    </div>
                                                                </div>                                                        
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="widget social-widget <?php echo ($numero_vagas_pequeno->precificacao_ativa == 0 ? 'bg-google' : 'bg-success'); ?> vaga">
                                                                <div class="widget-body">
                                                                    <div data-toggle="tooltip" data-placement="bottom" title="<?php echo ($numero_vagas_pequeno->precificacao_ativa == 0 ? 'Desativada' : 'Livre'); ?>" class="content">
                                                                        <div class="number">
                                                                            <?php echo ($numero_vagas_pequeno->precificacao_ativa == 0 ? '<i class="fas fa-ban"></i>' : $i); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                            </div>   
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endfor; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-6">
                                    <p class="text-center text-uppercase small small">Veículo Médio <?php echo ($numero_vagas_medio->precificacao_ativa == 0 ? '<span class="text-danger font-weight-bold"> <i class="fas fa-ban"></i> Desativada</span>' : ''); ?></p>

                                    <div class="widget social-widget">
                                        <div class="widget-body text-center">
                                            <div class="content">
                                                <i class="fas fa-truck-monster fa-3x text-primary"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="list-inline mt-15 text-center">
                                                <?php
                                                $ocupadas = array(); // Armazena as vagas
                                                $placas = array(); // Armazena as placas

                                                foreach ($vagas_ocupadas_medio as $vaga) {
                                                    $ocupadas[] = $vaga->estacionar_numero_vaga;
                                                    $placas[$vaga->estacionar_numero_vaga] = $vaga->estacionar_placa_veiculo;
                                                }
                                                ?>

                                                <?php for ($i = 1; $i <= $numero_vagas_medio->vagas; $i++): ?>
                                                    <li class="list-inline-item">
                                                        <?php if (in_array($i, $ocupadas)): ?>
                                                            <div class="widget social-widget bg-warning vaga">
                                                                <div class="widget-body">
                                                                    <div data-toggle="tooltip" data-placement="bottom" title="Placa: <?php echo $placas[$i] ?>" class="content">
                                                                        <i class="fas fa-truck-monster fa-lg"></i>
                                                                    </div>
                                                                </div>                                                        
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="widget social-widget <?php echo ($numero_vagas_medio->precificacao_ativa == 0 ? 'bg-google' : 'bg-success'); ?> vaga">
                                                                <div class="widget-body">
                                                                    <div data-toggle="tooltip" data-placement="bottom" title="<?php echo ($numero_vagas_medio->precificacao_ativa == 0 ? 'Desativada' : 'Livre'); ?>" class="content">
                                                                        <div class="number">
                                                                            <?php echo ($numero_vagas_medio->precificacao_ativa == 0 ? '<i class="fas fa-ban"></i>' : $i); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                            </div>   
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endfor; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-6">
                                    <p class="text-center text-uppercase small">Veículo Grande <?php echo ($numero_vagas_grande->precificacao_ativa == 0 ? '<span class="text-danger font-weight-bold"> <i class="fas fa-ban"></i> Desativada</span>' : ''); ?></p>

                                    <div class="widget social-widget">
                                        <div class="widget-body text-center">
                                            <div class="content">
                                                <i class="fas fa-truck fa-3x text-primary"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="list-inline mt-15 text-center">
                                                <?php
                                                $ocupadas = array(); // Armazena as vagas
                                                $placas = array(); // Armazena as placas

                                                foreach ($vagas_ocupadas_grande as $vaga) {
                                                    $ocupadas[] = $vaga->estacionar_numero_vaga;
                                                    $placas[$vaga->estacionar_numero_vaga] = $vaga->estacionar_placa_veiculo;
                                                }
                                                ?>
                                                <?php for ($i = 1; $i <= $numero_vagas_grande->vagas; $i++): ?>
                                                    <li class="list-inline-item">
                                                        <?php if (in_array($i, $ocupadas)): ?>
                                                            <div class="widget social-widget bg-warning vaga">
                                                                <div class="widget-body">
                                                                    <div data-toggle="tooltip" data-placement="bottom" title="Placa: <?php echo $placas[$i] ?>" class="content">
                                                                        <div data-toggle="tooltip" data-placement="bottom" title="Placa: <?php echo $placas[$i] ?>" class="content">
                                                                            <i class="fas fa-truck fa-lg"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="widget social-widget <?php echo ($numero_vagas_grande->precificacao_ativa == 0 ? 'bg-google' : 'bg-success'); ?> vaga">
                                                                <div class="widget-body">
                                                                    <div data-toggle="tooltip" data-placement="bottom" title="<?php echo ($numero_vagas_grande->precificacao_ativa == 0 ? 'Desativada' : 'Livre'); ?>" class="content">
                                                                        <div class="number">
                                                                            <?php echo ($numero_vagas_grande->precificacao_ativa == 0 ? '<i class="fas fa-ban"></i>' : $i); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                            </div>   
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endfor; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <p class="text-center text-uppercase small">Veículo Moto <?php echo ($numero_vagas_moto->precificacao_ativa == 0 ? '<span class="text-danger font-weight-bold"> <i class="fas fa-ban"></i> Desativada</span>' : ''); ?></p>

                                    <div class="widget social-widget">
                                        <div class="widget-body text-center">
                                            <div class="content">
                                                <i class="fas fa-motorcycle fa-3x text-primary"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="list-inline mt-15 text-center">

                                                <?php
                                                $ocupadas = array(); // Armazena as vagas
                                                $placas = array(); // Armazena as placas

                                                foreach ($vagas_ocupadas_moto as $vaga) {
                                                    $ocupadas[] = $vaga->estacionar_numero_vaga;
                                                    $placas[$vaga->estacionar_numero_vaga] = $vaga->estacionar_placa_veiculo;
                                                }
                                                ?>

                                                <?php for ($i = 1; $i <= $numero_vagas_moto->vagas; $i++): ?>
                                                    <li class="list-inline-item">
                                                        <?php if (in_array($i, $ocupadas)): ?>
                                                            <div class="widget social-widget bg-warning vaga">
                                                                <div class="widget-body">
                                                                    <div data-toggle="tooltip" data-placement="bottom" title="Placa: <?php echo $placas[$i] ?>" class="content">
                                                                        <div data-toggle="tooltip" data-placement="bottom" title="Placa: <?php echo $placas[$i] ?>" class="content">
                                                                            <i class="fas fa-motorcycle fa-lg"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="widget social-widget <?php echo ($numero_vagas_moto->precificacao_ativa == 0 ? 'bg-google' : 'bg-success'); ?> vaga">
                                                                <div class="widget-body">
                                                                    <div data-toggle="tooltip" data-placement="bottom" title="<?php echo ($numero_vagas_moto->precificacao_ativa == 0 ? 'Desativada' : 'Livre'); ?>" class="content">
                                                                        <div class="number">
                                                                            <?php echo ($numero_vagas_moto->precificacao_ativa == 0 ? '<i class="fas fa-ban"></i>' : $i); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                            </div>   
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endfor; ?>
                                            </ul>
                                        </div>
                                    </div>
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

