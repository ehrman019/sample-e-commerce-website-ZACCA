/*------ Admin Register Prodcut ------*/
// 入力時に値をHTMLに渡す補助関数
const setValue = (Elm) => {
  Elm.addEventListener("change", () => {
    const inputValue = Elm.value;
    if (Elm.tagName === "INPUT") {
      Elm.setAttribute("value", inputValue);
    } else if (Elm.tagName === "TEXTAREA") {
      Elm.innerText = inputValue;
    } else if (Elm.tagName === "SELECT") {
      for (let i = 0; i < Elm.options.length; i++) {
        if (Elm.options[i].hasAttribute("selected")) {
          Elm.options[i].removeAttribute("selected");
        }
        if (i === Elm.selectedIndex) {
          Elm.options[i].setAttribute("selected", "");
        }
      }
    }
  });
};

// admin_product_register.php内で入力時に値をHTMLに渡す関数
const productFunc = (rowNum = 1) => {
  for (let i = 0; i < rowNum; i++) {
    const name = document.getElementById(`product-name-${i + 1}`);
    const price = document.getElementById(`product-price-${i + 1}`);
    const category = document.getElementById(`product-category-${i + 1}`);
    const pickup = document.querySelectorAll(`.product-pickup-${i + 1}`);

    const description = document.getElementById(`product-description-${i + 1}`);

    setValue(name);
    setValue(price);
    setValue(category);
    if (description !== null) {
      setValue(description);
    }

    for (let j = 0; j < pickup.length; j++) {
      pickup[j].addEventListener("change", () => {
        for (let k = 0; k < pickup.length; k++) {
          if (pickup[k].checked) {
            pickup[k].setAttribute("checked", "");
          } else {
            pickup[k].removeAttribute("checked", "");
          }
        }
      });
    }
  }
};

//タイプの行の増減などの関数
const typeFunc = () => {
  for (let i = 0; i < rowNum; i++) {
    //定数
    const typeButton = document.getElementById(`type-button-${i + 1}`);
    const typeInc = document.getElementById(`type-inc-${i + 1}`);
    const typeDec = document.getElementById(`type-dec-${i + 1}`);
    const typeErr = document.getElementById(`type-err-${i + 1}`);
    const typeName = document.getElementById(`type-name-${i + 1}`);
    const typeNum = document.getElementById(`type-num-${i + 1}`);

    let curNum = 0;

    const open = (Button, Elm) => {
      Elm.style.setProperty("display", "block");
      Button.classList.add("open");
    };

    const close = (Button, Elm) => {
      Elm.style.setProperty("display", "none");
      Button.classList.remove("open");
    };

    const typeInput = (num) => {
      if (num > 10) {
        typeErr.innerHTML = "<p>タイプは10個までです</p>";
        num = 10;
      } else if (num <= 10 && typeErr.hasChildNodes()) {
        typeErr.removeChild(typeErr.firstElementChild);
      }

      curNum = typeName.children.length;

      if (curNum < num) {
        for (let j = curNum; j < num; j++) {
          typeName.innerHTML += `<li><span class="admin-type-number">${
            j + 1
          }</span><span class="admin-type-number">:</span><input type="text" name="type-name-${
            i + 1
          }[]" value=""></li>`;
        }
      } else {
        for (let j = 0; j < curNum - num; j++) {
          typeName.removeChild(typeName.lastElementChild);
        }
      }

      if (typeName.hasChildNodes()) {
        const typeRows = typeName.children;
        for (let j = 0; j < typeRows.length; j++) {
          const typeRowInput = typeRows[j].getElementsByTagName("input");
          setValue(typeRowInput[0]);
        }
      }

      curNum = num;
      typeNum.value = curNum;
      typeNum.setAttribute("value", curNum);
    };

    //増加するとき
    typeInc.addEventListener("click", () => {
      let num = typeNum.value;
      if (num === "") {
        typeErr.innerHTML = "<p>個数を入力してください</p>";
      } else {
        open(typeButton, typeName);
        num = Number(num);
        typeInput(++num);
      }
    });

    //減少するとき
    typeDec.addEventListener("click", () => {
      let num = typeNum.value;
      if (num === "") {
        typeErr.innerHTML = "<p>個数を入力してください</p>";
      } else {
        open(typeButton, typeName);
        num = Number(num);
        if (num > 0) {
          typeInput(--num);
        }
      }
    });

    //入力ボタンを押したとき
    typeButton.addEventListener("click", () => {
      let num = typeNum.value;

      if (num === "") {
        typeErr.innerHTML = "<p>個数を入力してください</p>";
      } else {
        num = Number(num);
        typeInput(num);
      }

      if (!typeButton.classList.contains("open")) {
        open(typeButton, typeName);
      } else {
        close(typeButton, typeName);
      }
    });
  }
};

productFunc();
typeFunc();
