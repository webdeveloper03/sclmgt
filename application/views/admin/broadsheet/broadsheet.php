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
                           <form role="form" id="broadsheetform" action="<?php echo site_url('admin/broadsheet') ?>" method="get">
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
                          <table class="table table-striped table-bordered table-hover example" id="broadsheet_table">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Admission No</th>
                                <th>Students</th>
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
                                <th>Total Mark Obtainable</th>
                                <th>Total</th>
                                <th>Average</th>
                                <th>Position</th>
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
                                   <?php
                                   if(isset($subjects) && $subjects->num_rows() > 0)
                                   {
                                      foreach($subjects->result() as $subject)
                                      {
                                      ?>
                                      <td><?php echo $student_mark[$student->id][$subject->id]; ?></td>
                                      <?php
                                      }
                                   }
                                   ?>
                                   <td><?php echo array_sum($student_exam_mark[$student->id]); ?></td>
                                   <td><?php echo array_sum($student_get_mark[$student->id]); ?></td>
                                   <td>
                                    <?php 
                                    $avg = array_sum($student_get_mark[$student->id]) / $subjects->num_rows(); 
                                    $average = number_format((float)$avg, 2, '.', '');
                                    echo $average;
                                    ?>                                       
                                    </td>
                                   <td><?php echo $smark[$student->id]; ?></td>
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
<script>
// $(document).ready( function () {
//     $('#broadsheet_table').DataTable();
// } );

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

    $("#broadsheetform").validate({
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