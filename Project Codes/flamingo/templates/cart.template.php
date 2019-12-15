<?php $extend_layout = 'layout'; ?>

<?php function block_body($context) { ?>

<div class="container cart_container">
  <div>
    <h1 class="form_header">Your Cart</h1>
  </div>
  <?php if (isset($context['cart_items'])): ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th class="cart_details"> <div>Details</div></th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; ?>
        <?php foreach ($context['cart_items'] as $item): ?>
          <tr>
            <td class="cart_image"><img src="<?php url_for('images/product-1.jpg'); ?>" alt=""></td>
            <td class="cart_details">
              <div>
                <h5><?php echo $item->product->name; ?></h5>
                <p> Tk. <?php echo $item->product->price; ?></p>
              </div>
              <div>
                <p> Quantity: <?php echo $item->item_quantity; ?></p>
                <h5>Sub Total: Tk. <?php echo $item->item_quantity * $item->product->price; ?></h5>
              </div>
              <div>
                <a href="/flamingo/cart/<?php echo "{$item->product->category}/{$item->product->id}/remove/"; ?>" class="btn btn-outline-danger">Remove item</a>
              </div>
            </td>
          </tr>
          <?php $total += $item->product->price; ?>
        <?php endforeach; ?>
        <tr>
          <td class="cart_details">
            <h2> Total </h2>
          </td>
          <td class="cart_details">
            <div>
              Tk. <?php echo $total; ?>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="cart_buttons">
      <a href="/flamingo/cart/cancel/" class="btn btn-outline-danger">Cancel Cart</a>
      <a href="#" class="btn btn-dark">Proceed to Chekcout</a>
    </div>
  <?php endif; ?>
</div>
      
<?php } // endblock_body ?>