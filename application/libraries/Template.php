<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Template
 *
 * @author gerard
 */
class Template {

    var $ci;

    function __construct() {
        $this->ci = & get_instance();
    }

    function load($tpl_view, $body_view = null, $data = null) {
        if (!is_null($body_view)) {
            if (file_exists(APPPATH . 'views/' . $tpl_view . '/' . $body_view)) {
                $body_view_path = $tpl_view . '/' . $body_view;
                echo "<br>1" . $body_view_path;
            } else if (file_exists(APPPATH . 'views/' . $tpl_view . '/' . $body_view . '.php')) {
                $body_view_path = $tpl_view . '/' . $body_view . '.php';
                echo "<br>2" . $body_view_path;
            } else if (file_exists(APPPATH . 'views/' . $body_view)) {
                $body_view_path = $body_view;
                echo "<br>3" . $body_view_path;
            } else if (file_exists(APPPATH . 'views/' . $body_view . '.php')) {
                $body_view_path = $body_view . '.php';
                echo "<br>4" . $body_view_path;
            } else {
                show_error('Unable to load the requested file: ' . $tpl_name . '/' . $view_name . '.php');
            }

            $body = $this->ci->load->view($body_view_path, $data, TRUE);

            if (is_null($data)) {
                $data = array('body' => $body);
            } else if (is_array($data)) {
                $data['body'] = $body;
            } else if (is_object($data)) {
                $data->body = $body;
            }
        }

        $this->ci->load->view('templates/' . $tpl_view, $data);
    }

}
