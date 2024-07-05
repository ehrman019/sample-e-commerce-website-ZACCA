/*------ Admin Edit Images -----*/
const dragField = document.getElementById("drop-img");
const imgInput = document.getElementById("img-submit");
const imgSelectText = document.getElementById("img-select-text");

// 選択した画像（ファイル）をページに表示する関数
function OnFileSelect(fileList) {
  const fileCount = fileList.length; // ファイルの数
  let loadCompleteCount = 0; // カウント用変数
  let imageList = ""; // HTML用変数

  // 選択されたファイルの数だけ処理する
  for (let i = 0; i < fileCount; i++) {
    let fileReader = new FileReader(); // FileReaderを生成
    const file = fileList[i]; // ファイルを取得
    // 読み込み完了時の処理
    fileReader.onload = function () {
      imageList += `<li><img src="${this.result}" /></li>`;
      if (++loadCompleteCount == fileCount) {
        document.getElementById("select-img").innerHTML = imageList;
      }
    };
    // ファイルの読み込み(Data URI Schemeの取得)
    fileReader.readAsDataURL(file);
  }
  imgSelectText.innerText = `${fileCount}ファイル選択中`;
}

dragField.addEventListener("dragover", function (e) {
  e.preventDefault();
});

dragField.addEventListener("drop", function (e) {
  e.preventDefault();
  const files = e.dataTransfer.files;
  imgInput.files = files;
  OnFileSelect(files);
});

imgInput.addEventListener("change", function () {
  const files = this.files;
  OnFileSelect(files);
});
