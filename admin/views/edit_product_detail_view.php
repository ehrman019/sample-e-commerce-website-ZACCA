<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-product">
      <h3>商品情報の編集</h3>
      <div class="content">
        <?php if (!$product_data) : ?>
          <p class="admin-err">商品が存在しません</p>
          <a href="edit_product.php" class="admin-button admin-button-main">一覧へ戻る</a>
        <?php else : ?>
          <form action="" method="post">
            <table class="admin-table-vertical admin-table-vertical-product">
              <tbody>
                <tr>
                  <th>商品ID <span>※変更不可</span></th>
                  <td><?= $product_data['product_id']  ?></td>
                </tr>
                <tr>
                  <th>商品名</th>
                  <td><input type="text" name="product-name" id="product-name-1" class="admin-input-name" value="<?= $product_data['product_name'] ?>"></td>
                </tr>
                <tr>
                  <th>価格</th>
                  <td><input type="text" name="product-price" id="product-price-1" class="admin-input-price" value="<?= $product_data['product_price'] ?>">円</td>
                </tr>
                <tr>
                  <th>カテゴリー</th>
                  <td>
                    <?php if (isset($err['category'])) : ?>
                      <p class="admin-table-err"><?= $err['category'] ?></p>
                    <?php else : ?>
                      <div class="select">
                        <select name="category-id" id="product-category-1">
                          <option value="0" selected disabled>選択してください</option>
                          <?php foreach ($category as $value) : ?>
                            <?php if ($product_data['category_id'] === $value['category_id']) : ?>
                              <option value="<?= $value['category_id'] ?>" selected><?= $value['category_name'] ?></option>
                            <?php else : ?>
                              <option value="<?= $value['category_id'] ?>"><?= $value['category_name'] ?></option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <th>ピックアップ</th>
                  <td>
                    <ul class="admin-input-radio">
                      <li><input type="radio" name="pickup" value="0" class="product-pickup" <?php if (!$product_data['pickup']) echo 'checked' ?>><span>しない</span></li>
                      <li><input type="radio" name="pickup" value="1" class="product-pickup" <?php if ($product_data['pickup']) echo 'checked' ?>><span>する</span></li>
                  </td>
                </tr>

                <tr>
                  <th>タイプ</th>
                  <td>
                    <div class="admin-type-init">
                      <input type="text" name="type-num" id="type-num-1" class="admin-input-num" value="<?= $type_num ?>">個
                      <button type="button" id="type-button-1" class="admin-type-button">変更</button>
                      <button type="button" id="type-inc-1" class="admin-type-icon admin-type-icon-inc">+</button>
                      <button type="button" id="type-dec-1" class="admin-type-icon admin-type-icon-dec">-</button>
                    </div>

                    <p id="type-err-1" class="admin-type-err"></p>
                    <ul class="admin-type-name" id="type-name-1">
                      <?php if ($type_list) : ?>
                        <?php foreach ($type_list as $value) : ?>
                          <li><span class="admin-type-number"><?= $value['type_id'] ?></span><span class="admin-type-number">:</span><input type="text" name="type-name-1[]" value="<?= $value['type_name'] ?>"></li>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </ul>
                  </td>
                </tr>

                <tr>
                  <th>商品説明</th>
                  <td><textarea type="text" name="product-description" id="product-description-1" class="admin-input-description" col="17" row="15"><?= $product_data['product_description'] ?></textarea></td>
                </tr>

              </tbody>
            </table>
            <input type="submit" value="更新" class="admin-button admin-button-main">
          </form>
        <?php endif; ?>
      </div>
      <?php if (isset($err['edit_prod'])) : ?>
        <p class="admin-err"> <?= $err['edit_prod'] ?></p>
      <?php endif; ?>
    </section>
  </div>
</main>

<!-- JavaScript -->
<script>
  let rowNum = 1;
</script>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript" src="js/admin_product.js"></script>

</body>

</html>