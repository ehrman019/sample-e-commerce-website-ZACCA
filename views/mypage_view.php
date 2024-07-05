<?php include_once('views/components/header.php'); ?>

<main id="main" class="main">
  <div class="container">
    <section>
      <h1 data-title="マイページ">MY PAGE</h1>
      <p class="mypage-name"><?= $user['last_name'] . ' ' . $user['first_name'] . ' 様' ?></p>
      <div class="mypage-content">
        <ul>
          <li><a href="mypage_order.php">注文履歴</a></li>
          <li><a href="mypage_edit.php" target="_blank">会員情報の編集</a></li>
          <li><a href="product_list.php?name=favorite&page=1">お気に入り一覧</a></li>
        </ul>
        <ul>
          <li><a href="logout.php">ログアウト</a></li>
          <li id="delete-account-button"><a>退会する</a></li>
        </ul>
      </div>
    </section>
    <section id="favorites" class="mypage-favorites">
      <h1 data-title="お気に入り">FAVORITES</h1>
      <?php if (!$fav_data) : ?>
        <p class="empty">該当商品はありません</p>
      <?php else : ?>
        <ul class="product-list">
          <?php for ($i = 0; $i < min(8, count($fav_data)); $i++) : ?>
            <li>
              <a href="product.php?id=<?= $fav_data[$i]['product_id']; ?>">
                <div>
                  <img src="img/<?= get_image($dbh, $fav_data[$i]['product_id']) ?>" alt="<?= $fav_data[$i]['product_name']; ?>">
                  <p><?= $fav_data[$i]['product_name']; ?><br><span><?= number_format($fav_data[$i]['product_price']); ?>yen</span></p>
                </div>
              </a>
            </li>
          <?php endfor; ?>
        </ul>
        <div class="product-more">
          <a href="product_list.php?name=favorite&page=1" class="dotted-line">お気に入り一覧へ</a>
        </div>
      <?php endif; ?>
    </section>
  </div>

  <aside class="page-modal" id="delete-account-modal">
    <div class="page-modal-content">
      <p>アカウントを削除します<br><span>※お気に入り・カート・注文履歴も<br class="mobile">削除されます</span></p>
      <a href="./delete_account.php" class="button button-short">削除する</a>
      <button type="button" class="button button-short" id="delete-account-cancel">戻る</button>
    </div>
  </aside>
</main>

<?php include_once('views/components/footer_button.php'); ?>
<?php include_once('views/components/footer.php'); ?>

<!-- JavaScript -->
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>