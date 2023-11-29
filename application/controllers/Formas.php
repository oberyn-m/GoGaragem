<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Formas extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }
    }

    public function index() {

        $data = array(
            'titulo' => 'Formas de pagamento cadastradas',
            'sub_titulo' => 'Chegou a hora de lista as formas de pagamento cadastradas no banco de dados',
            'icone_view' => 'fas fa-comment-dollar',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/estacionamento.js',
            ),
            'formas' => $this->core_model->get_all('formas_pagamentos'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('formas/index', $data);
        $this->load->view('layout/footer', $data);
    }

    public function core($forma_pagamento_id = NULL) {
        
        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Você não tem permissão para Editar ou Cadastrar Formas de Pagamento');
            redirect($this->router->fetch_class());
        }

        if (!$forma_pagamento_id) {
            //Cadastrando
            $this->form_validation->set_rules('forma_pagamento_nome', 'Nome da Forma de Pagamento', 'trim|required|min_length[3]|max_length[30]|is_unique[formas_pagamentos.forma_pagamento_nome]');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
                            'forma_pagamento_nome',
                            'forma_pagamento_ativa',
                        ), $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->insert('formas_pagamentos', $data);
                redirect($this->router->fetch_class());
            } else {
                //Erro de validação
                $data = array(
                    'titulo' => 'Criar forma de pagamento ',
                    'sub_titulo' => 'Chegou a hora de lista a forma de pagamento cadastradas no banco de dados',
                    'icone_view' => 'fas fa-comment-dollar',
                );

                $this->load->view('layout/header', $data);
                $this->load->view('formas/core', $data);
                $this->load->view('layout/footer', $data);
            }
        } else {
            if (!$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))) {
                $this->session->set_flashdata('error', 'Forma de pagamento não encontrada');
                redirect($this->router->fetch_class());
            } else {
                //Editando
                $this->form_validation->set_rules('forma_pagamento_nome', 'Nome da Forma de Pagamento', 'trim|required|min_length[3]|max_length[30]|callback_check_pagamento_nome');

                if ($this->form_validation->run()) {

                    $data = elements(
                            array(
                                'forma_pagamento_nome',
                                'forma_pagamento_ativa',
                            ), $this->input->post()
                    );

                    $data = html_escape($data);

                    $this->core_model->update('formas_pagamentos', $data, array('forma_pagamento_id' => $forma_pagamento_id));
                    redirect($this->router->fetch_class());
                } else {
                    //Erro de validação
                    $data = array(
                        'titulo' => 'Editar forma de pagamento ',
                        'sub_titulo' => 'Chegou a hora de lista a forma de pagamento cadastradas no banco de dados',
                        'icone_view' => 'fas fa-comment-dollar',
                        'forma' => $this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id)),
                    );

                    $this->load->view('layout/header', $data);
                    $this->load->view('formas/core', $data);
                    $this->load->view('layout/footer', $data);
                }
            }
        }
    }

    public function check_pagamento_nome($forma_pagamento_nome) {
        $forma_pagamento_id = $this->input->post('forma_pagamento_id');

        if ($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_nome' => $forma_pagamento_nome, 'forma_pagamento_id !=' => $forma_pagamento_id))) {
            $this->form_validation->set_message('check_pagamento_nome', 'Forma de pagamento já existe');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function del($forma_pagamento_id = NULL) {
        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Você não tem permissão para excluir Formas de Pagamento');
            redirect($this->router->fetch_class());
        }
        
        if (!$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))) {
            $this->session->set_flashdata('error', 'Forma de pagamento não encontrada');
            redirect($this->router->fetch_class());
        } else {
            //exit("Excluído");
            $this->core_model->delete('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id));
            redirect($this->router->fetch_class());
        }
    }
}
