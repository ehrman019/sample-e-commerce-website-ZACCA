<?php include_once('views/components/header.php'); ?>
<main id="main" class="main">
  <div class="container">
    <section class="mypage-order">
      <h1 data-title="注文履歴">MY PAGE</h1>
      <div class="mypage-order-content">
        <?php if (!$order_list) : ?>
          <p class="empty">注文履歴がありません</p>
        <?php else : ?>
          <?php foreach ($order_list as $i => $order) : ?>
            <?php
            $created_at = new DateTime($list[$i]['created_at']);
            $order_title = $created_at->format('Y年m月d日')
            ?>
            <h2><?= '注文日 : ' . $order_title ?></h2>
            <div class="mypage-order-flex">
              <div class="mypage-order-left">
                <div class="order-content">
                  <p class="order-title">宛て先</p>
                  <p class="order-user-name"><?= $list[$i]['order_name'] ?> 様</p>
                  <p class="order-user-zipcode">〒<?= $list[$i]['order_zipcode'] ?></p>
                  <p class="order-user-address">
                    <?= $list[$i]['order_address'] ?>
                    <?php if ($list[$i]['order_building']) : ?>
                      <br><?= $list[$i]['order_building']; ?>
                    <?php endif; ?>
                  </p>
                </div>
                <div class="order-content">
                  <p class="order-title">お支払い方法</p>
                  <p>***</p>
                </div>
              </div>
              <div class="mypage-order-right">
                <div class="order-content">
                  <p class="order-title">ご注文内容</p>
                  <?php $total = 0; ?>
                  <ul class="order-list">
                    <?php foreach ($order as $i => $value) : ?>
                      <?php $prod = get_product_data($dbh, $value['product_id']);
                      $type_data = get_type_name($dbh, $value['product_id'], $value['type_id']); ?>
                      <li>
                        <figure class="order-list-img">
                          <a href="product.php?id=<?= $value['product_id'] ?>" target="_blank"><img src="img/<?= get_image($dbh, $value['product_id']) ?>" alt="<?= $prod['product_name'] ?>"></a>
                        </figure>
                        <div class="order-list-content">
                          <div class="order-info">
                            <p class="order-name"><a href="product.php?id=<?= $value['product_id'] ?>" target="_blank"><?= $prod['product_name'] ?></a></p>
                            <p class="order-type"><?= $type_data['type_name'] ?></p>
                            <p class="order-price" data-price="<?= $prod['product_price'] ?>"><?= number_format($prod['product_price']) ?>yen * <?= $value['quantity'] ?>個</p>
                          </div>
                          <div class="order-subtotal-content">
                            <p class="order-subtotal-text">小計</p>
                            <p class="order-subtotal order-subtotal-tax order-tax"><?= number_format($prod['product_price'] * $value['quantity']) ?></p>
                          </div>
                        </div>
                      </li>
                      <?php $total += $prod['product_price'] * $value['quantity']; ?>
                    <?php endforeach; ?>
                  </ul>

                  <div class="order-total-content">
                    <p class="mypage-order-total-text">合計</p>
                    <p class="mypage-order-total mypage-order-total-tax order-tax"><?= number_format($total) ?></p>
                  </div>
                </div>

              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>
  </div>
</main>
<?php include_once('views/components/footer_button.php'); ?>
<?php include_once('views/components/footer.php'); ?>

<!-- JavaScript -->
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>