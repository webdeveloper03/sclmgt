<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Broadsheet extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();        
    }

    public function index() 
    {
        if(!$this->rbac->hasPrivilege('broadsheet', 'can_view')) 
        {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'broadsheet/index');

        $data['set']   = 'broadsheet';
        $data['title'] = 'Broadsheet';

        $data['classlist'] = $this->broadsheet_model->select('classes');

        $data['sessions'] = $this->broadsheet_model->select('sessions');

        if(!empty($this->input->get('class_id')))
        {
            $where_section['class_id'] = $this->input->get('class_id');
            $data['sections'] = $this->broadsheet_model->get_sections($where_section);

            $where_subject['class_id'] = $this->input->get('class_id');
            $where_subject['section_id'] = $this->input->get('section_id');
            $where_subject['c.session_id'] = $this->input->get('session');
            $data['subjects'] = $this->broadsheet_model->get_subjects($where_subject);

            $where_student['class_id'] = $this->input->get('class_id');
            $where_student['section_id'] = $this->input->get('section_id');
            $where_student['session_id'] = $this->input->get('session');
            $data['students'] = $this->broadsheet_model->get_students($where_student);

            if($data['students']->num_rows() > 0)
            {
                $wherein = array_column($data['students']->result_array(), 'id');
                $marks = $this->broadsheet_model->get_marks($wherein);

                //echo $this->db->last_query();exit;

                if($marks->num_rows() > 0)
                {
                    foreach($marks->result() as $mark)
                    {
                        $student_mark[$mark->student_id][$mark->subject_id] = $mark->total;

                        $student_exam_mark[$mark->student_id][] = $mark->max_total;
                        $student_get_mark[$mark->student_id][]  = $mark->total;
                    }

                    //print_r($student_exam_mark);exit;

                    $data['student_mark']      = $student_mark;
                    $data['student_exam_mark'] = $student_exam_mark;
                    $data['student_get_mark']  = $student_get_mark;
                    
                    foreach($student_get_mark as $student_key => $student_get_marks)
                    {
                        $student_total_mark[$student_key] = array_sum($student_get_marks);
                    }

                    $marks = $student_total_mark;

                    arsort($marks);

                    $i = 1;

                    foreach($marks as $skey => $mark)
                    {
                        $smark[$skey] = $i;

                        $i++;                      
                    }

                    $data['smark'] = $smark;                    
                }
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/broadsheet/broadsheet', $data);
        $this->load->view('layout/footer', $data);
    }

    public function select_section()
    {
        $where_section['class_id'] = $this->input->get('class_id');
        $data['sections'] = $this->broadsheet_model->get_sections($where_section);

        $this->load->view('admin/broadsheet/sections',$data);
    }
}
?>