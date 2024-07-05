<?php include_once('views/components/header.php'); ?>
<main id="main" class="main">
  <section class="home-search" id="top">
    <form action="product_list.php" method="get">
      <div class="home-search-content">
        <input type="hidden" name="name" value="search">
        <input type="hidden" name="page" value="1">
        <input type="search" name="word" id="search" placeholder="キーワード検索..">
        <button class="home-search-button">
          <input type="submit">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
    </form>
  </section>

  <figure class="MV fadeIn">
    <img class="MV-img mobile" src="img/MV300_300.jpg" alt="">
    <img class="MV-img pc" src="img/MV1320_600.jpg" alt="mainvisual">
    <div class="MV-content">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 363.63 63.99">
        <path class="cls-1" d="m335.72.53h-26.28l-23.76,63.01h6.57l8.1-20.88h19.8l9.45,20.88h34.03L335.72.53Zm-33.4,36.64l7.11-18.27,8.19,18.27h-15.3Zm-19.31,1.71c-.78,5.22-2.49,9.66-5.13,13.32-2.64,3.66-6.21,5.49-10.71,5.49s-8.1-2.91-10.26-8.73c-1.68-4.32-2.52-9.99-2.52-17.01,0-4.44.33-8.31.99-11.61.9-4.32,2.22-7.59,3.96-9.81,1.98-2.82,4.59-4.23,7.83-4.23,3.42,0,6.24,1.05,8.46,3.15,2.22,2.04,3.84,4.5,4.86,7.38,1.08,2.82,1.74,5.58,1.98,8.28h5.13c-.18-3.24-.84-6.51-1.98-9.81s-2.73-6.12-4.77-8.46c-2.46-2.82-5.64-4.65-9.54-5.49-3.84-.9-8.85-1.35-15.03-1.35-6.72,0-12.15.54-16.29,1.62s-7.89,3.3-11.25,6.66c-5.16,5.16-7.74,13.05-7.74,23.67s2.88,18,8.64,23.76c2.94,2.94,6.45,5.07,10.53,6.39,4.14,1.26,9.51,1.89,16.11,1.89,4.68,0,8.46-.18,11.34-.54,2.94-.36,5.61-1.14,8.01-2.34,2.46-1.26,4.65-3.15,6.57-5.67,3.42-4.56,5.55-10.08,6.39-16.56h-5.58Zm-77.12,13.32c-2.64,3.66-6.21,5.49-10.71,5.49s-8.1-2.91-10.26-8.73c-1.68-4.32-2.52-9.99-2.52-17.01,0-4.44.33-8.31.99-11.61.9-4.32,2.22-7.59,3.96-9.81,1.98-2.82,4.59-4.23,7.83-4.23,3.42,0,6.24,1.05,8.46,3.15,2.22,2.04,3.84,4.5,4.86,7.38,1.08,2.82,1.74,5.58,1.98,8.28h5.13c-.18-3.24-.84-6.51-1.98-9.81-1.14-3.3-2.73-6.12-4.77-8.46-2.46-2.82-5.64-4.65-9.54-5.49-3.84-.9-8.85-1.35-15.03-1.35-6.72,0-12.15.54-16.29,1.62-4.14,1.08-7.89,3.3-11.25,6.66-5.16,5.16-7.74,13.05-7.74,23.67s2.88,18,8.64,23.76c2.94,2.94,6.45,5.07,10.53,6.39,4.14,1.26,9.51,1.89,16.11,1.89,4.68,0,8.46-.18,11.34-.54,2.94-.36,5.61-1.14,8.01-2.34,2.46-1.26,4.65-3.15,6.57-5.67,3.42-4.56,5.55-10.08,6.39-16.56h-5.58c-.78,5.22-2.49,9.66-5.13,13.32ZM98.9.53l-23.76,63.01h6.57l8.1-20.88h19.8l9.45,20.88h34.03L125.18.53h-26.28Zm-7.11,36.64l7.11-18.27,8.19,18.27h-15.3ZM0,.53v5.22h34.21L0,63.54h70.93v-5.22h-34.11L70.93.53H0Z" />
      </svg>
      <p>Find your Favorites</p>
    </div>
  </figure>
  <div class="container">
    <?php include_once('views/components/pickup.php'); ?>

    <section id="products" class="products">
      <h1 data-title="新着商品">NEW ARRIVAL</h1>
      <?php if (!$new_arr_data) : ?>
        <p class="empty">該当商品はありません</p>
      <?php else : ?>
        <ul class="product-list">
          <?php for ($i = 0; $i < min(4, count($new_arr_data)); $i++) : ?>
            <li>
              <a href="product.php?id=<?= $new_arr_data[$i]['product_id']; ?>">
                <div>
                  <img src="img/<?= get_image($dbh, $new_arr_data[$i]['product_id']); ?>" alt="商品画像">
                  <p><?= $new_arr_data[$i]['product_name']; ?><br><span><?= number_format($new_arr_data[$i]['product_price']); ?>yen</span></p>
                </div>
              </a>
            </li>
          <?php endfor; ?>
        </ul>
        <div class="product-more">
          <a href="product_list.php?name=new_arr&page=1" class="dotted-line">もっと見る</a>
        </div>
      <?php endif; ?>
    </section>

    <section id="category" class="home-category">
      <h1 data-title="カテゴリーから探す">CATEGORY</h1>
      <?php include_once('views/components/category.php'); ?>
    </section>
    <section id="info">
      <h1 data-title="お知らせ">INFORMATION</h1>
      <ul class="home-info-list">
        <li>
          <p><span>2023.12.01</span>サイトリニューアル</p>
        </li>
        <li>
          <p><span>2023.11.24</span>新着商品更新しました</p>
        </li>
      </ul>

    </section>
  </div>

</main>

<?php include_once('views/components/footer_button.php'); ?>
<?php include_once('views/components/footer.php'); ?>


<!-- JavaScript -->
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>