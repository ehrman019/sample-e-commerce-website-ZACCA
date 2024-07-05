<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZACCA | 管理画面</title>

  <!-- Normalize.css -->
  <link rel="stylesheet" href="../css/normalize.css">

  <!-- My Styles -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/tablet.css">
  <link rel="stylesheet" href="../css/pc.css">
  <link rel="stylesheet" href="../css/admin.css">

  <!-- GoogleFonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Notable&family=Zen+Kaku+Gothic+New:wght@400;700&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/bd44d20742.js" crossorigin="anonymous"></script>

  <!-- Favicon -->
  <link rel="icon" href="../img/favicon.ico">


</head>

<body>
  <header class="admin-header">
    <div class="admin-header-content" id="header-content">
      <div class="admin-header-logo">
        <a href="./index.php">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 363.63 63.99">
            <path class="cls-1" d="m335.72.53h-26.28l-23.76,63.01h6.57l8.1-20.88h19.8l9.45,20.88h34.03L335.72.53Zm-33.4,36.64l7.11-18.27,8.19,18.27h-15.3Zm-19.31,1.71c-.78,5.22-2.49,9.66-5.13,13.32-2.64,3.66-6.21,5.49-10.71,5.49s-8.1-2.91-10.26-8.73c-1.68-4.32-2.52-9.99-2.52-17.01,0-4.44.33-8.31.99-11.61.9-4.32,2.22-7.59,3.96-9.81,1.98-2.82,4.59-4.23,7.83-4.23,3.42,0,6.24,1.05,8.46,3.15,2.22,2.04,3.84,4.5,4.86,7.38,1.08,2.82,1.74,5.58,1.98,8.28h5.13c-.18-3.24-.84-6.51-1.98-9.81s-2.73-6.12-4.77-8.46c-2.46-2.82-5.64-4.65-9.54-5.49-3.84-.9-8.85-1.35-15.03-1.35-6.72,0-12.15.54-16.29,1.62s-7.89,3.3-11.25,6.66c-5.16,5.16-7.74,13.05-7.74,23.67s2.88,18,8.64,23.76c2.94,2.94,6.45,5.07,10.53,6.39,4.14,1.26,9.51,1.89,16.11,1.89,4.68,0,8.46-.18,11.34-.54,2.94-.36,5.61-1.14,8.01-2.34,2.46-1.26,4.65-3.15,6.57-5.67,3.42-4.56,5.55-10.08,6.39-16.56h-5.58Zm-77.12,13.32c-2.64,3.66-6.21,5.49-10.71,5.49s-8.1-2.91-10.26-8.73c-1.68-4.32-2.52-9.99-2.52-17.01,0-4.44.33-8.31.99-11.61.9-4.32,2.22-7.59,3.96-9.81,1.98-2.82,4.59-4.23,7.83-4.23,3.42,0,6.24,1.05,8.46,3.15,2.22,2.04,3.84,4.5,4.86,7.38,1.08,2.82,1.74,5.58,1.98,8.28h5.13c-.18-3.24-.84-6.51-1.98-9.81-1.14-3.3-2.73-6.12-4.77-8.46-2.46-2.82-5.64-4.65-9.54-5.49-3.84-.9-8.85-1.35-15.03-1.35-6.72,0-12.15.54-16.29,1.62-4.14,1.08-7.89,3.3-11.25,6.66-5.16,5.16-7.74,13.05-7.74,23.67s2.88,18,8.64,23.76c2.94,2.94,6.45,5.07,10.53,6.39,4.14,1.26,9.51,1.89,16.11,1.89,4.68,0,8.46-.18,11.34-.54,2.94-.36,5.61-1.14,8.01-2.34,2.46-1.26,4.65-3.15,6.57-5.67,3.42-4.56,5.55-10.08,6.39-16.56h-5.58c-.78,5.22-2.49,9.66-5.13,13.32ZM98.9.53l-23.76,63.01h6.57l8.1-20.88h19.8l9.45,20.88h34.03L125.18.53h-26.28Zm-7.11,36.64l7.11-18.27,8.19,18.27h-15.3ZM0,.53v5.22h34.21L0,63.54h70.93v-5.22h-34.11L70.93.53H0Z" />
          </svg>
        </a>
        <p>管理画面</p>
      </div>
      <p class="admin-header-title">MENU</p>
      <ul>
        <li><a href="register_product.php">商品情報登録</a></li>
        <li><a href="purchase.php">入荷登録</a></li>
        <li><a href="edit_product.php">商品情報一覧</a></li>
        <li><a href="orders.php">注文履歴一覧</a></li>
        <li><a href="users.php">お客様情報</a></li>
        <li><a href="contact.php">お問い合わせ情報</a></li>
      </ul>
    </div>
    <div class="admin-header-button">
      <button id="header-button" class="open">
        <div class="admin-header-button-icon" id="header-button-icon"></div>
      </button>
    </div>
  </header>