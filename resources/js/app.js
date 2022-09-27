import './bootstrap';


let showResults  = document.querySelectorAll('.results__show');

showResults.forEach(function(item){
    item.addEventListener('click', function(){
        item.parentElement.classList.toggle('results--active');
    });
});
