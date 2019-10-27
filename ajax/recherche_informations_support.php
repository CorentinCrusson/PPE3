<?php
include 'accesBD.php';
$maBD = new accesBD();

if(isset($_GET['id_img'])){
  $img = (String) trim($_GET['id_img']);
  $resultat = $maBD->retournerInfosSupport($img);

  if(isset($resultat))
	{
		// résultats
		while($donnees = $resultat->fetch(PDO::FETCH_OBJ)) {
			// je remplis un tableau et mettant le nom de la ville en index pour garder le tri
			$data[$donnees->titreS][] = ($donnees->titreSupport);
      $data[$donnees->realisateurS][] = ($donnees->realisateur);
      $data[$donnees->libelleG][] = ($donnees->libelleGenre);
		}
	}
}
// renvoit un tableau dynamique encodé en json
echo json_encode($data);
?>
