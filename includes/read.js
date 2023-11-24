function populateDropdown(element, data) {
    element.html('<option value="0">Válasszon ...</option>');
    data.lista.forEach(item => {
        element.append(`<option value="${item.id}">${item.nev}</option>`);
    });
}

function fetchData(url, params, callback) {
    return new Promise((resolve, reject) => {
        $.post(url, params, data => {
            if (typeof callback === "function") {
                callback(data);
            }
            resolve(data);
        }, "json").fail(error => reject(error));
    });
}

function fetchAndPopulateDropdown(url, params, element, callback) {
    fetchData(url, params).then(data => {
        populateDropdown(element, data);
        if (typeof callback === "function") {
            callback();
        }
    }).catch(error => console.error(error));
}

function fetchAndDisplayInfo(url, params) {
    $(".adat").html("");
    fetchData(url, params).then(data => {
        $("#nev").text(data.nev);
        $("#hossz").text(data.hossz + " km");
        $("#allomas").text(data.allomas + " db");
        $("#ido").text(data.ido + " h");
        $("#vezetes").text(data.vezetes === 0 ? "Nincs" : "Van");
    }).catch(error => console.error(error));
}

function nemzeti_parkok() {
    const parkselect = $("#parkselect");
    fetchAndPopulateDropdown("../includes/read.inc.php", { "op": "parkok" }, parkselect, varosok);
}

function varosok() {
    $("#utselect").html("");
    $(".adat").html("");
    const parkid = $("#parkselect").val();

    if (parkid !== "0") {
        const varosselect = $("#varosselect");
        fetchAndPopulateDropdown("../includes/read.inc.php", { "op": "varos", "id": parkid }, varosselect, utak);
    }
}

function utak() {
    $("#utselect").html("");
    $(".adat").html("");
    const varosid = $("#varosselect").val();
    if (varosid !== "0") {
        const utselect = $("#utselect");
        fetchAndPopulateDropdown("../includes/read.inc.php", { "op": "ut", "id": varosid }, utselect, ut);
    }
}

function ut() {
    const utid = $("#utselect").val();
    if (utid !== "0") {
        fetchAndDisplayInfo("../includes/read.inc.php", { "op": "info", "id": utid });
    }
}

$(document).ready(() => {
    nemzeti_parkok();

    $("#parkselect").change(varosok);
    $("#varosselect").change(utak);
    $("#utselect").change(ut);
});
