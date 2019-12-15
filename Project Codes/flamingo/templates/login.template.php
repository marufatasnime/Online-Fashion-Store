<?php $extend_layout = 'layout'; ?>

<?php function block_body($context) { ?>

<div class="container form_container">
  <h1 class="form_header">Login</h1>
  <div class="form_body">
    <form action="" method="POST">
      <div class="form-group row">
        <label for="email" class="col-md-4">Cellphone Number</label>
        
        <div class="col-md-8">
          <input id="user_id" class="form-control" 
            type="number" name="user_id" value="<?php old_value('user_id'); ?>" 
            required autocomplete="user_id">
          <div> <?php form_error('user_id'); ?> </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="password" class="col-md-4">Password</label>
        
        <div class="col-md-8">
          <input id="password" class="form-control" 
            type="password" name="password" value="" autocomplete="new_password">
          <div> <?php form_error('password'); ?> </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="offset-sm-10">
          <button type="submit" class="btn btn-outline-secondary">Login</button>
        </div>
      </div> 
    </form>
  </div>
</div>

<?php } //endblock_body ?>