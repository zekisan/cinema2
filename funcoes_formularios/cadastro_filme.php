<?php
$cartaz = fopen($_FILES['cartaz']['tmp_name'], 'r');
$data = fread($cartaz, filesize($_FILES['cartaz']['tmp_name']));
$data = addslashes($data);
fclose($cartaz);

$filmes_db = new FilmesDB();

$id = $filmes_db->cadastraFilme($_POST['titulo'], $_POST['data_estreia'], $_POST['data_termino'],
  $_POST['genero'], $data, $_POST['duracao'], $_POST['ator_principal'],
  $_POST['atriz_principal'], $_POST['ator_coadjuvante'], $_POST['atriz_coadjuvante']);

header('location:../visualiza_filme.php?id='.$id);
?>