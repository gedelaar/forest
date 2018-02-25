<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller {

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
    public $schoolobj;
    public $data;

    public function __construct() {
        parent::__construct();
        $this->title = 'School';
        $this->schoolobj = new School_model();
        $this->data['schoolobj'] = $this->schoolobj;
        $sv_school_arr = $this->session->get_userdata('sv_school_id');
        if (isset($sv_school_arr['sv_school_id'])) {
            $this->schoolobj->set_school_id($this->session->get_userdata('sv_school_id'));
        }
        $this->data['page_title'] = $this->title;
        $this->form_validation->set_error_delimiters('<div class = "error"><p>', '</p></div>');
    }

    public function index() {
        $this->add_school();
    }

    public function add_school() {
        if ($this->form_validation->run() == FALSE) {
            $template = $this->make_screen_school($this->data, 'school/add_school');
            $this->template->load('default', null, $template);
        } else {
            if ($this->schoolobj->insert_entry()) {
                $this->session->set_flashdata('true', 'schoolgegevens geupdate');
                $this->session->set_userdata('sv_school_id', $this->schoolobj->get_school_id());
                $this->show_school();
            } else {
                $this->session->set_flashdata('err', "schoolgegevens komen al voor");
                $template = $this->make_screen_school($this->data, 'school/add_school');
                $this->template->load('default', null, $template);
            }
        }
    }

    private function upd_school() {
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('err', "schoolgegevens niet geupdate");
            $this->show_school();
        } else {
            $this->schoolobj->update_entry();
            $this->session->set_flashdata('true', 'schoolgegevens geupdate');
            $this->show_school();
        }
        return(TRUE);
    }

    private function del_school() {
        $this->schoolobj->delete_entry();
        $this->session->set_userdata('sv_school_id', "");
        $this->session->set_flashdata('true', "schoolgegevens verwijderd");
        $this->add_school();
        return;
    }

    private function make_screen_school($data, $content_page) {
        $template['page_header'] = $this->load->view('header', $data, TRUE);
        $template['page_menu'] = $this->load->view('menu', '', TRUE);
        $template['page_content'] = $this->load->view($content_page, $data, TRUE);
        $template['page_footer'] = $this->load->view('footer', '', TRUE);
        return($template);
    }

    public function sel_school() {
        $this->data = $this->sel_school_dd($this->data);
        $template = $this->make_screen_school($this->data, 'school/sel_school');
        $this->template->load('default', null, $template);
    }

    public function sel_school_dd($data) {
        $this->data['scholen'] = $this->schoolobj->select_entries();
        $this->data['dd_content'] = $this->load->view('school/dd_school', $this->data, TRUE);
        return($this->data);
    }

    private function show_school() {
        $this->schoolobj->select_entry();
        $template = $this->make_screen_school($this->data, 'school/show_school');
        $this->template->load('default', null, $template);
    }

    public function handle_form() {
        $this->schoolobj->set_school_naam($this->input->post('schoolnaam'));
        $this->schoolobj->set_school_jaar($this->input->post('schooljaar'));
        $this->schoolobj->set_school_id($this->input->post('school_id'));

        $this->session->set_userdata('sv_school_id', $this->schoolobj->get_school_id());
        switch ($this->input->post('submit')) {
            case 'Update':
                $this->valid_form();
                $this->upd_school();
                break;
            case 'Delete':
                $this->del_school();
                break;
            case 'Toevoegen':
                $this->valid_form();
                $this->add_school();
                break;
            case 'Selecteren':
                $this->show_school();
                break;
        }
        return;
    }

    private function valid_form() {
        $this->form_validation->set_rules('schooljaar', 'jaar', 'required|numeric|min_length[4]|max_length[4]');
        $this->form_validation->set_rules('schoolnaam', 'naam van de school', 'required|alpha_numeric|max_length[45]|min_length[4]');
        return;
    }

}
