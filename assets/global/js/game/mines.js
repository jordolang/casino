let betBtn = $(".betBtn");
let cashoutBtn = $(".cashoutBtn");
let gameLogId;
let mineBox;
let mineIds = [];
let balance = $(".balance");
let investField = $("[name=invest]");
let minesField = $("[name=mines]");
let goldMineBox = $(".gold-mine-box");
let betInput = $(".bet-input");
let minesInput = $(".mines-input");

function game(url, data) {
  $.post(url, data, function (response) {
    if (response.error) {
      betBtn.prop("disabled", false);
      betBtn.removeClass("d-none");
      notify("error", response.error);
      return;
    }

    betInput.hide();
    minesInput.hide();

    investField.val("");
    minesField.val("");

    balance.text(response.balance);

    $.each($(".mineBox"), function (index, item) {
      $(item).removeClass("gold-box");
    });
    cashoutBtn.removeClass("d-none");
    gameLogId = response.game_log_id;
  });
}

function gameEnd(mineUrl, mineData) {
  $.post(mineUrl, mineData, function (response) {
    if (response.error) {
      notify("error", response.error);
      return;
    }

    var mineId = mineBox.attr("id").split("mine");
    mineIds.push(Number(mineId[1]));

    const mineImage = `<img src="${response.mine_image}" alt="image"/>`;
    const goldImage = `<img src="${response.gold_image}" alt="image"/>`;
    const transparentImage = `<img src="${response.gold_transparent}" alt="image"/>`;

    mineBox.addClass("mined");

    if (response.type == "success") {
      mineBox.find(".mine-box-hidden").html(goldImage);
      goldMineBox.append(`<div class="mine-image">${transparentImage}</div>`);
    } else {
      playAudio(response.sound);
      mineBox.find(".mine-box-hidden").html(mineImage);

      const totalMines = response.mines;

      var items = [];
      for (let i = 1; i <= 25; i++) {
        if (!mineIds.includes(i)) {
          items.push(i);
        }
      }

      const availableMines = totalMines - 1;

      var randomValues = items.slice(0, availableMines).map(function () {
        return this.splice(Math.floor(Math.random() * this.length), 1)[0];
      }, items.slice());

      randomValues.push(Number(mineBox.attr("id").split("mine")[1]));

      $.each($(".mineBox"), function (index, item) {
        $(item).addClass("active-hidden");
        if (
          randomValues.includes(Number($(item).attr("id").split("mine")[1]))
        ) {
          $(item).find(".mine-box-hidden").html(mineImage);
        } else {
          $(item).addClass("mined");
          $(item).find(".mine-box-hidden").html(goldImage);
        }
      });
      notify("error", response.message);
      refreshBoard();
    }
  });
}

function cashout(cashoutUrl, cashoutData) {
  $.post(cashoutUrl, cashoutData, function (response) {
    if (response.error) {
      notify("error", response.error);
      return;
    }

    goldMineBox.html("");
    betInput.show();
    minesInput.show();

    balance.text(response.balance);
    playAudio(response.sound);
    refreshBoard();
    notify("success", response.success);
  });
}

function playAudio(filename) {
  var audio = new Audio(filename);
  audio.play();
}

function refreshBoard() {
  cashoutBtn.addClass("d-none");
  betBtn.removeClass("d-none");
  setTimeout(() => {
    $.each($(".mineBox"), function (index, item) {
      $(item).removeClass("active-hidden");
      $(item).removeClass("mined");
      $(item).addClass("gold-box");
      $(item).find(".mine-box-hidden").html("");
    });
    betBtn.prop("disabled", false);

    goldMineBox.html("");
    betInput.show();
    minesInput.show();
  }, 3000);
}
