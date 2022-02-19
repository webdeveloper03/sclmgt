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
                  <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
               </div>
               <div class="box-body">
                  <?php if ($this->session->flashdata('msg')) { ?> 
                  <div class="alert alert-success">  <?php echo $this->session->flashdata('msg') ?> </div>
                  <?php } ?>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="row">
                           <form role="form" id="sectionperformanceform" action="<?php echo site_url('admin/section_performance') ?>" method="get">
                              <div class="col-sm-3">
                                 <div class="form-group">
                                    <label><?php echo $this->lang->line('session'); ?></label> <small class="req"> *</small> 
                                    <select id="session" name="session" class="form-control">
                                       <option value=""><?php echo $this->lang->line('select'); ?></option>
                                       <?php
                                       foreach($sessions->result() as $session) 
                                       {
                                       ?>
                                          <option value="<?php echo $session->id; ?>" <?php if($session->id == $this->input->get('session')){ echo "selected"; }  ?>><?php echo $session->session; ?></option>
                                       <?php                                       
                                       }
                                       ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                 </div>
                              </div>
                              <div class="col-sm-3">
                                 <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?></label> <small class="req"> *</small> 
                                    <select id="class_id" name="class_id" class="form-control" onchange="select_section()">
                                       <option value=""><?php echo $this->lang->line('select'); ?></option>
                                       <?php
                                       foreach($classlist->result() as $class) 
                                       {
                                       ?>
                                          <option value="<?php echo $class->id; ?>" <?php if($class->id == $this->input->get('class_id')){ echo "selected"; }  ?>><?php echo $class->class; ?></option>
                                       <?php                                       
                                       }
                                       ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                 </div>
                              </div>
                              <div class="col-sm-3">
                                 <div class="form-group">
                                    <label><?php echo $this->lang->line('section'); ?></label> <small class="req"> *</small>
                                    <select  id="section_id" name="section_id" class="form-control" >                                       
                                       <option value=""><?php echo $this->lang->line('select'); ?></option>
                                       <?php
                                       if(isset($sections) && $sections->num_rows() > 0)
                                       {
                                          foreach($sections->result() as $section)
                                          {
                                          ?>
                                             <option value="<?php echo $section->id; ?>" <?php if($section->id == $this->input->get('section_id')){ echo "selected"; }  ?>><?php echo $section->section; ?></option>
                                          <?php
                                          }
                                       }
                                       ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                 </div>
                              </div>
                              <div class="col-sm-3">
                                 <div class="form-group">
                                    <label></label>
                                    <div class="clearfix"></div>
                                    <button type="submit" name="search" value="result" class="btn btn-primary btn-sm checkbox-toggle">
                                    <i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?>
                                    </button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="table-responsive" style="margin-top: 50px;">
                          <table class="table table-striped table-bordered table-hover example" id="section_performance_table">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Admission No</th>
                                <th>Student</th>
                                <th>Exam</th>
                                <?php
                                if(isset($subjects) && $subjects->num_rows() > 0)
                                {
                                   foreach($subjects->result() as $subject)
                                   {
                                   ?> 
                                    <th><?php echo $subject->name; ?></th>
                                   <?php
                                   }
                                }
                                ?>                                
                                <th>Grand Total</th>
                                <th>Average (%)</th>
                                 <?php 
                                 if ($this->rbac->hasPrivilege('section_performance', 'can_edit')) 
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
                              if(isset($students) && $students->num_rows() > 0)
                              {
                                 $i = 1;

                                 foreach($students->result() as $student)
                                 {
                                 ?>
                                 <tr>
                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $student->admission_no; ?></td>
                                   <td><?php echo $student->firstname.' '.$student->lastname; ?></td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td></td>                                   
                                   <td></td>
                                   <td></td>
                                    <?php 
                                    if ($this->rbac->hasPrivilege('section_performance', 'can_edit')) 
                                    {
                                    ?>
                                    <td style="float: right;"><a href="javascript:void(0)" onclick="select_report(<?php echo $student->id; ?>)"><i class="fa fa-bars"></i></a></td>
                                    <?php 
                                    }
                                    ?>
                                 </tr>
                                 <?php   
                                    foreach($student_marks[$student->id] as $exam_key => $student_mark)
                                    {
                                 ?>
                                 <tr>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td><?php echo $student_exam[$student->id][$exam_key]; ?></td>
                                   <?php
                                   if(isset($subjects) && $subjects->num_rows() > 0)
                                   {
                                      foreach($subjects->result() as $subject)
                                      {
                                       if(isset($student_marks[$student->id][$exam_key][$subject->id]))
                                       {
                                       ?>
                                       <td><?php echo $student_marks[$student->id][$exam_key][$subject->id]; ?></td>
                                       <?php   
                                       }
                                       else
                                       {
                                       ?>
                                       <td>-</td>
                                       <?php   
                                       }
                                      ?>                                      
                                      <?php
                                      }
                                   }
                                   ?>                                   
                                   <td><?php echo array_sum($student_get_mark[$student->id][$exam_key]).'/'.array_sum($student_exam_mark[$student->id][$exam_key]); ?></td>
                                   <td>
                                    <?php 
                                    $avg = array_sum($student_get_mark[$student->id][$exam_key]) / $subjects->num_rows(); 
                                    $average = number_format((float)$avg, 2, '.', '');
                                    echo $average;
                                    ?>                                       
                                    </td>
                                   <td></td>
                                 </tr>
                                 <?php
                                    }

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
<div id="section_performance_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Student Section Performance</h4>
            </div>
            <form action="<?php echo site_url('admin/section_performance/add_student_performance'); ?>" method="post" accept-charset="utf-8">
               <input type="hidden" name="query_string" value="<?php echo $_SERVER['QUERY_STRING']; ?>">
                <div class="modal-body" id="section_performance_modal_body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModalPer">Close</button>
                    <input type="submit" name="submit" class="btn btn-info" value="Save">                    
                </div>
            </form>
        </div>

    </div>
</div>
<script>
function select_report(stud_id)
{   
   var class_id   = $('#class_id').val();
   var section_id = $('#section_id').val();

   $.ajax({
      type: "GET",
      url: "<?php echo base_url('admin/section_performance/student_section_performance'); ?>",
      data: 'class_id='+class_id+'&section_id='+section_id+'&stud_id='+stud_id,
      success: function (data) {

         $('#section_performance_modal_body').html(data);
         $('#section_performance_modal').modal('show');

      }
  });
}  

function select_section()
{
   var class_id = $('#class_id').val();

   $.ajax({
      type: "GET",
      url: "<?php echo base_url('admin/broadsheet/select_section'); ?>",
      data: 'class_id='+class_id,
      success: function (data) {

          $("#section_id").html(data);
      }
  });
}  

$(document).ready(function(){

    $("#sectionperformanceform").validate({
       rules :{
           session : {
               required : true
           },
           class_id : {
               required : true
           },
           section_id : {
               required : true
           }
       },
       messages :{
           session : {
               required : '<span style="color:red">Please Select Session!</span>'
           },         
           class_id : {
               required : '<span style="color:red">Please Select Class!</span>'
           },
           section_id : {
               required : '<span style="color:red">Please Select Section!</span>'
           }
       }
    });

});

</script>