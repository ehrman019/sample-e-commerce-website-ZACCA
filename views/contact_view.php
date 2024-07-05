<?php include_once('views/components/header.php'); ?>
<main id="main" class="main">
  <div class="container">
    <section class="contact">
      <h1 data-title="お問い合わせ">CONTACT</h1>
      <div class="contact-content">
        <p class="contact-content-text">
          お問い合わせは、こちらのフォームからお願いいたします。<br>必須項目のご入力の上、送信してください。
        </p>
        <form action="" method="post">
          <p class="required-text"><span>※</span>必須項目</p>
          <div class="contact-form">
            <label for="name" class="required">お名前</label>
            <div>
              <?php if (!isset($data['contact_name'])) : ?>
                <input type="text" name="name" placeholder="お名前">
              <?php else : ?>
                <input type="text" name="name" placeholder="お名前" value="<?= html_escape($data['contact_name']) ?>">
              <?php endif; ?>
            </div>
            <label for="email" class="required">メールアドレス</label>
            <div>
              <?php if (!isset($data['contact_email'])) : ?>
                <input type="text" name="email" placeholder="メールアドレス">
              <?php else : ?>
                <input type="text" name="email" placeholder="メールアドレス" value="<?= html_escape($data['contact_email']) ?>">
              <?php endif; ?>
            </div>
            <label for="tel" class="optional">電話番号</label>
            <div>
              <?php if (!isset($data['contact_tel'])) : ?>
                <input type="text" name="tel" placeholder="080XXXXXXX">
              <?php else : ?>
                <input type="text" name="tel" placeholder="080XXXXXXX" value="<?= html_escape($data['contact_tel']) ?>">
              <?php endif; ?>
            </div>
            <label for="message" class="required">お問い合わせ内容</label>
            <div>
              <textarea type="text" name="message" cols="40" rows="8" placeholder="お問い合わせ内容"><?php if (isset($data['contact_message'])) echo nl2br(html_escape($data['contact_message'])); ?></textarea>
            </div>
            <input type="hidden" name="prev-y" value="0" class="page-y">
            <input type="submit" name="submit" value="送信する" class="button-short button">
            <?php if (isset($err['contact'])) : ?>
              <p class="contact-err"><?= $err['contact']; ?></p>
            <?php endif; ?>
          </div>
        </form>
      </div>
    </section>
  </div>


</main>
<?php include_once('views/components/footer_button.php'); ?>
<?php include_once('views/components/footer.php'); ?>


<!-- JavaScript -->
<script>
  let prevY = "<?= $prev_y ?>";
</script>
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>