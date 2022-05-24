const spinner = document.getElementById("spin");

/**
 * Ajout d'un spinner au chargement de la page
 */
function startSpinner(){
    //spinner.classList.remove('hidden');
    console.log('spinner non fonctionel');
}

/**
 * Suppression du spinner
 */
function stopSpinner(){
    /*window.setTimeout(function(){
        spinner.classList.add('hidden');
    }, 300)*/
    console.log('spinner non fonctionel');
}

/**
 * Après le chargement de la page, declenchement et arret du spinner
 */
window.addEventListener('load', () => {
    startSpinner();
    stopSpinner();

});