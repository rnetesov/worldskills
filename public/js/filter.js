document.getElementById('proposal-filter').onchange = function (e) {
    let url = e.target.value;
    document.location.replace(url);
}
