<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-register">
      <h3>商品登録</h3>
      <div class="content">
        <div class="admin-init">
          <form action="" method="post">
            <label>入力数 : </label>
            <input type="text" name="input-row" value="<?= $input_row ?>" class="admin-input-num">
            <input type="submit" value="変更" id="product-input-change" class="admin-button admin-button-small">
          </form>
        </div>
        <form action="" method="post">
          <table class="admin-register">
            <tbody>
              <tr class="admin-table-header">
                <th class="admin-table-id">商品ID</th>
                <th class="admin-table-name">商品名</th>
                <th class="admin-table-price">価格</th>
                <th>カテゴリー</th>
                <th>タイプ</th>
                <th>ピックアップ</th>
              </tr>
              <?php for ($i = 0; $i < $input_row; $i++) : ?>
                <tr>
                  <td class="admin-register-td"> <?= $first_id + $i ?></td>
                  <td><input type="text" name="product-name-<?= $i + 1 ?>" id="product-name-<?= $i + 1 ?>" class="admin-register-name" value="<?= get_post('product-name-' . $i + 1) ?>"></td>
                  <td class="admin-table-right">
                    <div class="admin-table-price-flex">
                      <input type="text" name="product-price-<?= $i + 1 ?>" id="product-price-<?= $i + 1 ?>" class="admin-input-price" value="<?= get_post('product-price-' . $i + 1) ?>"><span class="admin-bottom">円</span>
                    </div>
                  </td>
                  <td>
                    <?php if (isset($err['category'])) : ?>
                      <p class="admin-table-err"><?= $err['category'] ?></p>
                      <input type="hidden" name="category-id-<?= $i + 1 ?>" value="0">
                    <?php else : ?>
                      <div class="select">
                        <select name="category-id-<?= $i + 1 ?>" id="product-category-<?= $i + 1 ?>">
                          <option value="0" selected disabled>選択してください</option>
                          <?php foreach ($category as $value) : ?>
                            <?php if ((int)get_post('category-id-' . $i + 1) === (int)$value['category_id']) : ?>
                              <option value="<?= $value['category_id'] ?>" selected><?= $value['category_name'] ?></option>
                            <?php else : ?>
                              <option value="<?= $value['category_id'] ?>"><?= $value['category_name'] ?></option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php
                    $type_list = get_array_post("type-name-" . $i + 1);
                    if ($type_list) {
                      $type_num = count($type_list);
                    } else {
                      $type_num = 0;
                    }
                    ?>
                    <div class="admin-type-init">
                      <input type="text" name="type-num-<?= $i + 1 ?>" id="type-num-<?= $i + 1 ?>" class="admin-input-num" value="<?= $type_num ?>"><span class="admin-bottom">個</span>
                      <button type="button" id="type-button-<?= $i + 1 ?>" class="admin-type-button">変更</button>
                      <button type="button" id="type-inc-<?= $i + 1 ?>" class="admin-type-icon admin-type-icon-inc">+</button>
                      <button type="button" id="type-dec-<?= $i + 1 ?>" class="admin-type-icon admin-type-icon-dec">-</button>
                    </div>

                    <p id="type-err-<?= $i + 1 ?>" class="admin-type-err"></p>
                    <ul class="admin-type-name" id="type-name-<?= $i + 1 ?>">
                      <?php if ($type_list) : ?>
                        <?php foreach ($type_list as $j => $value) : ?>
                          <li><span class="admin-type-number"><?= $j + 1 ?></span><span class="admin-type-number">:</span><input type="text" name="type-name-<?= $i + 1 ?>[]" value="<?= $value ?>"></li>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </ul>
                  </td>
                  <td>
                    <ul class="admin-input-radio">
                      <li><input type="radio" name="pickup-<?= $i + 1 ?>" value="0" class="product-pickup-<?= $i + 1 ?>" checked><span>しない</span></li>
                      <li><input type="radio" name="pickup-<?= $i + 1 ?>" value="1" class="product-pickup-<?= $i + 1 ?>"><span>する</span></li>
                    </ul>
                  </td>
                </tr>
              <?php endfor; ?>
            </tbody>
          </table>
          <input type="hidden" name="input-row-submit" id="product-input-num-sub" value="<?= $input_row ?>">
          <input type="submit" value="登録" class="admin-button admin-button-main">
        </form>
      </div>
      <?php if (isset($err['register_product'])) : ?>
        <?php foreach ($err['register_product'] as $key => $value) : ?>
          <p class="admin-err"><?= ($key + 1) . '行目の' . $value ?></p>
        <?php endforeach; ?>
      <?php endif; ?>
    </section>
  </div>
</main>

<!-- JavaScript -->
<script>
  let rowNum = "<?= $input_row ?>";
</script>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript" src="js/admin_product.js"></script>

</body>

</html>