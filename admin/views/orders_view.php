<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-product">
      <h3>注文履歴一覧</h3>
      <?php if (!$list) : ?>
        <p class="admin-err">データが存在しません</p>
      <?php else : ?>
        <table>
          <tbody id="admin-product-input-table">
            <?php if (isset($err['product_list'])) : ?>
              <p><?= $err['product_list'] ?></p>
            <?php endif; ?>
            <tr class="admin-table-header">
              <th class="admin-table-id">注文ID</th>
              <th class="admin-table-user-name">お客様名</th>
              <th class="admin-table-date">注文日時</th>
              <th>詳細</th>
            </tr>
            <?php foreach ($list as $value) : ?>
              <tr>
                <td><?= $value['order_id']  ?></td>
                <td><?= $value['order_name'] ?></td>
                <td class="admin-table-right"><?= format_date($value['created_at']) ?></td>
                <td class="admin-table-link">
                  <form action="order_detail.php" method="post" target="_blank">
                    <div class="admin-button-icon">
                      <input type="hidden" name="id" value="<?= $value['order_id'] ?>">
                      <input type="submit" value="">
                      <i class="fa-regular fa-file"></i>
                    </div>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </section>
  </div>
</main>

<!-- JavaScript -->

<script type="text/javascript" src="js/admin.js"></script>

</body>

</html>