<section id="pickup" class="pickup">
  <h1 data-title="注目商品">PICK UP</h1>
  <?php if (!$pickup_data) : ?>
    <p class="empty">該当商品はありません</p>
  <?php else : ?>
    <ul class="product-list">
      <?php for ($i = 0; $i < min(4, count($pickup_data)); $i++) : ?>
        <li>
          <a href="product.php?id=<?php echo $pickup_data[$i]['product_id']; ?>">
            <div>
              <img src="img/<?php echo get_image($dbh, $pickup_data[$i]['product_id']) ?>" alt="<?php echo $pickup_data[$i]['product_name']; ?>">
              <p><?php echo $pickup_data[$i]['product_name']; ?><br><span><?php echo number_format($pickup_data[$i]['product_price']); ?>yen</span></p>
            </div>
          </a>
        </li>
      <?php endfor; ?>
    </ul>
    <div class="product-more">
      <a href="product_list.php?name=pickup&page=1" class="dotted-line">もっと見る</a>
    </div>
  <?php endif; ?>
</section>