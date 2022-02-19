<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Result_fees extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();        
    }

    public function index() 
    {
        if(!$this->rbac->hasPrivilege('result_fees', 'can_view')) 
        {
            access_denied();
        }

        $where['result_fees_status'] = 1;
        $data['fees_list'] = $this->broadsheet_model->get_result_fees($where);

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'result_fees/index');

        $data['set']   = 'result_fees';
        $data['title'] = 'Result Fees';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/result/result_fees', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add_fees()
    {
        if(!$this->rbac->hasPrivilege('result_fees', 'can_view')) 
        {
            access_denied();
        }

        if($this->input->post('submit'))
        {            
            $this->form_validation->set_rules('session','','required');
            $this->form_validation->set_rules('class_id','','required');
            $this->form_validation->set_rules('section_id','','required');
            $this->form_validation->set_rules('fees','','required');

            if($this->form_validation->run())
            {
                $ins['result_fees_session']    = $this->input->post('session');
                $ins['result_fees_class']      = $this->input->post('class_id');
                $ins['result_fees_term']       = $this->input->post('section_id');
                $ins['result_fees_amount']     = $this->input->post('fees');
                $ins['result_fees_added_on']   = date('Y-m-d H:i:s');
                $ins['result_fees_added_by']   = $this->session->userdata('admin')['id'];
                $ins['result_fees_updated_on'] = date('Y-m-d H:i:s');
                $ins['result_fees_updated_by'] = $this->session->userdata('admin')['id'];
                $ins['result_fees_status']     = 1;

                $add = $this->broadsheet_model->insert('result_fees',$ins);

                if($add)
                {
                    $this->session->set_flashdata('success','Details Added Successfully!');
                    redirect('admin/result_fees/add_fees');
                }
            }
            else
            {
                $this->session->set_flashdata('error','Some Fields Are Missing!');
                redirect('admin/result_fees/add_fees');
            }
        }

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'result_fees/index');

        $data['classlist'] = $this->broadsheet_model->select('classes');
        $data['sessions'] = $this->broadsheet_model->select('sessions');

        $data['set']   = 'result_fees';
        $data['title'] = 'Result Fees';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/result/add_fees', $data);
        $this->load->view('layout/footer', $data);
    }

    public function edit_fees()
    {
        if(!$this->rbac->hasPrivilege('result_fees', 'can_view')) 
        {
            access_denied();
        }

        if($this->input->post('submit'))
        {            
            $this->form_validation->set_rules('session','','required');
            $this->form_validation->set_rules('class_id','','required');
            $this->form_validation->set_rules('section_id','','required');
            $this->form_validation->set_rules('fees','','required');

            if($this->form_validation->run())
            {
                $upd['result_fees_session']     = $this->input->post('session');
                $upd['result_fees_class']       = $this->input->post('class_id');
                $upd['result_fees_term']        = $this->input->post('section_id');
                $upd['result_fees_amount']      = $this->input->post('fees');
                $upd['result_fees_updated_on']  = date('Y-m-d H:i:s');
                $upd['result_fees_updated_by']  = $this->session->userdata('admin')['id'];

                $where['result_fees_id'] = $this->uri->segment(4);
                $add = $this->broadsheet_model->update('result_fees',$upd,$where);

                if($add)
                {
                    $this->session->set_flashdata('success','Details Updated Successfully!');
                    redirect('admin/result_fees/edit_fees/'.$this->uri->segment(4));
                }
            }
            else
            {
                $this->session->set_flashdata('error','Some Fields Are Missing!');
                redirect('admin/result_fees/edit_fees/'.$this->uri->segment(4));
            }
        }

        $where_fees['result_fees_id'] = $this->uri->segment(4);
        $fees = $this->broadsheet_model->select('result_fees',$where_fees);
        $data['fees'] = $fees->row();        

        $where_section['class_id'] = $data['fees']->result_fees_class;
        $data['sections'] = $this->broadsheet_model->get_sections($where_section);

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'result_fees/index');

        $data['classlist'] = $this->broadsheet_model->select('classes');
        $data['sessions'] = $this->broadsheet_model->select('sessions');

        $data['set']   = 'result_fees';
        $data['title'] = 'Result Fees';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/result/edit_fees', $data);
        $this->load->view('layout/footer', $data);
    }
}
?>