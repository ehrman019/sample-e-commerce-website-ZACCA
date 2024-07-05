<?php include_once('views/components/header.php'); ?>

<main id="main" class="main">
  <div class="container">
    <section>
      <h1 data-title="ページが見つかりません">NOT FOUND</h1>
      <figure class="notfound-img">
        <img src="img/404_mobile.jpg" alt="" class="mobile" />
        <img src="img/404_PC.jpg" alt="" class="pc" />
        <p>SORRY..</p>
      </figure>

      <div class="notfound-content">
        <p>
          お探しのページは、削除されたか、名前が変更された可能性があります。<br /><a href="index.php">トップページ</a>から目的のページをお探しください。
        </p>

        <p class="notice">
          ※直接アドレスを入力された場合は、正しく入力されているか再度ご確認ください。
        </p>
      </div>
    </section>
  </div>
</main>

<?php include_once('views/components/footer.php'); ?>


<!-- JavaScript -->
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>