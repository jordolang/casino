$(".oneToTw").mouseover(function () {
    $(".oneToTwEl").addClass("__select");
});

$(".oneToTw").mouseout(function () {
    $(".oneToTwEl").removeClass("__select");
});
$(".thrtToTf").mouseover(function () {
    $(".thrtToTfEl").addClass("__select");
});

$(".thrtToTf").mouseout(function () {
    $(".thrtToTfEl").removeClass("__select");
});

$(".twfToTs").mouseover(function () {
    $(".twfToTsEl").addClass("__select");
});

$(".twfToTs").mouseout(function () {
    $(".twfToTsEl").removeClass("__select");
});

$(".oneToEt").mouseover(function () {
    $(".oneToEtEl").addClass("__select");
});

$(".oneToEt").mouseout(function () {
    $(".oneToEtEl").removeClass("__select");
});

$(".nineteenTtsix").mouseover(function () {
    $(".nineteenTtsixEl").addClass("__select");
});

$(".nineteenTtsix").mouseout(function () {
    $(".nineteenTtsixEl").removeClass("__select");
});

$(".even").mouseover(function () {
    $(".evenEl").addClass("__select");
});

$(".even").mouseout(function () {
    $(".evenEl").removeClass("__select");
});

$(".odd").mouseover(function () {
    $(".oddEl").addClass("__select");
});

$(".odd").mouseout(function () {
    $(".oddEl").removeClass("__select");
});

$(".red").mouseover(function () {
    $(".redEl").addClass("__select");
});

$(".red").mouseout(function () {
    $(".redEl").removeClass("__select");
});

$(".black").mouseover(function () {
    $(".blackEl").addClass("__select");
});

$(".black").mouseout(function () {
    $(".blackEl").removeClass("__select");
});

$(".twByOne1").mouseover(function () {
    $(this).parents("tr").find("td").addClass("__select");
    $(this).parents("tr").find(".zero").removeClass("__select");
    $(this).removeClass("__select");
});

$(".twByOne1").mouseout(function () {
    $(this).parents("tr").find("td").removeClass("__select");
});

$(".twByOne2").mouseover(function () {
    $(this).parents("tr").find("td").addClass("__select");
    $(this).removeClass("__select");
});

$(".twByOne2").mouseout(function () {
    $(this).parents("tr").find("td").removeClass("__select");
});

$(".twByOne3").mouseover(function () {
    $(this).parents("tr").find("td").addClass("__select");
    $(this).removeClass("__select");
});

$(".twByOne3").mouseout(function () {
    $(this).parents("tr").find("td").removeClass("__select");
});

//Click
var aroVal = 0;
$("td").click(function () {
    if (!$(this).find(".badge-success").hasClass("badge-success")) {
        $(".badge-success").remove();
    }
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
    }
    val = parseFloat($("input[name=amount]").val());
    $(this).addClass("selected");
    if (!$(this).find(".badge-success").hasClass("badge-success")) {
        aroVal = val;
        $("input[name=bet]").val(val);
    } else {
        aroVal += val;
        if (aroVal <= 1000) {
            $(this).find(".badge-success").text(aroVal);
            $("input[name=bet]").val(aroVal);
        }
    }
    if ($(this).find(".number-item").text()) {
        var numberItem = $(this).find(".number-item").text();
        $("input[name=choose]").val(numberItem);
    }
});

$(".clear-btn").click(function () {
    $("input[name=bet]").val("0");
    $("td").removeClass("selected");
    $("td").find(".custom-badge").remove();
});

$(".oneToTw").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $(".oneToTwEl").addClass("selected one");
    $("input[name=choose]").val("1_12");
});
$(".thrtToTf").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $(".thrtToTfEl").addClass("selected");
    $("input[name=choose]").val("13_24");
});

$(".twfToTs").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $(".twfToTsEl").addClass("selected");
    $("input[name=choose]").val("25_36");
});

$(".oneToEt").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $(".oneToEtEl").addClass("selected");
    $("input[name=choose]").val("1_18");
});

$(".nineteenTtsix").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $("input[name=choose]").val("19_36");
    $(".nineteenTtsixEl").addClass("selected");
});

$(".even").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $("input[name=choose]").val("even");
    $(".evenEl").addClass("selected");
});

$(".odd").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $(".oddEl").addClass("selected");
    $("input[name=choose]").val("odd");
});

$(".red").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $(".redEl").addClass("selected");
    $("input[name=choose]").val("red");
});

$(".black").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $(".blackEl").addClass("selected");
    $("input[name=choose]").val("black");
});

$(".twByOne1").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $(this).parents("tr").find("td").addClass("selected");
    $(this).parents("tr").find(".zero").removeClass("selected");
    $("input[name=choose]").val("2_1_1");
});

$(".twByOne2").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $(this).parents("tr").find("td").addClass("selected");
    $("input[name=choose]").val("2_1_2");
});

$(".twByOne3").click(function () {
    if ($("td").hasClass("selected")) {
        $("td").removeClass("selected");
        $("td").find("input[type=hidden]").removeAttr("name");
    }
    $(this).parents("tr").find("td").addClass("selected");
    $("input[name=choose]").val("2_1_3");
});
