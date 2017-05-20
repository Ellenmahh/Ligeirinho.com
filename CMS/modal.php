<?php 
// CONEXAO COM O BANCO, ESTA EM UM ARQUIVO SEPARADO
require_once('../moduloConexao.php');


$id = $_POST['id'];



?>
<html>
	<head> 
		<title> Teste Modal </title>
         <link rel="stylesheet" type="text/css" href="CMS_CSS/cms.css">  
	</head>
	
	<script>
$(document).ready(function() {

  $(".fechar").click(function() {
    //$(".modalContainer").fadeOut();
	$(".modalContainer").slideToggle(1000);
  });
});
	
	</script>
	
<body>

	<div>
		<a href="#" class="fechar">Fechar(x)</a>
	</div>
	<div>
		<?php
			$sql = $sql="SELECT * FROM tblfaleconosco where id=".$id;
		?>
		ID: <?php echo($id); ?>
        
        
        
        <table id="tblModal">
            <?php
                        
                        $select=mysql_query($sql);
                        while($retorno = mysql_fetch_assoc($select)){
                     ?> 
            <tr style="background-color: #ccc;">
               
                <td>Profissão</td>
                <td>Home Page</td>
                <td>Link Face</td>
                <td>Sugestoões/Críticas</td>
                <td>Informações sobre o Produto</td>
               
            </tr>
             <tr>
                
               <td> <?php echo $retorno['profissao']?></td>
                <td> <?php echo $retorno['homePage']?></td>
                <td> <?php echo $retorno['linkFace']?></td>
                <td><?php echo $retorno['sugestaoOuCritica']?></td>
                <td><?php echo $retorno['infoProdutos']?></td> 

            </tr>
                           
                  <?php }?>              
                               
            </table>
        
	</div>

    
    
</body>
</html>