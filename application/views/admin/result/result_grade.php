<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<div class="content-wrapper" style="min-height: 946px;">
   <section class="content-header">
      <h1><i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student'); ?></small></h1>
   </section>   
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('result_grade'); ?>
                     <?php 
                     if ($this->rbac->hasPrivilege('result_grade', 'can_add')) 
                     {
                     ?> 
                     <a href="<?php echo site_url('admin/result_grade/add_result_grade'); ?>" class="btn btn-success btn-sm" style="color: white;"><?php echo $this->lang->line('add_grade'); ?></a>
                     <?php 
                     }
                     ?>
                  </h3>
               </div>
               <div class="box-body">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover example" id="broadsheet_table">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Class</th>
                                <th>Term</th>
                                <th>Summary</th>
                                <th>Mark Upto</th>
                                <th>Mark From</th>   
                                <?php 
                                if($this->rbac->hasPrivilege('result_grade', 'can_edit')) 
                                {
                                ?>                              
                                <th>Action</th>
                                <?php 
                                 }
                                ?>
                              </tr>
                            </thead>
                            <tbody>
                              <?php                              
                              if(isset($grades) && $grades->num_rows() > 0)
                              {
                                 $i = 1;

                                 foreach($grades->result() as $grade)
                                 {
                                 ?>
                                 <tr>
                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $grade->class; ?></td>
                                   <td><?php echo $grade->section; ?></td>                                  
                                   <td><?php echo $grade->result_grade_name; ?></td>
                                   <td><?php echo $grade->result_grade_to; ?></td>
                                   <td><?php echo $grade->result_grade_from; ?></td>
                                   <?php 
                                   if($this->rbac->hasPrivilege('result_grade', 'can_edit')) 
                                   {
                                   ?>
                                   <td>
                                   <a href="<?php echo site_url('admin/result_grade/edit_result_grade/'.$grade->result_grade_id) ?>" style="float: right;"><i class="fa fa-edit"></i></a>   
                                   </td>
                                   <?php 
                                    }
                                   ?>
                                 </tr>
                                 <?php
                                    $i++;
                                 }
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