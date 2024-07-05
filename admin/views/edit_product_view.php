<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-product">
      <h3>商品情報一覧</h3>
      <div class="admin-init">
        <ul class="admin-flex">
          <li>
            <form action="" method="post">
              <label>商品ID : </label>
              <input type="text" name="edit-id" value="<?php if (isset($edit_id))  echo html_escape($edit_id) ?>" class="admin-input-num-long" id="admin-input-product-num">
              <input type="hidden" name="process" value="edit-id">
              <input type="submit" value="検索" class="admin-button admin-button-main">
            </form>
          </li>
          <li>
            <form action="" method="post">
              <label>商品名 : </label>
              <input type="text" name="edit-name" value="<?php if (isset($edit_name))  echo html_escape($edit_name) ?>" class="" id="admin-input-product-num">
              <input type="hidden" name="process" value="edit-name">
              <input type="submit" value="検索" class="admin-button admin-button-main">
            </form>
          </li>
        </ul>
        <a href="edit_product.php" class="admin-button admin-button-main">すべて表示</a>
      </div>

      <table>
        <tbody id="admin-product-input-table">
          <tr>
            <th class="admin-table-id">商品ID</th>
            <th class="admin-table-name">商品名</th>
            <th class="admin-table-price">価格</th>
            <th>カテゴリー</th>
            <th>PK</th>
            <th>詳細</th>
          </tr>
          <?php if ($list) : ?>
            <?php foreach ($list as $value) : ?>
              <?php
              if (!$category_data = get_category_name($dbh, $value['category_id'])) {
                $err['category'] = 'データを取得できません';
              } else {
                $category_name = $category_data['category_name'];
              }
              if (!$type_data = get_type_data($dbh, $value['product_id'])) {
                $err['type'] = 'データを取得できません';
              }
              ?>
              <tr>
                <td><?= $value['product_id']  ?></td>
                <td><?= $value['product_name'] ?></td>
                <td class="admin-right"><?= number_format($value['product_price']) . '円' ?></td>
                <?php if (isset($err['category'])) : ?>
                  <td><?= $err['category'] ?></td>
                <?php else : ?>
                  <td><?= $category_name ?></td>
                <?php endif; ?>

                <td>
                  <?php if ($value['pickup']) : ?>
                    <p><i class="fa-solid fa-check"></i></p>
                  <?php else : ?>
                    <p>-</p>
                  <?php endif; ?>
                </td>
                <td>
                  <div class="admin-button-icon">
                    <a href="product.php?id=<?= $value['product_id'] ?>" target="_blank"></a>
                    <i class="fa-solid fa-tag"></i>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
      <?php if (!$list) : ?>
        <p class="admin-err">データが存在しません</p>
      <?php endif; ?>
    </section>
  </div>
</main>

<!-- JavaScript -->

<script type="text/javascript" src="js/admin.js"></script>

</body>

</html>