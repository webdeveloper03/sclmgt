<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Result_grade extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();        
    }

    public function index() 
    {
        if(!$this->rbac->hasPrivilege('result_grade', 'can_view')) 
        {
            access_denied();
        }

        $where['result_grade_status'] = 1;
        $data['grades'] = $this->broadsheet_model->get_result_grade($where);

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'result_grade/index');

        $data['set']   = 'result_grade';
        $data['title'] = 'Result Grade';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/result/result_grade', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add_result_grade()
    {
        if(!$this->rbac->hasPrivilege('result_grade', 'can_view')) 
        {
            access_denied();
        }

        if($this->input->post('submit'))
        {            
            $this->form_validation->set_rules('session','','required');
            $this->form_validation->set_rules('class_id','','required');
            $this->form_validation->set_rules('section_id','','required');
            $this->form_validation->set_rules('grade_name','','required');
            $this->form_validation->set_rules('mark_upto','','required');
            $this->form_validation->set_rules('mark_from','','required');

            if($this->form_validation->run())
            {
                $ins['result_grade_session']     = $this->input->post('session');
                $ins['result_grade_class']       = $this->input->post('class_id');
                $ins['result_grade_term']        = $this->input->post('section_id');
                $ins['result_grade_name']        = $this->input->post('grade_name');
                $ins['result_grade_to']          = $this->input->post('mark_upto');
                $ins['result_grade_from']        = $this->input->post('mark_from');                
                $ins['result_grade_added_on']    = date('Y-m-d H:i:s');
                $ins['result_grade_added_by']    = $this->session->userdata('admin')['id'];
                $ins['result_grade_updated_on']  = date('Y-m-d H:i:s');
                $ins['result_grade_updated_by']  = $this->session->userdata('admin')['id'];
                $ins['result_grade_status']      = 1;

                $add = $this->broadsheet_model->insert('result_grade',$ins);

                if($add)
                {
                    $this->session->set_flashdata('success','Details Added Successfully!');
                    redirect('admin/result_grade/add_result_grade');
                }
            }
            else
            {
                $this->session->set_flashdata('error','Some Fields Are Missing!');
                redirect('admin/result_grade/add_result_grade');
            }
        }

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'result_grade/index');

        $data['classlist'] = $this->broadsheet_model->select('classes');
        $data['sessions'] = $this->broadsheet_model->select('sessions');

        $data['set']   = 'result_grade';
        $data['title'] = 'Result Grade';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/result/add_result_grade', $data);
        $this->load->view('layout/footer', $data);
    }

    public function edit_result_grade()
    {
        if(!$this->rbac->hasPrivilege('result_grade', 'can_view')) 
        {
            access_denied();
        }

        if($this->input->post('submit'))
        {            
            $this->form_validation->set_rules('session','','required');
            $this->form_validation->set_rules('class_id','','required');
            $this->form_validation->set_rules('section_id','','required');
            $this->form_validation->set_rules('grade_name','','required');
            $this->form_validation->set_rules('mark_upto','','required');
            $this->form_validation->set_rules('mark_from','','required');

            if($this->form_validation->run())
            {
                $upd['result_grade_session']     = $this->input->post('session');
                $upd['result_grade_class']       = $this->input->post('class_id');
                $upd['result_grade_term']        = $this->input->post('section_id');
                $upd['result_grade_name']        = $this->input->post('grade_name');
                $upd['result_grade_to']          = $this->input->post('mark_upto');
                $upd['result_grade_from']        = $this->input->post('mark_from');                
                $upd['result_grade_updated_on']  = date('Y-m-d H:i:s');
                $upd['result_grade_updated_by']  = $this->session->userdata('admin')['id'];                

                $where['result_grade_id'] = $this->uri->segment(4);
                $add = $this->broadsheet_model->update('result_grade',$upd,$where);

                if($add)
                {
                    $this->session->set_flashdata('success','Details Updated Successfully!');
                    redirect('admin/result_grade/edit_result_grade/'.$this->uri->segment(4));
                }
            }
            else
            {
                $this->session->set_flashdata('error','Some Fields Are Missing!');
                redirect('admin/result_grade/edit_result_grade/'.$this->uri->segment(4));
            }
        }

        $where_grade['result_grade_id'] = $this->uri->segment(4);
        $grade = $this->broadsheet_model->select('result_grade',$where_grade);
        $data['grade'] = $grade->row();        

        $where_section['class_id'] = $data['grade']->result_grade_class;
        $data['sections'] = $this->broadsheet_model->get_sections($where_section);

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'result_grade/index');

        $data['classlist'] = $this->broadsheet_model->select('classes');
        $data['sessions'] = $this->broadsheet_model->select('sessions');

        $data['set']   = 'result_grade';
        $data['title'] = 'Result Grade';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/result/edit_result_grade', $data);
        $this->load->view('layout/footer', $data);
    }
}
?>