<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<style type="text/css">
 /*div.dataTables_wrapper {
         margin-bottom: 3em;
     }*/
</style>
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
                           <form role="form" id="resultform" action="<?php echo site_url('user/result') ?>" method="get">
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
               </div>                                          
            </div>            
         </div>
      </div>
      <?php
      if(!empty($this->input->get('class_id')))
      {
         if(isset($sch_student))
         {
      ?>
      <div>
         <div class="row">
            <div class="col-md-12">
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="printDiv('#marksheet_id')"><i class="fa fa-print"></i> Print </a>
                  </div>
                  <div class="box-body" id="marksheet_id">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="sfborder">
                              <div class="col-md-12">
                                 <div class="logo_left text-center">
                                 <!-- <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 logo_left text-center"> -->
                                    <?php 
                                    if(!empty($sch_student->image))
                                    {
                                    ?>
                                    <img style="height:115px; width:115px;" class="round5" src="<?php echo base_url($sch_student->image); ?>" alt="No Image">
                                    <?php   
                                    }
                                    else
                                    {
                                    ?>
                                    <img style="height:115px; width:115px;" class="round5" src="<?php echo base_url('uploads/student_images/no_image.png'); ?>">
                                    <?php   
                                    }
                                    ?>                                 
                                 </div>
                                 <div class="result_school_title text-center">
                                 <!-- <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 result_school_title text-center"> -->
                                    <p><strong style="font-size: 28px; text-transform:uppercase; color: #0000FF;"><?php echo $settings->name; ?></strong></p>
                                    <p style="color: #0000FF; text-transform:uppercase;font-size: 18px"><span class="glyphicon glyphicon-map-marker"></span><span style="font-size: 18px"> <?php echo $settings->address; ?></span></p>
                                    <p style="color: #0000FF;"><span class="glyphicon glyphicon-earphone"></span> <?php echo $settings->phone; ?> &nbsp; <span class="glyphicon glyphicon-envelope"></span> <?php echo $settings->email; ?></p>
                                    <br />
                                    <p style="color: #d82f2f;"><b><?php echo $session_row->session; ?> SESSION. <?php echo strtoupper($sch_student->section); ?> (TERMLY EXAMINATION) RESULT</b></p>
                                 </div>
                                 <div class="logo_right text-center">
                                 <!-- <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 logo_right text-center"> -->
                                    <img style="height:115px; width:115px;" class="round5" src="<?php echo base_url('uploads/school_content/logo/result_logo/'.$settings->result_logo); ?>">
                                 </div>
                              </div>
                              <?php 
                              if(isset($student_get_tmark) && isset($student_tmark))
                              {                                                                                                   
                                 $tavg = (array_sum($student_get_tmark) / array_sum($student_tmark)) * 100;
                                 $percentage = number_format((float)$tavg, 2, '.', '');                                 
                              }
                              else
                              {
                                 $percentage = '&nbsp;';
                              }
                              ?>
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="table-responsive-sm">
                                       <table class="table .table-bordered">
                                          <tbody class="tbl_border">
                                             <tr>
                                                <td style="color: #0000FF;">Name</td>
                                                <th style="color: #592a9c;"><?php echo $sch_student->firstname.' '.$sch_student->lastname; ?></th>
                                                <td style="color: #0000FF;">Date Printed</td>
                                                <th style="color: #592a9c;"><?php echo date('d-m-Y'); ?></th>
                                             </tr>
                                             <tr>
                                                <td style="color: #0000FF;">Gender</td>
                                                <th style="color: #592a9c;"><?php echo $sch_student->gender; ?></th>
                                                <td style="color: #0000FF;">Class Teacher</td>
                                                <th style="color: #592a9c;"><?php echo $staff->name.' '.$staff->surname; ?></th>
                                             </tr>
                                             <tr>
                                                <td style="color: #0000FF;">Class</td>
                                                <th style="color: #592a9c;"><?php echo $sch_student->class; ?> (<?php echo $sch_student->section; ?>)</th>
                                                <td style="color: #0000FF;">Present in Class</td>
                                                <th style="color: #592a9c;"><?php echo $total_present; ?></th>
                                             </tr>
                                             <tr>
                                                <td style="color: #0000FF;">Admission Number</td>
                                                <th style="color: #592a9c;"><?php echo $sch_student->admission_no; ?></th>
                                                <td style="color: #0000FF;">Result Summary</td>
                                                <th style="color: #592a9c;">
                                                <?php 
                                                if($result_summary->num_rows() > 0)
                                                {
                                                   foreach($result_summary->result() as $summary)
                                                   {
                                                      if($percentage >= $summary->result_grade_from && $percentage <= $summary->result_grade_to)
                                                      {
                                                         echo $summary->result_grade_name;
                                                      }
                                                   }
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }
                                                ?>   
                                                </th>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <?php $subject_remark = json_decode($remark->performance_subjects,true); ?>
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="table-responsive">
                                       <table class="table .table-bordered">
                                          <thead class="tbl_border">
                                             <tr>
                                                <th style="text-align:center; color: #0000FF;">Subject</th>
                                                <?php
                                                foreach($exams->result() as $exam)
                                                {
                                                ?>
                                                <th style="text-align:center; color: #0000FF;"><?php echo $exam->exam; ?></th>
                                                <?php 
                                                }
                                                ?>
                                                <th style="text-align:center; color: #0000FF;">Total Score</th>
                                                <th style="text-align:center; color: #0000FF;">Average Score</th>
                                                <th style="text-align:center; color: #0000FF;">Grade</th>
                                                <th style="text-align:center; color: #0000FF;">Remarks</th>
                                             </tr>
                                          </thead>
                                          <tbody class="tbl_border">
                                             <?php
                                             foreach($subjects->result() as $subject)
                                             {
                                             ?>
                                             <tr>
                                                <td><?php echo $subject->name; ?></td>
                                                <?php
                                                foreach($exams->result() as $exam)
                                                {
                                                   if(isset($student_mark[$exam->exam_group_class_batch_exams_id][$subject->id]))
                                                   {
                                                   ?>
                                                   <td style="text-align:center;"><?php echo $student_mark[$exam->exam_group_class_batch_exams_id][$subject->id]; ?></td>
                                                   <?php 
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                   <td>&nbsp;</td>
                                                   <?php   
                                                   }
                                                }
                                                ?>
                                                <td style="text-align:center;">
                                                <?php 
                                                if(isset($student_subject_mark[$subject->id]))
                                                {
                                                   $total_score = array_sum($student_subject_gmark[$subject->id]);                                                   
                                                   echo $total_score;
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }
                                                ?>                                                   
                                                </td>
                                                <td style="text-align:center;">
                                                <?php 
                                                if(isset($student_subject_gmark[$subject->id]))
                                                {
                                                   $avg = (array_sum($student_subject_gmark[$subject->id]) / $exams->num_rows());
                                                   $average = number_format((float)$avg, 2, '.', '');
                                                   echo $average;
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }
                                                ?>                                                   
                                                </td>
                                                <td>
                                                <?php 
                                                if($grades->num_rows() > 0)
                                                {
                                                   if(isset($student_subject_gmark[$subject->id]))
                                                   {
                                                      foreach($grades->result() as $grade)
                                                      {
                                                         if($total_score >= $grade->subject_grade_from && $total_score <= $grade->subject_grade_to)
                                                         {
                                                            echo $grade->subject_grade_name;
                                                         }
                                                      }
                                                   }
                                                   else
                                                   {
                                                      echo '&nbsp;';   
                                                   }
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }
                                                ?>   
                                                </td>
                                                <?php 
                                                if(isset($subject_remark[$subject->id]))
                                                {
                                                ?>
                                                <td><?php echo $subject_remark[$subject->id]; ?></td>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <td>&nbsp;</td>
                                                <?php   
                                                }
                                                ?>
                                             </tr>
                                             <?php
                                             }
                                             ?>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="table-responsive">
                                       <table class="table .table-bordered">
                                          <tbody class="tbl_border">
                                             <tr>
                                                <td style="color: #0000FF;">No in class</td>
                                                <td style="color: #592a9c;"><b><?php echo $students->num_rows(); ?></b></td>
                                                <td style="color: #0000FF;">Total Score obtained</td>
                                                <?php 
                                                if(isset($student_get_tmark))
                                                {
                                                ?>
                                                <td style="color: #592a9c;"><b><?php echo array_sum($student_get_tmark); ?></b></td>
                                                <?php 
                                                }
                                                else
                                                {
                                                ?>
                                                <td style="color: #592a9c;">&nbsp;</td>
                                                <?php 
                                                 }
                                                ?>
                                                <td style="color: #0000FF;">Out of</td>
                                                <?php 
                                                if(isset($student_tmark)) 
                                                {
                                                ?>
                                                <td style="color: #592a9c;"><b><?php echo array_sum($student_tmark); ?></b></td>
                                                <?php 
                                                }
                                                else
                                                {
                                                ?>
                                                <td>&nbsp;</td>
                                                <?php   
                                                }
                                                ?>
                                             </tr>
                                             <tr>
                                                <td style="color: #0000FF;">Roll</td>
                                                <td style="color: #592a9c;">&nbsp;</td>
                                                <td style="color: #0000FF;">Average Score</td>
                                                <td style="color: #592a9c;">
                                                <?php 
                                                if(isset($student_get_tmark) && isset($student_tmark))
                                                {                                                                                                   
                                                   $tavg = (array_sum($student_get_tmark) / $subjects->num_rows());
                                                   $taverage = number_format((float)$tavg, 2, '.', '');
                                                   echo '<b>'.$taverage.'</b>';
                                                }
                                                else
                                                {                                                
                                                   echo '&nbsp;';                                                
                                                }
                                                ?>                                                
                                                </td>
                                                <td style="color: #0000FF;">Percentage</td>
                                                <td style="color: #592a9c;"><b><?php echo $percentage; ?> %</b></td>
                                             </tr>
                                          </tbody>                                          
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <table class="table table-borderless">
                                          <tbody>
                                             <tr>
                                                <td style="text-align: left;">
                                                   <p>Teacher's Comment:</p>
                                                   <p>                                                   
                                                   <?php 
                                                   if(isset($remark->performance_teacher_comments))
                                                   {
                                                      echo $remark->performance_teacher_comments; 
                                                   }
                                                   else
                                                   {
                                                      echo '&nbsp;';
                                                   }
                                                   ?>   
                                                   </p>
                                                   <br />
                                                </td>
                                                <td style="text-align: right;">&nbsp;</td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left;">
                                                   <p>Teacher’s Signature:</p>
                                                   <p>&nbsp;</p>
                                                </td>
                                                <td style="text-align: right;">&nbsp;</td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left;">Principal/Headmaster’s  comment:</td>                                                
                                                <td style="text-align: right;">
                                                <?php 
                                                if(isset($remark->performance_principal_comments))
                                                {
                                                   echo $remark->performance_principal_comments; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }
                                                ?>                                                   
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left;">Principal/Headmaster’s  Name:</td>
                                                <td style="text-align: right;">
                                                <?php 
                                                if(isset($remark->performance_principal_name))
                                                {
                                                   echo $remark->performance_principal_name; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }
                                                ?>                                                   
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left;">
                                                   <p>Principal/Headmaster’s  signature:</p>
                                                   <p>&nbsp;</p>
                                                </td>
                                                <td style="text-align: right;">&nbsp;</td>
                                             </tr>
                                             <tbody class="tbl_border">
                                                <tr>
                                                   <td style="text-align: left;">Date of resumption</td>
                                                   <?php
                                                   if(!empty($remark->performance_date_resumption) && $remark->performance_date_resumption != '0000-00-00')
                                                   {
                                                   ?>   
                                                   <td style="text-align: right;"><?php echo date('d-m-Y',strtotime($remark->performance_date_resumption)); ?></td>
                                                   <?php 
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                   <td style="text-align: right;">&nbsp;</td>
                                                   <?php   
                                                   }
                                                   ?>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left;">Total amount balance</td>
                                                   <td style="text-align: right;"><?php echo $balance; ?></td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left;">Fees for next term</td>                                                   
                                                   <?php 
                                                   if($fees->result_fees_amount != '')
                                                   {
                                                   ?>
                                                   <td style="text-align: right;"><?php echo $fees->result_fees_amount; ?></td>                                                   
                                                   <?php 
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                   <td style="text-align: right;">0</td>                                                   
                                                   <?php
                                                   }
                                                   ?>
                                                </tr>
                                             </tbody>
                                          </tbody>
                                       </table>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                       <table class="table table-borderless">
                                          <thead>
                                             <tr>
                                                <th class="text-center" colspan="2" style="color: #0000FF;">Student Conducts</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <th style="color: #0000ff;"><strong>Student Assessment</strong></th>
                                                <th style="color: #0000ff;"><strong>Rating</strong></th>
                                             </tr>
                                          </tbody>
                                          <tbody>
                                             <tr>
                                                <td style="text-align: left; color: #0000FF;">Neatness</td>
                                                <td style="color: #592a9c;">
                                                <?php 
                                                if(isset($remark->performance_neatness))
                                                {
                                                   echo $remark->performance_neatness; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }
                                                ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left; color: #0000FF;">Politeness</td>
                                                <td style="color: #592a9c;">
                                                <?php                                                 
                                                if(isset($remark->performance_politeness))
                                                {
                                                   echo $remark->performance_politeness; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }                                                
                                                ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left; color: #0000FF;">Honesty</td>
                                                <td style="color: #592a9c;">
                                                <?php
                                                if(isset($remark->performance_honesty))
                                                {
                                                   echo $remark->performance_honesty; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }                                                                                                
                                                ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left; color: #0000FF;">Leadership</td>
                                                <td style="color: #592a9c;">                                                
                                                <?php
                                                if(isset($remark->performance_leadership))
                                                {
                                                   echo $remark->performance_leadership; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }                                                                                                
                                                ?>   
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left; color: #0000FF;">Attentiveness</td>
                                                <td style="color: #592a9c;">                                                
                                                <?php
                                                if(isset($remark->performance_attentiveness))
                                                {
                                                   echo $remark->performance_attentiveness; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }                                                                                                
                                                ?>      
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left; color: #0000FF;">Emotional Stability</td>
                                                <td style="color: #592a9c;">                                                
                                                <?php
                                                if(isset($remark->performance_emotional_stability))
                                                {
                                                   echo $remark->performance_emotional_stability; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }                                                                                                
                                                ?>   
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left; color: #0000FF;">Health</td>
                                                <td style="color: #592a9c;">                                                
                                                <?php
                                                if(isset($remark->performance_health))
                                                {
                                                   echo $remark->performance_health; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }                                                                                                
                                                ?>      
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left; color: #0000FF;">Attitude to Sch.Work</td>
                                                <td style="color: #592a9c;">                                                
                                                <?php
                                                if(isset($remark->performance_attitude_to_sch_work))
                                                {
                                                   echo $remark->performance_attitude_to_sch_work; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }                                                                                                
                                                ?>   
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left; color: #0000FF;">Speaking</td>
                                                <td style="color: #592a9c;">                                                
                                                <?php
                                                if(isset($remark->performance_speaking))
                                                {
                                                   echo $remark->performance_speaking; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }                                                                                                
                                                ?>   
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="text-align: left; color: #0000FF;">Hand Writing</td>
                                                <td style="color: #592a9c;">                                                
                                                <?php
                                                if(isset($remark->performance_hand_writing))
                                                {
                                                   echo $remark->performance_hand_writing; 
                                                }
                                                else
                                                {
                                                   echo '&nbsp;';
                                                }                                                                                                
                                                ?>   
                                                </td>
                                             </tr>
                                          </tbody>
                                          <tbody>
                                             <tr>
                                                <th colspan="2">5 = Excellent, 4 = V. Good, 3 = Good, 2 = Pass, 1 = Fair, 0 = Fail</th>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php
         }
      }
      ?>
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
      url: "<?php echo base_url('user/result/select_section'); ?>",
      data: 'class_id='+class_id,
      success: function (data) {

          $("#section_id").html(data);
      }
  });
}  

$(document).ready(function(){

    $("#resultform").validate({
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

var base_url = window.location.origin+'/';

function printDiv(elem) 
{   
  Popup(jQuery(elem).html());
}

function Popup(data) 
{   
  var frame1 = $('<iframe />');
  frame1[0].name = "frame1";
  frame1.css({"position": "absolute", "top": "-1000000px"});
  $("body").append(frame1);
  var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
  frameDoc.document.open();
  //Create a new HTML document.
  frameDoc.document.write('<html>');
  frameDoc.document.write('<head>');
  frameDoc.document.write('<title></title>');
  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/style-main.css">');
  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');

  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
  frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
  frameDoc.document.write('<style></style>');
  frameDoc.document.write('</head>');
  frameDoc.document.write('<body>');
  frameDoc.document.write(data);
  frameDoc.document.write('</body>');
  frameDoc.document.write('</html>');
  frameDoc.document.close();
  setTimeout(function () {
      window.frames["frame1"].focus();
      window.frames["frame1"].print();
      frame1.remove();
  }, 500);


  return true;
}
</script>