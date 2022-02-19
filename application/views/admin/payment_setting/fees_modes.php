<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<div class="content-wrapper" style="min-height: 946px;">
   <section class="content-header">
      <h1><i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search"></i> Fees Modes</h3>
               </div>
               <div class="box-body">
                  <?php if ($this->session->flashdata('msg')) { ?> 
                  <div class="alert alert-success">  <?php echo $this->session->flashdata('msg') ?> </div>
                  <?php } ?>                  
                  <div class="row">
                     <div class="col-md-12">
                        <div class="table-responsive" style="margin-top: 50px;">
                          <table class="table table-striped table-bordered table-hover example" id="section_performance_table">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Mode</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $i = 1;
                              foreach($fees_modes->result() as $fees_mode)
                              {
                              ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $fees_mode->fees_mode_name; ?></td>
                                 <td style="float: right;">
                                 <?php 
                                 if($fees_mode->fees_mode_status == 1)
                                 {
                                 ?>   
                                    <a href="<?php echo site_url('admin/paymentsettings/fees_mode_status/'.$fees_mode->fees_mode_id.'/'.$fees_mode->fees_mode_status); ?>" class="btn btn-primary btn-sm" title="Click to disable" onclick="return confirm('Are you sure?')"><i class="fa fa-check"></i></a>
                                 <?php 
                                 }
                                 else
                                 {
                                 ?>
                                    <a href="<?php echo site_url('admin/paymentsettings/fees_mode_status/'.$fees_mode->fees_mode_id.'/'.$fees_mode->fees_mode_status); ?>" class="btn btn-danger btn-sm" title="Click to enable" onclick="return confirm('Are you sure?')"><i class="fa fa-ban"></i></a>
                                 <?php 
                                 }
                                 ?>
                                 </td>
                              </tr>
                              <?php 
                                 $i++;
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                     </div>
                  </div>
               </div>                                          
            </div>            
         </div>
      </div>
   </section>
</div>