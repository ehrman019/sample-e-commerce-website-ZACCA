<?php include_once('views/components/header.php'); ?>

<main id="main" class="main">
  <div class="container">
    <section class="signup">
      <h1 data-title="新規登録">SIGN UP</h1>
      <div class="signup-content">
        <form action="signup.php" method="post">
          <div class="signup-form-content">
            <div class="signup-flex">
              <label for="email">新規メールアドレス</label>
              <input type="text" name="email" id="email" placeholder="メールアドレス">
            </div>
            <div class="signup-flex">
              <label for="pwd">パスワード設定</label>
              <input type="password" name="pwd" id="pwd" placeholder="パスワード">
            </div>
            <div class="signup-flex">
              <label for="repwd">パスワード設定（再入力）</label>
              <input type="password" name="repwd" id="repwd" placeholder="パスワード">
            </div>

            <div class="signup-note">
              <p>※パスワードは8文字以上32文字以下</p>
              <p>※英字と数字を両方とも使用</p>
            </div>
          </div>

          <input type="submit" value="次ヘ進む" class="button-short button">
        </form>

        <p class="signup-err"><?php if (isset($err['signup'])) echo $err['signup']; ?></p>
      </div>

    </section>
  </div>
</main>

<?php include_once('views/components/footer.php'); ?>


<!-- JavaScript -->
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>