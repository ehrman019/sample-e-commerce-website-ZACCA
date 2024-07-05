<?php if (!$category) : ?>
  <p class="empty">カテゴリーが存在しません</p>
<?php else : ?>
  <ul class="category-list">
    <?php foreach ($category as $value) : ?>
      <li>
        <a href="product_list.php?name=category&page=1&id=<?= $value['category_id'] ?>">
          <div>
            <img src="img/category_<?= $value['category_id'] ?>.jpg" alt="<?= $value['category_name'] ?>">
            <p><?= $value['category_name'] ?></p>
          </div>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>