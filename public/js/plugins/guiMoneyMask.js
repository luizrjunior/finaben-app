
"use restrict";

function getGuiMoneyFloat(input) {
    var money = guiMoneyMask(input,1);

    if (!money) {
        return 0;
    }
    money = money.replace(",", ".");

    return parseFloat(money);
}

function guiMoneyMask(input,getMoney) {
    var icon = "R$";

    icon += " ";
    var money = $("#" + input).val();

    money = money.replace(icon, "");
    money = money.replace(" ", "");

    money = money.replace(",", "");
    money = money.replace(".", "");

    if (money === "") {
        return;
    }
    if (isNaN(money)) {
        $("#" + input).val("");
        return;
    }

    $("#" + input).val("");

    var aux = money + '';

    if (aux.length < 3) {
        aux = aux.replace(/([0-9]{2})$/g, "0,$1");
    } else if (aux.length > 2) {
        aux = aux.replace(/([0-9]{2})$/g, ",$1");
    }

    if (aux.length > 2) {
        var tmp = aux.split(",");
        aux = parseInt(tmp[0]) + "," + tmp[1];

    }

    $("#" + input).val(icon + aux);
    if (getMoney === 1) {
        return aux;
    }
}