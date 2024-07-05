/*------- Default -------*/
//CSSの定数
const root = document.querySelector(":root");
const html = document.querySelector("html");
const header = document.querySelector(".header");

//スクロール位置の変数
let y = 0;

const modalOpen = (modal) => {
  modal.style.opacity = "1";
  modal.style.visibility = "visible";
  html.style.setProperty("overflow", "hidden");
};

const modalClose = (modal) => {
  modal.style.opacity = "0";
  modal.style.visibility = "hidden";
  html.style.setProperty("overflow", null);
};

// フォーム送信後のページ位置の保持
const forms = document.querySelectorAll(".form");
const submitButton = document.querySelectorAll(".submit-button");
const pageY = document.querySelectorAll(".page-y");

if (forms.length > 0) {
  for (let i = 0; i < forms.length; i++) {
    submitButton[i].addEventListener("click", (e) => {
      e.preventDefault();
      pageY[i].value = window.scrollY;
      forms[i].submit();
    });
  }
  window.scroll({
    top: prevY,
    behavior: "instant",
  });
}

/*------- Header -------*/
const HeaderContent = document.getElementById("header-content");

//ヘッダの下線
window.addEventListener("scroll", () => {
  let now_position = document.documentElement.scrollTop;

  if (now_position !== 0) {
    HeaderContent.style.borderBottom = "none";
  } else {
    HeaderContent.style.borderBottom = "0.4px solid var(--lightbrown)";
  }
});

/*------ Header Modal -------*/
const buttonOpen = document.getElementById("modalOpen");
const buttonClose = document.getElementById("modalClose");

const modal = document.getElementById("modal");

//ハンバーガーメニューのアニメーション
const bar1 = document.querySelectorAll('[data-bar="1"]');
const bar2 = document.querySelectorAll('[data-bar="2"]');
const bar3 = document.querySelectorAll('[data-bar="3"]');

const barOpen = () => {
  bar1.forEach((Elm) => {
    Elm.style.setProperty("transform", "translate(0, 6.5px) rotate(45deg)");
  });
  bar2.forEach((Elm) => {
    Elm.style.setProperty("opacity", "0");
  });
  bar3.forEach((Elm) => {
    Elm.style.setProperty("transform", "translate(0, -6.5px) rotate(-45deg)");
  });
};

const barClose = () => {
  bar1.forEach((Elm) => {
    Elm.style.setProperty("transform", "translate(0, 0) rotate(0)");
  });
  bar2.forEach((Elm) => {
    Elm.style.setProperty("opacity", "1");
  });
  bar3.forEach((Elm) => {
    Elm.style.setProperty("transform", "translate(0, 0) rotate(0)");
  });
};

//モーダルを閉じたとき、以前のスクロール位置を表示
buttonOpen.addEventListener("click", () => {
  y = window.scrollY;
  modalOpen(modal);
  barOpen();
});

buttonClose.addEventListener("click", () => {
  modalClose(modal);
  barClose();
});

/*------ FooterButton ------*/
const footerButton = document.getElementById("footer-before-button");
//TOPボタンの色の変化
//スマホ・タブレットのとき無効にする
if (!navigator.userAgent.match(/(iPhone|iPad|Android)/)) {
  if (footerButton !== null) {
    footerButton.addEventListener("mouseover", () => {
      root.style.setProperty("--footerbutton-color", "var(--beige)");
      root.style.setProperty("--footerbutton-background", "var(--lightbrown)");
    });
    footerButton.addEventListener("mouseout", () => {
      root.style.setProperty("--footerbutton-color", "var(--lightbrown)");
      root.style.setProperty("--footerbutton-background", "transition");
    });
  }
}

/*------ Select ------*/
//セレクトをクリック時、文字の色を変化させる
const selects = document.querySelectorAll(".select-hidden");
if (selects !== null) {
  selects.forEach((elm) => {
    elm.addEventListener("focusin", () => {
      elm.classList.remove("select-hidden");
    });
  });
}

/*------ Quantity ------*/
const decButton = document.querySelectorAll(".quantity-dec");
const incButton = document.querySelectorAll(".quantity-inc");
const quantityNum = document.querySelectorAll(".quantity-input");

let sz = quantityNum.length;

for (let i = 0; i < sz; i++) {
  if (quantityNum[i] !== null) {
    decButton[i].addEventListener("click", () => {
      if (quantityNum[i].value > 1) {
        quantityNum[i].value--;
      }
    });

    incButton[i].addEventListener("click", () => {
      if (quantityNum[i].value < 99) {
        quantityNum[i].value++;
      }
    });
  }
}

/*------ MyPage Delete Account ------*/
const deleteAccountButton = document.getElementById("delete-account-button");
const deleteAccountModal = document.getElementById("delete-account-modal");
const deleteAccountCancel = document.getElementById("delete-account-cancel");

if (deleteAccountModal) {
  deleteAccountButton.addEventListener("click", () => {
    modalOpen(deleteAccountModal);
  });

  deleteAccountCancel.addEventListener("click", () => {
    modalClose(deleteAccountModal);
  });

  deleteAccountModal.addEventListener("click", (e) => {
    if (e.target === deleteAccountModal) {
      modalClose(deleteAccountModal);
    }
  });
}
