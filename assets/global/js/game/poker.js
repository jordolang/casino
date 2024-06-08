let investField = $("[name=invest]");
let dealBtn = $(".dealBtn");
let investBtn = $(".investBtn");
let actionArea = $(".action-area");
let dealArea = $(".deal-area");
let refreshArea = $(".refresh-area");
let balance = $(".balance");
let cardArea = $(".poker-table__wrapper");
let sessionId = 0;
let invest;
let gameLogId;
let gameCard = $("#game--card");
let formArea = $("#form--area");

dealBtn.addClass("d-none");
refreshArea.hide();
actionArea.hide();

function game(url, data) {
  $.post(url, data, function (response) {
    if (response.error) {
      investBtn.removeClass("d-none");
      notify("error", response.error);
      return;
    }

    formArea.hide();
    gameCard.removeClass("col-xl-9");
    gameCard.addClass("col-xl-12");

    investField.val("");
    dealBtn.removeClass("d-none");
    gameLogId = response.game_log_id;
    balance.text(response.balance);
    notify("success", response.message);
  });
}

function deal(url, data) {
  $.post(url, data, function (response) {
    if (response.error) {
      notify("error", response.error);
    }

    localStorage.setItem("sessionId", gameLogId);

    dealArea.hide();
    actionArea.show();

    cardArea
      .children(":first")
      .find("img")
      .attr("src", `${response.path}/${response.result[0]}.png`);
    cardArea
      .children(":eq(1)")
      .find("img")
      .attr("src", `${response.path}/${response.result[1]}.png`);
    cardArea
      .children(":eq(2)")
      .find("img")
      .attr("src", `${response.path}/${response.result[2]}.png`);
  });
}

function call(url, data) {
  $.post(url, data, function (response) {
    if (response.error) {
      notify("error", response.error);
    }

    localStorage.setItem("sessionId", gameLogId);

    actionArea.hide();
    refreshArea.show();

    balance.text(response.balance);
    cardArea
      .children(":eq(3)")
      .find("img")
      .attr("src", `${response.path}/${response.result[0]}.png`);
    cardArea
      .children(":eq(4)")
      .find("img")
      .attr("src", `${response.path}/${response.result[1]}.png`);

    $(".win-loss-popup").addClass("active");
    $(".win-loss-popup__body").find("img").addClass("d-none");
    playAudio(response.sound);

    if (response.type == "success") {
      $(".win-loss-popup__body").find(".win").removeClass("d-none");
    } else {
      $(".win-loss-popup__body").find(".lose").removeClass("d-none");
    }
    $(".win-loss-popup__footer").find(".data-result").text(response.rank);
  });
}
function fold(url, data) {
  $.post(url, data, function (response) {
    if (response.error) {
      notify("error", response.error);
    }

    localStorage.setItem("sessionId", gameLogId);

    actionArea.hide();
    refreshArea.show();

    $(".win-loss-popup").addClass("active");
    $(".win-loss-popup__body").find("img").addClass("d-none");
    playAudio(response.sound);
    $(".win-loss-popup__body").find(".lose").removeClass("d-none");
    $(".win-loss-popup__footer").find(".data-result").text(response.rank);
  });
}

function playAudio(filename) {
  var audio = new Audio(filename);
  audio.play();
}

$(".refreshBtn").on("click", function () {
  refresh();
});

function refresh() {
  localStorage.removeItem("sessionId");
  window.location.reload();
}

$(window).on("load", function () {
  localStorage.removeItem("sessionId");
});
