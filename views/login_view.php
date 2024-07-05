<?php include_once('views/components/header.php'); ?>

<main id="main" class="main">
  <div class="container">
    <section class="login">
      <h1 data-title="ログイン">LOGIN</h1>
      <div class="login-content">
        <form action="login.php" method="post">
          <div class="login-flex">
            <label for="email">メールアドレス</label>
            <input type="text" name="email" id="email" class="login-form-input" size="200" maxlength="32" placeholder="メールアドレス">
          </div>
          <div class="login-flex">
            <label for="pwd">パスワード</label>
            <input type="password" name="pwd" id="pwd" size="40" maxlength="32" class="login-form-input" placeholder="パスワード">
          </div>
          <?php if (isset($err['login'])) : ?>
            <p class="login-err"><?= $err['login'] ?></p>
          <?php endif; ?>
          <input type="submit" value="ログイン" class="button-short button">
        </form>
        <p class="login-content-text">アカウント登録が<br class="mobile">お済みでない方は<a href="signup.php" class="dotted-line">こちら</a></p>
      </div>

    </section>
  </div>
</main>

<?php include_once('views/components/footer.php'); ?>


<!-- JavaScript -->
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>