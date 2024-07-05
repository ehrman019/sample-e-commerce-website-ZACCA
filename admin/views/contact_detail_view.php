<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-product">
      <h3>お問い合わせ情報詳細</h3>
      <?php if (!$contact_data) : ?>
        <p class="admin-err">データが存在しません</p>
      <?php else : ?>
        <table class="admin-table-vertical">
          <tbody>
            <tr>
              <th>ID</th>
              <td><?= $contact_data['contact_id'] ?></td>
            </tr>
            <tr>
              <th>お客様名</th>
              <td><?= $contact_data['contact_name'] ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?= $contact_data['contact_email'] ?></td>
            </tr>
            <tr>
              <th>TEL</th>
              <td>
                <?php if ($contact_data['contact_tel']) : ?>
                  <?= $contact_data['contact_tel'] ?>
                <?php else : ?>
                  記載なし
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>日時</th>
              <td>
                <?= format_date($contact_data['created_at']) ?>
              </td>
            </tr>
            <tr>
              <th>内容</th>
              <td>
                <?= nl2br($contact_data['message']) ?>
              </td>
            </tr>

          </tbody>
        </table>
      <?php endif; ?>
    </section>
  </div>
</main>

<script type="text/javascript" src="js/admin.js"></script>
</body>

</html>