<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paymentsettings extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {        
        if (!$this->rbac->hasPrivilege('payment_methods', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'admin/paymentsettings');
        $data['title'] = 'SMS Config List';
        $payment_result = $this->paymentsetting_model->get();        

        $data['statuslist'] = $this->customlib->getStatus();
        $data['paymentlist'] = $payment_result;        

        $this->load->view('layout/header', $data);
        $this->load->view('admin/payment_setting/paymentsettingList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function monnify()
    {
        $this->form_validation->set_rules('monnify_api_key', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('monnify_contract_code', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('monnify_sub_account', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('monnify_fee_percentage', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('monnify_split_amount', '', 'trim|required|xss_clean');

        if($this->form_validation->run()) 
        {
            $upd['monnify_api_key']           = $this->input->post('monnify_api_key');
            $upd['monnify_contract_code']     = $this->input->post('monnify_contract_code');
            $upd['monnify_sub_account']       = $this->input->post('monnify_sub_account');
            $upd['monnify_fee_percentage']    = $this->input->post('monnify_fee_percentage');
            $upd['monnify_split_amount']      = $this->input->post('monnify_split_amount');
            $upd['monnify_enable_sms']        = $this->input->post('monnify_enable_sms');
            $upd['monnify_commission_amount'] = $this->input->post('monnify_commission_amount');
            $upd['monnify_sms_content']       = $this->input->post('monnify_sms_content');

            $where['payment_type'] = 'monnify';
            $add = $this->broadsheet_model->update('payment_settings',$upd,$where);

            if($add)
            {
                redirect('admin/paymentsettings');    
            }
        }
        else
        {
            redirect('admin/paymentsettings');
        }
    }

    public function paypal() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('paypal_username', $this->lang->line('username'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('paypal_password', $this->lang->line('password'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('paypal_signature', $this->lang->line('signature'), 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $data = array(
                'payment_type' => 'paypal',
                'api_username' => $this->input->post('paypal_username'),
                'api_password' => $this->input->post('paypal_password'),
                'api_signature' => $this->input->post('paypal_signature'),
                'paypal_demo' => 'TRUE',
            );
            $this->paymentsetting_model->add($data);
            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {

            $data = array(
                'paypal_username' => form_error('paypal_username'),
                'paypal_password' => form_error('paypal_password'),
                'paypal_signature' => form_error('paypal_signature'),
            );

            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function stripe() {

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('api_secret_key', $this->lang->line('secret_key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('api_publishable_key', $this->lang->line('publishable_key'), 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $data = array(
                'api_secret_key' => $this->input->post('api_secret_key'),
                'api_publishable_key' => $this->input->post('api_publishable_key'),
                'payment_type' => 'stripe',
            );

            $this->paymentsetting_model->add($data);
            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {
            $data = array(
                'api_secret_key' => form_error('api_secret_key'),
                'api_publishable_key' => form_error('api_publishable_key'),
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function payu() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('key', $this->lang->line('key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('salt', $this->lang->line('salt'), 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $data = array(
                'api_secret_key' => $this->input->post('key'),
                'salt' => $this->input->post('salt'),
                'payment_type' => 'payu',
            );
            $this->paymentsetting_model->add($data);
            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {
            $data = array(
                'key' => form_error('key'),
                'salt' => form_error('salt')
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function twocheckout() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('api_secret_key', $this->lang->line('key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('api_publishable_key', $this->lang->line('salt'), 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $data = array(
                'api_secret_key' => $this->input->post('api_secret_key'),
                'api_publishable_key' => $this->input->post('api_publishable_key'),
                'payment_type' => 'twocheckout',
            );
            $this->paymentsetting_model->add($data);
            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {
            $data = array(
                'api_secret_key' => form_error('api_secret_key'),
                'api_publishable_key' => form_error('api_publishable_key')
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function ccavenue() {
        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('ccavenue_secret', $this->lang->line('key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('ccavenue_salt', $this->lang->line('salt'), 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $data = array(
                'api_secret_key' => $this->input->post('ccavenue_secret'),
                'salt' => $this->input->post('ccavenue_salt'),
                'payment_type' => 'ccavenue',
            );
            $this->paymentsetting_model->add($data);
            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {
            $data = array(
                'ccavenue_secret' => form_error('ccavenue_secret'),
                'ccavenue_salt' => form_error('ccavenue_salt')
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function paystack() {
        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('paystack_secretkey', $this->lang->line('key'), 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $data = array(
                'api_secret_key' => $this->input->post('paystack_secretkey'),
                'payment_type' => 'paystack',
            );
            $this->paymentsetting_model->add($data);
            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {
            $data = array(
                'paystack_secretkey' => form_error('paystack_secretkey'),
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function instamojo() {

        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('instamojo_apikey', $this->lang->line('key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('instamojo_authtoken', $this->lang->line('key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('instamojo_salt', $this->lang->line('key'), 'trim|required|xss_clean');

        if ($this->form_validation->run()) {

            $data = array(
                'api_secret_key' => $this->input->post('instamojo_apikey'),
                'api_publishable_key' => $this->input->post('instamojo_authtoken'),
                'salt' => $this->input->post('instamojo_salt'),
                'payment_type' => 'instamojo',
            );

            $this->paymentsetting_model->add($data);
            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {

            $data = array(
                'instamojo_apikey' => form_error('instamojo_apikey'),
                'instamojo_authtoken' => form_error('instamojo_authtoken'),
                'instamojo_salt' => form_error('instamojo_salt'),
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function razorpay() {
        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('razorpay_keyid', $this->lang->line('key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('razorpay_secretkey', $this->lang->line('key'), 'trim|required|xss_clean');


        if ($this->form_validation->run()) {

            $data = array(
                'api_secret_key' => $this->input->post('razorpay_secretkey'),
                'api_publishable_key' => $this->input->post('razorpay_keyid'),
                'payment_type' => 'razorpay',
            );

            $this->paymentsetting_model->add($data);
            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {

            $data = array(
                'razorpay_keyid' => form_error('razorpay_keyid'),
                'razorpay_secretkey' => form_error('razorpay_secretkey'),
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function paytm() {

        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('paytm_merchantid', $this->lang->line('key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('paytm_merchantkey', $this->lang->line('key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('paytm_website', $this->lang->line('key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('paytm_industrytype', $this->lang->line('key'), 'trim|required|xss_clean');


        if ($this->form_validation->run()) {

            $data = array(
                'api_secret_key' => $this->input->post('paytm_merchantkey'),
                'api_publishable_key' => $this->input->post('paytm_merchantid'),
                'paytm_website' => $this->input->post('paytm_website'),
                'paytm_industrytype' => $this->input->post('paytm_industrytype'),
                'payment_type' => 'paytm',
            );

            $this->paymentsetting_model->add($data);
            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {

            $data = array(
                'paytm_merchantkey' => form_error('paytm_merchantkey'),
                'paytm_merchantid' => form_error('paytm_merchantid'),
                'paytm_website' => form_error('paytm_website'),
                'paytm_industrytype' => form_error('paytm_industrytype'),
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function midtrans() {

        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('midtrans_serverkey', $this->lang->line('key'), 'trim|required|xss_clean');



        if ($this->form_validation->run()) {

            $data = array(
                'api_secret_key' => $this->input->post('midtrans_serverkey'),
                'payment_type' => 'midtrans',
            );

            $this->paymentsetting_model->add($data);
            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {

            $data = array(
                'midtrans_serverkey' => form_error('midtrans_serverkey'),
            );
            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function setting() {

        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules(
                'payment_setting', $this->lang->line('payment_setting'), array(
            'required',
            array('paymentsetting', array($this->paymentsetting_model, 'valid_paymentsetting'))
                )
        );
        if ($this->form_validation->run()) {
            $paymentsetting = $this->input->post('payment_setting');
            $other = false;
            if ($paymentsetting == "none") {
                $other = true;
                $data = array(
                    'is_active' => 'no'
                );
            } else {
                $data = array(
                    'payment_type' => $this->input->post('payment_setting'),
                    'is_active' => 'yes'
                );
            }
            $this->paymentsetting_model->active($data, $other);

            echo json_encode(array('st' => 0, 'msg' => $this->lang->line('update_message')));
        } else {

            $data = array(
                'payment_setting' => form_error('payment_setting')
            );

            echo json_encode(array('st' => 1, 'msg' => $data));
        }
    }

    public function payment_modes()
    {
        if(!$this->rbac->hasPrivilege('payment_methods', 'can_view')) 
        {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'admin/paymentsettings/payment_modes');

        $data['title'] = 'Payment Modes';

        $data['payment_modes'] = $this->broadsheet_model->select('payment_modes');

        $this->load->view('layout/header', $data);
        $this->load->view('admin/payment_setting/payment_modes', $data);
        $this->load->view('layout/footer', $data);
    }
   
    public function payment_mode_status()
    {
        $id     = $this->uri->segment(4);
        $status = $this->uri->segment(5);

        if($status == 1)
        {
            $upd['payment_mode_status'] = 0;
        }
        else
        {
            $upd['payment_mode_status'] = 1;
        }

        $where['payment_mode_id'] = $id;

        $add = $this->broadsheet_model->update('payment_modes',$upd,$where);

        if($add)
        {
            redirect('admin/paymentsettings/payment_modes');
        }
    }

    public function fees_modes()
    {
        if(!$this->rbac->hasPrivilege('payment_methods', 'can_view')) 
        {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'admin/paymentsettings/fees_modes');

        $data['title'] = 'Fees Modes';

        $data['fees_modes'] = $this->broadsheet_model->select('fees_modes');

        $this->load->view('layout/header', $data);
        $this->load->view('admin/payment_setting/fees_modes', $data);
        $this->load->view('layout/footer', $data);
    }

    public function fees_mode_status()
    {
        $id     = $this->uri->segment(4);
        $status = $this->uri->segment(5);

        if($status == 1)
        {
            $upd['fees_mode_status'] = 0;
        }
        else
        {
            $upd['fees_mode_status'] = 1;
        }

        $where['fees_mode_id'] = $id;

        $add = $this->broadsheet_model->update('fees_modes',$upd,$where);

        if($add)
        {
            redirect('admin/paymentsettings/fees_modes');
        }
    }

    public function payment_sms()
    {
        if(!$this->rbac->hasPrivilege('payment_sms', 'can_view')) 
        {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'admin/paymentsettings/payment_sms');

        $data['title'] = 'Payment SMS';

        $payment_sms = $this->broadsheet_model->select('payment_sms');
        $data['payment_sms'] = $payment_sms->row();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/payment_setting/payment_sms', $data);
        $this->load->view('layout/footer', $data);
    }

    public function payment_sms_submit()
    {
        if($this->input->post('submit'))
        {
            $upd['payment_sms_content'] = $this->input->post('payment_sms_content');

            $where['payment_sms_status'] = 1;
            $add = $this->broadsheet_model->update('payment_sms',$upd,$where);

            if($add)
            {
                redirect('admin/paymentsettings/payment_sms');
            }
        }        
    }
}

?>