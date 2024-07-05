<?php include_once('views/components/header.php'); ?>

<main id="main" class="main">
  <div class="container">
    <section>
      <h1 data-title="<?= $sub_title ?>"><?= $title_h1 ?></h1>
      <?php if (empty($list)) : ?>
        <p class="empty">該当商品はありません</p>
      <?php else : ?>
        <?php if (isset($note)) : ?>
          <p class="note"><?= $note ?></p>
        <?php endif; ?>
        <ul class="product-list">
          <?php for ($i = $left; $i < $right; $i++) : ?>
            <li>
              <a href="product.php?id=<?= $list[$i]['product_id']; ?>">
                <img src="img/<?= get_image($dbh, $list[$i]['product_id']) ?>" alt="<?= $list[$i]['product_name']; ?>">
                <p><?= $list[$i]['product_name']; ?><br><span><?= number_format($list[$i]['product_price']); ?>yen</span></p>
              </a>
            </li>
          <?php endfor; ?>
        </ul>
        <div class="page-nav">
          <?php if (isset($category_id)) : ?>
            <a href="product_list.php?name=<?= $name ?>&page=<?= max($page - 1, 1); ?>&id=<?= $category_id ?>"><i class="fa-solid fa-chevron-left"></i>prev</a>
            <ul>
              <?php for ($i = 0; $i < $pagenum; $i++) : ?>
                <?php if ($i + 1 == $page) : ?>
                  <li class="page-nav-now"><a href="product_list.php?name=<?= $name; ?>&page=<?= $i + 1 ?>&id=<?= $category_id ?>"><?= $i + 1; ?></a></li>
                <?php else : ?>
                  <li><a href="product_list.php?name=<?= $name; ?>&page=<?= $i + 1 ?>&id=<?= $category_id ?>"><?= $i + 1; ?></a></li>
                <?php endif; ?>
              <?php endfor; ?>
            </ul>
            <a href="product_list.php?name=<?= $name ?>&page=<?= min($page + 1, $pagenum); ?>&id=<?= $category_id ?>">next<i class="fa-solid fa-chevron-right"></i></a>
          <?php elseif (isset($word)) : ?>
            <a href="product_list.php?name=<?= $name ?>&page=<?= max($page - 1, 1); ?>&word=<?= $word ?>"><i class="fa-solid fa-chevron-left"></i>prev</a>
            <ul>
              <?php for ($i = 0; $i < $pagenum; $i++) : ?>
                <?php if ($i + 1 == $page) : ?>
                  <li class="page-nav-now"><a href="product_list.php?name=<?= $name; ?>&page=<?= $i + 1 ?>&word=<?= $word ?>"><?= $i + 1; ?></a></li>
                <?php else : ?>
                  <li><a href="product_list.php?name=<?= $name; ?>&page=<?= $i + 1 ?>&word=<?= $word ?>"><?= $i + 1; ?></a></li>
                <?php endif; ?>
              <?php endfor; ?>
            </ul>
            <a href="product_list.php?name=<?= $name ?>&page=<?= min($page + 1, $pagenum); ?>&word=<?= $word ?>">next<i class="fa-solid fa-chevron-right"></i></a>
          <?php else : ?>
            <a href="product_list.php?name=<?= $name ?>&page=<?= max($page - 1, 1); ?>"><i class="fa-solid fa-chevron-left"></i>prev</a>
            <ul>
              <?php for ($i = 0; $i < $pagenum; $i++) : ?>
                <?php if ($i + 1 == $page) : ?>
                  <li class="page-nav-now"><a href="product_list.php?name=<?= $name; ?>&page=<?= $i + 1 ?>"><?= $i + 1; ?></a></li>
                <?php else : ?>
                  <li><a href="product_list.php?name=<?= $name; ?>&page=<?= $i + 1 ?>"><?= $i + 1; ?></a></li>
                <?php endif; ?>
              <?php endfor; ?>
            </ul>
            <a href="product_list.php?name=<?= $name ?>&page=<?= min($page + 1, $pagenum); ?>">next<i class="fa-solid fa-chevron-right"></i></a>
          <?php endif; ?>

        </div>
      <?php endif; ?>


    </section>

  </div>

</main>

<?php if (($list) && $right % 16 > 4) {
  include_once('views/components/footer_button.php');
} ?>

<?php include_once('views/components/footer.php'); ?>


<!-- JavaScript -->
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>