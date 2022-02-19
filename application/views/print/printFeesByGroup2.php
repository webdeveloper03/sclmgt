<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<style type="text/css">
    .page-break	{ display: block; page-break-before: always; }
    @media print {
        .page-break	{ display: block; page-break-before: always; }
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
            float: left;
        }
        .col-sm-12 {
            width: 100%;
        }
        .col-sm-11 {
            width: 91.66666667%;
        }
        .col-sm-10 {
            width: 83.33333333%;
        }
        .col-sm-9 {
            width: 75%;
        }
        .col-sm-8 {
            width: 66.66666667%;
        }
        .col-sm-7 {
            width: 58.33333333%;
        }
        .col-sm-6 {
            width: 50%;
        }
        .col-sm-5 {
            width: 41.66666667%;
        }
        .col-sm-4 {
            width: 33.33333333%;
        }
        .col-sm-3 {
            width: 25%;
        }
        .col-sm-2 {
            width: 16.66666667%;
        }
        .col-sm-1 {
            width: 8.33333333%;
        }
        .col-sm-pull-12 {
            right: 100%;
        }
        .col-sm-pull-11 {
            right: 91.66666667%;
        }
        .col-sm-pull-10 {
            right: 83.33333333%;
        }
        .col-sm-pull-9 {
            right: 75%;
        }
        .col-sm-pull-8 {
            right: 66.66666667%;
        }
        .col-sm-pull-7 {
            right: 58.33333333%;
        }
        .col-sm-pull-6 {
            right: 50%;
        }
        .col-sm-pull-5 {
            right: 41.66666667%;
        }
        .col-sm-pull-4 {
            right: 33.33333333%;
        }
        .col-sm-pull-3 {
            right: 25%;
        }
        .col-sm-pull-2 {
            right: 16.66666667%;
        }
        .col-sm-pull-1 {
            right: 8.33333333%;
        }
        .col-sm-pull-0 {
            right: auto;
        }
        .col-sm-push-12 {
            left: 100%;
        }
        .col-sm-push-11 {
            left: 91.66666667%;
        }
        .col-sm-push-10 {
            left: 83.33333333%;
        }
        .col-sm-push-9 {
            left: 75%;
        }
        .col-sm-push-8 {
            left: 66.66666667%;
        }
        .col-sm-push-7 {
            left: 58.33333333%;
        }
        .col-sm-push-6 {
            left: 50%;
        }
        .col-sm-push-5 {
            left: 41.66666667%;
        }
        .col-sm-push-4 {
            left: 33.33333333%;
        }
        .col-sm-push-3 {
            left: 25%;
        }
        .col-sm-push-2 {
            left: 16.66666667%;
        }
        .col-sm-push-1 {
            left: 8.33333333%;
        }
        .col-sm-push-0 {
            left: auto;
        }
        .col-sm-offset-12 {
            margin-left: 100%;
        }
        .col-sm-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-sm-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-sm-offset-9 {
            margin-left: 75%;
        }
        .col-sm-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-sm-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-sm-offset-6 {
            margin-left: 50%;
        }
        .col-sm-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-sm-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-sm-offset-3 {
            margin-left: 25%;
        }
        .col-sm-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-sm-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-sm-offset-0 {
            margin-left: 0%;
        }
        .visible-xs {
            display: none !important;
        }
        .hidden-xs {
            display: block !important;
        }
        table.hidden-xs {
            display: table;
        }
        tr.hidden-xs {
            display: table-row !important;
        }
        th.hidden-xs,
        td.hidden-xs {
            display: table-cell !important;
        }
        .hidden-xs.hidden-print {
            display: none !important;
        }
        .hidden-sm {
            display: none !important;
        }
        .visible-sm {
            display: block !important;
        }
        table.visible-sm {
            display: table;
        }
        tr.visible-sm {
            display: table-row !important;
        }
        th.visible-sm,
        td.visible-sm {
            display: table-cell !important;
        }
    }
    .student_fee {
        width: 170px !important;
    }
    .print_group {
        margin: 3px 0px;
    }
    .print_label {
        font-size: 13px;
        font-weight: 600;
    }
    .print_value {
        font-size: 12px;
        font-weight: 400;
    }
    .print_wrap {
        border: 1px solid #f4f4f4;
    }
</style>

<html lang="en">
    <head>
        <title><?php echo $this->lang->line('fees_receipt'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css">
    </head>
    <body>       
        <div class="container"> 
            <div class="row">
                <div id="content" class="student_fee col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="print_wrap">
                        <?php
                            if ($settinglist[0]['is_duplicate_fees_invoice']) {
                        ?>
                                <div class="row">
                                    <div class="col-md-12 text text-center">
                                        <?php echo $this->lang->line('office_copy'); ?>
                                    </div>
                                </div>
                        <?php
                            }

                            $fee_discount = 0;
                            $fee_paid = 0;

                            $fee_fine = 0;
                            $alot_fee_discount = 0;
                            if ($feeList->is_system) {
                                $feeList->amount = $feeList->student_fees_master_amount;
                            }
                            if (!empty($feeList->amount_detail)) {
                                $fee_deposits = json_decode(($feeList->amount_detail));

                                foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                    $fee_paid = $fee_paid + $fee_deposits_value->amount;
                                    $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                    $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
                                }
                            }
                            $feetype_balance = $feeList->amount - ($fee_paid + $fee_discount);
                        ?>
                        <div class="row">                           
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <br/>
                                <strong><?php echo $settings->name; ?></strong>                                
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <br/>
                                <strong>Date: <?php echo date('d-m-Y'); ?></strong>
                            </div>
                        </div>
                        <hr style="margin-top: 5px;margin-bottom: 5px;" />
                        
                            <div class="row print_group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-xs-6"><strong><span class="print_label"><span class="print_label">Name of student</span></span></strong></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><span class="print_value"><?php echo $feeList->firstname . " " . $feeList->lastname; ?></span></div>    
                                </div>                            
                            </div>
                            <div class="row print_group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-xs-6"><strong><span class="print_label">Class</span></strong></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><span class="print_value"><?php echo $feeList->class . " (" . $feeList->section . ")"; ?></span></div>    
                                </div>                            
                            </div>
                            <div class="row print_group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-xs-6"><strong><span class="print_label">Total Fees</span></strong></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><span class="print_value"><?php echo $currency_symbol . $feeList->amount; ?></span></div>    
                                </div>                            
                            </div>
                            <div class="row print_group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-xs-6"><strong><span class="print_label">Amount Paid</span></strong></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><span class="print_value"><?php echo $currency_symbol . number_format($fee_paid, 2, '.', ''); ?></span></div>    
                                </div>                            
                            </div>
                            <div class="row print_group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-xs-6"><strong><span class="print_label">Balance</span></strong></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><span class="print_value">
                                        <?php 
                                        if ($feetype_balance > 0) 
                                        {
                                            echo $currency_symbol . number_format($feetype_balance, 2, '.', '');
                                        }
                                        else
                                        {
                                            echo "-";
                                        }
                                        ?>
                                    </span></div>    
                                </div>                            
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <br />
                                    <p style="color: #ff0000;">This receipt is computer generated hence no signature is required.</p>
                                    <br />
                                    <p class="text-center" style="color: #ff0000;">[Powered by figtec]</p>
                                </div>                                
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </body>
</html>