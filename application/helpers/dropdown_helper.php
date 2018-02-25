<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function listData($table, $name, $value, $condition = NULL, $orderBy = 'ASC') {
    $items = array();
    $CI = & get_instance();
    if ($orderBy) {
        $CI->db->order_by($value, $orderBy);
    }
    $CI->db->select("$name,$value");
    $CI->db->from($table);
    if (isset($condition)) {
        $CI->db->where($condition);
    }
    $query = $CI->db->get();
    //$query = $CI->db->select("$name,$value")->from($table)->get();
    if ($query->num_rows() > 0) {
        foreach ($query->result() as $data) {
            $items[$data->$name] = $data->$value;
        }
        $query->free_result();
        return $items;
    }
}

/* End of file dropdwon_helper.php */
/* Location: ./application/helper/dropdown_helper.php */