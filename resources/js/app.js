import './bootstrap';


let showResults  = document.querySelectorAll('.results__show');

showResults.forEach(function(item){
    item.addEventListener('click', function(){
        alert('tu');
    });
});
// let results__wrap    = document.querySelector('.dw_rabats_quick_add_form');

// quickAddButton.addEventListener('click', function(){
//     quickAddForm.classList.toggle('dw_quick_add_from_active');
// });
