<?php
include 'accesBD.php';
$maBD = new accesBD();

if(isset($_GET['video'])){
  $video = (String) trim($_GET['video']);
  $rep = $maBD->retournerInfosRecherche($video);
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
  <div class="search_bar_img slide colonne" style="color: white ;"> <?php
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
