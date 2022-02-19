<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?><small><?php echo $this->lang->line('setting1'); ?></small>
            <small class="pull-right"><a type="button" onclick="sms_test()" class="btn btn-primary btn-sm">SMS Test--r</a></small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom theme-shadow">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1" data-toggle="tab"><?php echo $this->lang->line('sms_gateway'); ?></a></li>
                        <li class="pull-left header"><i class="fa fa-mobile"></i> <?php echo $this->lang->line('sms_setting'); ?></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form role="form" id="clickatell" action="<?php echo site_url('smsconfig/clickatell') ?>" class="form-horizontal" method="post">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12 minheight170">
                                            <div class="col-md-7">                                                
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('username'); ?><small class="req"> *</small></label>
                                                    <div class="col-sm-7">
                                                        <input autofocus="" type="text" class="form-control" name="clickatell_user" value="<?php if(isset($smslist->sms_config_username)){ echo $smslist->sms_config_username; } ?>">
                                                        <span class=" text text-danger clickatell_user_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('password'); ?><small class="req"> *</small></label>
                                                    <div class="col-sm-7">
                                                        <input type="password" class="form-control" name="clickatell_password"  value="<?php if(isset($smslist->sms_config_password)) { echo $smslist->sms_config_password; } ?>">
                                                        <span class=" text text-danger clickatell_password_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('sender_name'); ?><small class="req"> *</small></label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" name="clickatell_sender"  value="<?php if(isset($smslist->sms_config_sender)){ echo $smslist->sms_config_sender; } ?>">
                                                        <span class=" text text-danger clickatell_sender_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('status'); ?><small class="req"> *</small></label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="clickatell_status">
                                                            <?php
                                                            foreach($statuslist as $s_key => $s_value) 
                                                            {
                                                            ?>
                                                            <option value="<?php echo $s_key; ?>" <?php if(isset($smslist->sms_config_status) && $smslist->sms_config_status == $s_key) { echo "selected"; } ?>><?php echo $s_value; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <span class=" text text-danger clickatell_status_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 text text-center disblock">                                                
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <?php if ($this->rbac->hasPrivilege('sms_setting', 'can_edit')) {
                                        ?>
                                        <button type="submit" class="btn btn-primary col-md-offset-3"><?php echo $this->lang->line('save'); ?></button>&nbsp;&nbsp;<span class="clickatell_loader"></span>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>                        
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
        </div>  
    </section>
</div>
<div id="myModal" class="modal fade in" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Test SMS --r</h4>
            </div>
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                        <div class="">
                            <form id="sendform" action="<?php echo base_url() ?>emailconfig/test_mail"   name="employeeform" class="form-horizontal form-label-left" method="post" accept-charset="utf-8"> 
                                <div class="">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pwd">Mobile Number --r</label><small class="req"> *</small>  
                                            <input type="text" id="title" autocomplete="off" class="form-control" value="" name="mobile">
                                            <span id="name_add_error" class="text-danger"></span>
                                        </div>

                                    </div>
                                </div>

                        </div><!--./row--> 
                        <div class="box-footer">
                            <div class="pull-right paddA10">

                                <button type="submit" class="btn btn-info pull-right">Send --r</button>
                            </div>
                        </div>
                        </form>  
                    </div>                     
                </div><!--./col-md-12-->       

            </div><!--./row--> 

        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
    function sms_test() {
        $('#myModal').modal('show');
    }

    $(document).ready(function (e) {
        $("#sendform").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url() ?>admin/mailsms/test_sms',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                },
                error: function () {}
            });
        }));
    });

    var img_path = "<?php echo base_url() . '/backend/images/loading.gif' ?>";
   

    $("#twilio").submit(function (e) {
        $("[class$='_error']").html("");

        $(".twilio_loader").html('<img src="' + img_path + '">');
        var url = $(this).attr('action'); // the script where you handle the form input.

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: url,
            data: $("#twilio").serialize(), // serializes the form's elements.
            success: function (data, textStatus, jqXHR)
            {
                if (data.st === 1) {
                    $.each(data.msg, function (key, value) {
                        $('.' + key + "_error").html(value);
                    });
                } else {
                    successMsg(data.msg);
                }
                $(".twilio_loader").html("");

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $(".twilio_loader").html("");
                //if fails      
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });


    $("#custom").submit(function (e) {
        $("[class$='_error']").html("");

        $(".custom_loader").html('<img src="' + img_path + '">');
        var url = $(this).attr('action'); // the script where you handle the form input.

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: url,
            data: $("#custom").serialize(), // serializes the form's elements.
            success: function (data, textStatus, jqXHR)
            {
                if (data.st === 1) {
                    $.each(data.msg, function (key, value) {
                        $('.' + key + "_error").html(value);
                    });
                } else {
                    successMsg(data.msg);
                }
                $(".custom_loader").html("");

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $(".custom_loader").html("");
                //if fails      
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

    $("#msg_nineone").submit(function (e) {
        $("[class$='_error']").html("");

        $(".msg_nineone_loader").html('<img src="' + img_path + '">');
        var url = $(this).attr('action'); // the script where you handle the form input.

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: url,
            data: $("#msg_nineone").serialize(), // serializes the form's elements.
            success: function (data, textStatus, jqXHR)
            {
                if (data.st === 1) {
                    $.each(data.msg, function (key, value) {
                        $('.' + key + "_error").html(value);
                    });
                } else {
                    successMsg(data.msg);
                }
                $(".msg_nineone_loader").html("");

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $(".msg_nineone_loader").html("");
                //if fails      
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

    $("#smscountry").submit(function (e) {
        $("[class$='_error']").html("");

        $(".smscountry_loader").html('<img src="' + img_path + '">');
        var url = $(this).attr('action'); // the script where you handle the form input.

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: url,
            data: $("#smscountry").serialize(), // serializes the form's elements.
            success: function (data, textStatus, jqXHR)
            {
                if (data.st === 1) {
                    $.each(data.msg, function (key, value) {
                        $('.' + key + "_error").html(value);
                    });
                } else {
                    successMsg(data.msg);
                }
                $(".smscountry_loader").html("");

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $(".msg_nineone_loader").html("");
                //if fails      
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });


    $("#text_local").submit(function (e) {
        $("[class$='_error']").html("");
        $(".text_local_loader").html('<img src="' + img_path + '">');
        var url = $(this).attr('action'); // the script where you handle the form input.
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: url,
            data: $("#text_local").serialize(), // serializes the form's elements.
            success: function (data, textStatus, jqXHR)
            {
                if (data.st === 1) {
                    $.each(data.msg, function (key, value) {
                        $('.' + key + "_error").html(value);
                    });
                } else {
                    successMsg(data.msg);
                }
                $(".text_local_loader").html("");

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $(".text_local_loader").html("");
                //if fails      
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

$(document).ready(function(){

    $("#clickatell").validate({
       rules :{
           clickatell_user : {
               required : true
           },
           clickatell_password : {
               required : true
           },
           clickatell_sender : {
               required : true
           },
           clickatell_status : {
               required : true
           }
       },
       messages :{
           clickatell_user : {
               required : '<span style="color:red">Please Enter Username!</span>'
           },         
           clickatell_password : {
               required : '<span style="color:red">Please Enter Password!</span>'
           },
           clickatell_sender : {
               required : '<span style="color:red">Please Enter Sender!</span>'
           },
           clickatell_status : {
               required : '<span style="color:red">Please Select Status!</span>'
           }
       }
    });

});
</script>


