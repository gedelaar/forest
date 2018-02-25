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
class Leerling_model extends CI_Model {

    //put your code here
    public $title;
    public $content;
    public $date;
    public $table;
    public $klas_id;
    public $leerling_id;
    public $achternaam;
    public $voornaam;
    public $tussenvoegsel;

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        // Your own constructor code
        $this->table = 'leerling';
    }

    public function get_leerling_id() {
        return $this->leerling_id;
    }

    public function set_leerling_id($newval) {
        $this->leerling_id = $newval;
    }

    public function get_klas_id() {
        return $this->klas_id;
    }

    public function set_klas_id($newval) {
        $this->klas_id = $newval;
    }

    public function get_leerling_achternaam() {
        return $this->achternaam;
    }

    public function set_leerling_achternaam($newval) {
        $this->achternaam = $newval;
    }

    public function get_leerling_voornaam() {
        return $this->voornaam;
    }

    public function set_leerling_voornaam($newval) {
        $this->voornaam = $newval;
    }

    public function get_leerling_tussenvoegsel() {
        return $this->tussenvoegsel;
    }

    public function set_leerling_tussenvoegsel($newval) {
        $this->tussenvoegsel = $newval;
    }

    public function insert_entry() {
        if (!$this->select_entry_id_by_naam()) {
            $data_i = ['klas_id' => $this->get_klas_id(),
                'achternaam' => $this->get_leerling_achternaam(),
                'voornaam' => $this->get_leerling_voornaam(),
                'tussenvoegsel' => $this->get_leerling_tussenvoegsel()
            ];
            $this->db->insert($this->table, $data_i);
            $this->select_entry_id_by_naam();
            return(TRUE);
        }
        return(FALSE);
    }

    public function update_entry() {
        $data_i = ['voornaam' => $this->get_leerling_voornaam(),
            'achternaam' => $this->get_leerling_achternaam(),
            'tussenvoegsel' => $this->get_leerling_tussenvoegsel()
        ];
        $this->db->where('leerling_id', $this->get_leerling_id());
        $this->db->update($this->table, $data_i);
        $this->select_entry_id_by_naam();
        return(TRUE);
    }

    public function delete_entry() {
        if ($this->get_leerling_id() > 0) {
            $this->db->where('leerling_id', $this->get_leerling_id());
            $this->db->delete($this->table);
            $this->set_klas_id(0);
            return(TRUE);
        }
        return(FALSE);
    }

    public function select_entries() {
        $condition = "klas_id =" . $this->get_klas_id();
        $dropdownItems = listData($this->table, 'leerling_id', 'achternaam', $condition);
        return $dropdownItems;
    }

    /* public function select_all_entries() {
      //$condition = "school_id =" . $id;
      $dropdownItems = listData($this->table, 'klas_id', 'klas_naam');
      return $dropdownItems;
      }
     */

    public function select_entry() {
        if (isset($this->klas_id)) {
            $this->db->select('achternaam, klas_id as klasid, voornaam, tussenvoegsel');
            $this->db->where('leerling_id', $this->leerling_id);
            $this->db->from($this->table);
            $query = $this->db->get();
            $row = $query->row();
            if (isset($row)) {
                $this->set_leerling_achternaam($row->achternaam);
                $this->set_leerling_voornaam($row->voornaam);
                $this->set_leerling_tussenvoegsel($row->tussenvoegsel);
                $this->set_klas_id($row->klasid);
                return(TRUE);
            }
        }
        return (FALSE);
    }

    private function select_entry_id_by_naam() {
        $this->db->select('leerling_id');
        $this->db->where('achternaam', $this->get_leerling_achternaam());
        $this->db->where('voornaam', $this->get_leerling_voornaam());
        $this->db->where('klas_id', $this->get_klas_id());
        $this->db->from($this->table);
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            $this->set_leerling_id($row->leerling_id);
            return (TRUE);
        }
        return (FALSE);
    }

}
