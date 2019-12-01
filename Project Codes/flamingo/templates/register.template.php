<?php $extend_layout = 'layout'; ?>

<?php function block_body($context) { ?>

<div class="container form_container">
  <h1 class="form_header">Register</h1>
  <div class="form_body">
    <form action="" method="POST">

      <div class="form-group row">
        <label for="first_name" class="col-md-4">First Name</label>
        
        <div class="col-md-8">
          <input id="first_name" class="form-control" 
            type="text" name="first_name" placeholder="" required autocomplete="first_name" autofocus>
        </div>
      </div>

      <div class="form-group row">
        <label for="last_name" class="col-md-4">Last Name</label>
        
        <div class="col-md-8">
          <input id="last_name" class="form-control" 
            type="text" name="last_name" value="" required autocomplete="last_name">
        </div>
      </div>

      <div class="form-group row">
        <label for="address" class="col-md-4">Address</label>
        
        <div class="col-md-8">
          <input id="address" class="form-control" 
            type="text" name="address" value="" required autocomplete="address">
        </div>
      </div>

      <div class="form-group row">
        <label for="email" class="col-md-4">Cellphone Number</label>
        
        <div class="col-md-8">
          <input id="user_id" class="form-control" 
            type="number" name="user_id" value="" required autocomplete="user_id">
        </div>
      </div>

      <div class="form-group row">
        <label for="email" class="col-md-4">E-Mail Address</label>
        
        <div class="col-md-8">
          <input id="email" class="form-control" 
            type="email" name="email" value="" required autocomplete="email">
        </div>
      </div>

      <div class="form-group row">
        <label for="password" class="col-md-4">Password</label>
        
        <div class="col-md-8">
          <input id="password" class="form-control" 
            type="password" name="password" value="" required autocomplete="new_password">
        </div>
      </div>

      <div class="form-group row">
        <label for="repeat_password" class="col-md-4">Re-enter Password</label>
        
        <div class="col-md-8">
          <input id="repeat_password" class="form-control" 
            type="password" name="password_confirmation" value="" required autocomplete="new_password">
        </div>
      </div>  
      <div class="form-group row">
        <div class="offset-sm-10">
          <button type="submit" class="btn btn-outline-secondary">Register</button>
        </div>
      </div>      
    </form>
  </div>
</div> 

<?php } //endblock_body ?>