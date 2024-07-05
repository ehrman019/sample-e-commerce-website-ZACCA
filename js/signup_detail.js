/*------ 生年月日入力 ------*/

// Elements
const selectYear = document.getElementById("year");
const selectMonth = document.getElementById("month");
const selectDay = document.getElementById("day");
const nowYear = new Date().getFullYear();

// １月～12月のリスト
const thirtyone = ["1", "3", "5", "7", "8", "10", "12"];
const thirty = ["4", "6", "9", "11"];

// selectタグ内のoptionリストを作成する関数
const createList = (l, r, elm, post, def) => {
	if (def === undefined) {
		for (let i = l; i <= r; i++) {
			if (i === post) {
				elm.innerHTML += `<option value="${i}" selected>${i}</option>`;
			} else {
				elm.innerHTML += `<option value="${i}">${i}</option>`;
			}
		}
	} else {
		for (let i = l; i <= r; i++) {
			if (i === def && i === post) {
				elm.innerHTML += `<option value="${i}" id="default" selected>${i}</option>`;
			} else if (i === def) {
				elm.innerHTML += `<option value="${i}" id="default">${i}</option>`;
			} else if (i === post) {
				elm.innerHTML += `<option value="${i}" selected>${i}</option>`;
			} else {
				elm.innerHTML += `<option value="${i}" >${i}</option>`;
			}
		}
	}
};

// 選択された年、月で日のリストを変更する関数
const createDay = () => {
	let year = selectYear.value;
	let month = selectMonth.value;
	// 年、月両方選択されているときのみ日のリストを生成
	if (year !== "-" && month !== "-") {
		selectDay.innerHTML = `<option value="" hidden>-</option>`;
		let num = 0;
		if (thirtyone.includes(month)) {
			num = 31;
		} else if (thirty.includes(month)) {
			num = 30;
		} else if (year % 400 === 0 || (year % 100 !== 0 && year % 4 == 0)) {
			num = 29;
		} else {
			num = 28;
		}
		createList(1, num, selectDay);
	}
};

// 読み込み時にリストを作成
createList(nowYear - 120, nowYear, selectYear, postYear, 1990);
createList(1, 12, selectMonth, postMonth);
createList(1, 31, selectDay, postDay);

// クリック、タップ時にデフォルトの年が表示されるようにする
// !ブラウザによってはうまくいかない
selectYear.addEventListener("focus", () => {
	if (postYear === 0) {
		const def = document.getElementById("default");
		def.setAttribute("selected", "");
	}
});

selectYear.addEventListener("touchstart", () => {
	if (postYear === 0) {
		const def = document.getElementById("default");
		def.setAttribute("selected", "");
	}
});

// 月が選択されたら日のリストを作成
selectMonth.addEventListener("click", () => {
	createDay();
});

// 年が選択されたら日のリストを作成
selectYear.addEventListener("click", () => {
	createDay();
});


