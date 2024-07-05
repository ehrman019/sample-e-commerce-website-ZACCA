/*------ Definition ------*/
const root = document.querySelector(":root");

/*------ Header ------*/
// ヘッダのボタンが押されたとき横にスライド
const headerButton = document.getElementById("header-button");
const headerContent = document.getElementById("header-content");
const headerButtonIcon = document.getElementById("header-button-icon");
const headerWidth = "-240px";
headerButton.addEventListener("click", () => {
  if (headerButton.classList.contains("open")) {
    root.style.setProperty("--admin-header-width", headerWidth);
    headerButtonIcon.style.setProperty(
      "transform",
      "rotate(225deg) translateX(-50%)"
    );
    headerButton.classList.remove("open");
  } else {
    root.style.setProperty("--admin-header-width", "0px");
    headerButtonIcon.style.setProperty(
      "transform",
      "rotate(45deg) translateX(100%)"
    );
    headerButton.classList.add("open");
  }
});

/*------- Select ------*/
//セレクトをクリック時、文字の色を変化させる
const selects = document.querySelectorAll(".select-hidden");
if (selects !== null) {
  selects.forEach((elm) => {
    elm.addEventListener("focusin", () => {
      elm.classList.remove("select-hidden");
    });
  });
}
