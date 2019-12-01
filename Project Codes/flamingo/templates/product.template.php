<?php $extend_layout = 'layout'; ?>

<?php function block_body($context) { ?>

<div class="products_container">
  <div class="showcase">
    <div class="product_details">
      <img src="<?php url_for('images/product-1.jpg'); ?>" alt="">
    </div>
    
    <div class="product_details">
      <div>
        <h1><?php echo $context['product']->name; ?></h1>
        <h4><?php echo $context['product']->price; ?></h4>
      </div>
      <button type="button" class="btn btn-outline-info">Add to cart</button>
    </div>
  </div>
</div>
      
<?php } // endblock_body ?>