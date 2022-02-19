<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="theme-color" content="#424242" />
      <title>School Management System</title>
      <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css">
   </head>
   <body style="background: #ededed;">
      <div class="container">
         <div class="row">
            <div class="paddtop20">
               <div class="col-md-8 col-md-offset-2 text-center">
                  <img src="<?php echo base_url('uploads/school_content/logo/' . $setting[0]['image']); ?>">
               </div>
               <?php echo validation_errors(); ?>
               <div class="col-md-6 col-md-offset-3 mt20">
                  <div class="paymentbg">
                     <div class="invtext"><?php echo $this->lang->line('fees_payment_details'); ?> </div>
                     <br>
                     <?php if ($api_error) {
                        ?>
                     <div class="alert alert-danger"><?php print_r($api_error); ?> </div>
                     <?php }
                        ?>
                     <div class="padd2 paddtzero">
                        <form action="<?php echo base_url(); ?>students/paystack/paystack_pay" method="post">
                           <table class="table2" width="100%">
                              <tr>
                                 <th><?php echo $this->lang->line('description'); ?></th>
                                 <th class="text-right"><?php echo $this->lang->line('amount') ?></th>
                              </tr>
                              <tr>
                                 <td> <?php
                                    echo $params['payment_detail']->fee_group_name . "<br/><span>" . $params['payment_detail']->code;
                                    ?></span></td>
                                 <td class="text-right"><?php echo $setting[0]['currency_symbol'] . $params['total']; ?></td>
                              </tr>
                              <?php
                              $commission_amount = 0;

                              if($params['commission_amount'] != '' && $params['commission_amount'] != 0)
                              {
                              ?>
                              <tr>
                                 <td> Commission Amount </td>
                                 <td class="text-right"><?php echo $setting[0]['currency_symbol'] . $params['commission_amount']; ?></td>
                              </tr>
                              <?php
                                 $commission_amount = $params['commission_amount']; 
                              }
                              ?>
                              <tr class="bordertoplightgray">
                                 <td  bgcolor="#fff"> <?php echo $this->lang->line('total'); ?>:</td>
                                 <td  bgcolor="#fff" class="text-right"> <?php echo $setting[0]['currency_symbol'] .''.($params['total'] + $commission_amount); ?></td>
                              </tr>
                              <hr>
                              <tr class="bordertoplightgray">
                                 <td  bgcolor="#fff"><button type="button" onclick="window.history.go(-1); return false;" name="search"  value="" class="btn btn-info"><i class="fa fa fa-chevron-left"></i> <?php echo $this->lang->line('back'); ?> </button>  </td>
                                 <td  bgcolor="#fff" class="text-right"> <button type="button" onclick="payWithMonnify()" name="search"  value="" class="btn btn-info"><i class="fa fa fa-chevron-right"></i> Pay With Monnify</button>  </td>
                              </tr>
                           </table>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://sdk.monnify.com/plugin/monnify.js"></script>
<script>
function payWithMonnify() 
{
   var amount = <?php echo $params['total'] + $commission_amount; ?>;

   MonnifySDK.initialize({
      amount: amount,
      currency: "NGN",
      reference: '' + Math.floor((Math.random() * 1000000000) + 1),
      customerName: "<?php echo $student->firstname.' '.$student->lastname; ?>",
      customerEmail: "<?php echo $school->email; ?>",
      apiKey: "<?php echo $params['key']; ?>",
      contractCode: "<?php echo $params['contract_code']; ?>",
      paymentDescription: "Student Fees",
      isTestMode: true,
      metadata: {
              "name": "<?php echo $this->session->userdata('student')['username']; ?>"
      },
      paymentMethods: ["CARD", "ACCOUNT_TRANSFER"],
      incomeSplitConfig:  [
         {
            "subAccountCode": "<?php echo $params['sub_account_code']; ?>",
            "feePercentage": <?php echo $params['fee_percentage']; ?>,
            "splitAmount": <?php echo $params['split_amount']; ?>,
            "feeBearer": true
         }
      ],
      onComplete: function(response){

         var amount_paid    = response.amountPaid;
         var transaction_id = response.transactionReference;

         if(response.paymentStatus == 'PAID')
         {
            $.ajax({
               type:"POST",
               url:"<?php echo site_url('students/monnify/monnify_payment'); ?>",
               data: 'transaction_id='+transaction_id+'&amount='+amount_paid,
               dataType: "json",
               success: function(data)
               {
                  window.location.href = "/students/payment/successinvoice/"+data.invoice_id+'/'+data.sub_invoice_id;
               }
            });
         }
      },
      onClose: function(data){
          
         console.log(data);
      }
   });
}
</script>