<?php 
// CONEXAO COM O BANCO, ESTA EM UM ARQUIVO SEPARADO
require_once('moduloConexao.php');
$id = $_POST['id'];

?>
<html>
	<head> 
		<title> Modal index</title>
         <link rel="stylesheet" type="text/css" href="LigeirinhoCSS/1home.css"> 
        
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
		<a href="index.php#produtos" class="fechar">Fechar(x)</a>
	</div>
	<div>
		<?php
			$sql = $sql="SELECT * FROM produtos where idProduto=".$id;
		?>
		ID: <?php echo($id); ?>
        
        <table id="tblModal">
            <?php

                $select=mysql_query($sql);
                while($retorno = mysql_fetch_array($select)){
             ?> 
            <tr>
               
                <td colspan='4'>Mais detalhes</td>
               </tr>
            <tr  style="background-color: #B8860B;">
                <td>Imagem</td>
                <td>Nome</td>
                <td>Descrição</td>
                <td>Preço</td>
                
            </tr>
             <tr>
                
               <td> 
                 <img class="imgProdutoModal" 
                      src="CMS/<?php echo $retorno['imagem']?>">
                 </td>
                <td> <?php echo $retorno['nome']?></td>
                <td> <?php echo $retorno['descricao']?></td>
                <td><?php echo $retorno['preco']?></td>
                

            </tr>
                           
                  <?php }?>              
                               
            </table>
        
	</div>

    
    
</body>
</html