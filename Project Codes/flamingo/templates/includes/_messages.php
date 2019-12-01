<?php if(isset($context['flash'])): ?>
  <div class="messages" >
    <div class="alert alert-success alert-dismissible fade show"> 
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo $context['flash'] ?> 
    </div>
  </div>
<?php endif; ?>

<?php if(isset($context['error'])): ?>
  <div class="messages" >
    <div class="alert alert-danger alert-dismissible fade show"> 
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo $context['error'] ?> 
    </div>
  </div>
<?php endif; ?>