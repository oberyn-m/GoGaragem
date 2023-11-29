<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Estacionar extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->ion_auth->logged_in()) {
            redirect('login');
        }

        $this->load->model('estacionar_model');
    }

    public function index() {

        $data = array(
            'titulo' => 'Tickets de estacionamento cadastrado',
            'sub_titulo' => 'Chegou a hora de listar os tickets de estacionamneto',
            'icone_view' => 'fas fa-warehouse',
            'styles' => array(
                'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
                'dist/css/estacionar.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/estacionamento.js',
            ),
            'estacionados' => $this->estacionar_model->get_all(),
            'numero_vagas_pequeno' => $this->estacionar_model->get_numero_vagas(1), // 1 - VEÍCULO PEQUENO
            'vagas_ocupadas_pequeno' => $this->core_model->get_all('estacionar', array('estacionar_status' => 0, 'estacionar_precificacao_id'=>1)),
            
            'numero_vagas_medio' => $this->estacionar_model->get_numero_vagas(2), // 2 - VEÍCULO MÉDIO
            'vagas_ocupadas_medio' => $this->core_model->get_all('estacionar', array('estacionar_status' => 0, 'estacionar_precificacao_id'=>2)),
            
            'numero_vagas_grande' => $this->estacionar_model->get_numero_vagas(3), // 3 - VEÍCULO GRANDE
            'vagas_ocupadas_grande' => $this->core_model->get_all('estacionar', array('estacionar_status' => 0, 'estacionar_precificacao_id'=>3)),
            
            'numero_vagas_moto' => $this->estacionar_model->get_numero_vagas(4), // 4 - VEÍCULO MOTO
            'vagas_ocupadas_moto' => $this->core_model->get_all('estacionar', array('estacionar_status' => 0, 'estacionar_precificacao_id'=>4)),
            
        );
        
        //echo '<pre>';
        //print_r($data['estacionados']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('estacionar/index');
        $this->load->view('layout/footer');
    }

    public function core($estacionar_id = NULL) {
        if (!$estacionar_id) {
            //Cadastrando

            $this->form_validation->set_rules('estacionar_precificacao_id', 'Categoria', 'required');
            $this->form_validation->set_rules('estacionar_numero_vaga', 'Número da Vaga', 'required|integer|greater_than[0]|callback_check_vaga_ocupada|callback_check_range_vagas_categoria');
            $this->form_validation->set_rules('estacionar_placa_veiculo', 'Placa Veículo', 'required|exact_length[8]|callback_check_placa_status_aberta');
            $this->form_validation->set_rules('estacionar_marca_veiculo', 'Marca Veículo', 'required|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('estacionar_modelo_veiculo', 'Modelo Veículo', 'required|min_length[2]|max_length[20]');

            if ($this->form_validation->run()) {

                //echo '<pre>';
                //print_r($this->input->post());
                //exit();

                $data = elements(
                        array(
                            'estacionar_valor_hora',
                            'estacionar_numero_vaga',
                            'estacionar_placa_veiculo',
                            'estacionar_marca_veiculo',
                            'estacionar_modelo_veiculo',
                        ), $this->input->post()
                );

                $data['estacionar_precificacao_id'] = intval(substr($this->input->post('estacionar_precificacao_id'), 0, 1));
                $data['estacionar_status'] = 0; //Ao cadastrar ticket, o valor de estacionar_status fica como '0'

                $data = html_escape($data);

                $this->core_model->insert('estacionar', $data, TRUE);

                $estacionar_id = $this->session->userdata('last_id');

                redirect($this->router->fetch_class() . '/acoes/' . $estacionar_id);

                //Criar método imprimir
            } else {
                $data = array(
                    'titulo' => 'Cadastrar ticket',
                    'sub_titulo' => 'Chegou a hora de cadastrar novo ticket de estacionamento',
                    'texto_modal' => 'Tem certeza que deseja salvar este Ticket? Não será possível alterá-lo',
                    'icone_view' => 'fas fa-warehouse',
                    'script' => array(
                        'plugins/mask/jquery.mask.min.js',
                        'plugins/mask/custom.js',
                        'js/estacionar/estacionar.js',
                    ),
                    'precificacoes' => $this->core_model->get_all('precificacoes', array('precificacao_ativa' => 1)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('estacionar/core');
                $this->load->view('layout/footer');
            }
        } else {
            if (!$this->core_model->get_by_id('estacionar', array('estacionar_id' => $estacionar_id))) {
                $this->session->set_flashdata('error', 'Ticket não encontrado para encerramento');
                redirect($this->router->fetch_class());
            } else {
                //Encerramento o ticket
                $estacionar_tempo_decorrido = str_replace('.', '', $this->input->post('estacionar_tempo_decorrido'));

                //Torna a forma de pagamento obrigatório se o tempo decorrido for maior que 15 minutos
                if ($estacionar_tempo_decorrido > '015') {
                    $this->form_validation->set_rules('estacionar_forma_pagamento_id', 'Forma de pagamento', 'required');
                }else{
                    $this->form_validation->set_rules('estacionar_forma_pagamento_id', 'Forma de pagamento', 'trim');
                }

                if ($this->form_validation->run()) {

                    $data = elements(
                            array(
                                'estacionar_valor_devido',
                                'estacionar_forma_pagamento_id',
                                'estacionar_tempo_decorrido',
                            ), $this->input->post()
                    );

                    if ($estacionar_tempo_decorrido <= '015') {
                        $data['estacionar_forma_pagamento_id'] = 6; //Forma de pagamento grátis
                    }

                    $data['estacionar_data_saida'] = date('Y-m-d H:i:s');
                    $data['estacionar_status'] = 1; //Encerrando ticket de estacionamento

                    $data = html_escape($data);

                    $this->core_model->update('estacionar', $data, array('estacionar_id' => $estacionar_id));

                    redirect($this->router->fetch_class() . '/acoes/' . $estacionar_id);
                } else {
                    $data = array(
                        'titulo' => 'Encerrando ticket',
                        'sub_titulo' => 'Chegou a hora de encerrar o ticket de estacionamento',
                        'texto_modal' => 'Tem certeza que deseja encerrar este Ticket?',
                        'icone_view' => 'fas fa-warehouse',
                        'script' => array(
                            'plugins/mask/jquery.mask.min.js',
                            'plugins/mask/custom.js',
                            'js/estacionar/estacionar.js',
                        ),
                        'estacionado' => $this->core_model->get_by_id('estacionar', array('estacionar_id' => $estacionar_id)),
                        'precificacoes' => $this->core_model->get_all('precificacoes', array('precificacao_ativa' => 1)),
                        'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                    );
                    
                    //echo '<pre>';
                    //print_r('estacionado');
                    //exit();
                    
                    //$data = html_escape($data);

                    //$this->core_model->update('estacionar', $data, array('estacionar_id' => $estacionar_id));

                    //redirect($this->router->fetch_class() . '/acoes/' . $estacionar_id);

                    $this->load->view('layout/header', $data);
                    $this->load->view('estacionar/core');
                    $this->load->view('layout/footer');
                }
            }
        }
    }

    public function check_range_vagas_categoria($numero_vaga) {

        $precificacao_id = intval(substr($this->input->post('estacionar_precificacao_id'), 0, 1));

        if ($precificacao_id) {

            $precificacao = $this->core_model->get_by_id('precificacoes', array('precificacao_id' => $precificacao_id));

            if ($precificacao->precificacao_numero_vagas < $numero_vaga) {

                $this->form_validation->set_message('check_range_vagas_categoria', 'O número da vaga deve estar entre 1 e ' . $precificacao->precificacao_numero_vagas);

                return FALSE;
            } else {

                return TRUE;
            }
        } else {
            $this->form_validation->set_message('check_range_vagas_categoria', 'Escolha uma categoria');
            return FALSE;
        }
    }

    public function check_vaga_ocupada($estacionar_numero_vaga) {

        $estacionar_precificacao_id = intval(substr($this->input->post('estacionar_precificacao_id'), 0, 1));

        if ($this->core_model->get_by_id('estacionar', array('estacionar_numero_vaga' => $estacionar_numero_vaga, 'estacionar_status' => 0, 'estacionar_precificacao_id' => $estacionar_precificacao_id))) {

            $this->form_validation->set_message('check_vaga_ocupada', 'Essa vaga já está ocupada para essa categoria');

            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function check_placa_status_aberta($estacionar_placa_veiculo) {

        $estacionar_placa_veiculo = strtoupper($estacionar_placa_veiculo);

        if ($this->core_model->get_by_id('estacionar', array('estacionar_placa_veiculo' => $estacionar_placa_veiculo, 'estacionar_status' => 0))) {

            $this->form_validation->set_message('check_placa_status_aberta', 'Existe um ticket aberto para essa placa');

            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function acoes($estacionar_id = NULL) {
        if (!$this->core_model->get_by_id('estacionar', array('estacionar_id' => $estacionar_id))) {
            $this->session->set_flashdata('error', 'Ticket não encontrado');
            redirect($this->router->fetch_class());
        } else {
            $data = array(
                'titulo' => 'O que você gostaria de fazer?',
                'sub_titulo' => 'Por favor escolha uma das opções a seguir',
                'icone_view' => 'fas fa-question',
                'estacionado' => $this->core_model->get_by_id('estacionar', array('estacionar_id' => $estacionar_id)),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('estacionar/acoes');
            $this->load->view('layout/footer');
        }
    }

    public function pdf($estacionar_id = NULL) {
        if (!$estacionar_id || !$this->core_model->get_by_id('estacionar', array('estacionar_id' => $estacionar_id))) {
            $this->session->set_flashdata('error', 'Ticket não encontrado para impressão');
            redirect($this->router->fetch_class());
        } else {
            $this->load->library('pdf');

            $this->load->model('estacionar_model');

            $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

            $ticket = $this->estacionar_model->get_by_id($estacionar_id);

            $file_name = 'Ticket - Placa_' . $ticket->estacionar_placa_veiculo;

            $dados_saida = '';

            if ($ticket->estacionar_status == 1) {
                $dados_saida .= '<strong>Data saída: </strong>' . formata_data_banco_com_hora($ticket->estacionar_data_saida) . '<br/>'
                        . '<strong>Tempo Decorrido (hh:mm): </strong>' . $ticket->estacionar_tempo_decorrido . '<br/>'
                        . '<strong>Valor pago: R$</strong>' . $ticket->estacionar_valor_devido . '<br/>'
                        . '<strong>Forma de Pagamento: </strong>' . $ticket->forma_pagamento_nome . '<br/>';
            }

            $html = '
                <html style="font-size:11px">
                    <head>
                        <title> ' . $empresa->sistema_razao_social . '</title>
                    </head>
                    <body>
                        <h5 align="center" style="font-size:14px">
                        ' . $empresa->sistema_nome_fantasia . ' <br/>
                        CNPJ: ' . $empresa->sistema_cnpj . '<br/>
                        ' . $empresa->sistema_endereco . ' - ' . $empresa->sistema_numero . '<br/>
                        ' . $empresa->sistema_cep . '<br/>
                        ' . $empresa->sistema_cidade . '<br/>
                        ' . $empresa->sistema_telefone_fixo . ' - ' . $empresa->sistema_telefone_movel . '<br/>
                        ' . $empresa->sistema_email . '<br/>  
                        </h5>
                        <hr>
                        
                        <p align="right">Ticket Nº: ' . $ticket->estacionar_id . '
                        </p>    
                        
                        <strong>Placa Veicúlo: </strong>' . $ticket->estacionar_placa_veiculo . '<br/>
                        <strong>Marca Veicúlo: </strong>' . $ticket->estacionar_marca_veiculo . '<br/>
                        <strong>Modelo Veicúlo: </strong>' . $ticket->estacionar_modelo_veiculo . '<br/>
                        <strong>Categoria Veicúlo: </strong>' . $ticket->precificacao_categoria . '<br/>
                        <strong>Número da Vaga: </strong>' . $ticket->estacionar_numero_vaga . '<br/>
                        <strong>Data entrada: </strong>' . formata_data_banco_com_hora($ticket->estacionar_data_entrada) . '<br/> 
                        ' . $dados_saida . '
                        <br/>
                        <hr>
                        <h5 align="center" style="font-size:14px">
                        ' . $empresa->sistema_nome_fantasia . '<br/> ' . $empresa->sistema_texto_ticket . '
                        </h5> <br/>
                    </body>
                </html>
            ';

            /*
              False - Abre no navegador
              True - Faz o download
             */

            $this->pdf->createPDF($html, $file_name, false);
        }
    }

    public function del($estacionar_id = NULL) {
        if (!$estacionar_id || !$this->core_model->get_by_id('estacionar', array('estacionar_id' => $estacionar_id))) {
            $this->session->set_flashdata('error', 'Ticket não encontrado para exclusão');
            redirect($this->router->fetch_class());
        }

        if ($this->core_model->get_by_id('estacionar', array('estacionar_id' => $estacionar_id, 'estacionar_status' => 0))) {
            $this->session->set_flashdata('error', 'Esse Ticket não pode ser excluído, pois ainda está em aberto');
            redirect($this->router->fetch_class());
        }

        $this->core_model->delete('estacionar', array('estacionar_id' => $estacionar_id));
        redirect($this->router->fetch_class());
    }
}
