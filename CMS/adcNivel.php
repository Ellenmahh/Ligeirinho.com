<?php
// CONEXAO COM O BANCO, ESTA EM UM ARQUIVO SEPARADO
require_once('../moduloConexao.php');
// VARIAVEL DE SESSÃO PARA INICIAR UM VARIAVEL QUE SE DISPONIBILIZA PELO SITE TODO
session_start();
$nomeNivel="";

$btnNivel="Cadastrar";


if(isset($_GET['modoNivel'])){
	$modoNivel=$_GET['modoNivel'];
		if($modoNivel=='excluirNivel'){
			$codNivel=$_GET['idNivel'];
			$deleteNivel='delete from tblNiveis WHERE id='.$codNivel;
			mysql_query($deleteNivel);
			header('location:adcNivel.php');
			
		}else if(isset($_GET['modoNivel'])){
        $modoNivel=$_GET['modoNivel'];
        if($modoNivel=='editarNivel'){
            $codNivel=$_GET['idNivel'];
            
            $_SESSION['alterarNivel']=$codNivel;
            
           $sql ="SELECT * FROM tblNiveis WHERE id = " .$codNivel;
            
            $resultado = mysql_query($sql);
            $valores=mysql_fetch_assoc($resultado);
            $nomeNivel = $valores['nomeNivel'];
            

          $btnNivel="Alterar";
             
        }
    }	
}


if(isset($_POST['cadastrarNivel'])){
    $novoNivel=($_POST['novoNivel']);
   
    
    //echo $sql;
    if($_POST['cadastrarNivel']=="Cadastrar"){
        $sql="INSERT INTO tblniveis (nomeNivel) VALUES ('".$novoNivel."');";
       
         if(mysql_affected_rows() ==1){
             header('location:adcNivel.php');
            
         }else{
              echo "<script>alert('erro');</script>";
         } 
    }elseif ($_POST['cadastrarNivel']=="Alterar") {
        $sql="UPDATE tblNiveis SET nomeNivel = '".$novoNivel."' WHERE id = ".$_SESSION['alterarNivel'];
        
      //echo "ALTERAR REGISTRO";  
    }
        //echo $sql;
        mysql_query($sql);
        header('location:adcNivel.php');
}


?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Ligeirinho.com CMS </title>
         <link rel="stylesheet" type="text/css" href="CMS_CSS/cms.css">  
        <script src="js/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function(){
                
                $("#button").click(function(){
                    $(".tblExibicao").toggle();
                });
                
            });
            $(document).ready(function(){
                
                $("#btnNivel").click(function(){
                    $(".tabelaNivel").toggle();
                });
                
            });
            
		</script>
    </head>
    <body>
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
                     <a href="../1home.php">  <img id ="btndesligar" src="CMS_IMG/desligar.png" > </a>
                 </div>
                 <section>
                   
                     <div id="divNivel">
                       
                        <div id="tblNivel">
                             <h1 >Adicionar novo nivel!</h1>
                            <form method="POST" name="frmNivel" action="adcNivel.php" >
                                <table>
                                    <tr>
                                        <td>Novo nivel:</td>
                                        <td> <input required type="text" placeholder="Digite o novo usuário" name="novoNivel" value="<?php echo $nomeNivel ?>" ></td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <input id="btn" type="submit" name="cadastrarNivel" value="<?php echo $btnNivel?>">

                                        </td>
                                       

                                    </tr>

                                </table>
                            </form> 
                             <button id="btnNivel">Exibir/Ocultar Niveis cadastrados::</button>
                          <div >
                            <?php 
                                $sql ="SELECT * from tblNiveis" ;
                                $select= mysql_query($sql);
                                while($retornaValores = mysql_fetch_assoc($select)){
                             ?> 
                            <table class="tabelaNivel">
                                
                                <tr>
                                    <td>Nivel:
                                        <?php 
                                            echo ($retornaValores['nomeNivel']);
                                        ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                         <a href="adcNivel.php?modoNivel=editarNivel&idNivel=<?php echo $retornaValores['id']?>">
                                             <img style="height:50px" src="CMS_IMG/edit.png"></a>

                                        <a href="adcNivel.php?modoNivel=excluirNivel&idNivel=<?php echo $retornaValores['id']?>"> 
                                            <img style="height:50px" src="CMS_IMG/delete.png"></a>
                                    </td>
                                </tr>

                            </table>
                            <?php
                                }
                            ?>
                        </div>

                         </div>
                          
                     </div>
                     <div>
                            <a href="cadastrarUserOuNivel.php"> <img src="CMS_IMG/volts.png"></a>						
                        </div>
                 </section>
                 
                     
                     
                      
                     
                       
                 
            </section>
            <footer id="rodape">
            </footer> 
        </section>
    
    </body>
</html>