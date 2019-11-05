<?php
include 'accesBD.php';
$maBD = new accesBD();

if(isset($_GET['video'])){
  $video = (String) trim($_GET['video']);
  $rep = $maBD->retournerInfosRecherche($video);
  $nbr = 0;
  ?> <div class="search_bar_img slide colonne" style="color: white ;"> <?php
  foreach($rep as $r){
    ?>
      <div> <div> <a href="index.php?vue=videotheque&action=fiche&id=<?php echo $r['idSupport']; ?> "	> <img center src='./Images/<?= $r['image'] ?>' /></a> <?= $r['titreSupport'] ?> </div> </div>
      <?php
      $nbr++;
      if($nbr%3==0)
      { ?>
      </div> <div class="search_bar_img slide colonne" style="color: white ;">
      <?php }

  }
  ?> </div> <?php
}
?>
