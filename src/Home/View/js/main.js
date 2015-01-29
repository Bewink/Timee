document.getElementById("showMenu").onclick = function () {
    var sideMenu = document.getElementById('sideMenu');
    if (sideMenu.classList.contains('isActive')) {
        sideMenu.classList.remove('isActive');
    } else {
        sideMenu.classList.add('isActive');
    }
};