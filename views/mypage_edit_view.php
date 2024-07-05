<?php include_once('views/components/header.php'); ?>

<main id="main" class="main">
  <div class="container">
    <section class="mypage-edit">
      <h1 data-title="マイページ">MY PAGE</h1>
      <div class="mypage-edit-content">
        <h2>メールアドレス変更</h2>
        <form action="mypage_edit.php" method="post" class="form">
          <ul class="mypage-edit-list mypage-edit-email">
            <li>
              <p class="mypage-edit-title">現在のメールアドレス</p>
              <p class="mypage-edit-text"><a href="#" class="disabled-link"><?= $user['email'] ?></a href="#" class="link-disabled"></p>
            </li>
            <li>
              <label>新しいメールアドレス</label>
              <div class="mypage-edit-long"><input type="text" name="email" placeholder="メールアドレス" value=""></div>
              <div class="mypage-edit-long"><input type="text" name="re-email" placeholder="メールアドレス（再入力）" value=""></div>
            </li>
          </ul>
          <p class="mypage-edit-err"><?php if (isset($err['email'])) echo $err['email']; ?></p>
          <input type="hidden" name="process" value="email">
          <input type="hidden" name="prev-y" value="0" class="page-y">
          <input type="submit" value="更新" class="button button-short submit-button">
        </form>
        <h2>パスワード変更</h2>
        <form action="mypage_edit.php" method="post" class="form">
          <ul class="mypage-edit-list mypage-edit-pwd">
            <li>
              <label>現在のパスワード</label>
              <div class="mypage-edit-long"><input type="password" name="prev-pwd" placeholder="現在のパスワード" value=""></div>
            </li>
            <li>
              <label>新しいパスワード</label>
              <div class="mypage-edit-long"><input type="password" name="pwd" placeholder="新しいパスワード" value=""></div>
              <div class="mypage-edit-long"><input type="password" name="re-pwd" placeholder="新しいパスワード（再入力）" value=""></div>
            </li>
          </ul>
          <p class="mypage-edit-err"><?php if (isset($err['pwd'])) echo $err['pwd']; ?></p>
          <input type="hidden" name="process" value="pwd">
          <input type="hidden" name="prev-y" value="" class="page-y">
          <input type="submit" value="更新" class="button button-short submit-button">
        </form>
        <h2>ご本人情報</h2>
        <form action="mypage_edit.php" method="post" class="form">
          <ul class="mypage-edit-list">
            <li>
              <label for="last_name">お名前</label>
              <div class="mypage-edit-flex mypage-edit-name">
                <input type="text" name="last-name" id="last-name" placeholder="姓" value="<?= $user['last_name'] ?>">
                <input type="text" name="first-name" id="first-name" placeholder="名" value="<?= $user['first_name'] ?>">
              </div>
            </li>
            <li>
              <label for="last_name-f">お名前（ふりがな）</label>
              <div class="mypage-edit-flex mypage-edit-name">
                <input type="text" name="last-name-kana" id="last-name-kana" placeholder="せい" value="<?= $user['last_name_kana'] ?>">
                <input type="text" name="first-name-kana" id="first-name-kana" placeholder="めい" value="<?= $user['first_name_kana'] ?>">
              </div>
            </li>
            <li>
              <p class="mypage-edit-title">性別（変更できません）</p>
              <p class="mypage-edit-text"><?= $gender[$user['gender'] - 1] ?></p>
            </li>
            <li class="mypage-edit-birth">
              <p class="mypage-edit-title">生年月日（変更できません）</p>
              <div class="mypage-edit-flex">
                <p class="mypage-edit-text"><?= $user['year'] . '年' ?>&nbsp;</p>
                <p class="mypage-edit-text"><?= $user['month'] . '月' ?>&nbsp;</p>
                <p class="mypage-edit-text"><?= $user['day'] . '日' ?></p>
              </div>
            </li>
          </ul>
          <p class="mypage-edit-err"><?php if (isset($err['name'])) echo $err['name']; ?></p>
          <input type="hidden" name="process" value="name">
          <input type="hidden" name="prev-y" value="0" class="page-y">
          <input type="submit" value="更新" class="button button-short submit-button">
        </form>
        <h2>ご住所</h2>
        <form action="mypage_edit.php" method="post" class="form">
          <ul class="mypage-edit-list">
            <li>
              <p class="mypage-edit-title">現在の登録住所</p>
              <p class="mypage-edit-text">〒<?= $user['zipcode'] ?></p>
              <p class="mypage-edit-text"><?= $prefectures[$user['prefecture'] - 1] . ' ' . $user['city'] . ' ' . $user['address'] ?><br><?= $user['building'] ?></p>
            </li>
            <li>
              <label for="zipcode">郵便番号</label>
              <div class="mypage-edit-zipcode"><input type="text" name="zipcode" id="zipcode" placeholder="000-0000" value="<?php if (isset($data['zipcode'])) echo html_escape($data['zipcode']) ?>">
              </div>
            </li>
            <li>
              <label for="prefecture">都道府県</label>
              <div class="select">
                <select name="prefecture" id="prefecture" class="
                    <?php if (!isset($data['prefecture']) || !$data['prefecture']) {
                      echo 'select-hidden';
                    } ?>">
                  <option value="" selected hidden>-</option>

                  <?php foreach ($prefectures as $i => $value) : ?>
                    <?php if (isset($data['prefecture']) && $i + 1 == $data['prefecture']) : ?>
                      <option value="<?= $i + 1 ?>" selected>
                        <?= $value ?>
                      </option>
                    <?php else : ?>
                      <option value="<?= $i + 1 ?>">
                        <?= $value ?>
                      </option>
                    <?php endif; ?>
                  <?php endforeach; ?>

                </select>
              </div>
            </li>
            <li>
              <label for="city">市区町村</label>
              <div class="mypage-edit-city"><input type="text" name="city" id="city" placeholder="市区町村" value="<?php if (isset($data['city'])) echo html_escape($data['city']) ?>"></div>
            </li>
            <li>
              <label for="address">番地</label>
              <div class="mypage-edit-long"><input type="text" name="address" id="address" placeholder="番地" value="<?php if (isset($data['address'])) echo html_escape($data['address']) ?>"></div>
            </li>
            <li>
              <label for="building" class="optional">建物名</label>
              <div class="mypage-edit-long"><input type="text" name="building" id="building" placeholder="建物名" value="<?php if (isset($data['building'])) echo html_escape($data['building']) ?>"></div>
            </li>
          </ul>
          <p class="mypage-edit-err"><?php if (isset($err['address'])) echo $err['address']; ?></p>
          <input type="hidden" name="process" value="address">
          <input type="hidden" name="prev-y" value="0" class="page-y">
          <input type="submit" value="更新" class="button button-short submit-button">
        </form>
        <h2>ご連絡先</h2>
        <form action="mypage_edit.php" method="post" class="form">
          <ul class="mypage-edit-list">
            <li>
              <p class="mypage-edit-title">現在の登録電話番号</p>
              <p class="mypage-edit-text"><a href="#" class="disabled-link"><?= $user['tel'] ?></a></p>
            </li>
            <li>
              <label for="tel">新しい電話番号</label>
              <div class="mypage-edit-tel"><input type="text" name="tel" id="tel" placeholder="000-0000-0000" value=""></div>
            </li>
          </ul>
          <p class="mypage-edit-err"><?php if (isset($err['tel'])) echo $err['tel']; ?></p>
          <input type="hidden" name="process" value="tel">
          <input type="hidden" name="prev-y" value="0" class="page-y">
          <input type="submit" value="更新" class="button button-short submit-button">
        </form>
      </div>
      </form>
    </section>
  </div>
  <?php include_once('views/components/footer_button.php'); ?>
  <?php include_once('views/components/footer.php'); ?>
</main>

<!-- JavaScript -->
<script>
  let prevY = "<?= $prev_y ?>";
</script>
<script type="text/javascript" src="js/script.js"></script>
</body>

</html>