<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends MY_Model {

    public function __construct() {
        parent::__construct();
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
}
