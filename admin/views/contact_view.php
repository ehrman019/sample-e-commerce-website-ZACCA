<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-contact">
      <h3>お問い合わせ情報</h3>
      <?php if (!$contact_list) : ?>
        <p class="admin-err">データが存在しません</p>
      <?php else : ?>
        <table>
          <tbody id="admin-prod-input-table">
            <tr class="admin-table-header">
              <th class="admin-table-id">ID</th>
              <th class="admin-table-user-name">お名前</th>
              <th class="admin-table-email">Email</th>
              <th class="admin-table-date">日時</th>
              <th>詳細</th>
            </tr>
            <?php foreach ($contact_list as $value) : ?>
              <tr class="admin-table-row">
                <td><?= $value['contact_id']  ?></td>
                <td><?= $value['contact_name'] ?></td>
                <td class="admin-table-left"><?= $value['contact_email'] ?></td>
                <td class="admin-table-left"><?= format_date($value['created_at']) ?></td>
                <td>
                  <form action="contact_detail.php" method="post" target="_blank">
                    <div class="admin-button-icon">
                      <input type="hidden" name="id" value="<?= $value['contact_id'] ?>">
                      <input type="submit" value="">
                      <i class="fa-solid fa-envelope"></i>
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

<script type="text/javascript" src="js/admin.js"></script>

</body>

</html>