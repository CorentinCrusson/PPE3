<?php
include 'accesBD.php';
$maBD = new accesBD();

if(isset($_GET['video'])){
  $video = (String) trim($_GET['video']);
  $rep = $maBD->retournerInfos($video);

  foreach($rep as $r){
    ?>
    <div style="margin-top: 20%; 0; padding: 30%; color: white; border-bottom: 2px solid #ccc"><?= $r['idSupport'] . " " . $r['titreSupport'] ?></div><?php
  }
}
?>
