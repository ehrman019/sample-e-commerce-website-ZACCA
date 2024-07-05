<?php include_once('views/components/header.php'); ?>
<main>
  <div class="admin-container">
    <section class="admin-product">
      <h3>お客様情報詳細</h3>
      <?php if (!$user) : ?>
        <p class="admin-err">データが存在しません</p>
      <?php else : ?>
        <table class="admin-table-vertical">
          <tbody>
            <tr>
              <th>ID</th>
              <td><?= $user['user_id'] ?></td>
            </tr>
            <tr>
              <th>お客様名</th>
              <td><?= $user['last_name'] . ' ' . $user['first_name'] ?></td>
            </tr>
            <tr>
              <th>ふりがな</th>
              <td><?= $user['last_name_kana'] . ' ' . $user['first_name_kana'] ?></td>
            </tr>
            <tr>
              <th>性別</th>
              <td><?= $gender[$user['gender'] - 1] ?></td>
            </tr>
            <tr>
              <th>生年月日</th>
              <td><?= $user['year'] . '/' . $user['month'] . '/' . $user['day'] ?></td>
            </tr>
            <tr>
              <th>住所</th>
              <td><?= '〒' . $user['zipcode'] ?><br><?= $prefectures[$user['prefecture'] - 1] . $user['city'] . $user['address'] . $user['building'] ?></td>
            </tr>
            <tr>
              <th>電話番号</th>
              <td><?= $user['tel'] ?></td>
            </tr>
            <tr>
              <th>登録日時</th>
              <td><?= format_date($user['created_at']) ?></td>
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