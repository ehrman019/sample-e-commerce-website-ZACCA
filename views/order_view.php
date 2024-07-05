<?php include_once('views/components/header.php'); ?>
<main id="main" class="main">
  <div class="container order-container">
    <section class="order">
      <div class="order-flex">
        <div class="order-left">
          <div class="order-content">
            <p class="order-title">宛て先</p>
            <p class="order-user-name"><?= $user['last_name'] ?> <?= $user['first_name'] ?> 様</p>
            <p class="order-user-zipcode">〒<?= $user['zipcode'] ?></p>
            <p class="order-user-address"><?= $prefectures[$user['prefecture'] - 1] ?> <?= $user['city'] ?> <?= $user['address'] ?><br>
              <?php if ($user['building']) echo $user['building']; ?></p>
          </div>
          <div class="order-content">
            <p class="order-title">お支払い方法</p>
            <p>***</p>
          </div>
        </div>
        <div class="order-right">
          <div class="order-content">
            <p class="order-title">ご注文内容</p>
            <?php $total = 0; ?>
            <ul class="order-list">
              <?php foreach ($order as $i => $value) : ?>
                <?php $product = get_product_data($dbh, $value['product_id']);
                $type_data = get_type_name($dbh, $value['product_id'], $value['type_id']); ?>
                <li>
                  <figure class="order-list-img">
                    <img src="img/<?= get_image($dbh, $value['product_id']) ?>" alt="<?= $product['product_name'] ?>">
                  </figure>
                  <div class="order-list-content">
                    <div class="order-info">
                      <p class="order-name"><?= $product['product_name'] ?></p>
                      <p class="order-type"><?= $type_data['type_name'] ?></p>
                      <p class="order-price" data-price="<?= $product['product_price'] ?>"><?= number_format($product['product_price']) ?>yen * <?= $value['quantity'] ?>個</p>
                    </div>
                    <div class="order-subtotal-content">
                      <p class="order-subtotal-text">小計</p>
                      <p class="order-subtotal order-subtotal-tax order-tax"><?= number_format($product['product_price'] * $value['quantity']) ?></p>
                    </div>
                  </div>
                </li>
                <?php $total += $product['product_price'] * $value['quantity']; ?>
              <?php endforeach; ?>
            </ul>

            <div class="order-total-content">
              <p class="order-total-text">ご請求金額</p>
              <p class="order-total order-total-tax order-tax"><?= number_format($total) ?></p>
            </div>
            <form action="" method="post">
              <input type="hidden" name="name" value="order">
              <input type="submit" class="button button-long" id="order-button" value="注文確定">
            </form>
          </div>

        </div>
      </div>
    </section>
  </div>
</main>
<?php include_once('views/components/footer_button.php'); ?>
<?php include_once('views/components/footer.php'); ?>

<!-- JavaScript -->
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/order.js"></script>


</body>

</html>