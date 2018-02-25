<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Foto extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->title = 'Foto maken';
        $this->sv_leerling_id = $this->session->userdata('sv_leerling_id');
        $this->sv_klas_id = $this->session->userdata('sv_klas_id');
        $this->sv_school_id = $this->session->userdata('sv_school_id');
        $this->form_validation->set_error_delimiters('<div class = "error"><p>', '</p></div>');

        $this->leerlingobj = new Leerling_model();
        $this->data['leerlingobj'] = $this->leerlingobj;
        $this->klasobj = new Klas_model();
        $this->data['klasobj'] = $this->klasobj;
        $this->schoolobj = new School_model();
        $this->data['schoolobj'] = $this->schoolobj;
        $this->leerlingobj->set_klas_id($this->session->userdata('sv_leerling_id'));
        $this->klasobj->set_klas_id($this->session->userdata('sv_klas_id'));
        $this->set_klasobj();
        $this->schoolobj->set_school_id($this->session->userdata('sv_school_id'));
        $this->set_schoolobj();
        $this->data['page_title'] = $this->title;
        $this->form_validation->set_error_delimiters('<div class = "error"><p>', '</p></div>');
    }

    public function index() {
        $this->show_leerling_lijst();
    }

    public function testfoto() {
        $this->leerlingobj = new Leerling_model();
        $this->leerlingobj->set_klas_id(50);
        $lijst = $this->leerlingobj->select_entries();
        $this->_pr($lijst, __FUNCTION__);
        $this->_pr($this->leerlingobj, __FUNCTION__);
    }

    private function _pr($data, $functie) {
        echo "<pre>";
        echo "functie => <i>" . $functie . "</i><br>";
        print_r($data);
        echo "</pre>";
    }

    public function handle_form() {
        switch ($this->input->post('submit')) {
            case 'Foto selectie':
                $this->show_leerling_lijst();
                break;
        }
        return;
    }

    public function show_leerling_lijst() {
        $this->leerlingobj->set_klas_id(50);
        $this->leerlingobj->select_entries();
        $this->set_klasobj();
        $this->set_schoolobj();
        $template = $this->make_screen_ft_leerling($this->data, 'foto/show_ft_leerling');
        $this->template->load('default', null, $template);
    }

    private function make_screen_ft_leerling($data, $content_page) {
        $template['page_header'] = $this->load->view('header', $data, TRUE);
        $template['page_menu'] = $this->load->view('menu', '', TRUE);
        $template['page_content'] = $this->load->view($content_page, $data, TRUE);
        $template['page_footer'] = $this->load->view('footer', '', TRUE);
        return($template);
    }

    private function set_schoolobj() {
        $this->schoolobj->set_school_id($this->klasobj->get_school_id());
        $this->schoolobj->select_entry();
        return;
    }

    private function set_klasobj() {
        $this->klasobj->set_klas_id($this->klasobj->get_klas_id());
        $this->klasobj->select_entry();
        return;
    }

    private function valid_form() {
        $this->form_validation->set_rules('leerlingachternaam', 'achternaam van de leerling', 'required|alpha_numeric_spaces|max_length[45]|min_length[2]');
        $this->form_validation->set_rules('leerlingvoornaam', 'voornaam van de leerling', 'required|alpha_numeric_spaces|max_length[45]|min_length[2]');
        $this->form_validation->set_rules('leerlingtussenvoegsel', 'tussenvoegsel van de leerling', 'alpha_numeric_spaces|max_length[10]');
    }

}
