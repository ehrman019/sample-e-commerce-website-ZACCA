<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-product-img">
      <h3>画像アップロード・編集</h3>
      <?php if (!$product_data) : ?>
        <p class="admin-err">商品が存在しません</p>
        <a href="edit_prod.php" class="admin-button admin-button-main">一覧へ戻る</a>
      <?php else : ?>
        <table>
          <tbody id="admin-product-input-table">
            <tr>
              <th class="admin-table-id">商品ID</th>
              <th class="admin-table-name">商品名</th>
              <th class="admin-table-price">価格</th>
              <th>カテゴリー</th>
              <th>タイプ</th>
              <th>PK</th>
            </tr>
            <tr>
              <td><?= $product_data['product_id']  ?></td>
              <td><?= $product_data['product_name'] ?></td>
              <td class="admin-right"><?= number_format($product_data['product_price']) . '円' ?></td>
              <td>
                <?php if (!isset($category_name)) : ?>
                  <p class="admin-table-err">データを取得できません</p>
                <?php else : ?>
                  <?= $category_name ?>
                <?php endif; ?>
              </td>
              <td>
                <?php if (!$type_data) : ?>
                  <p class="admin-table-err">データを取得できません</p>
                <?php else : ?>
                  <ul class="admin-type-name admin-table-left">
                    <?php foreach ($type_data as $type) : ?>
                      <li class="admin-left"><span class="admin-type-number"><?= $type['type_id'] ?></span> <span class="admin-type-number">:</span><?= $type['type_name'] ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </td>
              <td>
                <?php if ($product_data['pickup']) : ?>
                  <p><i class="fa-solid fa-check"></i></p>
                <?php else : ?>
                  <p>-</p>
                <?php endif; ?>
              </td>
            </tr>
          </tbody>
        </table>

        <h4>新規画像アップロード</h4>
        <div class="admin-product-img-content">
          <p>JPEG 500px*500px 上限: 10枚</p>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="admin-product-img-form">
              <label class="admin-product-img-button admin-button">
                画像を選択<input type="file" name="product-img[]" id="img-submit" multiple>
              </label>
              <p id="img-select-text">複数選択できます</p>
              <input type="submit" value="アップロード" class="admin-button admin-button-main">
            </div>
          </form>
          <div class="admin-product-img-upload">
            <div id="drop-img" class="admin-product-img-drop">
              <p>ファイルをドラッグ</p>

            </div>
            <ul id="select-img" class="admin-product-img-flex admin-product-img-drop">
            </ul>
          </div>
        </div>

        <?php if (isset($err['img'])) : ?>
          <p><?= $err['img'] ?></p>
        <?php endif; ?>

        <h4>現在の画像</h4>
        <ul class="admin-product-img-flex admin-product-img-list">
          <?php for ($i = 0; $i < $product_data['product_img_num']; $i++) : ?>
            <li>
              <div class="admin-product-img-list-label">
                <p><?= $i + 1 ?>.</p>
                <a href="delete_product_img.php?id=<?= $product_data['product_id'] ?>&img=<?= $i + 1 ?>"> 削除</a>
              </div>
              <img src="../img/<?= $product_data['product_id'] ?>_<?= $i + 1 ?>.jpg?<?= date('YmdHis') ?>" alt="<?= $product_data['product_name'] . '_' . $i + 1 ?>">
            </li>
          <?php endfor; ?>
        </ul>

      <?php endif; ?>
    </section>
  </div>
</main>

<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript" src="js/admin_img.js"></script>

</body>

</html>