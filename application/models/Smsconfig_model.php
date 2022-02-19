<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Smsconfig_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
        $this->db->select()->from('sms_config');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result();
        }
    }

    public function changeStatus($type) {
        $data = array('is_active' => 'disabled');
        $this->db->where('type !=', $type);
        $this->db->update('sms_config', $data);
    }

    public function add($data) 
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('type', $data['type']);
        $q = $this->db->get('sms_config');

        if ($q->num_rows() > 0) {
            $this->db->where('type', $data['type']);
            $this->db->update('sms_config', $data);
            $message = UPDATE_RECORD_CONSTANT . " On sms config id " . $data['type'];
            $action = "Update";
            $record_id = $data['type'];
            $this->log($message, $record_id, $action);
        } else {
            $this->db->insert('sms_config', $data);
            $insert_id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On sms config id " . $insert_id;
            $action = "Insert";
            $record_id = $insert_id;
            $this->log($message, $record_id, $action);
        }
        if ($data['is_active'] == "enabled") {
            $this->changeStatus($data['type']);
        }

        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
        /* Optional */

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            return true;
        }
    }

    public function getActiveSMS() 
    {
        $this->db->select()->from('sms_config');
        $this->db->where('sms_config_status', 'enabled');
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($table,$values)
    {
        $query = $this->db->insert($table,$values);

        if($query)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    public function select($table,$where = "")
    {       
        $this->db->select("*");
        $this->db->from($table);
        if($where !="")
        {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query;
    }
    
    public function update($table,$values,$where)
    {
        $query = $this->db->update($table,$values,$where);

        if($query)
        {
            return 1;
        }
        else
        {
            return 0;
        } 
    }
    
    public function delete($table,$where)
    {
        $query = $this->db->delete($table,$where);

        if($query)
        {
            return 1;
        }
        else
        {
            return 0;
        } 
    }

    public function select_student($where)
    {
        $this->db->select("*");
        $this->db->from('students as a');
        $this->db->join('student_fees_master as b','a.id = b.student_session_id');
        $this->db->join('fee_session_groups as d','b.fee_session_group_id = d.id');
        $this->db->join('fee_groups as e','e.id = d.fee_groups_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
}
