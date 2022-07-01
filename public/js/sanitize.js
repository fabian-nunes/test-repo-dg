function setInputFilter(textbox, inputFilter, errMsg) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(event) {
        textbox.addEventListener(event, function(e) {
            if (inputFilter(this.value)) {
                // Accepted value
                if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
                    this.classList.remove("input-error");
                    this.setCustomValidity("");
                }
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                // Rejected value - restore the previous one
                this.classList.add("input-error");
                this.setCustomValidity(errMsg);
                this.reportValidity();
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                // Rejected value - nothing to restore
                this.value = "";
            }
        });
    });
}

//Campo de idade ex 20, max 200
setInputFilter(document.getElementById("inputPAge"), function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 200); }, "Valor precisa de ser inteiro e válido");

//Campo de altura 1.75, max 5
setInputFilter(document.getElementById("inputPHeight"), function(value) {
    return /^-?\d*[.,]?\d{0,2}$/.test(value) && (value === "" || parseInt(value) <= 3); }, "Valor precisa de ser númerico com o máximo de duas casas decimais");

//Campo de peso 70.2, max 300
setInputFilter(document.getElementById("inputPWeight"), function(value) {
    return /^-?\d*[.,]?\d{0,1}$/.test(value) && (value === "" || parseInt(value) <= 300); }, "Valor precisa de ser númerico com o máximo de uma casa decimal");

//Campo para o nome
setInputFilter(document.getElementById("inputPName"), function(value) {
    return /^[A-zÀ-ú\s]*$/i.test(value); }, "Campo só aceita letras");
