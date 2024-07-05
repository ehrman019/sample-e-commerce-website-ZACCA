/*------ Cart ------*/
const cartPrice = document.querySelectorAll(".cart-price");
const cartQuantity = document.querySelectorAll(".quantity-input");
const cartSubtotal = document.querySelectorAll(".cart-subtotal");
const cartTotal = document.getElementById("cart-total");

// 再計算の関数
const calcPrice = () => {
	let data = [];
	for (let i = 0; i < cart.length; i++) {
		const p = cartPrice[i].getAttribute("data-price");
		const num = cartQuantity[i].value;

		// 送信用データを格納
		data.push({
			product_id: cart[i]["product_id"],
			product_price: p,
			type_id: cart[i]["type_id"],
			quantity: cartQuantity[i].value,
		});
	}
	return data;
};

// ロード時に計算
let sum = 0;
for (let i = 0; i < cart.length; i++) {
	const p = cartPrice[i].getAttribute("data-price");
	const num = cartQuantity[i].value;

	cartSubtotal[i].innerText = new Intl.NumberFormat().format(p * num);
	sum += p * num;
}
cartTotal.innerText = new Intl.NumberFormat().format(sum);

// 再計算ボタンが押されたとき
const cartButton = document.getElementById("cart-calc-button");
cartButton.addEventListener("click", () => {
	// 連想配列をfetchで送信する
	const postData = calcPrice();

	// データを送信
	fetch("./api/cart_calc.php", {
		method: "POST",
		headers: { "Content-Type": "application/json" },
		body: JSON.stringify(postData),
	})
		.then((res) => res.json())
		.then((data) => {
			//帰ってきたデータを挿入

			cartSubtotal.forEach((Elm) => {
				Elm.style.opacity = "0";
			});
			cartTotal.style.opacity = "0";

			let sum = 0;
			for (let i = 0; i < data.length; i++) {
				cartSubtotal[i].innerText = new Intl.NumberFormat().format(
					data[i]["product_price"] * data[i]["quantity"]
				);
				sum += data[i]["product_price"] * data[i]["quantity"];
			}
			cartTotal.innerText = new Intl.NumberFormat().format(sum);

			// 金額をフェードインさせる
			window.setTimeout(function () {
				cartSubtotal.forEach((Elm) => {
					Elm.style.opacity = "1";
				});
				cartTotal.style.opacity = "1";
			}, 200);
		});
});

// 購入ボタンが押されたとき
const checkButton = document.getElementById("cart-button");
checkButton.addEventListener("click", () => {
	const postData = calcPrice();

	// データを送信
	fetch("cart_calc.php", {
		method: "POST",
		headers: { "Content-Type": "application/json" },
		body: JSON.stringify(postData),
	}).catch((error) => {
		console.log(error);
	});

	window.location.href = "order.php";
});
