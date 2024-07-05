<?php include_once('views/components/header.php'); ?>

<main id="main" class="main">
  <div class="container">
    <section class="product">
      <div class="product-content">
        <div class="product-images">
          <div class="product-img-flame">
            <figure class="product-img" id="product-img">
              <button class="product-favorite" id="product-favorite">
                <i class="fa-regular fa-heart" id="favorite-icon"></i>
              </button>
            </figure>
          </div>
          <figure class="product-thumb">
            <button type="button" id="thumb-prev"><i class="fa-solid fa-chevron-left"></i></button>
            <div class="product-thumb-list" id="product-thumb-list">

            </div>
            <button type="button" id="thumb-nex"><i class="fa-solid fa-chevron-right"></i></button>
          </figure>
        </div>
        <div class="product-form">
          <div class="product-info">
            <div class="product-info-content">
              <p class="product-name"><?= $product['product_name'] ?></p>
              <p class="product-price"><?= number_format($product['product_price']) ?>yen</p>

              <div class="product-select">
                <div class="select">
                  <select name="type" id="type" class="select-hidden">
                    <option value="0" hidden>タイプ選択</option>
                    <?php foreach ($type as $value) : ?>
                      <option value="<?= $value['type_id'] ?>"><?= $value['type_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <p class="product-err" id="type-err"></p>
              </div>
              <div class="product-quantity">
                <div class="quantity">
                  <input type="text" class="quantity-input" id="quantity-input" name="quantity" value="1">
                  <button type="button" class="quantity-dec quantity-button"></button>
                  <button type="button" class="quantity-inc quantity-button"></button>
                </div>
                <p class="product-err" id="product-err"></p>
              </div>

            </div>
            <a href="add_favorite.php?id=<?= $product_id ?>"></a>
            <button type="button" class="button button-long" id="product-button">カートに入れる</button>
            <div class="product-detail-text">
              <p><?php if($product['product_description']) echo nl2br($product['product_description']) ?></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include_once('views/components/pickup.php'); ?>
  </div>
</main>

<aside class="page-modal" id="product-modal">
  <div class="page-modal-content">
    <p>カートに商品が入りました</p>
    <a href="cart.php" class="button button-short">カートを見る</a>
    <a href="product.php?id=<?= $product_id ?>" class="button button-short">お買い物に戻る</a>
  </div>
</aside>

<?php include_once('views/components/footer_button.php'); ?>
<?php include_once('views/components/footer.php'); ?>



<!-- JavaScript -->
<script>
  const productID = Number("<?= $product_id ?>");
  const imgNum = Number("<?= $product['product_img_num'] ?>");
  let favorite = Number("<?= $favorite ?>");
</script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/product.js"></script>

</body>

</html>