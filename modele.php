<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <link rel='stylesheet' href="css/modele.css" type="text/css"/>
    
<?php
  //Creation de la variable comprenant le message d'erreur
  $mess_erreur = "<strong> Desoler mais il semblerait que cette page ne soit pas accessible, verifier bien l'orthographe renseigné dans le formulaire et reessayer. </strong>";
  //On compte le nombre de collection au total
  $num = count(scandir("modeles"));
  //On remplace les underscores dans la donnée renseigné par l'utilisateur par des espaces
  $nom = str_replace('_', ' ', $_POST['url']);

  //On regarde si la donnée renseigné par l'utilisateur existe
  if(!isset($_POST['url'])){
    echo 'ca marche pas';
  }
  //on verifie si la donnée renseigné par l'utilisateur est bien un repertoire qui existe
  if(!file_exists('modeles/' . $_POST['url'])){
    echo $mess_erreur;
  }
  else{
    //Definition du constante IMG egale a la chaine de caractere 'modeles/' concatenée a la donnée renseigné par l'utilisateur (chemin d'accée)
    define('IMG', 'modeles/' . $_POST['url']);
      //On creer un tableau vide qui va contenir tout les modeles 3D
      $image = [];
      //On ouvre le repertoire 
      if($dir = opendir(IMG)){
        //On lit tout ce qui est contenu dedans
        while($f = readdir($dir)){
          //Si le fichier/dossier commence par un . ou un .., on ignore
          if($f === '.' || $f === '..') continue; 
          //On ajoute ce fichier au tableau
          $image[] = $f;
        }
      } 
?>

  <title>Model de la collection <?php echo $nom?> </title>
  </head> 
  <body>

  <div className="container">
    <img id="logostex" src=icon/saint_ex_180x180.png alt="" />

    <h1>Collection n°<?php echo $num ?>: Realiser par <?php echo $nom?></h1>

<?php
  //On parcour le tableau des modeles 3D
  foreach($image as $model){
  //On remplace les underscores contenus dans les noms des modeles 3D par des espaces vides
  $model_final = str_replace('_', ' ', $model);
?>
      
    <div className="App">
      <h2>Modele de <?php echo $model_final ?></h2>
      <model-viewer class="model" src=<?php echo "modeles/" . $_POST['url'] . "/" . $model?> shadow-intensity="1" ar ar-modes="webxr scene-viewer quick-look" camera-controls min-camera-orbit="auto auto 100%" max-camera-orbit="auto auto 100%" min-field-of-view="45deg" max-field-of-view="45deg" environment-image="neutral" auto-rotate autoplay></model-viewer>
    </div>

<?php
  //On ferme la boucle 
  }
?>
  </div>


</body>
</html>

<?php
  //On ferme le else
  }
?>