<?php include_once('views/components/header.php'); ?>

<main id="main" class="main">
  <div class="container">
    <section class="signup-detail">
      <h1 data-title="新規登録">SIGN UP</h1>
      <form action="signup_detail.php" method="post" class="form">
        <div class="signup-detail-content">
          <h2>ご本人情報</h2>
          <p class="required-text"><span>※</span>必須項目</p>
          <ul class="signup-detail-list">
            <li>
              <label for="last-name" class="required">お名前</label>
              <div class="signup-detail-flex signup-detail-name">
                <input type="text" name="last-name" id="last-name" placeholder="姓" value="<?php if (isset($data['last_name'])) echo html_escape($data['last_name']); ?>">
                <input type="text" name="first-name" id="first-name" placeholder="名" value="<?php if (isset($data['first_name'])) echo html_escape($data['first_name']); ?>">
              </div>
            </li>

            <li>
              <label for="last-name-kana" class="required">お名前（ふりがな）</label>
              <div class="signup-detail-flex signup-detail-name">
                <input type="text" name="last-name-kana" id="last-name-kana" placeholder="せい" value="<?php if (isset($data['last_name_kana'])) echo html_escape($data['last_name_kana']) ?>">
                <input type="text" name="first-name-kana" id="first-name-kana" placeholder="めい" value="<?php if (isset($data['first_name_kana'])) echo html_escape($data['first_name_kana']) ?>">
              </div>
            </li>

            <li>
              <label for="gender" class="required">性別</label>
              <div class="select">
                <?php if (!isset($data['gender']) || !$data['gender']) : ?>
                  <select name="gender" id="gender" class="select-hidden">
                    <option value="" hidden>-</option>
                    <option value="2"><?= $gender[1] ?></option>
                    <option value="1"><?= $gender[0] ?></option>
                    <option value="3"><?= $gender[2] ?></option>
                  </select>
                <?php else : ?>
                  <select name="gender" id="gender">
                    <option value="" hidden>-</option>
                    <option value="2" <?php if ($data['gender'] === 2) echo 'selected'; ?>><?= $gender[1] ?></option>
                    <option value="1" <?php if ($data['gender'] === 1) echo 'selected'; ?>><?= $gender[0] ?></option>
                    <option value="3" <?php if ($data['gender'] === 3) echo 'selected'; ?>><?= $gender[2] ?></option>
                  </select>
                <?php endif; ?>
              </div>
            </li>

            <li>
              <label for="year" class="required">生年月日</label>

              <div class="signup-detail-flex">
                <div class="select">
                  <?php if (!$data['year']) : ?>
                    <select name="year" id="year" class="year select-hidden">
                      <option value="" hidden>-</option>
                    </select>
                  <?php else : ?>
                    <select name="year" id="year" class="year">
                      <option value="" hidden>-</option>
                    </select>
                  <?php endif; ?>
                </div>
                <div class="select">
                  <?php if (!isset($data['month']) || !$data['month']) : ?>
                    <select name="month" id="month" class="month select-hidden">
                      <option value="" hidden>-</option>
                    </select>
                  <?php else : ?>
                    <select name="month" id="month" class="month">
                      <option value="" hidden>-</option>
                    </select>
                  <?php endif; ?>
                </div>
                <div class="select">
                  <?php if (!isset($data['day']) || !$data['day']) : ?>
                    <select name="day" id="day" class="day select-hidden">
                      <option value="" hidden>-</option>
                    </select>
                  <?php else : ?>
                    <select name="day" id="day" class="day">
                      <option value="" hidden>-</option>
                    </select>
                  <?php endif; ?>
                </div>
              </div>

            </li>
          </ul>
          <h2>ご住所</h2>
          <p class="required-text"><span>※</span>必須項目</p>
          <ul class="signup-detail-list">
            <li>
              <label for="zipcode" class="required">郵便番号</label>
              <div class="signup-detail-zipcode"><input type="text" name="zipcode" id="zipcode" placeholder="000-0000" value="<?php if (isset($data['zipcode'])) echo html_escape($data['zipcode']) ?>"></div>
            </li>
            <li>
              <label for="prefecture" class="required">都道府県</label>
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
              <label for="city" class="required">市区町村</label>
              <div class="signup-detail-city"><input type="text" name="city" id="city" placeholder="市区町村" value="<?php if (isset($data['city'])) echo html_escape($data['city']) ?>"></div>
            </li>
            <li>
              <label for="address" class="required">番地</label>
              <div class="signup-detail-long"><input type="text" name="address" id="address" placeholder="番地" value="<?php if (isset($data['address'])) echo html_escape($data['address']) ?>"></div>
            </li>
            <li>
              <label for="building" class="optional">建物名</label>
              <div class="signup-detail-long"><input type="text" name="building" id="building" placeholder="建物名" value="<?php if (isset($data['building'])) echo html_escape($data['building']) ?>"></div>
            </li>
          </ul>
          <h2>ご連絡先</h2>
          <p class="required-text"><span class="required-span">※</span>必須項目</p>
          <ul class="signup-detail-list">
            <li>
              <label for="tel" class="required">電話番号</label>
              <div class="signup-detail-tel"><input type="text" name="tel" id="tel" placeholder="000-0000-0000" value="<?php if (isset($data['tel'])) echo html_escape($data['tel']) ?>"></div>
            </li>
          </ul>

          <div class="signup-detail-button">
            <input type="hidden" name="prev-y" value="" class="page-y">
            <input type="submit" value="登録する" class="button-short button submit-button">
          </div>
          <p class="signup-detail-err"><?php if (isset($err['signup_detail'])) echo $err['signup_detail']; ?></p>
        </div>

      </form>
    </section>
  </div>
</main>

<?php include_once('views/components/footer_button.php'); ?>
<?php include_once('views/components/footer.php'); ?>


<!-- JavaScript -->
<script>
  <?php $data = json_encode($data); ?>
  const data = JSON.parse('<?= $data; ?>');

  const postYear = Number(data['year']);
  const postMonth = Number(data['month']);
  const postDay = Number(data['day']);
  let prevY = "<?= $prev_y ?>";
</script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/signup_detail.js"></script>

</body>

</html>