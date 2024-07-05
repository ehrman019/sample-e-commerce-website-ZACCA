<?php include_once('views/components/header.php'); ?>

<main id="main" class="main">
  <div class="container">
    <section class="guide">
      <h1 data-title="お買い物ガイド">SHOPPING GUIDE</h1>

      <nav class="guide-nav">
        <ul>
          <li><a href="#find">商品を探す</a></li>
          <li><a href="#order">ご注文について</a></li>
          <li><a href="#payment">お支払方法について</a></li>
        </ul>
        <ul>
          <li><a href="#delivery">配送について</a></li>
          <li><a href="#exchange">交換・返品について</a></li>
          <li><a href="contact.php">お問い合わせ</a></li>
        </ul>
      </nav>

      <div class="guide-content">
        <article id="find">
          <h2>商品を探す</h2>

          <div class="guide-article">
            <p class="guide-article-text">
              こちらの<a href="product_list.php?name=list&page=1">商品一覧</a>から一覧を<br class="mobile" />ご覧いただけます。また、
            </p>
            <ul>
              <li><a href="search.php">キーワード検索</a></li>
              <li><a href="search.php">カテゴリー検索</a></li>
            </ul>

            <p class="guide-article-text">
              などの方法で検索できます。<br />ぜひお気に入りを見つけてください。
            </p>

            <p class="guide-article-text">
              会員登録していただくと、<br class="mobile" />お気に入り登録することができます。<br />新規登録は<a href="signup.php">こちら</a>
            </p>
          </div>
        </article>

        <article id="order">
          <h2>ご注文について</h2>
          <div class="guide-article">
            <p class="guide-article-text">
              ご注文は1点から可能です。<br />カートに商品を入れ、<br class="mobile" />購入手続きへお進みください。
            </p>
            <p class="guide-article-text">
              会員登録がお済みでない方は、<br class="mobile" />購入手続きの前に会員登録ページに<br class="mobile" />進みます。<br />会員情報を入力して頂きますと、<br class="mobile" />購入手続きへお進みできます。
            </p>
            <p class="guide-article-text">
              配送料については<a href="#delivery">こちら</a>
            </p>
          </div>
        </article>

        <article id="payment">
          <h2>お支払方法について</h2>
          <div class="guide-article">
            <p class="guide-article-text">
              購入手続き画面で、以下の方法から<br class="mobile" />選択できます。
            </p>
            <ul class="guide-article-text">
              <li>
                <p>クレジットカード</p>
              </li>
              <li>
                <p>コンビニ支払い</p>
              </li>
              <li>
                <p>代引き（手数料 +￥330）</p>
              </li>
            </ul>
          </div>
        </article>

        <article id="delivery">
          <h2>配送について</h2>
          <div class="guide-article">
            <p class="guide-article-text">
              受け取り日時の指定が可能です。<br />ご購入手続きの際に選択してください。
            </p>
            <p class="guide-article-text">
              送料は全国一律500円となります。<br />5,000円以上お買い上げの方は送料無料です。
            </p>
          </div>
        </article>

        <article id="exchange">
          <h2>交換・返品について</h2>
          <div class="guide-article">
            <p class="guide-article-text">
              出荷日を含め14日以内であれば、<br class="mobile" />交換・返品可能です。
            </p>
            <p class="guide-article-text">
              条件・手続き方法など詳しくは<a href="">こちら</a>
            </p>
          </div>
        </article>
      </div>
    </section>
  </div>
</main>

<?php include_once('views/components/footer_button.php'); ?>
<?php include_once('views/components/footer.php'); ?>

<!-- JavaScript -->
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>