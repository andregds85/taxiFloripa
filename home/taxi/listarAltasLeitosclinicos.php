<?php include ("session.php"); 
      header("Content-Type: text/html; charset=ISO-8859-1");



?>

<!DOCTYPE html>
<html lang="pt-br">
   <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Language" content="pt-br">
     
    <script language="JavaScript" type="text/javascript" src="cidades-estados-1.4-utf8.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
           
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGV9Jm2u7rmsCe65wKzPTw5jtS38n2tVEGi2yFNYwFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title><?php include ("title.php"); ?></title>
    </head>
  <body>
 
<!-- Topo da Página -->      
      
<?php include("topo.php"); 
include("../conecta.php");
?>
 <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">DATA INTERNACAO</th>
      <th scope="col">NOME </th>
      <th scope="col">DATA ALTA </th>
      <th scope="col">OBSERVACAO</th>
      <th scope="col"></th>
      <th scope="col">Grafico</th>     

    </tr>
 </thead>  
<?php          
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1; 
 
    //seleciona todos os itens da tabela 
    $cmd = "select * from altautilc"; 
    $produtos = mysqli_query($con,$cmd); 

    //conta o total de itens 
    $total = mysqli_num_rows($produtos); 

    //seta a quantidade de itens por página, neste caso, 2 itens 
    $registros = 1000000; 

    //calcula o número de páginas arredondando o resultado para cima 
    $numPaginas = ceil($total/$registros); 

    //variavel para calcular o início da visualização com base na página atual 
    $inicio = ($registros*$pagina)-$registros; 
 
    //seleciona os itens por página 
    $cmd = "select * from altautilc limit $inicio,$registros"; 
    $produtos = mysqli_query($con,$cmd); 
    echo "<b>";
    echo "Total de Registros : ".$total = mysqli_num_rows($produtos); 
    echo "<br>";




    while ($produto = mysqli_fetch_array($produtos)) { 
       
        
      echo "<tbody>";
      echo"<tr>";
      echo "<th scope='row'>";
      $cod=$produto['id'];
      $internacaoy=date('d-m-y', strtotime($produto['internacao']));
      echo $internacaoy;
      echo "</a>";     
      echo "</th>";  
      echo "<td>";
      echo $produto['nome']." - "; 
      echo"</td>";
      echo "<td>";
      $dataAltay=date('d-m-y', strtotime($produto['dataAlta']));   
      echo $produto['dataAlta'];
      echo"</td>";
      echo "<td>";
      echo $produto['obs'];
      echo"</td>";
      echo "<td>";    
      echo "<a href='ExcluiAltasLeitosUti.php?us_id=$cod'>Apagar</a>";  
      echo "<td>";
        
      echo "<a href='atualizag.php?us_id=$cod'>status</a>";  
       
          
      echo "</tr>";        
      echo"</tbody>";  
  } 
   
      
echo "<div class='container'>";
 //exibe a paginação 
    for($i = 1; $i < $numPaginas + 1; $i++) { 
        echo "<a href='listarPacientesUti.php?pagina=$i'>".$i."</a> "; 
    } 
echo "</div>";     
     
     


     
?>     
     
     

      