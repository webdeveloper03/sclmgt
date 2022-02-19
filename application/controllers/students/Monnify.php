<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monnify extends CI_Controller {

    public $setting = "";

    function __construct() {
        parent::__construct();
        $this->load->helper('file');

        $this->load->library('auth');
        $this->load->library('paypal_payment');

        $this->setting = $this->setting_model->get();
    }

    public function index() 
    {        
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/index');

        $data = array();

        $where_student['id'] = $this->session->userdata('student')['student_id'];
        $student = $this->broadsheet_model->select('students',$where_student);        
        $data['student'] = $student->row();

        $school = $this->broadsheet_model->select('sch_settings');
        $data['school'] = $school->row();

        $data['params'] = $this->session->userdata('params');

        $data['setting'] = $this->setting;                

        $this->load->view('student/monnify', $data);
    }    

    public function monnify_payment() 
    {
        $params = $this->session->userdata('params');
        $payment_id = $this->input->post('transaction_id');

        $json_array = array(
            'amount' => $params['total'],
            'commission' => $params['commission_amount'],
            'date' => date('Y-m-d'),
            'amount_discount' => 0,
            'amount_fine' => 0,
            'description' => "Online fees deposit through Monnify TXN ID: " . $payment_id,
            'received_by' => '',
            'payment_mode' => 'Monnify',
        );

        $data = array(
            'student_fees_master_id' => $params['student_fees_master_id'],
            'fee_groups_feetype_id' => $params['fee_groups_feetype_id'],
            'amount_detail' => $json_array
        );

        $send_to = $params['guardian_phone'];
        $inserted_id = $this->studentfeemaster_model->fee_deposit($data, $send_to);
        $invoice_detail = json_decode($inserted_id);

        if($params['sms_enable'] == 1)
        {
            if($params['student_mobile'] != '')
            {
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

                $message = 'Fee for '.$params['total'].' '.$params['sms_content'].' balance fee '.$total_balance_amount;
                $this->smsgateway->sendSMS($params['student_mobile'], "", ($message));
            }            
        }        

        $array = array('invoice_id' => $invoice_detail->invoice_id, 'sub_invoice_id' => $invoice_detail->sub_invoice_id);

        echo json_encode($array);
    }
}
?>