<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Beheer extends CI_Controller {

    function index() {
        echo "hello world";
    }

    //put your code here
    public function set_doctrine() {
        $this->load->library('doctrine');
        $this->doctrine->load('generate_classes');
    }

}
