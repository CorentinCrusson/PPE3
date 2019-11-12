<?php
include 'accesBD.php';
$maBD = new accesBD();

if(isset($_POST['video'])){
  $video = (String) trim($_POST['video']);

  $typeSupport='';
  if(isset($_POST[('type')]))
  {
    $typeSupport = $_POST['type'];
  }

  if(isset($_POST[('type')])) {
    $vue = $_POST[('type')];
    if($vue!='videotheque' && $vue != 'compte') {
      $rep = $maBD->retournerInfosRecherche($video,$typeSupport);
      $nbr = 0;
      if($rep) {
        $_SESSION['path'] = $_SERVER['REQUEST_URI'];
      ?>
      <script>
        document.getElementById('displaySupport').innerHTML = "";
      </script>
      <?php
    }
      ?>
      <div class="conteneur searchResult" style=""> <?php
      foreach($rep as $r){
        ?>
          <div class="element"> <a href="index.php?vue=videotheque&action=fiche&id=<?php echo $r['idSupport']; ?> "	> <img center src='./Images/<?= $r['image'] ?>' /></a> <p> <?= $r['titreSupport'] ?> </p> </div>
          <?php

      }
      ?> </div> <?php
    } else {
      ?> <div> </div> <?php
    }
  }
} else {
  $page = $_SESSION['path'];
  echo "</nav>
      <div class='container h-100'>
        <div class='row h-100 justify-content-center align-items-center'>
          <span class='text-white'></span>
        </div>
      </div>
      <meta http-equiv='refresh' content='0;$page'>
      ";
}

?>
