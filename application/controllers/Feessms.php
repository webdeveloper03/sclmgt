<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feessms extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();
    }

    public function index()
    {
        if(!$this->rbac->hasPrivilege('feessms', 'can_view')) 
        {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'feessms/index');

        $data['title'] = 'Fees SMS';

        $data['payment_modes'] = $this->broadsheet_model->select('fees_sms');

        $this->load->view('layout/header', $data);
        $this->load->view('admin/fees_sms', $data);
        $this->load->view('layout/footer', $data);
    }

    public function fees_sms_status()
    {
        $id     = $this->uri->segment(3);
        $status = $this->uri->segment(4);

        if($status == 1)
        {
            $upd['fees_sms_status'] = 0;
        }
        else
        {
            $upd['fees_sms_status'] = 1;
        }

        $where['fees_sms_id'] = $id;

        $add = $this->broadsheet_model->update('fees_sms',$upd,$where);

        if($add)
        {
            redirect('feessms');
        }
    }
}
?>