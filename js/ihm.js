const spinner = document.getElementById("spin");

/**
 * Ajout d'un spinner au chargement de la page
 */
function startSpinner(){
    spinner.classList.remove('hidden');
}

/**
 * Suppression du spinner
 */
function stopSpinner(){
    window.setTimeout(function(){
        spinner.classList.add('hidden');
    }, 300)

}

/** 
 * Affiche un message d'erreur si aucune donnée n'a pu etre recup
 * @param error
 * @returns {null}
 */
function showErrorMessage(error){
    error = 'Aucune donnée n\'a pu etre recuperé sur le reseaux, affichage des données contenue dans le cache';
    return alert(error);
}

/**
 * Après le chargement de la page, declenchement et arret du spinner
 */
window.addEventListener('load', () => {
    startSpinner();
    stopSpinner();

});