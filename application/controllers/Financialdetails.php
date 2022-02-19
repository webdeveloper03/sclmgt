<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Financialdetails extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        if(!$this->rbac->hasPrivilege('financialdetails', 'can_view'))
        {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'financialdetails/index');
        
        $financial_result = $this->common_model->select('financial_details');
        $data['financial'] = $financial_result->row();

        $data['title'] = 'Financial Details';

        $this->load->view('layout/header', $data);
        $this->load->view('financial/bank_account', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add_bank_account()
    {
        if($this->input->post('submit'))
        {
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('financial_bank_name', '', 'required');
            $this->form_validation->set_rules('financial_account_number', '', 'required');
            $this->form_validation->set_rules('financial_account_name', '', 'required');
            $this->form_validation->set_rules('financial_account_purpose', '', 'required');

            if($this->form_validation->run()) 
            {
                $upd['financial_bank_name']       = $this->input->post('financial_bank_name');
                $upd['financial_account_number']  = $this->input->post('financial_account_number');
                $upd['financial_account_name']    = $this->input->post('financial_account_name');
                $upd['financial_account_purpose'] = $this->input->post('financial_account_purpose');
                $upd['financial_updated_on']      = date('Y-m-d H:i:s');
                $upd['financial_updated_by']      = $this->session->userdata('admin')['id'];                

                $where['financial_status'] = 1;
                $add = $this->common_model->update('financial_details',$upd,$where);

                $this->session->set_flashdata('success','Details Updated Successfully');
                redirect("financialdetails");
            } 
            else 
            {
                $this->session->set_flashdata('error','Some Fields Are Missing');
                redirect("financialdetails");
            }
        }
    }
}
?>