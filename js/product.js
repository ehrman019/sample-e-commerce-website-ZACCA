/*------　画像の表示　------*/
// 画像をURLをHTMLに挿入する関数
const showImages = (img, thumbnails, id, num) => {
	if (num == 0) {
		img.innerHTML += `<img src="./img/no_image.jpg" alt="商品画像" style="visibility: visible; opacity:1; ">`;
		thumbnails.innerHTML += `<img src="./img/no_image.jpg" alt="商品サムネ" class="show">`;
	} else {
		for (let i = 1; i <= num; i++) {
			if (i === 1) {
				img.innerHTML += `<img src="./img/${id}_${i}.jpg" alt="商品画像" style="visibility: visible; opacity:1;">`;
				thumbnails.innerHTML += `<img src="./img/${id}_${i}.jpg" alt="商品サムネ" class="show">`;
			} else {
				img.innerHTML += `<img src="./img/${id}_${i}.jpg" alt="商品画像"  style="visibility: hidden;">`;
				thumbnails.innerHTML += `<img src="./img/${id}_${i}.jpg" alt="商品サムネ">`;
			}
		}
	}
};

const open = (image) => {
	image.style.opacity = "1";
	image.style.visibility = "visible";
};

const close = (image) => {
	image.style.opacity = "0";
	image.style.visibility = "hidden";
};

// 現在表示している画像のIdxを取得する関数
const getImgIndex = (list) => {
	const num = list.length;
	for (let i = 0; i < num; i++) {
		if (list[i].classList.contains("show")) {
			return i;
		}
	}
};

// Elements
const productImg = document.getElementById("product-img");
const productThumbnails = document.getElementById("product-thumb-list");
const thumbPrev = document.getElementById("thumb-prev");
const thumbNex = document.getElementById("thumb-nex");

// ロード時に画像URLを挿入
showImages(productImg, productThumbnails, productID, imgNum);

// 画像の遷移（前後）の関数
const thumbnails = document.querySelectorAll(".product-thumb-list img");
const images = document.querySelectorAll(".product-img img");

const nextImg = () => {
	let nowIndex = getImgIndex(thumbnails);

	thumbnails[nowIndex].classList.remove("show");
	close(images[nowIndex]);

	nowIndex++;
	nowIndex %= imgNum;

	thumbnails[nowIndex].classList.add("show");
	open(images[nowIndex]);
};

// 画像の自動遷移用の変数(global)
let autoImg;

// 2枚以上の時のみ作動させる
if (imgNum > 1) {
	// 画像の自動遷移開始
	autoImg = window.setInterval(nextImg, 4000);

	// サムネ画像クリック時
	for (let i = 0; i < imgNum; i++) {
		thumbnails[i].addEventListener("click", function () {
			let nowIndex = getImgIndex(thumbnails);
			thumbnails[nowIndex].classList.remove("show");

			close(images[nowIndex]);

			this.classList.add("show");
			nowIndex = getImgIndex(thumbnails);

			open(images[nowIndex]);
			// サムネ画像クリック時は自動遷移を停止
			window.clearInterval(autoImg);
		});
	}

	// prevボタンクリック時
	thumbPrev.addEventListener("click", () => {
		let nowIndex = getImgIndex(thumbnails);

		thumbnails[nowIndex].classList.remove("show");

		close(images[nowIndex]);

		nowIndex += imgNum - 1;
		nowIndex %= imgNum;

		thumbnails[nowIndex].classList.add("show");
		open(images[nowIndex]);

		window.clearInterval(autoImg);
		autoImg = setInterval(nextImg, 4000);
	});

	// nextボタンクリック時
	thumbNex.addEventListener("click", () => {
		let nowIndex = getImgIndex(thumbnails);

		thumbnails[nowIndex].classList.remove("show");
		images[nowIndex].style.display = "block";
		close(images[nowIndex]);

		nowIndex++;
		nowIndex %= imgNum;

		thumbnails[nowIndex].classList.add("show");
		open(images[nowIndex]);

		window.clearInterval(autoImg);
		autoImg = setInterval(nextImg, 4000);
	});
}

/*------ [カートに入れる]ボタンをクリック時 ------*/
const productButton = document.getElementById("product-button");
const productModal = document.getElementById("product-modal");
productButton.addEventListener("click", () => {
	const type = Number(document.getElementById("type").value);
	// タイプのバリデーション
	console.log(type);
	if (type === 0) {
		const typeErr = document.getElementById("type-err");
		typeErr.innerHTML = "タイプを選択して</br>ください";
	} else {
		const quantity = Number(document.getElementById("quantity-input").value);
		const postData = {
			product_id: productID,
			type_id: type,
			quantity: quantity,
		};
		// データを送信
		fetch("./api/add_product.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify(postData),
		})
			.then((res) => res.json())
			.then((res) => {
				// カートに送信成功のとき
				if (res) {
					//モーダルを開く
					modalOpen(productModal);
					// 背景となるページの画像遷移を停止
					window.clearInterval(autoImg);
				}
			})
			.catch((error) => {
				console.log(error);
			});
	}
});

/*------ お気に入りボタンをクリック時 ------*/
const favButton = document.getElementById("product-favorite");
const favIcon = document.getElementById("favorite-icon");

// お気に入りかどうかをPHPから取得
if (favorite) {
	favIcon.style.setProperty("font-weight", "bold");
}
favButton.addEventListener("click", () => {
	// PHPから商品IDを取得しデータを送信
	fetch("./api/add_favorite.php", {
		method: "POST",
		headers: { "Content-Type": "application/json" },
		body: JSON.stringify(productID),
	})
		.then((res) => {
			return res.json();
		})
		.then((res) => {
			if (res === "login") {
				// ログイン状態で押されたとき
				if (favorite) {
					favIcon.style.setProperty("font-weight", "normal");
					favorite = 0;
				} else {
					favIcon.style.setProperty("font-weight", "bold");
					favorite = 1;
				}
			} else if (res === "logout") {
				// ログアウト状態で押されたとき
				window.location.href = "login.php";
			} else if (res === "index") {
				// POSTがないとき
				window.location.href = "index.php";
			}
		})
		.catch((error) => {
			console.log(error);
		});
});
