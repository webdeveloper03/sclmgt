<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Result extends Student_Controller {

    public function __construct() 
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'result/index');

        $data['title'] = 'Result';
        $data['title_list'] = 'Result';

        $data['classlist'] = $this->result_model->select('classes');
        $data['sessions']  = $this->result_model->select('sessions');
        
        if(!empty($this->input->get('class_id')))
        {            
            $where_section['class_id'] = $this->input->get('class_id');
            $data['sections'] = $this->result_model->get_sections($where_section);

            $where_session['id'] = $this->input->get('session');
            $data['session'] = $this->result_model->select('sessions',$where_session);            
            $data['session_row'] = $data['session']->row();

            $where_subject_grade['subject_grade_session'] = $this->input->get('session');
            $where_subject_grade['subject_grade_class']   = $this->input->get('class_id');
            $where_subject_grade['subject_grade_term']    = $this->input->get('section_id');
            $data['grades'] = $this->result_model->select('subject_grade',$where_subject_grade);

            $where_result_grade['result_grade_session'] = $this->input->get('session');
            $where_result_grade['result_grade_class']   = $this->input->get('class_id');
            $where_result_grade['result_grade_term']    = $this->input->get('section_id');
            $data['result_summary'] = $this->result_model->select('result_grade',$where_result_grade);

            $where_sch_student['b.class_id'] = $this->input->get('class_id');
            $where_sch_student['b.section_id'] = $this->input->get('section_id');
            $where_sch_student['b.session_id'] = $this->input->get('session');
            $where_sch_student['a.id'] = $this->session->userdata('student')['student_id'];
            $data['sch_student'] = $this->result_model->student_details($where_sch_student);
            $data['sch_student'] = $data['sch_student']->row();

            $data['settings'] = $this->result_model->select('sch_settings');
            $data['settings'] = $data['settings']->row();

            $where_staff['b.class_id'] = $this->input->get('class_id');
            $where_staff['b.section_id'] = $this->input->get('section_id');
            $where_staff['b.session_id'] = $this->input->get('session');
            $data['staff'] = $this->result_model->get_staff($where_staff);

            $where_subject['class_id'] = $this->input->get('class_id');
            $where_subject['section_id'] = $this->input->get('section_id');
            $where_subject['b.session_id'] = $this->input->get('session');
            $data['subjects'] = $this->result_model->get_subjects($where_subject);

            $where_exam['student_id'] = $this->session->userdata('student')['student_id'];
            $where_exam['a.session_id'] = $this->input->get('session');
            $data['exams'] = $this->result_model->get_exams($where_exam);

            $where_attendance['student_session_id'] = $this->session->userdata('student')['student_id'];
            $attendances = $this->result_model->select('student_attendences',$where_attendance);
            
            $present  = array();
            $late     = array();
            $half_day = array();

            foreach($attendances->result() as $attendance)
            {
                if($attendance->attendence_type_id == 1){ $present[] = 1; }

                if($attendance->attendence_type_id == 3){ $late[] = 1; }

                if($attendance->attendence_type_id == 6){ $half_day[] = 1; }

                if($attendance->attendence_type_id == 4){ $absent[] = 1; }
            }

            $data['total_present'] = count($present) + count($late) + (count($half_day) / 2);

            $data['total_absent'] = count($absent) + (count($half_day) / 2);

            $where_mark['student_id'] = $this->session->userdata('student')['student_id'];
            $where_mark['d.session_id'] = $this->input->get('session');
            $data['marks'] = $marks = $this->result_model->get_exam_marks($where_mark);

            if($marks->num_rows() > 0)
            {
                foreach($marks->result() as $mark)
                {                    
                    $student_mark[$mark->exam_group_class_batch_exams_id][$mark->subject_id] = $mark->get_marks;
                    $student_subject_mark[$mark->subject_id][] = $mark->max_marks;
                    $student_subject_gmark[$mark->subject_id][] = $mark->get_marks;
                    $student_grand_total[] = $mark->get_marks;
                    $student_tmark[] = $mark->max_marks;
                    $student_get_tmark[] = $mark->get_marks;
                }                

                $data['student_mark']          = $student_mark;
                $data['student_subject_mark']  = $student_subject_mark;
                $data['student_tmark']         = $student_tmark;
                $data['student_get_tmark']     = $student_get_tmark;
                $data['student_subject_gmark'] = $student_subject_gmark;
                $data['student_grand_total']   = $student_grand_total;
            }

            $where_student['class_id']   = $this->input->get('class_id');
            $where_student['section_id'] = $this->input->get('section_id');
            $where_student['session_id'] = $this->input->get('session');
            $data['students'] = $this->result_model->get_students($where_student);

            if($data['students']->num_rows() > 0)
            {
                $wherein = array_column($data['students']->result_array(), 'id');
                $tmarks = $this->broadsheet_model->get_marks($wherein);                                

                if($tmarks->num_rows() > 0)
                {
                    foreach($tmarks->result() as $tmark)
                    {                     
                        $student_get_mark[$tmark->student_id][] = $tmark->total;                        
                    }                    

                    $data['student_get_mark'] = $student_get_mark;                    
                    
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

                    $data['position'] = $this->ordinal($smark[$this->session->userdata('student')['student_id']]);
                }
            }

            $where_remark['performance_class']   = $this->input->get('class_id');
            $where_remark['performance_section'] = $this->input->get('section_id');
            $where_remark['performance_stud']    = $this->session->userdata('student')['student_id'];
            $data['remark'] = $this->result_model->select('student_performance',$where_remark);            
            $data['remark'] = $data['remark']->row();            

            $where_fees['result_fees_session'] = $this->input->get('session');
            $where_fees['result_fees_class']   = $this->input->get('class_id');
            $where_fees['result_fees_term']    = $this->input->get('section_id');
            $where_fees['result_fees_status']  = 1;
            $data['fees'] = $this->result_model->get_recent_fees('result_fees',$where_fees);
            $data['fees'] = $data['fees']->row();

            $id = $this->session->userdata('student')['student_id'];

            $student_due_fee = $this->studentfeemaster_model->getStudentFees($id);
            $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($id);

            $total_amount = 0;
            $total_deposite_amount = 0;
            $total_fine_amount = 0;
            $total_discount_amount = 0;
            $total_balance_amount = 0;
            $alot_fee_discount = 0;
           
            foreach($student_due_fee as $key => $fee)
            {
                foreach($fee->fees as $fee_key => $fee_value)
                {
                    $fee_paid = 0;
                    $fee_discount = 0;
                    $fee_fine = 0;

                    if(!empty($fee_value->amount_detail))
                    {
                        $fee_deposits = json_decode(($fee_value->amount_detail));

                        foreach($fee_deposits as $fee_deposits_key => $fee_deposits_value)
                        {
                            $fee_paid = $fee_paid + $fee_deposits_value->amount;
                            $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                            $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
                        }
                    }

                    $total_amount = $total_amount + $fee_value->amount;
                    $total_discount_amount = $total_discount_amount + $fee_discount;
                    $total_deposite_amount = $total_deposite_amount + $fee_paid;
                    $total_fine_amount = $total_fine_amount + $fee_fine;
                    $feetype_balance = $fee_value->amount - ($fee_paid + $fee_discount);
                    $total_balance_amount = $total_balance_amount + $feetype_balance;                      
                }
            }

            if(!empty($student_discount_fee))
            {
                foreach($student_discount_fee as $discount_key => $discount_value)
                {
                    $alot_fee_discount = $alot_fee_discount;
                }
            }      

            $total_balance_amount = number_format($total_balance_amount - $alot_fee_discount, 2, '.', '');
            
            $data['balance'] = $total_balance_amount;
        }

        $this->load->view('layout/student/header', $data);
        $this->load->view('user/result/results', $data);
        $this->load->view('layout/student/footer', $data);
    }

    public function select_section()
    {
        $where_section['class_id'] = $this->input->get('class_id');
        $data['sections'] = $this->result_model->get_sections($where_section);

        $this->load->view('user/result/sections',$data);
    }

    public function ordinal($number) 
    {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');

        if((($number % 100) >= 11) && (($number%100) <= 13))
        {            
            return $number. 'th';
        }
        else
        {            
            return $number. $ends[$number % 10];
        }
    }
}
