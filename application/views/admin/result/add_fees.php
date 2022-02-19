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
                  <h3 class="box-title"><?php echo $this->lang->line('next_term_fees'); ?></h3>
               </div>
               <form id="resultfeesform" action="<?php echo site_url('admin/result_fees/add_fees') ?>" method="post" accept-charset="utf-8">
                  <div class="box-body">
                     <?php echo $this->customlib->getCSRF(); ?>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="session"><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
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
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="class_id"><?php echo $this->lang->line('class'); ?><small class="req"> *</small></label>
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
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="section_id"><?php echo $this->lang->line('section'); ?><small class="req"> *</small></label>
                           <select  id="section_id" name="section_id" class="form-control" >                                       
                              <option value=""><?php echo $this->lang->line('select'); ?></option>                              
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="fees"><?php echo $this->lang->line('fees'); ?><small class="req"> *</small></label>
                           <input type="text" id="fees" name="fees" class="form-control">                           
                        </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" class="btn btn-info pull-right" name="submit" value="submit"><?php echo $this->lang->line('save'); ?></button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
</div>
<script>
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

    $("#resultfeesform").validate({
       rules :{
           session : {
               required : true
           },
           class_id : {
               required : true
           },
           section_id : {
               required : true
           },
           fees : {
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
           },
           fees : {
               required : '<span style="color:red">Please Enter Fees!</span>'
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