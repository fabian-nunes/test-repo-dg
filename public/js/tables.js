function setTables(tab) {
    let tab1 = document.getElementById('monitorTable');
    let tab2 = document.getElementById('patientTable');
    let tab3 = document.getElementById('bandTable');

    let btn1 = document.getElementById('btn1');
    let btn2 = document.getElementById('btn2');
    let btn3 = document.getElementById('btn3');

    switch (tab) {
        case 1:
            tab1.hidden = false;
            tab2.hidden = true;
            tab3.hidden = true;

            btn1.className = 'btn btn-primary';
            btn2.className = 'btn btn-outline-success';
            btn3.className = 'btn btn-outline-danger';

            btn1.disabled = true;
            btn2.disabled = false;
            btn3.disabled = false;
            break
        case 2:
            tab1.hidden = true;
            tab2.hidden = false;
            tab3.hidden = true;

            btn1.className = 'btn btn-outline-primary';
            btn2.className = 'btn btn-success';
            btn3.className = 'btn btn-outline-danger';

            btn1.disabled = false;
            btn2.disabled = true;
            btn3.disabled = false;
            break
        case 3:
            tab1.hidden = true;
            tab2.hidden = true;
            tab3.hidden = false;

            btn1.className = 'btn btn-outline-primary';
            btn2.className = 'btn btn-outline-success';
            btn3.className = 'btn btn-danger';

            btn1.disabled = false;
            btn2.disabled = false;
            btn3.disabled = true;
            break
    }
}
