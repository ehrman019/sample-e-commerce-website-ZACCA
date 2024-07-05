<?php include_once('views/components/header.php'); ?>

<main id="main" class="main">
  <div class="container">
    <section class="search">
      <h1 data-title="商品検索">SEARCH</h1>
      <div class="search-content">
        <div class="search-keyword" id="search-keyword">
          <p class="search-title">キーワード検索</p>
          <form action="product_list.php" method="get">
            <div class="search-keyword-content">
              <input type="hidden" name="name" value="search">
              <input type="hidden" name="page" value="1">
              <input type="search" name="word" placeholder="キーワード検索..">
              <button class="search-keyword-content-button"><i class="fa-solid fa-magnifying-glass"></i><input type="submit" value=""></button>
            </div>
          </form>
        </div>

        <div class="search-category" id="search-category">
          <p class="search-title">カテゴリー検索</p>

          <?php include_once('views/components/category.php'); ?>

        </div>
      </div>

    </section>

    <?php include_once('views/components/pickup.php'); ?>

  </div>

</main>

<?php include_once('views/components/footer.php'); ?>

<!-- JavaScript -->
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>