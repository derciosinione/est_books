<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$database = 'Livraria';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

$titulo = $_REQUEST["titulo"];

mysqli_select_db($conn, $database);
$sql = "DELETE FROM livro WHERE titulo='$titulo'";
$retval = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) == 1){
//    header('http://localhost/ficha3/livro.php');
    echo('<span style="color: green; ">Livro eliminado com sucesso!!!</span>');
    echo "<br><a href='livro.php'>Voltar ao ínicio</a>";
}
else{
    echo('<span style="color: red; ">Nao foi possivel eliminar o livro Informado!!!</span>');
    echo "<br><a href='livro.php'>Voltar ao ínicio</a>";
}
