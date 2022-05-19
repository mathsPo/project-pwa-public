<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <link rel='stylesheet' href="css/modele.css" type="text/css"/>
    
  <?php
$mess_erreur = "<strong> Desoler mais il semblerait que cette page ne soit pas accessible, verifier bien l'orthographe renseigné dans le formulaire et reessayer. </strong>";
$num = count(scandir("modeles"));
$nom = str_replace('_', ' ', $_POST['url']);

if(!isset($_POST['url'])){
  echo 'ca marche pas';
}
if(!file_exists('modeles/' . $_POST['url'])){
  echo $mess_erreur;
}
else{
  define('IMG', 'modeles/' . $_POST['url']);
    $image = [];
    if($dir = opendir(IMG)){
      while($f = readdir($dir)){
        if($f === '.' || $f === '..') continue; 
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
        foreach($image as $model){
          $model_final = str_replace('_', ' ', $model);
      ?>
      
      <div className="App">
        <h2>Modele de <?php echo $model_final ?></h2>
        <model-viewer class="model" src=<?php echo "modeles/" . $_POST['url'] . "/" . $model?> shadow-intensity="1" ar ar-modes="webxr scene-viewer quick-look" camera-controls min-camera-orbit="auto auto 100%" max-camera-orbit="auto auto 100%" min-field-of-view="45deg" max-field-of-view="45deg" environment-image="neutral" auto-rotate autoplay></model-viewer>
      </div>

      <?php
        }
      ?>
    </div>


  </body>
</html>

<?php
}
?>