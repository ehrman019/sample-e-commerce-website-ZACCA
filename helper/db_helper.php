<?php
/*------ Defalut ------*/
function get_db_connect()
{
  try {
    $dsn = DSN;
    $user = DB_USER;
    $password = DB_PASSWORD;

    $dbh = new PDO($dsn, $user, $password);
  } catch (PDOException $e) {
    echo ('接続エラー: ' . $e->getMessage());
    die();
  }
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $dbh;
}

/*------ Signup and Login ------*/
function email_exists($dbh, $email)
{
  $sql = "SELECT * FROM users WHERE email = :email";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data;
}

function login($dbh, $email, $pwd)
{
  $sql = "SELECT * FROM users WHERE email = :email";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  if (password_verify($pwd, $data['pwd'])) {
    return $data;
  } else {
    return false;
  }
}

/*------ User ------*/
function get_user_data($dbh, $id)
{
  $sql = "SELECT * FROM users WHERE user_id = :id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data;
}

function insert_user_data($dbh, $data)
{
  $sql = "INSERT INTO users(email, pwd, last_name, first_name, last_name_kana, first_name_kana, gender, year, month, day, zipcode, prefecture, city, address, building, tel, created_at) VALUE(:email, :pwd, :last_name, :first_name, :last_name_kana, :first_name_kana, :gender, :year, :month, :day, :zipcode, :prefecture, :city, :address, :building, :tel, SYSDATE())";

  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
  $stmt->bindValue(':pwd', $data['pwd'], PDO::PARAM_STR);
  $stmt->bindValue(':last_name', $data['last_name'], PDO::PARAM_STR);
  $stmt->bindValue(':first_name', $data['first_name'], PDO::PARAM_STR);
  $stmt->bindValue(':last_name_kana', $data['last_name_kana'], PDO::PARAM_STR);
  $stmt->bindValue(':first_name_kana', $data['first_name_kana'], PDO::PARAM_STR);
  $stmt->bindValue(':gender', $data['gender'], PDO::PARAM_INT);
  $stmt->bindValue(':year', $data['year'], PDO::PARAM_INT);
  $stmt->bindValue(':month', $data['month'], PDO::PARAM_INT);
  $stmt->bindValue(':day', $data['day'], PDO::PARAM_INT);
  $stmt->bindValue(':zipcode', $data['zipcode'], PDO::PARAM_STR);
  $stmt->bindValue(':prefecture', $data['prefecture'], PDO::PARAM_INT);
  $stmt->bindValue(':city', $data['city'], PDO::PARAM_STR);
  $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
  $stmt->bindValue(':building', $data['building'], PDO::PARAM_STR);
  $stmt->bindValue(':tel', $data['tel'], PDO::PARAM_STR);

  $stmt->execute();
}

function update_user_email($dbh, $user_id, $email)
{
  $sql = "UPDATE users SET email = :email WHERE user_id = :user_id";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
}

function update_user_pwd($dbh, $user_id, $pwd)
{
  $sql = "UPDATE users SET pwd = :pwd WHERE user_id = :user_id";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':pwd', $pwd, PDO::PARAM_STR);
  $stmt->execute();
}

function update_user_name($dbh, $user_id, $data)
{
  $sql = "UPDATE users SET last_name = :last_name, first_name = :first_name, last_name_kana = :last_name_kana, first_name_kana = :first_name_kana WHERE user_id = :user_id";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':last_name', $data['last_name'], PDO::PARAM_STR);
  $stmt->bindValue(':first_name', $data['first_name'], PDO::PARAM_STR);
  $stmt->bindValue(':last_name_kana', $data['last_name_kana'], PDO::PARAM_STR);
  $stmt->bindValue(':first_name_kana', $data['first_name_kana'], PDO::PARAM_STR);

  $stmt->execute();
}

function update_user_address($dbh, $user_id, $data)
{
  $sql = "UPDATE users SET zipcode = :zipcode, prefecture=:prefecture,city = :city, address = :address, building = :building WHERE user_id = :user_id";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':zipcode', $data['zipcode'], PDO::PARAM_STR);
  $stmt->bindValue(':prefecture', $data['prefecture'], PDO::PARAM_INT);
  $stmt->bindValue(':city', $data['city'], PDO::PARAM_STR);
  $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
  $stmt->bindValue(':building', $data['building'], PDO::PARAM_STR);

  $stmt->execute();
}

function update_user_tel($dbh, $user_id, $tel)
{
  $sql = "UPDATE users SET tel = :tel WHERE user_id = :user_id";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
  $stmt->execute();
}

function user_exists($dbh)
{
  if (!isset($_SESSION['user'])) {
    return false;
  }
  $user_id = $_SESSION['user'];
  if ($user = get_user_data($dbh, $user_id)) {
    return $user;
  } else {
    return false;
  }
}

function delete_user($dbh, $user_id)
{
  $sql = "DELETE FROM users WHERE user_id = :user_id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();
}

// User - Admin
function get_all_user($dbh)
{
  $sql = "SELECT * FROM users";
  $stmt = $dbh->prepare($sql);

  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}



/*------ Product ------*/
function get_product_data($dbh, $product_id)
{
  $sql = "SELECT * FROM products WHERE product_id = :product_id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data;
}

function get_image($dbh, $id)
{
  $product = get_product_data($dbh, $id);
  if ($product['product_img_num'] > 0) {
    return $product['product_id'] . '_1.jpg';
  } else {
    return 'no_image.jpg';
  }
}

// Product - List
function get_new_arrival_data($dbh)
{
  $sql = "SELECT * FROM products ORDER BY created_at ASC";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
} //ポートフォリオ用に昇順に表示

function get_pickup_data($dbh)
{
  $sql = "SELECT * FROM products WHERE pickup = 1 ";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

// Product - Search
function search_product($dbh, $name, $word = null)
{
  if ($word) {
    $sql = "SELECT * FROM products WHERE product_name LIKE :name || product_description LIKE :word";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
    $stmt->bindValue(':word', '%' . $word . '%', PDO::PARAM_STR);

    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  } else {
    $sql = "SELECT * FROM products WHERE product_name LIKE :name ";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);

    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }
}

// Product - Type
function get_type_data($dbh, $id)
{
  $sql = "SELECT * FROM products_detail WHERE product_id = :id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

function get_type_name($dbh, $id, $type)
{
  $sql = "SELECT * FROM products_detail WHERE product_id = :id && type_id = :type";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->bindValue(':type', $type, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data;
}

// Product - Category
function get_category_name_list($dbh)
{
  $sql = "SELECT * FROM categories ";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

function get_category_name($dbh, $category_id)
{
  $sql = "SELECT * FROM categories WHERE category_id = :category_id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);

  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data;
}

function get_category_data($dbh, $category_id)
{
  $sql = "SELECT * FROM products WHERE category_id = :category_id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);

  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

// Product - Favorite
function favorite_exists($dbh, $data)
{
  $sql = "SELECT * FROM favorites WHERE user_id = :user_id && product_id = :product_id";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);

  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data;
}

function add_favorite($dbh, $data)
{
  $sql = "INSERT INTO favorites(user_id, product_id, created_at) VALUE(:user_id, :product_id, SYSDATE())";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);

  $stmt->execute();
}

function delete_favorite($dbh, $data)
{
  $sql = "DELETE FROM favorites WHERE user_id = :user_id && product_id = :product_id";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);

  $stmt->execute();
}

function get_favorite_data($dbh, $user_id)
{
  $sql = "SELECT * FROM products INNER JOIN favorites ON products.product_id = favorites.product_id WHERE favorites.user_id =:user_id ORDER BY favorites.created_at DESC";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

// Product - Admin
function get_product_id($dbh)
{
  $sql = "SELECT MAX(product_id) FROM products ";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data;
}

function insert_product_data($dbh, $data)
{
  $sql = "INSERT INTO products(product_name,product_price,product_description, pickup,category_id, created_at) VALUE(:product_name,:product_price,:product_description,:pickup,:category_id,SYSDATE())";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':product_name', $data['product_name'], PDO::PARAM_STR);
  $stmt->bindValue(':product_price', $data['product_price'], PDO::PARAM_INT);
  $stmt->bindValue(':product_description', $data['product_description'], PDO::PARAM_STR);
  $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);
  $stmt->bindValue(':pickup', $data['pickup'], PDO::PARAM_INT);
  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }
}

function update_product_data($dbh, $data)
{
  $sql = "UPDATE products SET product_name = :product_name, product_price = :product_price,product_description = :product_description, pickup = :pickup ,category_id = :category_id WHERE product_id = :product_id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
  $stmt->bindValue(':product_name', $data['product_name'], PDO::PARAM_STR);
  $stmt->bindValue(':product_price', $data['product_price'], PDO::PARAM_INT);
  $stmt->bindValue(':product_description', $data['product_description'], PDO::PARAM_STR);
  $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);
  $stmt->bindValue(':pickup', $data['pickup'], PDO::PARAM_INT);

  $stmt->execute();
}

function update_product_img($dbh, $id, $num)
{
  $sql = "UPDATE products SET product_img_num = :num WHERE product_id = :product_id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':product_id', $id, PDO::PARAM_INT);
  $stmt->bindValue(':num', $num, PDO::PARAM_INT);

  $stmt->execute();
}

function insert_type_data($dbh, $data)
{
  $sql = "INSERT INTO products_detail(product_id,type_id,type_name) VALUE(:product_id,:type_id,:type_name)";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_id', $data['type_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_name', $data['type_name'], PDO::PARAM_STR);

  $stmt->execute();
}

function update_type_data($dbh, $data)
{
  $sql = "UPDATE products_detail SET type_name = :type_name WHERE product_id = :product_id && type_id = :type_id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_id', $data['type_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_name', $data['type_name'], PDO::PARAM_STR);

  $stmt->execute();
}

function delete_type_data($dbh, $data)
{
  $sql = "DELETE FROM products_detail WHERE product_id = :product_id && type_id = :type_id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_id', $data['type_id'], PDO::PARAM_INT);

  $stmt->execute();
}

function get_product_all($dbh)
{
  $sql = "SELECT * FROM products";
  $stmt = $dbh->prepare($sql);

  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

function delete_product_data($dbh, $product_id)
{
  $sql = "DELETE FROM products WHERE product_id = :product_id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
  $stmt->execute();
}

function get_order_all($dbh)
{
  $sql = "SELECT * FROM orders";
  $stmt = $dbh->prepare($sql);

  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

function update_purchase($dbh, $data)
{
  $sql = "UPDATE products_detail SET quantity = :quantity WHERE product_id = :product_id && type_id = :type_id";
  $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_id', $data['type_id'], PDO::PARAM_INT);
  $stmt->bindValue(':quantity', $data['quantity'], PDO::PARAM_INT);

  $stmt->execute();
}


/*--------- Cart ---------*/
function insert_cart_data($dbh, $data)
{
  $sql = "INSERT INTO cart(user_id, product_id, type_id, quantity, created_at) VALUE(:user_id, :product_id, :type_id, :quantity, SYSDATE())";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_id', $data['type_id'], PDO::PARAM_INT);
  $stmt->bindValue(':quantity', $data['quantity'], PDO::PARAM_INT);

  $stmt->execute();
}

function update_cart_data($dbh, $data)
{
  $sql = "UPDATE cart SET quantity = :quantity WHERE user_id = :user_id && product_id = :product_id && type_id = :type_id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_id', $data['type_id'], PDO::PARAM_INT);
  $stmt->bindValue(':quantity', $data['quantity'], PDO::PARAM_INT);

  $stmt->execute();
}

function get_cart_data($dbh, $id)
{
  $sql = "SELECT * FROM cart WHERE user_id = :id ORDER BY created_at ASC";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id);

  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

function add_to_cart($dbh, $data, $user_id = null)
{
  if ($user_id !== null) {
    //ユーザのカートを取得
    $user_cart = get_cart_data($dbh, $user_id);

    //カートに中身がある場合
    $data['user_id'] = $user_id;
    if ($user_cart) {
      // 一致する商品がある場合アップデート
      foreach ($user_cart as $key => $value) {
        if ($value['product_id'] === $data['product_id'] && $value['type_id'] === $data['type_id']) {
          $user_cart[$key]['quantity'] += $data['quantity'];
          update_cart_data($dbh, $user_cart[$key]);
          return true;
        }
      }
      //一致する商品がない場合insert
      insert_cart_data($dbh, $data);
      return true;
    }
    //カートの中身がない場合insert
    insert_cart_data($dbh, $data);
    return true;
    //セッションに商品がある場合
  } elseif (isset($_SESSION['cart'])) {
    // 一致する商品がある場合：要素に個数を追加
    foreach ($_SESSION['cart'] as $key => $value) {
      if ($value['product_id'] === $data['product_id'] && $value['type_id'] === $data['type_id']) {
        $_SESSION['cart'][$key]["quantity"] += $data['quantity'];
        return true;
      }
    }
    // 一致する商品がない場合：配列に追加
    $_SESSION['cart'][] = $data;
    return true;
  } else {
    // セッションに商品がない場合：配列に追加
    $_SESSION['cart'][] = $data;
    return true;
  }
}

function delete_cart_data($dbh, $data)
{
  $sql = "DELETE FROM cart WHERE user_id = :user_id && product_id = :product_id && type_id = :type_id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_id', $data['type_id'], PDO::PARAM_INT);

  $stmt->execute();
}

function delete_user_cart($dbh, $user_id)
{
  $sql = "DELETE FROM cart WHERE  user_id = :user_id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

  $stmt->execute();
}

function insert_order_data($dbh, $data)
{
  $sql = "INSERT INTO orders(user_id, order_name, order_zipcode, order_address, order_building, created_at) VALUE (:user_id, :order_name, :order_zipcode, :order_address, :order_building, :created_at)";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
  $stmt->bindValue(':order_name', $data['order_name'], PDO::PARAM_STR);
  $stmt->bindValue(':order_zipcode', $data['order_zipcode'], PDO::PARAM_STR);
  $stmt->bindValue(':order_address', $data['order_address'], PDO::PARAM_STR);
  $stmt->bindValue(':order_building', $data['order_building'], PDO::PARAM_STR);
  $stmt->bindValue(':created_at', $data['created_at'], PDO::PARAM_STR);

  $stmt->execute();
}

function get_order_id($dbh, $user_id, $created_at)
{
  $sql = "SELECT * FROM orders WHERE user_id = :user_id && created_at = :created_at";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':created_at', $created_at, PDO::PARAM_STR);

  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data;
}

function insert_order_detail($dbh, $data)
{
  $sql = "INSERT INTO orders_detail(order_id, product_id, type_id, quantity) VALUE (:order_id, :product_id, :type_id,:quantity)";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':order_id', $data['order_id'], PDO::PARAM_INT);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_id', $data['type_id'], PDO::PARAM_INT);
  $stmt->bindValue(':quantity', $data['quantity'], PDO::PARAM_INT);

  $stmt->execute();
}

function update_product_quantity($dbh, $data)
{
  $sql = "UPDATE products_detail SET quantity = :quantity WHERE product_id = :product_id && type_id = :type_id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
  $stmt->bindValue(':type_id', $data['type_id'], PDO::PARAM_INT);
  $stmt->bindValue(':quantity', $data['quantity'], PDO::PARAM_INT);

  $stmt->execute();
}

function get_user_order($dbh, $user_id)
{
  $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

function get_order_data($dbh, $order_id)
{
  $sql = "SELECT * FROM orders WHERE order_id = :order_id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data;
}

function get_order_detail($dbh, $order_id)
{
  $sql = "SELECT * FROM orders_detail  WHERE order_id = :order_id";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

/*------ Contact ------*/
function insert_contact_data($dbh, $data)
{
  $sql = "INSERT INTO contacts(contact_name, contact_email, contact_tel, message, created_at) VALUE(:contact_name, :contact_email, :contact_tel, :message, SYSDATE())";

  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':contact_name', $data['contact_name'], PDO::PARAM_STR);
  $stmt->bindValue(':contact_email', $data['contact_email'], PDO::PARAM_STR);
  $stmt->bindValue(':contact_tel', $data['contact_tel'], PDO::PARAM_STR);
  $stmt->bindValue(':message', $data['contact_message'], PDO::PARAM_STR);

  $stmt->execute();
}

//Admin
function get_contact_all($dbh)
{
  $sql = "SELECT * FROM contacts";
  $stmt = $dbh->prepare($sql);

  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

function get_contact_data($dbh, $contact_id)
{
  $sql = "SELECT * FROM contacts WHERE contact_id = :contact_id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':contact_id', $contact_id, PDO::PARAM_INT);

  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $data;
}
