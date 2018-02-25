<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_school
 *
 * @author gerard
 */
class Klas_model extends CI_Model {

    //put your code here
    public $title;
    public $content;
    public $date;
    public $table;
    public $school_id;
    //public $school_naam;
    public $klas_id;
    public $klas_naam;

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        // Your own constructor code
        $this->table = 'klas';
    }

    public function get_school_id() {
        return $this->school_id;
    }

    public function set_school_id($newval) {
        $this->school_id = $newval;
    }

    public function get_klas_id() {
        return $this->klas_id;
    }

    public function set_klas_id($newval) {
        $this->klas_id = $newval;
    }

    public function get_klas_naam() {
        return $this->klas_naam;
    }

    public function set_klas_naam($newval) {
        $this->klas_naam = $newval;
    }

    public function get_schoolid_as_cond() {
        return $this->schoolid_as_cond;
    }

    public function set_schoolid_as_cond($newval) {
        $this->schoolid_as_cond = $newval;
    }

    public function insert_entry() {
        if (!$this->select_entry_id_by_naam()) {
            $data_i = ['klas_naam' => $this->get_klas_naam(),
                'school_id' => $this->get_school_id()
            ];
            $this->db->insert($this->table, $data_i);
            $this->select_entry_id_by_naam();
            return(TRUE);
        }
        return(FALSE);
    }

    public function update_entry() {
        $data_i = ['klas_naam' => $this->get_klas_naam()
        ];
        $this->db->where('klas_id', $this->get_klas_id());
        $this->db->update($this->table, $data_i);

        $this->select_entry_id_by_naam();
        return(TRUE);
    }

    public function delete_entry() {
        if ($this->get_klas_id() > 0) {
            $this->db->where('klas_id', $this->get_klas_id());
            $this->db->delete($this->table);
            $this->set_school_id(0);
            $this->set_klas_id(0);
            $this->set_klas_naam("");
            return(TRUE);
        }
        return(FALSE);
    }

    public function select_entries() {
        $condition = null;
        if (isset($this->schoolid_as_cond)) {
            $condition = 'school_id = ' . $this->get_schoolid_as_cond();
        }
        $dropdownItems = listData($this->table, 'klas_id', 'klas_naam', $condition);
        return $dropdownItems;
    }

    public function select_all_entries() {
        //$condition = "school_id =" . $id;
        $dropdownItems = listData($this->table, 'klas_id', 'klas_naam');
        return $dropdownItems;
    }

    public function select_entry() {
        if (isset($this->klas_id)) {
            $this->db->select('klas_naam as klasnaam, school_id as schoolid');
            $this->db->where('klas_id', $this->klas_id);
            $this->db->from($this->table);
            $query = $this->db->get();
            $row = $query->row();
            //echo "<pre>";
            //print_r($row);
            //echo "</pre>";
            if (isset($row)) {
                $this->set_klas_naam($row->klasnaam);
                $this->set_school_id($row->schoolid);
                return(TRUE);
            }
        }
        return (FALSE);
    }

    private function select_entry_id_by_naam() {
        $this->db->select('klas_id');
        $this->db->where('klas_naam', $this->get_klas_naam());
        $this->db->where('school_id', $this->get_school_id());
        $this->db->from($this->table);
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            $this->set_klas_id($row->klas_id);
            return (TRUE);
        }
        return (FALSE);
    }

}
