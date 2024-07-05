<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-purchase">
      <h3>入荷登録</h3>
      <div class="admin-init">
        <ul>
          <li>
            <form action="" method="post">
              <label>商品ID : </label>
              <?php if (isset($product_id)) : ?>
                <input type="text" name="product-id" value="<?= html_escape($product_id) ?>" class="admin-input-num">
              <?php else : ?>
                <input type="text" name="product-id" value="" class="admin-input-num">
              <?php endif ?>

              <input type="hidden" name="process" value="product">
              <input type="submit" value="設定" class="admin-button admin-button-small">
              <p class="admin-init-label">商品名:</p>
              <?php if (isset($err['purchase'])) : ?><p class="admin-init-note"><?= $err['purchase'] ?></p>
              <?php elseif (isset($product_id)) : ?>
                <p class="admin-init-text"><?= $product_data['product_name'] ?></p>
              <?php else : ?>
                <p class="admin-init-note">商品を設定すると表示されます</p>
              <?php endif; ?>
            </form>
          </li>
          <li>
            <form action="" method="post">
              <label>タイプ : </label>
              <?php if (isset($product_id) && $type_data) : ?>
                <div class="select">
                  <select name="type-id" class="select-hidden">
                    <option value="" disabled selected>選択してください</option>
                    <?php foreach ($type_data as $value) : ?>
                      <option value="<?= $value['type_id'] ?>"><?= $value['type_id'] . '.' . $value['type_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <input type="hidden" name="process" value="type">
                <input type="hidden" name="product-id" value="<?= $product_id ?>">
                <input type="submit" value="設定" class="admin-button admin-button-small">
              <?php elseif (isset($err['purchase_type'])) : ?><p class="admin-init-note"><?= $err['purchase_type'] ?></p>
              <?php else : ?>
                <p class="admin-init-note">商品を設定すると表示されます</p>
              <?php endif ?>
            </form>
          </li>
        </ul>
      </div>
      <form action="" method="post">
        <table>
          <tbody id="admin-product-input-table">
            <tr>
              <th class="admin-table-id">商品ID</th>
              <th class="admin-table-name">商品名</th>
              <th>タイプ</th>
              <th class="admin-table-num">在庫数</th>
              <th class="admin-table-num">入荷数</th>
            </tr>
            <?php if (isset($product_id) && isset($type_name)) : ?>
              <tr>
                <td><?= $product_data['product_id'] ?></td>
                <td>
                  <div class="admin-flex">
                    <?= $product_data['product_name'] ?>
                    <div class="admin-button-icon admin-button-icon-td">
                      <a href="product.php?id=<?= $product_data['product_id'] ?>" target="_blank"></a>
                      <i class="fa-solid fa-tag"></i>
                    </div>
                  </div>
                </td>
                <td class="admin-table-type-short"><span><?= $type_name['type_id'] . ' : ' ?></span><?= $type_name['type_name'] ?></td>
                <td class="admin-right"><?= $type_name['quantity'] ?></td>

                <td class="admin-right"><input type="text" name="product-quantity" class="admin-input-num" value=""></td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <?php if (isset($product_id) && isset($type_name)) : ?>
          <input type="hidden" name="process" value="purchase">
          <input type="hidden" name="product-id" value="<?= $product_id ?>">
          <input type="hidden" name="type-id" value="<?= $type_name['type_id'] ?>">
          <input type="submit" value="登録" class="admin-button admin-button-main">
        <?php else : ?>
          <p class="admin-init-note">商品・タイプを設定してください</p>
        <?php endif; ?>
      </form>
    </section>
  </div>
</main>

<script type="text/javascript" src="js/admin.js"></script>
</body>

</html>