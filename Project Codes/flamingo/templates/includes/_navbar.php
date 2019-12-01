<nav id="navigation_bar">
  <h1 id="logo"><a href="/flamingo/">Flamingo</a></h1>
  <div id="navigation_links">
    <ul>
      <li><a href="/flamingo/">Home</a></li>
      <li><a href="/flamingo/products/women">Women</a></li>
      <li><a href="/flamingo/products/men">Men</a></li>
      <li><a href="#">About Us</a></li>
      <?php if($logged_in): ?>
      <li><a href="">Cart</a></li>
      <li><a href="#"><?php echo $user->first_name; ?></a></li>
      <li><a href="/flamingo/logout/">Logout</a></li>
      <?php else: ?>
      <li><a href="/flamingo/login">Login</a></li>
      <li><a href="/flamingo/register/">Register</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>