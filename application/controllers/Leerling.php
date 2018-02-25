<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Leerling extends CI_Controller {

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
    public $title;
    public $klasobj;
    public $schoolobj;
    public $leerlingobj;
    public $data;

    public function __construct() {
        parent::__construct();
        $this->title = 'Leerling';
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
        $this->add_leerling();
    }

    public function add_leerling() {
        if ($this->form_validation->run() == FALSE) {
            $this->sel_klas_dd();
            $this->sel_school_dd();
            $template = $this->make_screen_leerling($this->data, 'leerling/add_leerling');
            $this->template->load('default', null, $template);
        } else {
            if ($this->leerlingobj->insert_entry()) {
                $this->session->set_flashdata('true', 'leerlinggegevens geupdate');
                $this->session->set_userdata('sv_leerling_id', $this->leerlingobj->get_leerling_id());
                $this->show_leerling();
            } else {
                $this->session->set_flashdata('err', "leerlinggegevens komen al voor");
                $template = $this->make_screen_leerling($this->data, 'leerling/add_leerling');
                $this->template->load('default', null, $template);
            }
        }
    }

    private function make_screen_leerling($data, $content_page) {
        $template['page_header'] = $this->load->view('header', $data, TRUE);
        $template['page_menu'] = $this->load->view('menu', '', TRUE);
        $template['page_content'] = $this->load->view($content_page, $data, TRUE);
        $template['page_footer'] = $this->load->view('footer', '', TRUE);
        return($template);
    }

    public function sel_leerling() {
        $this->sel_school_dd();
        $this->sel_klas_dd();
        if ($this->sel_leerling_dd()) {
            $template = $this->make_screen_leerling($this->data, 'leerling/sel_leerling');
            $this->template->load('default', null, $template);
        } else {
            $this->add_leerling();
        }
        return;
    }

    public function sel_leerling_dd() {
        $this->leerlingobj->set_klas_id($this->session->userdata('sv_klas_id'));
        $this->data['leerlingen'] = $this->leerlingobj->select_entries();
        if (isset($this->data['leerlingen'])) {
            $this->data['dd_leerlingen'] = $this->load->view('leerling/dd_leerling', $this->data, TRUE);
        } else {
            return false;
        }
        return true;
    }

    public function sel_klas_dd() {
        $this->klasobj->set_school_id($this->session->userdata('sv_school_id'));
        $this->klasobj->set_klas_id($this->session->userdata('sv_klas_id'));
        $this->klasobj->set_schoolid_as_cond($this->klasobj->school_id);
        $this->data['klassen'] = $this->klasobj->select_entries();
        $this->data['dd_klassen'] = $this->load->view('klas/dd_klas', $this->data, TRUE);
        return;
    }

    public function sel_school_dd() {
        $this->schoolobj->set_school_id($this->session->userdata('sv_school_id'));
        //$this->schoolobj->select_entry();
        //$this->data['scholen'] = $this->schoolobj->school_naam;
        $this->schoolobj->set_schoolid_as_cond($this->schoolobj->school_id);
        $this->data['scholen'] = $this->schoolobj->select_entries();
        $this->data['dd_school'] = $this->load->view('school/dd_school', $this->data, TRUE);
        return;
    }

    public function show_leerling() {
        $this->leerlingobj->select_entry();
        $this->set_klasobj();
        $this->set_schoolobj();
        $template = $this->make_screen_leerling($this->data, 'leerling/show_leerling');
        $this->template->load('default', null, $template);
    }

    private function upd_leerling() {
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('err', "leerlinggegevens niet geupdate");
            $this->show_leerling();
        } else {
            $this->leerlingobj->update_entry();
            $this->session->set_flashdata('true', 'leerlinggegevens geupdate');
            $this->show_leerling();
        }
        return(TRUE);
    }

    private function del_leerling() {
        $this->leerlingobj->delete_entry();
        $this->session->set_userdata('sv_leerlng_id', "");
        $this->session->set_flashdata('true', "leerlinggegevens verwijderd");
        $this->add_leerling();
        return;
    }

    public function get_leerlingen($klas) {
        $this->leerlingobj->set_klas_id($klas);
        $this->output->enable_profiler(false);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo(json_encode($this->leerlingobj->select_entries()));
        return;
    }

    public function handle_form() {
        $this->set_obj_from_input();
        $this->session->set_userdata('sv_leerling_id', $this->leerlingobj->get_leerling_id());
        $hlp_klas_id = $this->klasobj->get_klas_id();
        $this->session->set_userdata('sv_klas_id', $hlp_klas_id);
        $hlp_school_id = $this->klasobj->get_school_id();
        $this->session->set_userdata('sv_school_id', $hlp_school_id);
        switch ($this->input->post('submit')) {
            case 'Update':
                $this->valid_form();
                $this->upd_leerling();
                break;
            case 'Delete':
                $this->del_leerling();
                break;
            case 'Toevoegen':
                $this->valid_form();
                $this->add_leerling();
                break;
            case 'Selecteren':
                $this->show_leerling();
                break;
        }
        return;
    }

    private function set_obj_from_input() {
        $this->leerlingobj->set_leerling_id($this->input->post('leerling_id', true));
        $this->leerlingobj->set_leerling_voornaam($this->input->post('leerlingvoornaam', true));
        $this->leerlingobj->set_leerling_achternaam($this->input->post('leerlingachternaam', true));
        $this->leerlingobj->set_leerling_tussenvoegsel($this->input->post('leerlingtussenvoegsel', true));
        $this->klasobj->set_klas_naam($this->input->post('klasnaam', true));
        $this->klasobj->set_klas_id($this->input->post('klas_id', true));
        // $this->leerlingobj->set_klas_id($this->input->post('klas_id', true));
        $this->set_klasobj();
        $this->leerlingobj->set_klas_id($this->input->post('klas_id', true));
        $this->klasobj->set_school_id($this->input->post('school_id', true));
        $this->set_schoolobj();
        return;
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
