<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-product">
      <h3>商品情報</h3>
      <h4>商品情報詳細</h4>
      <?php if (!$product_data) : ?>
        <p class="admin-err">データが存在しません</p>
      <?php else : ?>
        <table class="admin-table-vertical">
          <tbody>
            <tr>
              <th>商品ID</th>
              <td><?= $product_data['product_id'] ?></td>
            </tr>
            <tr>
              <th>商品名</th>
              <td><?= $product_data['product_name'] ?></td>
            </tr>
            <tr>
              <th>価格</th>
              <td><?= number_format($product_data['product_price']) ?>円</td>
            </tr>
            <tr>
              <th>カテゴリー</th>
              <?php if (!isset($category_name)) : ?>
                <td>
                  <p class="admin-table-err">データが存在しません</p>
                </td>
              <?php else : ?>
                <td><?= $category_name ?></td>
              <?php endif; ?>
            </tr>
            <tr>
              <th>ピックアップ</th>
              <?php if ($product_data['pickup']) : ?>
                <td>あり</td>
              <?php else : ?>
                <td>なし</td>
              <?php endif; ?>
            </tr>
            <?php if (!$type_data) : ?>
              <tr>
                <th>タイプ</th>
                <td>
                  <p class="admin-table-err">データが存在しません</p>
                </td>
              </tr>
            <?php else : ?>
              <tr>
                <th>タイプ数</th>
                <td><?= count($type_data) ?></td>
              </tr>
            <?php endif; ?>
            <tr>
              <th>商品説明</th>
              <td>
                <?php if ($product_data['product_description']) echo nl2br($product_data['product_description']) ?>
              </td>
            </tr>
          </tbody>
        </table>

        <?php if ($type_data) : ?>
          <table class="admin-table-white">
            <tbody>
              <tr>
                <th>タイプID</th>
                <th class="admin-table-type">タイプ名</th>
                <th>在庫数</th>
              </tr>
              <?php foreach ($type_data as $type) : ?>
                <tr>
                  <td><?= $type['type_id'] ?></td>
                  <td><?= $type['type_name'] ?></td>
                  <td><?= $type['quantity'] ?></td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
        <?php endif; ?>
        <ul class="admin-flex">
          <li><a href="edit_product_detail.php?id=<?= $product_id ?>" class="admin-button admin-button-main">編集</a></li>
          <li><a href="purchase.php" class="admin-button admin-button-main" target="_blank">入荷登録</a></li>
        </ul>

        <h4>現在の画像</h4>
        <ul class="admin-product-img-flex admin-product-img-list">
          <?php for ($i = 0; $i < $product_data['product_img_num']; $i++) : ?>
            <li>
              <div class="admin-product-img-list-label">
                <p><?= $i + 1 ?>.</p>
              </div>
              <img src="../img/<?= $product_data['product_id'] ?>_<?= $i + 1 ?>.jpg" alt="<?= $product_data['product_name'] . '_' . $i + 1 ?>" class="admin-img">
            </li>
          <?php endfor; ?>
        </ul>

        <a href="edit_product_img.php?id=<?= $product_id ?>" class="admin-button admin-button-main">編集</a>


      <?php endif; ?>

    </section>
  </div>
</main>

<script type="text/javascript" src="js/admin.js"></script>
</body>

</html>