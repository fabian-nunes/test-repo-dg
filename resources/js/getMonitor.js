function setSearch(val) {
    let monitor = document.getElementById("dropMonitor");
    let queryR = document.getElementById("queryR");
    let user = document.getElementById('inputMNumber');
    let band = document.getElementById('inputBNumber');

    switch (val) {
        case 1:
            monitor.textContent = "Identificador da Banda";
            queryR.value = "1";
            user.hidden = true;
            band.hidden = false;
            break
        case 2:
            monitor.textContent = "Identificador do Utente";
            queryR.value = "2";
            user.hidden = false;
            band.hidden = true;
            break;
    }
}

function setValue(val) {
    let sel = document.getElementById("valueSelect");
    sel.value = val.value;
    console.log(sel);
}
