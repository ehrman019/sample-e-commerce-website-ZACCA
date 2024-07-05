<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-product">
      <h3>注文詳細</h3>
      <?php if (!$order_data || !$order_detail) : ?>
        <p class="admin-err">データが存在しません</p>
      <?php else : ?>
        <table class="admin-table-vertical">
          <tbody>
            <tr>
              <th>注文ID</th>
              <td><?= $order_data['order_id'] ?></td>
            </tr>
            <tr>
              <th>お客様名</th>
              <td>
                <div class="admin-flex">
                  <?= $order_data['order_name'] ?>
                  <form action="users_detail.php" method="post" target="_blank">
                    <div class="admin-button-icon admin-button-icon-td">
                      <input type="hidden" name="id" value="<?= $order_data['user_id'] ?>">
                      <input type="submit" value="">
                      <i class="fa-solid fa-circle-user"></i>
                    </div>
                  </form>
                </div>
              </td>
            </tr>
            <tr>
              <th>住所</th>
              <td>
                <?= '〒' . $order_data['order_zipcode'] ?><br><?= $order_data['order_address'] ?>
                <?php if ($order_data['order_building']) : ?>
                  <br><?= $order_data['order_building'] ?>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>注文日時</th>
              <td><?= format_date($order_data['created_at']) ?></td>
            </tr>

          </tbody>
        </table>

        <h4>注文内容</h4>
        <?php $total = 0; ?>
        <table class="admin-table-white">
          <tr>
            <th class="admin-table-name">商品名</th>
            <th>タイプ</th>
            <th>値段</th>
            <th>個数</th>
            <th>小計</th>
          </tr>
          <?php foreach ($order_detail as $value) : ?>
            <?php $product = get_product_data($dbh, $value['product_id']); ?>
            <?php $type_name = get_type_name($dbh, $value['product_id'], $value['type_id']); ?>
            <tr>
              <td>
                <div class="admin-flex">
                  <?= $product['product_name'] ?>
                  <div class="admin-button-icon admin-button-icon-td">
                    <a href="product.php?id=<?= $product['product_id'] ?>" target="_blank"></a>
                    <i class="fa-solid fa-tag"></i>
                  </div>
                </div>
              </td>
              <td class="admin-left">
                <?= $type_name['type_id'] . ' : ' . $type_name['type_name'] ?>
              </td>
              <td class="admin-right">
                <?= number_format($product['product_price']) . '円' ?>
              </td>
              <td class="admin-right">
                <?= $value['quantity'] ?>
              </td>
              <td class="admin-right">
                <?= number_format($product['product_price'] * $value['quantity']) . '円' ?>
              </td>
            </tr>

            <?php $total += $product['product_price'] * $value['quantity']; ?>
          <?php endforeach; ?>
          <tr class="admin-table-order-tr">
            <td colspan="4">
              合計
            </td>
            <td><?= number_format($total) . ' 円' ?></td>
          </tr>
        </table>
      <?php endif; ?>
    </section>
  </div>
</main>

<script type="text/javascript" src="js/admin.js"></script>
</body>

</html>