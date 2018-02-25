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
class School_model extends CI_Model {

    //put your code here
    public $title;
    public $content;
    public $date;
    public $table;
    public $school_id;
    public $school_naam;
    public $school_jaar;
    public $datum_tijd;
    public $schoolid_as_cond;

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        // Your own constructor code
        $this->table = 'school';
    }

    public function get_school_id() {
        return $this->school_id;
    }

    public function set_school_id($newval) {
        $this->school_id = $newval;
    }

    public function get_school_naam() {
        return $this->school_naam;
    }

    public function set_school_naam($newval) {
        $this->school_naam = $newval;
    }

    public function get_school_jaar() {
        return $this->school_jaar;
    }

    public function set_school_jaar($newval) {
        $this->school_jaar = $newval;
    }

    public function get_datum_tijd() {
        return $this->datum_tijd;
    }

    public function set_datum_tijd($newval) {
        $this->datum_tijd = $newval;
    }

    public function get_schoolid_as_cond() {
        return $this->schoolid_as_cond;
    }

    public function set_schoolid_as_cond($newval) {
        $this->schoolid_as_cond = $newval;
    }

    public function insert_entry() {
        if (!$this->select_entry_id_by_naam()) {
            $data_i = ['school_naam' => $this->get_school_naam(),
                'school_jaar' => $this->get_school_jaar()
            ];
            $this->db->insert($this->table, $data_i);
            $this->select_entry_id_by_naam();
            return(TRUE);
        }
        return(FALSE);
    }

    public function update_entry() {
        $data_i = ['school_naam' => $this->get_school_naam(),
            'school_jaar' => $this->get_school_jaar()
        ];
        $this->db->where('school_id', $this->get_school_id());
        $this->db->update($this->table, $data_i);

        $this->select_entry_id_by_naam();
        return(TRUE);
    }

    public function delete_entry() {
        if ($this->get_school_id() > 0) {
            $this->db->where('school_id', $this->get_school_id());
            $this->db->delete($this->table);
            $this->set_school_id(0);
            $this->set_school_jaar(0);
            $this->set_school_naam("");
            return(TRUE);
        }
        return(FALSE);
    }

    public function select_entries() {
        $cond = null;
        if (isset($this->schoolid_as_cond)) {
            $cond = 'school_id = ' . $this->get_schoolid_as_cond();
        }
        $dropdownItems = listData($this->table, 'school_id', 'school_naam', $cond);
        return $dropdownItems;
    }

    public function select_entry() {
        if (($this->school_id) > 0) {
            $this->db->select('school_naam as schoolnaam, school_jaar as schooljaar');
            $this->db->where('school_id', $this->get_school_id());
            $this->db->from($this->table);
            $query = $this->db->get();
            $row = $query->row();
            if (isset($row)) {
                $this->set_school_naam($row->schoolnaam);
                $this->set_school_jaar($row->schooljaar);
                return(TRUE);
            }
        }
        return (FALSE);
    }

    private function select_entry_id_by_naam() {
        $this->db->select('school_id');
        $this->db->where('school_naam', $this->get_school_naam());
        $this->db->where('school_jaar', $this->get_school_jaar());
        $this->db->from($this->table);
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            $this->set_school_id($row->school_id);
            return (TRUE);
        }
        return (FALSE);
    }

}
