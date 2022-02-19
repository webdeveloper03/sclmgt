<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Section_performance extends Admin_Controller {

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

        $data['set']   = 'section_performance';
        $data['title'] = 'section_performance';

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
                $marks = $this->broadsheet_model->get_exam_marks($wherein);

                //echo $this->db->last_query();exit;

                if($marks->num_rows() > 0)
                {
                    foreach($marks->result() as $mark)
                    {
                        $student_marks[$mark->student_id][$mark->exam_group_class_batch_exams_id][$mark->subject_id] = $mark->get_marks;
                        $student_exam[$mark->student_id][$mark->exam_group_class_batch_exams_id]  = $mark->exam;

                        $student_exam_mark[$mark->student_id][$mark->exam_group_class_batch_exams_id][] = $mark->max_marks;
                        $student_get_mark[$mark->student_id][$mark->exam_group_class_batch_exams_id][]  = $mark->get_marks;
                    }                    

                    //print_r($student_exam);exit;

                    $data['student_marks']     = $student_marks;
                    $data['student_exam']      = $student_exam;
                    $data['student_exam_mark'] = $student_exam_mark;
                    $data['student_get_mark']  = $student_get_mark;                                                        
                }
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/section_performance/section_performance', $data);
        $this->load->view('layout/footer', $data);
    }

    public function student_section_performance()
    {    
        $where_check['performance_class']   = $this->input->get('class_id');
        $where_check['performance_section'] = $this->input->get('section_id');
        $where_check['performance_stud']    = $this->input->get('stud_id');
        $performance = $this->broadsheet_model->select('student_performance',$where_check);
        $data['performance'] = $performance->row();

        $data['class_id']   = $this->input->get('class_id');
        $data['section_id'] = $this->input->get('section_id');
        $data['stud_id']    = $this->input->get('stud_id');

        $where_subject['class_id'] = $this->input->get('class_id');
        $where_subject['section_id'] = $this->input->get('section_id');
        $data['subjects'] = $this->broadsheet_model->get_subjects($where_subject);

        $this->load->view('admin/section_performance/section_performance_modal',$data);
    }

    public function add_student_performance()
    {
        $query_string = $this->input->post('query_string');

        $where_check['performance_class']   = $this->input->post('class_id');
        $where_check['performance_section'] = $this->input->post('section_id');
        $where_check['performance_stud']    = $this->input->post('student_id');
        $check = $this->broadsheet_model->select('student_performance',$where_check);

        $ins['performance_class']                = $this->input->post('class_id');
        $ins['performance_section']              = $this->input->post('section_id');
        $ins['performance_stud']                 = $this->input->post('student_id');
        $ins['performance_subjects']             = json_encode($this->input->post('subject_remark'));
        $ins['performance_neatness']             = $this->input->post('neatness');
        $ins['performance_politeness']           = $this->input->post('politeness');
        $ins['performance_honesty']              = $this->input->post('honesty');
        $ins['performance_leadership']           = $this->input->post('leadership');
        $ins['performance_attentiveness']        = $this->input->post('attentiveness');
        $ins['performance_emotional_stability']  = $this->input->post('emotional_stability');
        $ins['performance_health']               = $this->input->post('health');
        $ins['performance_attitude_to_sch_work'] = $this->input->post('attitude_to_sch_work');
        $ins['performance_speaking']             = $this->input->post('speaking');
        $ins['performance_hand_writing']         = $this->input->post('hand_writing');
        $ins['performance_counsellor_name']      = $this->input->post('counsellor_name');
        $ins['performance_counsellor_comments']  = $this->input->post('counsellor_comments');
        $ins['performance_teacher_name']         = $this->input->post('teacher_name');
        $ins['performance_teacher_comments']     = $this->input->post('teacher_comments');
        $ins['performance_principal_name']       = $this->input->post('principal_name');
        $ins['performance_principal_comments']   = $this->input->post('principal_comments');
        $ins['performance_sports_athletics']     = $this->input->post('sports_athletics');

        if(!empty($this->input->post('date_resumption')))
        {
            $ins['performance_date_resumption'] = date('Y-m-d',strtotime($this->input->post('date_resumption')));        
        }        
        else
        {
            $ins['performance_date_resumption'] = '';
        }

        if($check->num_rows() > 0)
        {            
            $ins['performance_updated_on']           = date('Y-m-d H:i:s');
            $ins['performance_updated_by']           = $this->session->userdata('admin')['id'];            

            $where['performance_class']   = $this->input->post('class_id');
            $where['performance_section'] = $this->input->post('section_id');
            $where['performance_stud']    = $this->input->post('student_id');

            $add = $this->broadsheet_model->update('student_performance',$ins,$where);
        }
        else
        {
            $ins['performance_added_on']   = date('Y-m-d H:i:s');
            $ins['performance_added_by']   = $this->session->userdata('admin')['id'];
            $ins['performance_updated_on'] = date('Y-m-d H:i:s');
            $ins['performance_updated_by'] = $this->session->userdata('admin')['id'];
            $ins['performance_status']     = 1;

            $add = $this->broadsheet_model->insert('student_performance',$ins);
        }        

        if($add)
        {
            redirect('admin/section_performance?'.$query_string);
        }        
    }
}
?>