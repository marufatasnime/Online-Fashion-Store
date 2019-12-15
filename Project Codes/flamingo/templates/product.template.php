<?php $extend_layout = 'layout'; ?>

<?php function block_body($context) { ?>

<?php $product = $context['product']; ?>
<div class="products_container">
  <div class="showcase">
    <div class="product_details">
      <img src="<?php url_for('images/product-1.jpg'); ?>" alt="">
    </div>
    
    <div class="product_details">
      <div>
        <h1><?php echo $product->name; ?></h1>
        <h4><?php echo $product->price; ?></h4>
      </div>
      <a href="/flamingo/cart/<?php echo "$product->category/$product->id"; ?>" class="btn btn-outline-info">Add to cart</a>
    </div>
  </div>
</div>
      
<?php } // endblock_body ?>