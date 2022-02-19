<div class="modal-header">
   <h4 class="modal-title">Credentials</h4>
   <button type="button" class="close" data-dismiss="modal">&times;</button>        
</div>
<form action="<?php echo site_url('admin/users/update_credentials'); ?>" method="post">   
   <input type="hidden" name="id" value="<?php echo $credentials->id; ?>">
   <div class="modal-body">
      <div class="col-md-12">
         <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo $credentials->username; ?>" required>
         </div>
      </div>
      <div class="col-md-12">
         <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" id="password" class="form-control" value="<?php echo $credentials->password; ?>" required>
         </div>
      </div>
   </div>
   <div class="modal-footer">
      <input type="submit" name="submit" class="btn btn-success" value="Submit">
   </div>
</form>