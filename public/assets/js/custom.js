/*On affiche un document qui est de base en hidden*/
function showHiddenById(hiddenId, buttonId) {
    let toShow = document.getElementById(hiddenId)
    let toHide = document.getElementById(buttonId)
    //On affiche l'élément initialement caché
    toShow.classList.remove('d-none')
    //On cache le btn qui a affiché l'élément
    toHide.classList.add('d-none')
}