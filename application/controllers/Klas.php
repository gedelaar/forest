<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Klas extends CI_Controller {

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
    public $data;

    public function __construct() {
        parent::__construct();
        $this->title = 'Klas';
        $this->sv_klas_id = $this->session->userdata('sv_klas_id');
        $this->sv_school_id = $this->session->userdata('sv_school_id');
        $this->form_validation->set_error_delimiters('<div class = "error"><p>', '</p></div>');

        $this->klasobj = new Klas_model();
        $this->data['klasobj'] = $this->klasobj;
        $this->schoolobj = new School_model();
        $this->data['schoolobj'] = $this->schoolobj;
        $this->klasobj->set_klas_id($this->session->userdata('sv_klas_id'));
        $this->schoolobj->set_school_id($this->session->userdata('sv_school_id'));
        $this->data['page_title'] = $this->title;
        $this->form_validation->set_error_delimiters('<div class = "error"><p>', '</p></div>');
    }

    public function index() {
        $this->add_klas();
    }

    public function add_klas() {
        if ($this->form_validation->run() == FALSE) {
            $this->sel_school_dd();
            $template = $this->make_screen_klas($this->data, 'klas/add_klas');
            $this->template->load('default', null, $template);
        } else {
            if ($this->klasobj->insert_entry()) {
                $this->session->set_flashdata('true', 'klasgegevens geupdate');
                $this->session->set_userdata('sv_klas_id', $this->klasobj->get_klas_id());
                $this->show_klas();
            } else {
                $this->session->set_flashdata('err', "klasgegevens komen al voor");
                $template = $this->make_screen_klas($this->data, 'klas/add_klas');
                $this->template->load('default', null, $template);
            }
        }
    }

    private function make_screen_klas($data, $content_page) {
        $template['page_header'] = $this->load->view('header', $data, TRUE);
        $template['page_menu'] = $this->load->view('menu', '', TRUE);
        $template['page_content'] = $this->load->view($content_page, $data, TRUE);
        $template['page_footer'] = $this->load->view('footer', '', TRUE);
        return($template);
    }

    public function sel_klas() {
        $this->sel_school_dd();
        $this->sel_klas_dd();
        $template = $this->make_screen_klas($this->data, 'klas/sel_klas');
        $this->template->load('default', null, $template);
        return;
    }

    public function sel_klas_dd() {
        $this->klasobj->set_school_id($this->session->userdata('sv_school_id'));
        $this->klasobj->set_schoolid_as_cond($this->klasobj->school_id);
        $this->data['klassen'] = $this->klasobj->select_entries();
        $this->data['dd_klassen'] = $this->load->view('klas/dd_klas', $this->data, TRUE);
        return;
    }

    public function sel_school_dd() {
        $this->data['scholen'] = $this->School_model->select_entries();
        $this->data['dd_school'] = $this->load->view('school/dd_school', $this->data, TRUE);
        return;
    }

    public function show_klas() {
        $this->klasobj->select_entry();
        $this->set_schoolobj();
        $template = $this->make_screen_klas($this->data, 'klas/show_klas');
        $this->template->load('default', null, $template);
    }

    private function upd_klas() {
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('err', "klasgegevens niet geupdate");
            $this->show_klas();
        } else {
            $this->klasobj->update_entry();
            $this->session->set_flashdata('true', 'klasgegevens geupdate');
            $this->show_klas();
        }
        return(TRUE);
    }

    private function del_klas() {
        $this->klasobj->delete_entry();
        $this->session->set_userdata('sv_klas_id', "");
        $this->session->set_flashdata('true', "klasgegevens verwijderd");
        $this->add_klas();
        return;
    }

    public function get_klassen($school) {
        $this->klasobj->set_school_id($school);
        $this->klasobj->set_schoolid_as_cond($this->klasobj->school_id);
        $this->output->enable_profiler(false);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo(json_encode($this->klasobj->select_entries()));
        return;
    }

    public function handle_form() {
        $this->set_obj_from_input();
        $this->session->set_userdata('sv_klas_id', $this->klasobj->get_klas_id());
        $this->session->set_userdata('sv_school_id', $this->schoolobj->get_school_id());
        switch ($this->input->post('submit')) {
            case 'Update':
                $this->valid_form();
                $this->upd_klas();
                break;
            case 'Delete':
                $this->del_klas();
                break;
            case 'Toevoegen':
                $this->valid_form();
                $this->add_klas();
                break;
            case 'Selecteren':
                $this->show_klas();
                break;
        }
        return;
    }

    private function set_obj_from_input() {
        $this->klasobj->set_klas_naam($this->input->post('klasnaam', true));
        $this->klasobj->set_klas_id($this->input->post('klas_id', true));
        $this->klasobj->set_school_id($this->input->post('school_id', true));
        $this->set_schoolobj();
        return;
    }

    private function set_schoolobj() {
        $this->schoolobj->set_school_id($this->klasobj->get_school_id());
        $this->schoolobj->select_entry();
        return;
    }

    private function valid_form() {
        $this->form_validation->set_rules('klasnaam', 'naam van de klas', 'required|alpha_numeric_spaces|max_length[45]|min_length[4]');
    }

}
