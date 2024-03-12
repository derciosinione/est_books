<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><!-- poem os acentos no site -->
  <title>E-FNAK</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <link href="http://fonts.googleapis.com/css?family=Arvo:400,700" rel="stylesheet" type="text/css" />
  <link href="default.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
  <div id="wrapper-gradiant">
    <div id="wrapper-bgshadow">
      <div id="wrapper">
        <div id="header">
          <div id="logo">
            <h1><a href="#">ESPonteSor-FNAK</a></h1>
          </div>
        </div>
        <div id="menu-wrapper">
          <div id="menu">
            <ul>
              <!-- Opções no site no menu -->
              <li><a href="livro.php" accesskey="1" title="">Página Inicial</a></li>
              <li><a href="livro.php" accesskey="2" title="">Livro</a></li>
              <li><a href="cd.php" accesskey="3" title="">CD</a></li>
              <li><a href="video.php" accesskey="4" title="">Video</a></li>
              <li><a href="revista.php" accesskey="5" title="">Revista</a></li>
              <li><a href="insere_livro.html" accesskey="6" title="">Inserir Livro</a></li>
            </ul>
          </div>
        </div>
        <div id="banner">
          <div class="image"><a href="#"><img src="books.jpg" width="1000" height="262" alt="" /></a></div>
        </div>

          <br>
          <br>

        <form action="livro.php" method="get">

            <label for="">Titulo</label>
            <select name="titleFilter" id="">
                <option value="=">=</option>
                <option value="like">Like</option>
            </select>

            <input type="text" name="searchTitulo">

            <br>
            <br>

            <label>
                And
                <input type="radio" name="searchType" value="AND" checked>
            </label>

            <label>
                OR
                <input type="radio" name="searchType" value="OR">
            </label>

            <br>
            <br>

            <label for="">Autor</label>
            <select name="autorfilter" id="">
                <option value="=">=</option>
                <option value="like">Like</option>
            </select>

            <input type="text" name="searchAutor">

            <input type="submit" value="Pesquisar">
        </form>
        <center>

          <?php
				$dbhost = 'localhost';
				$dbuser = 'root';
				$dbpass = '';
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
				if(!$conn){
					die('Could not connect: ' . mysqli_error($conn));
				}

                $query = 'SELECT * FROM livro';

                if (isset($_GET['searchTitulo'], $_GET['titleFilter'])){
                    $titleFilter = $_GET['titleFilter'];
                    $searchTitulo = $_GET['searchTitulo'];

                    if ($searchTitulo!=null){
                        $query = ($titleFilter=='=') ?
                            $query . " WHERE titulo='$searchTitulo'" :
                            $query . " WHERE titulo like '%$searchTitulo%'";
                    }
                }

                if (isset($_GET['searchType'], $_GET['searchAutor'])){

                    $searchType = $_GET['searchType'];

                    $autorfilter = $_GET['autorfilter'];
                    $searchAutor = $_GET['searchAutor'];

                    if ($searchAutor!=null && $searchType!=null){
                        $query = $query . " $searchType ";

                        $query = ($autorfilter=='=') ?
                            $query . " autor='$searchAutor'" :
                            $query . " autor like '%$searchAutor%'";
                    }

                }

				// Cria a tabela
				echo "<table border='1' style='text-align:center;'><tr><th>Capa do Livro</th><th>Titulo</th><<th>Autor</th></tr>";

                $sql = $query;

                mysqli_select_db($conn,'Livraria');
				$retval = mysqli_query( $conn, $sql );
				if(! $retval ){
					die('Could not get data: ' . mysqli_error($conn));// se não funcionar dá erro
				}

				while($row = mysqli_fetch_array($retval)){// vai buscar ha base de dados os dados nela guardada e poem os na tabela
					echo "<tr><td>" . '<img class="filme" id="capa" src="'.$row['img_capa'].'">' ."</td>";
					echo "<td>".$row['titulo']."</td>";
					echo "<td>".$row['autor']."</td>";
                    echo "<td><a href='editar.php.php?titulo={$row['titulo']}'>Editar</a></td>";
                    echo "<td><a href='delete.php?titulo={$row['titulo']}'>Eliminar</a></td>";
                    echo "</tr>";
				}
				echo "</table><br/>  <a href='livro.php'>Voltar ao ínicio</a>";// fecha a tabela e uma hiperligação para voltar ao inicio do site
				mysqli_close($conn);
			?>

        </center>
      </div>
    </div>
  </div>
</body>

</html>