<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?><small><?php echo $this->lang->line('setting1'); ?></small>
            <small class="pull-right"><a type="button" onclick="sms_test()" class="btn btn-primary btn-sm">Financial Details</a></small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom theme-shadow">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1" data-toggle="tab"><?php echo $this->lang->line('financial_details'); ?></a></li>
                        <li class="pull-left header"><i class="fa fa-mobile"></i> <?php echo $this->lang->line('financial_details'); ?></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form role="form" id="bankaccountform" action="<?php echo site_url('financialdetails/add_bank_account') ?>" class="form-horizontal" method="post">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12 minheight170">
                                            <div class="col-md-7">                                                
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('bank_name'); ?><small class="req"> *</small></label>
                                                    <div class="col-sm-7">
                                                        <input autofocus="" type="text" class="form-control" name="financial_bank_name" value="<?php if(isset($financial->financial_bank_name)){ echo $financial->financial_bank_name; } ?>">
                                                        <span class=" text text-danger financial_bank_name_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('account_no'); ?><small class="req"> *</small></label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" name="financial_account_number"  value="<?php if(isset($financial->financial_account_number)) { echo $financial->financial_account_number; } ?>">
                                                        <span class=" text text-danger financial_account_number_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('account_name'); ?><small class="req"> *</small></label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" name="financial_account_name"  value="<?php if(isset($financial->financial_account_name)){ echo $financial->financial_account_name; } ?>">
                                                        <span class=" text text-danger financial_account_name_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('account_purpose'); ?><small class="req"> *</small></label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" name="financial_account_purpose"  value="<?php if(isset($financial->financial_account_purpose)){ echo $financial->financial_account_purpose; } ?>">
                                                        <span class=" text text-danger financial_account_purpose_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 text text-center disblock">                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <?php if ($this->rbac->hasPrivilege('financial', 'can_edit')) {
                                        ?>
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary col-md-offset-3"><?php echo $this->lang->line('save'); ?></button>&nbsp;&nbsp;<span class="bank_account_loader"></span>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>  
    </section>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    $("#bankaccountform").validate({
       rules :{
           financial_bank_name : {
               required : true
           },
           financial_account_number : {
               required : true
           },
           financial_account_name : {
               required : true
           },
           financial_account_purpose : {
               required : true
           }
       },
       messages :{
           financial_bank_name : {
               required : '<span style="color:red">Please Enter Bank Name!</span>'
           },         
           financial_account_number : {
               required : '<span style="color:red">Please Enter Account Number!</span>'
           },
           financial_account_name : {
               required : '<span style="color:red">Please Enter Account Name!</span>'
           },
           financial_account_purpose : {
               required : '<span style="color:red">Please Enter Account Purpose!</span>'
           }
       }
    });

});

<?php
if($this->session->flashdata('success'))
{
?>
swal("Success", "<?php echo $this->session->flashdata('success'); ?>", "success");
<?php 
}
if($this->session->flashdata('error'))
{
?>
swal("Sorry", "<?php echo $this->session->flashdata('error'); ?>", "warning");
<?php 
}
?>
</script>