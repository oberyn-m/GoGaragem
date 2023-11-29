

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
                                <li class="breadcrumb-item">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Listar <?php echo $this->router->fetch_class(); ?>" href="<?php echo base_url('/usuarios'); ?>">
                                        Listar &nbsp;<?php echo $this->router->fetch_class(); ?>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><?php echo $titulo; ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><?php echo(isset($usuario) ? '<i class="ik ik-calendar ik-2x"></i>&nbspData da última alteração:&nbsp' . formata_data_banco_com_hora($usuario->data_ultima_alteracao) : ''); ?></div>
                        <div class="card-body">
                            <form class="forms-sample" name="form_core" method="POST">
                                <div class="form-group row">
                                    <div class="col-md-6 mb-20">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name="first_name" value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('first_name')); ?>">
                                        <?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Sobrenome</label>
                                        <input type="text" class="form-control" name="last_name" value="<?php echo (isset($usuario) ? $usuario->last_name : set_value('last_name')); ?>">
                                        <?php echo form_error('last_name', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 mb-20">
                                        <label>Usuário</label>
                                        <input type="text" class="form-control" name="username" value="<?php echo (isset($usuario) ? $usuario->username : set_value('username')); ?>">
                                        <?php echo form_error('username', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>E-mail (Login)</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo (isset($usuario) ? $usuario->email : set_value('email')); ?>">
                                        <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 mb-20">
                                        <label>Senha</label>
                                        <input type="password" class="form-control" name="password" value="">
                                        <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Confirmar Senha</label>
                                        <input type="password" class="form-control" name="confirmacao">
                                        <?php echo form_error('confirmacao', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>

                                <?php if ($this->ion_auth->is_admin()): ?>
                                    <div class="form-group row">
                                        <div class="col-md-6 mb-20">
                                            <label>Perfil de acesso</label>
                                            <select class="form-control" name="perfil">
                                                <?php if (isset($usuario)): ?>
                                                    <option value="2" <?php echo ($perfil_usuario->id == 2 ? 'selected' : '') ?>>
                                                        Atendente
                                                    </option>
                                                    <option value="1" <?php echo ($perfil_usuario->id == 1 ? 'selected' : '') ?>>
                                                        Administrador
                                                    </option>
                                                <?php else: ?>
                                                    <option value="2">
                                                        Atendente
                                                    </option>
                                                    <option value="1">
                                                        Administrador
                                                    </option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <label>Ativo</label>
                                            <select class="form-control" name="active">

                                                <?php if (isset($usuario)): ?>

                                                    <option value="0" <?php echo ($usuario->active == 0 ? 'selected' : '') ?>>
                                                        Não
                                                    </option>
                                                    <option value="1" <?php echo ($usuario->active == 1 ? 'selected' : '') ?>>
                                                        Sim
                                                    </option>

                                                <?php else: ?>
                                                    <option value="0">Não</option>
                                                    <option value="1">Sim</option>

                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (isset($usuario)): ?>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control" name="usuario_id" value=" <?php echo $usuario->id; ?>"
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <button type="submit" class="btn btn-primary mr-2">Salvar</button>
                                <a class="btn btn-info" href="<?php echo base_url($this->router->fetch_class()); ?>">Voltar</a>
                            </form>
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

