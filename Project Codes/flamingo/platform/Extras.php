<?php function display_errors($messages) { ?>
  <ul class="text-danger">
  <?php foreach($messages as $message): ?>
    <li> <?php echo $message; ?> </li>
  <?php endforeach; ?>
  </ul>
<?php } //end_block ?>