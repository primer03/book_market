const btnOpenModal = document.getElementById('btn-openmodal');
const myModal = document.getElementById('my_modal_1');
const btnCloseModal = document.getElementById('close-modal');
var dataStrorage = localStorage.getItem('dataStrorage');
var coloractive = null;
var borderactive = null;
var textactive = null;
var pickbg = document.querySelectorAll('#pickbg');
var picktext = document.querySelectorAll('#picktext');
var pickborder = document.querySelectorAll('#pickborder');
var btnsave_area = document.querySelector('#save-area');
window.onload = () => {
    if (dataStrorage) {
        dataStrorage = JSON.parse(dataStrorage);
        console.log(dataStrorage);
        // var card_sale = document.querySelector('#card-sale')
        // for (var x = 1; x <= 3; x++) {
        //     card_sale.innerHTML += `<div class="flex flex-col gap-3 p-3 ${dataStrorage.border} ${dataStrorage.shadow}"></div>`
        // }
    } else {
        dataStrorage = {
            'shadow': 'shadow-lg shadow-pink-500',
            'border': 'border-2 border-pink-500',
        }
        localStorage.setItem('dataStrorage', JSON.stringify(dataStrorage));
    }

}

btnOpenModal.onclick = function() {
    datarowcol = localStorage.getItem('rowcol');
    // createcol();
    myModal.classList.add('modal-open');
}
btnCloseModal.onclick = function() {
    myModal.classList.remove('modal-open');
}
btnrowcol.onclick = function() {
    localStorage.setItem('rowcol', JSON.stringify({
        row: row.value,
        col: col.value,
        border: `border-violet-500`,
    }));
}


//pick

pickbg.forEach(function(e, index) {
    e.addEventListener('click', function(ex) {
        console.log(ex.target.classList[2]);
        if (coloractive != null) {
            if (ex.target == coloractive) {
                coloractive.classList.remove('outline', 'outline-offset-2', 'outline-black');
                coloractive = null;
            } else {
                coloractive.classList.remove('outline', 'outline-offset-2', 'outline-black');
                coloractive = ex.target;
                ex.target.classList.add('outline', 'outline-offset-2', 'outline-black');
            }
        } else {
            coloractive = ex.target;
            ex.target.classList.add('outline', 'outline-offset-2', 'outline-black');
        }
    })
})
pickborder.forEach(function(e, index) {
    e.addEventListener('click', function(ex) {
        console.log(index);
        if (borderactive != null) {
            if (ex.target == borderactive) {
                borderactive.classList.remove('outline', 'outline-offset-2', 'outline-black');
                borderactive = null;
            } else {
                borderactive.classList.remove('outline', 'outline-offset-2', 'outline-black');
                borderactive = ex.target;
                ex.target.classList.add('outline', 'outline-offset-2', 'outline-black');
            }
        } else {
            borderactive = ex.target;
            ex.target.classList.add('outline', 'outline-offset-2', 'outline-black');
        }
    })
})
picktext.forEach(function(e, index) {
    e.addEventListener('click', function(ex) {
        console.log(index);
        if (textactive != null) {
            if (ex.target == textactive) {
                textactive.classList.remove('outline', 'outline-offset-2', 'outline-black');
                textactive = null;
            } else {
                textactive.classList.remove('outline', 'outline-offset-2', 'outline-black');
                textactive = ex.target;
                ex.target.classList.add('outline', 'outline-offset-2', 'outline-black');
            }
        } else {
            textactive = ex.target;
            ex.target.classList.add('outline', 'outline-offset-2', 'outline-black');
        }
    })
})

btnsave_area.onclick = function() {
    //console.log(coloractive);
    //console.log(borderactive);
    //console.log(textactive);
    let coloractive_class = coloractive ? coloractive.classList[2] : 'bg-white';
    let borderactive_class = borderactive ? borderactive.classList[3] : 'border-black';
    let textactive_class = textactive ? textactive.classList[2] : 'text-black';
    let card_salex = document.querySelector('#card-sale')
    card_salex.innerHTML += `<div class="flex flex-col gap-3 p-3 border-2 ${borderactive_class} ${coloractive_class}"></div>`
    myModal.classList.remove('modal-open');
}