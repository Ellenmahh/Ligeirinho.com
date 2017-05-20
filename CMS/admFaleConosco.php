<?php
// CONEXAO COM O BANCO, ESTA EM UM ARQUIVO SEPARADO
require_once('../moduloConexao.php');
// VARIAVEL DE SESSÃO PARA INICIAR UM VARIAVEL QUE SE DISPONIBILIZA PELO SITE TODO
session_start();

if(isset($_GET['modo'])){
	$modo=$_GET['modo'];
		if($modo=='excluir'){
			$cod=$_GET['codigo'];
			$delete='delete from tblfaleconosco WHERE id='.$cod;
			//echo $delete;
            mysql_query($delete);
			header('location:admFaleConosco.php');	
		}	
}

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Ligeirinho.com CMS </title>
         <link rel="stylesheet" type="text/css" href="CMS_CSS/cms.css">  
        <script type="text/javascript" src="../js/jquery.js"></script>

    <script>
    $(document).ready(function() {

      $(".ver").click(function() {
        $(".modalContainer").fadeIn();
        //slideToggle
        //toggle
        //FadeIn
      });
    });



        function Modal(idIten){
            
            $.ajax({
                type: "POST",
                url: "modal.php",
                data: {id:idIten},
                success: function(dados){
                    $('.modal').html(dados);
                }
            });
        }
    </script>
    </head>
    <body>
        <div class="modalContainer">
            <div class="modal">
            <?php
                //echo ($_POST['id']);
                
               
                ?>    

                

            </div>
        </div>	
        
   

        <section id="principal">

            <header>
                <div id="cabecalho">
                    <h1>CMS - Sitema de Gerenciamente de Site  </h1>
                    <img id="logo" src="../img/logo.png" alt="Logo Ligeirinho">
                </div>
            </header>
             <section id="conteudo">
  
                 <div id="inicioConteudo">

                     Bem vindo(a),
                     <?php echo($_SESSION['txtnome']); ?>
                     <a href="../1home.php"> 
                        <img id ="btndesligar" src="CMS_IMG/desligar.png">
                     </a>
                 </div>
                 
                 <form method="POST" name="frmFaleConosco" action="admFaleConosco.php" >
                     
                <a href="cms.php"> <img src="CMS_IMG/volts.png"></a>						
                 <div id="faleconosco" >
                     
                        <div id="tblFaleConosco">
                            <?php
                                $sql="SELECT * FROM tblfaleconosco";
                                $select=mysql_query($sql);
                                while($retorno = mysql_fetch_assoc($select)){
                             ?> 
                            <table id="tabelafale">
                                <tr style="background-color:#B8860B;">
                                    <td>Nome:</td>
                                    <td>Telefone: </td>
                                    <td>Celular:</td>
                                    <td>Email: </td>
                                    <td>mais...</td>
                                     <td>Excluir</td>
                                    
                                </tr>
                                <tr>
                                    <td><?php echo $retorno['nome']?></td>
                                    <td> <?php echo $retorno['telefone']?></td>
                                    <td> <?php echo $retorno['celular']?></td>
                                    <td> <?php echo $retorno['email']?></td>
                                    <td>
                                        <a href="#" class="ver" onclick="Modal(<?php  echo($retorno["id"])?>)"> Detalhes
                                        </a>
                                    </td>
                                       <td>
                                        <a href="admFaleConosco.php?modo=excluir&codigo=<?php echo $retorno['id']?>"> 
                                        <img style="height:50px" src="CMS_IMG/lixeira.png"></a> 
                                     </td>            
                                    
                                </tr>
  
                            </table>
                             <?php }?>
                        </div>
                   
                    </div>
                  
                 </div>
                        
                </form> 
          
                 
            </section>
            <footer id="rodape">
            </footer> 
        </section>
      
    </body>
</html>