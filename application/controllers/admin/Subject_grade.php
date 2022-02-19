<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subject_grade extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        if(!$this->rbac->hasPrivilege('subject_grade', 'can_view')) 
        {
            access_denied();
        }

        $where['subject_grade_status'] = 1;
        $data['grades'] = $this->broadsheet_model->get_subject_grade($where);

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'subject_grade/index');

        $data['set']   = 'subject_grade';
        $data['title'] = 'Subject Grade';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/result/subject_grade', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add_subject_grade()
    {
        if(!$this->rbac->hasPrivilege('subject_grade', 'can_view')) 
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
                $ins['subject_grade_session']     = $this->input->post('session');
                $ins['subject_grade_class']       = $this->input->post('class_id');
                $ins['subject_grade_term']        = $this->input->post('section_id');
                $ins['subject_grade_name']        = $this->input->post('grade_name');
                $ins['subject_grade_to']          = $this->input->post('mark_upto');
                $ins['subject_grade_from']        = $this->input->post('mark_from');
                $ins['subject_grade_description'] = $this->input->post('description');
                $ins['subject_grade_added_on']    = date('Y-m-d H:i:s');
                $ins['subject_grade_added_by']    = $this->session->userdata('admin')['id'];
                $ins['subject_grade_updated_on']  = date('Y-m-d H:i:s');
                $ins['subject_grade_updated_by']  = $this->session->userdata('admin')['id'];
                $ins['subject_grade_status']      = 1;

                $add = $this->broadsheet_model->insert('subject_grade',$ins);

                if($add)
                {
                    $this->session->set_flashdata('success','Details Added Successfully!');
                    redirect('admin/subject_grade/add_subject_grade');
                }
            }
            else
            {
                $this->session->set_flashdata('error','Some Fields Are Missing!');
                redirect('admin/subject_grade/add_subject_grade');
            }
        }

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'subject_grade/index');

        $data['classlist'] = $this->broadsheet_model->select('classes');
        $data['sessions'] = $this->broadsheet_model->select('sessions');

        $data['set']   = 'subject_grade';
        $data['title'] = 'Subject Grade';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/result/add_subject_grade', $data);
        $this->load->view('layout/footer', $data);
    }

    public function edit_subject_grade()
    {
        if(!$this->rbac->hasPrivilege('subject_grade', 'can_view')) 
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
                $upd['subject_grade_session']     = $this->input->post('session');
                $upd['subject_grade_class']       = $this->input->post('class_id');
                $upd['subject_grade_term']        = $this->input->post('section_id');
                $upd['subject_grade_name']        = $this->input->post('grade_name');
                $upd['subject_grade_to']          = $this->input->post('mark_upto');
                $upd['subject_grade_from']        = $this->input->post('mark_from');
                $upd['subject_grade_description'] = $this->input->post('description');                
                $upd['subject_grade_updated_on']  = date('Y-m-d H:i:s');
                $upd['subject_grade_updated_by']  = $this->session->userdata('admin')['id'];                

                $where['subject_grade_id'] = $this->uri->segment(4);
                $add = $this->broadsheet_model->update('subject_grade',$upd,$where);

                if($add)
                {
                    $this->session->set_flashdata('success','Details Updated Successfully!');
                    redirect('admin/subject_grade/edit_subject_grade/'.$this->uri->segment(4));
                }
            }
            else
            {
                $this->session->set_flashdata('error','Some Fields Are Missing!');
                redirect('admin/subject_grade/edit_subject_grade/'.$this->uri->segment(4));
            }
        }

        $where_grade['subject_grade_id'] = $this->uri->segment(4);
        $grade = $this->broadsheet_model->select('subject_grade',$where_grade);
        $data['grade'] = $grade->row();        

        $where_section['class_id'] = $data['grade']->subject_grade_class;
        $data['sections'] = $this->broadsheet_model->get_sections($where_section);

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'subject_grade/index');

        $data['classlist'] = $this->broadsheet_model->select('classes');
        $data['sessions'] = $this->broadsheet_model->select('sessions');

        $data['set']   = 'subject_grade';
        $data['title'] = 'Subject Grade';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/result/edit_subject_grade', $data);
        $this->load->view('layout/footer', $data);
    }
}
?>