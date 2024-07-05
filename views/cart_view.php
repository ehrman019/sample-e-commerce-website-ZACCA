<?php include_once('views/components/header.php'); ?>
<main id="main" class="main">
  <div class="container">
    <section class="cart">
      <h1 data-title="カート">CART</h1>
      <?php if (!$cart) : ?>
        <p class="empty">カートに商品がありません</p>
      <?php else : ?>
        <div class="cart-content">

          <form action="checkout.php" method="post">
            <ul class="cart-list">
              <?php foreach ($cart as $i => $value) : ?>
                <?php $product = get_product_data($dbh, $value['product_id']);
                $type_data = get_type_name($dbh, $value['product_id'], $value['type_id']); ?>
                <li>
                  <figure class="cart-list-img">
                    <a href="product.php?id=<?= $value['product_id'] ?>">
                      <img src="img/<?= get_image($dbh, $value['product_id']) ?>" alt="<?= $product['product_name'] ?>">
                    </a>
                  </figure>
                  <div class="cart-list-content">
                    <div class="cart-info">
                      <p class="cart-name"><a href="product.php?id=<?= $value['product_id'] ?>"><?= $product['product_name'] ?></a></p>
                      <p class="cart-type"><?= $type_data['type_name'] ?></p>
                      <p class="cart-price" data-price="<?= $product['product_price'] ?>"><?= number_format($product['product_price']) ?></p>
                    </div>
                    <div class="cart-quantity">
                      <div class="quantity">
                        <input type="text" class="quantity-input" value="<?= $value['quantity'] ?>">
                        <button type="button" class="quantity-dec quantity-button"></button>
                        <button type="button" class="quantity-inc quantity-button"></button>
                      </div>
                      <a href="delete_cart.php?id=<?= $value['product_id'] ?>&type=<?= $type_data['type_id'] ?>" class="delete">削除</a>
                    </div>
                    <div class="cart-subtotal-content">
                      <p class="cart-subtotal-text">小計</p>
                      <p class="cart-subtotal cart-subtotal-tax cart-tax"></p>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>

            </ul>
            <div class="cart-total-content">
              <div class="cart-calc">
                <button type="button" id="cart-calc-button">再計算</button>
              </div>
              <p class="cart-total-text">合計金額</p>
              <p class="cart-total cart-total-tax cart-tax" id="cart-total"></p>
            </div>
            <button type="button" class="button button-long" id="cart-button">購入手続きへ</button>
          </form>
        </div>
      <?php endif; ?>
    </section>
    <?php include_once('views/components/pickup.php'); ?>
  </div>
</main>
<?php include_once('views/components/footer_button.php'); ?>
<?php include_once('views/components/footer.php'); ?>


<!-- JavaScript -->
<script>
  <?php $cart = json_encode($cart); ?>
  const cart = JSON.parse('<?= $cart; ?>');
</script>
<script type="text/javascript" src="js/script.js"></script>
<?php if (!empty($cart)) : ?>
  <?= '<script type="text/javascript" src="js/cart.js"></script>'; ?>
<?php endif; ?>

</body>

</html>