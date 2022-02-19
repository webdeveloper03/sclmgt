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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><?php echo 'SMS Balance'; ?></a></li>
                        <li class="pull-left header"><i class="fa fa-mobile"></i> <?php echo 'SMS'; ?></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form role="form" id="clickatell" action="<?php echo site_url('smsconfig/clickatell') ?>" class="form-horizontal" method="post">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12 minheight170">
                                            <div class="col-md-7">                                                
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label">Balance (<?php echo $sms_result->currency; ?>)</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" name="clickatell_user" value="<?php echo $sms_result->balance; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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