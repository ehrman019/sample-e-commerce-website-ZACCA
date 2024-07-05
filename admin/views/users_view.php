<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-user">
      <h3>お客様一覧</h3>
      <?php if (!$list) : ?>
        <p class="admin-err">データが存在しません</p>
      <?php else : ?>
        <table>
          <tbody>
            <tr class="admin-table-header">
              <th class="admin-table-id">ID</th>
              <th class="admin-table-user-name">お客様名</th>
              <th class="admin-table-email">Email</th>
              <th>性別</th>
              <th>生年月日</th>
              <th>登録日時</th>
              <th>詳細</th>
            </tr>
            <?php foreach ($list as $value) : ?>
              <tr>
                <td><?= $value['user_id'] ?></td>
                <td><?= $value['last_name'] . ' ' . $value['first_name'] ?></td>
                <td><?= $value['email'] ?></td>

                <td><?= $gender[$value['gender'] - 1] ?></td>
                <td><?= $value['year'] . '/' . $value['month'] . '/' . $value['day'] ?></td>
                <td><?= format_date($value['created_at']) ?></td>
                <td>
                  <form action="users_detail.php" method="post" target="_blank">
                    <div class="admin-button-icon">
                      <input type="hidden" name="id" value="<?= $value['user_id'] ?>">
                      <input type="submit" value="">
                      <i class="fa-solid fa-circle-user"></i>
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