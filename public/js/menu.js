let dropdown = document.querySelector('.dropdown > a');

document.addEventListener('click', function(e) {
    let target = e.target;

    if (target === dropdown) {
        e.preventDefault();
        target.nextElementSibling.classList.toggle('show-dropdown');
    } else {
        if (dropdown.nextElementSibling.classList.contains('show-dropdown'))
            dropdown.nextElementSibling.classList.remove('show-dropdown')
    }

});
