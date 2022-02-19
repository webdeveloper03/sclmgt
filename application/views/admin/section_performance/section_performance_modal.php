<style>
   .checkbox input[type="radio"]{
   margin-right: 4px;
   }
</style>
<div class="row">
   <div class="col-md-12">
      <div class="tshadow mb25 bozero">
         <h3 class="pagetitleh2">
            Subject Remark Section
         </h3>
         <div class="around10">
            <input type="hidden" name="ci_csrf_token" value="">                
            <div class="row">
               <div class="col-md-12">
                  <div class="table-responsive">
                     <table class="table table-striped table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>Subject</th>
                              <th colspan="<?php echo $subjects->num_rows(); ?>">
                                 Remarks
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                           <?php

                           $subject_remark = array();

                           if(isset($performance->performance_subjects))
                           {
                              $subject_remark = json_decode($performance->performance_subjects,true);
                           }                           

                           if($subjects->num_rows() > 0)
                           {
                              foreach($subjects->result() as $subject)
                              {
                              ?>
                              <tr>
                                 <td><?php echo $subject->name; ?></td>
                                 <td>
                                    <div class="">
                                       <input type="text" name="subject_remark[<?php echo $subject->id; ?>]" class="form-control input-sm" id="subject_remark_<?php echo $subject->id; ?>" value="<?php if(isset($subject_remark[$subject->id])){ echo $subject_remark[$subject->id]; } ?>" placeholder="Enter Remarks">
                                    </div>
                                 </td>
                              </tr>
                              <?php
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
      <div class="tshadow mb25 bozero">
         <h3 class="pagetitleh2"> Student Conducts </h3>
         <div class="around10">
            <div class="row">
               <div class="col-md-12">
                  <div class="table-responsive">
                     <table class="table table-striped table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>Student Assessment</th>
                              <th colspan="6">Rating (5 = Excellent, 4 = V. Good, 3 = Good, 2 = Pass, 1 = Fair, 0 = Fail)</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Neatness</td>
                              <?php
                              $j = 5;
                              for($i=1;$i<=6;$i++)
                              {
                              ?>
                              <td>
                                 <div class="checkbox" style="margin-top: 0; margin-bottom: 0;">
                                    <label><input name="neatness" value="<?php echo $j; ?>" type="radio" <?php if(isset($performance->performance_neatness) && $performance->performance_neatness == $j){ echo 'checked'; } ?>><?php echo $j; ?></label>
                                 </div>
                              </td>
                              <?php
                                 $j--;
                              }
                              ?>
                           </tr>
                           <tr>
                              <td>Politeness</td>
                              <?php
                              $j = 5;
                              for($i=1;$i<=6;$i++)
                              {
                              ?>
                              <td>
                                 <div class="checkbox" style="margin-top: 0; margin-bottom: 0;">
                                    <label><input name="politeness" value="<?php echo $j; ?>" type="radio" <?php if(isset($performance->performance_politeness) && $performance->performance_politeness == $j){ echo 'checked'; } ?>><?php echo $j; ?></label>
                                 </div>
                              </td>
                              <?php
                                 $j--;
                              }
                              ?>                              
                           </tr>
                           <tr>
                              <td>Honesty</td>
                              <?php
                              $j = 5;
                              for($i=1;$i<=6;$i++)
                              {
                              ?>
                              <td>
                                 <div class="checkbox" style="margin-top: 0; margin-bottom: 0;">
                                    <label><input name="honesty" value="<?php echo $j; ?>" type="radio" <?php if(isset($performance->performance_honesty) && $performance->performance_honesty == $j){ echo 'checked'; } ?>><?php echo $j; ?></label>
                                 </div>
                              </td>
                              <?php
                                 $j--;
                              }
                              ?>                              
                           </tr>
                           <tr>
                              <td>Leadership</td>
                              <?php
                              $j = 5;
                              for($i=1;$i<=6;$i++)
                              {
                              ?>
                              <td>
                                 <div class="checkbox" style="margin-top: 0; margin-bottom: 0;">
                                    <label><input name="leadership" value="<?php echo $j; ?>" type="radio" <?php if(isset($performance->performance_leadership) && $performance->performance_leadership == $j){ echo 'checked'; } ?>><?php echo $j; ?></label>
                                 </div>
                              </td>
                              <?php
                                 $j--;
                              }
                              ?>                              
                           </tr>
                           <tr>
                              <td>Attentiveness</td>
                              <?php
                              $j = 5;
                              for($i=1;$i<=6;$i++)
                              {
                              ?>
                              <td>
                                 <div class="checkbox" style="margin-top: 0; margin-bottom: 0;">
                                    <label><input name="attentiveness" value="<?php echo $j; ?>" type="radio" <?php if(isset($performance->performance_attentiveness) && $performance->performance_attentiveness == $j){ echo 'checked'; } ?>><?php echo $j; ?></label>
                                 </div>
                              </td>
                              <?php
                                 $j--;
                              }
                              ?>                              
                           </tr>
                           <tr>
                              <td>Emotional Stability</td>
                              <?php
                              $j = 5;
                              for($i=1;$i<=6;$i++)
                              {
                              ?>
                              <td>
                                 <div class="checkbox" style="margin-top: 0; margin-bottom: 0;">
                                    <label><input name="emotional_stability" value="<?php echo $j; ?>" type="radio" <?php if(isset($performance->performance_emotional_stability) && $performance->performance_emotional_stability == $j){ echo 'checked'; } ?>><?php echo $j; ?></label>
                                 </div>
                              </td>
                              <?php
                                 $j--;
                              }
                              ?>                              
                           </tr>
                           <tr>
                              <td>Health</td>
                              <?php
                              $j = 5;
                              for($i=1;$i<=6;$i++)
                              {
                              ?>
                              <td>
                                 <div class="checkbox" style="margin-top: 0; margin-bottom: 0;">
                                    <label><input name="health" value="<?php echo $j; ?>" type="radio" <?php if(isset($performance->performance_health) && $performance->performance_health == $j){ echo 'checked'; } ?>><?php echo $j; ?></label>
                                 </div>
                              </td>
                              <?php
                                 $j--;
                              }
                              ?>                              
                           </tr>
                           <tr>
                              <td>Attitude to Sch.Work</td>
                              <?php
                              $j = 5;
                              for($i=1;$i<=6;$i++)
                              {
                              ?>
                              <td>
                                 <div class="checkbox" style="margin-top: 0; margin-bottom: 0;">
                                    <label><input name="attitude_to_sch_work" value="<?php echo $j; ?>" type="radio" <?php if(isset($performance->performance_attitude_to_sch_work) && $performance->performance_attitude_to_sch_work == $j){ echo 'checked'; } ?>><?php echo $j; ?></label>
                                 </div>
                              </td>
                              <?php
                                 $j--;
                              }
                              ?>                              
                           </tr>
                           <tr>
                              <td>Speaking</td>
                              <?php
                              $j = 5;
                              for($i=1;$i<=6;$i++)
                              {
                              ?>
                              <td>
                                 <div class="checkbox" style="margin-top: 0; margin-bottom: 0;">
                                    <label><input name="speaking" value="<?php echo $j; ?>" type="radio" <?php if(isset($performance->performance_speaking) && $performance->performance_speaking == $j){ echo 'checked'; } ?>><?php echo $j; ?></label>
                                 </div>
                              </td>
                              <?php
                                 $j--;
                              }
                              ?>                              
                           </tr>
                           <tr>
                              <td>Hand Writing</td>
                              <?php
                              $j = 5;
                              for($i=1;$i<=6;$i++)
                              {
                              ?>
                              <td>
                                 <div class="checkbox" style="margin-top: 0; margin-bottom: 0;">
                                    <label><input name="hand_writing" value="<?php echo $j; ?>" type="radio" <?php if(isset($performance->performance_hand_writing) && $performance->performance_hand_writing == $j){ echo 'checked'; } ?>><?php echo $j; ?></label>
                                 </div>
                              </td>
                              <?php
                                 $j--;
                              }
                              ?>                              
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tshadow mb25 bozero">
         <h3 class="pagetitleh2">
            Guidance &amp; Counsellor Section
         </h3>
         <div class="around10">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Name</label>
                     <input id="counsellor_name" name="counsellor_name" placeholder="" type="text" class="form-control" value="<?php if(isset($performance->performance_counsellor_name)){ echo $performance->performance_counsellor_name; } ?>">
                     <span class="text-danger"></span>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Comments</label>
                     <input id="counsellor_comments" name="counsellor_comments" placeholder="" type="text" class="form-control" value="<?php if(isset($performance->performance_counsellor_comments)){ echo $performance->performance_counsellor_comments; } ?>">
                     <span class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tshadow mb25 bozero">
         <h3 class="pagetitleh2">
            Form Teacher Section
         </h3>
         <div class="around10">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Name</label>
                     <input id="teacher_name" name="teacher_name" placeholder="" type="text" class="form-control" value="<?php if(isset($performance->performance_teacher_name)){ echo $performance->performance_teacher_name; } ?>">
                     <span class="text-danger"></span>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Comments</label>
                     <input id="teacher_comments" name="teacher_comments" placeholder="" type="text" class="form-control" value="<?php if(isset($performance->performance_teacher_comments)){ echo $performance->performance_teacher_comments; } ?>">
                     <span class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tshadow mb25 bozero">
         <h3 class="pagetitleh2">
            Principal Section
         </h3>
         <div class="around10">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Name</label>
                     <input id="principal_name" name="principal_name" placeholder="" type="text" class="form-control" value="<?php if(isset($performance->performance_principal_name)){ echo $performance->performance_principal_name; } ?>">
                     <span class="text-danger"></span>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Comments</label>
                     <input id="principal_comments" name="principal_comments" placeholder="" type="text" class="form-control" value="<?php if(isset($performance->performance_principal_comments)){ echo $performance->performance_principal_comments; } ?>">
                     <span class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tshadow mb25 bozero">
         <h3 class="pagetitleh2">
            Sports &amp; Athletics Section
         </h3>
         <div class="around10">
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Sports &amp; Athletics</label>
                     <input id="sports_athletics" name="sports_athletics" placeholder="" type="text" class="form-control" value="<?php if(isset($performance->performance_sports_athletics)){ echo $performance->performance_sports_athletics; } ?>">
                     <span class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tshadow mb25 bozero">
         <h3 class="pagetitleh2">
            Fees Details
         </h3>
         <div class="around10">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="date_resumption">Date of resumption</label>
                     <input id="date_resumption" name="date_resumption" placeholder="" type="date" class="form-control" value="<?php if(isset($performance->performance_date_resumption)){ echo $performance->performance_date_resumption; } ?>">
                     <span class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="">
         <input type="hidden" name="student_id" value="<?php echo $stud_id; ?>">
         <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
         <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">         
      </div>
   </div>
</div>