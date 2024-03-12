<?php
$autor = $_GET["autor"];
$titulo = $_GET["titulo"];
$img_capa = $_GET["img_capa"];
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn ){
die('Could not connect: ' . mysqli_error($conn));
}
//Seleciona a base de dados
mysqli_select_db($conn , 'Livraria');
$sql = "INSERT INTO livro (titulo, autor, img_capa) VALUES ('$titulo', '$autor', '$img_capa')";
$retval = mysqli_query($conn , $sql);
if (mysqli_affected_rows ($conn) == 1)
echo ('<span style="color: green; ">INSERT com sucesso!!!</span>');
else
echo ('<span style="color: red; ">INSERT falhou!!!</span>');
echo "<br><a href='livro.php'>Voltar ao ínicio</a>";
?>