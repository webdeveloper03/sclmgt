<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1><i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?> </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom box box-primary theme-shadow">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-mobile"></i> Salary SMS</li>
                    </ul> 
                    <div class="tab-content pb0">
                        <div class="tab-pane active" id="tab_1">
                            <form role="form" id="paymentsmsform" action="<?php echo site_url('admin/paymentsettings/payment_sms_submit') ?>" class="form-horizontal" method="post">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-12 col-xs-12" for="payment_sms_content">Sample : </label>
                                                    <div class="col-md-7 col-sm-7 col-xs-12"><label class="control-label">{{ amount }} Your content {{ staff name }}</label></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">                                            
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label class="control-label col-md-5 col-sm-12 col-xs-12" for="payment_sms_content">SMS Content <small class="req"> *</small>
                                                    </label>
                                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                                        <textarea id="name" name="payment_sms_content" class="form-control col-md-7 col-xs-12"><?php echo $payment_sms->payment_sms_content; ?></textarea>
                                                        <span class=" text text-danger payment_sms_content_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary col-md-offset-3" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>
</div>
<?php

function check_selected($array) {
    $selected = "none";
    if (!empty($array)) {

        foreach ($array as $a => $element) {
            if ($element->is_active == "yes") {
                $selected = $element->payment_type;
            }
        }
    }
    return $selected;
}

function check_in_array($find, $array) {
    if (!empty($array)) {

        foreach ($array as $element) {

            if ($find == $element->payment_type) {
                return $element;
            }
        }
    }
    $object = new stdClass();
    $object->id = "";
    $object->type = "";
    $object->api_id = "";
    $object->username = "";
    $object->url = "";
    $object->name = "";
    $object->contact = "";
    $object->password = "";
    $object->authkey = "";
    $object->senderid = "";
    $object->is_active = "";
    return $object;
}
?>