<?php $extend_layout = 'layout'; ?>

<?php function block_body($context) { ?>

<div class="products_container">
  <div class="showcase">
    <?php if(isset($context['categories'])): ?>
      <?php foreach($context['categories'] as $category): ?>
        <div class="category_title">
          <h2> <?php echo $category->name; ?> </h2>
        </div>
        
        <?php foreach($context['products'] as $product): ?>
          <?php if($product->category == $category->id): ?>
            <div class="product_card">
              <div class="product_image">
                <a href="/flamingo/products/<?php echo "$product->category/$product->id" ; ?>/">
                  <img src="<?php url_for('images/product-1.jpg'); ?>" alt="">
                </a>
              </div>
              <div class="product_info">
                <div class="card_title">
                  <h4> <?php echo $product->name; ?> </h4>
                </div>
                <div class="card_price">
                  <h6><span> <?php echo $product->price; ?> </span></h6>
                </div>
                <div class="card_extra">
                  
                </div>
                <div class="add_to_cart">
                  
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
      
<?php } // endblock_body ?>