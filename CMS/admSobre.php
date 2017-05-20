    <?php
// CONEXAO COM O BANCO, ESTA EM UM ARQUIVO SEPARADO
require_once('../moduloConexao.php');
// VARIAVEL DE SESSÃO PARA INICIAR UM VARIAVEL QUE SE DISPONIBILIZA PELO SITE TODO
session_start();
$titulo="";
$descricao="";
$btn="Salvar";

if(isset($_GET['modo'])){
	$modo=$_GET['modo'];
		if($modo=='excluir'){
			$cod=$_GET['codigo'];
			$delete='delete from tblsobre WHERE id='.$cod;
			//echo $delete;
            mysql_query($delete);
			header('location:admSobre.php');
			
		}else if(isset($_GET['modo'])){
        $modo=$_GET['modo'];
        if($modo=='editar'){
            $cod=$_GET['codigo'];
            $_SESSION['idAlterar']=$cod;
            $sql ="SELECT * from tblsobre where id=" .$cod;
            $resultado = mysql_query($sql);
            $valores=mysql_fetch_assoc($resultado);
            
            $titulo = $valores['titulo'];
            $descricao = $valores['descricao'];
            
            $btn="Alterar";
        }else if (isset($_GET['modo'])){
            $modo=$_GET['modo'];
            if($modo=='ativo'){
                $cod=$_GET['codigo'];
                $_SESSION['idAtivo']=$cod;
                $sql = "UPDATE tblsobre SET exibir = 1 WHERE id=".$cod;
                //echo $sql;
                mysql_query($sql);
                header('location:admSobre.php');
            }else if($modo=='inativo'){
                $cod=$_GET['codigo'];
                $_SESSION['idInativo']=$cod;
                $sql="UPDATE tblsobre SET exibir = 0 WHERE id=".$cod;
                 mysql_query($sql);
                header('location:admSobre.php');
            }
        }
        }
    }	


if(isset($_POST['btncadastrar'])){
    $titulo=$_POST['txttitulo'];
    $descricao=$_POST['txtdescricao'];
        if($_POST['btncadastrar']=="Salvar"){
            $sql="INSERT INTO tblsobre (titulo,descricao) VALUES ('".$titulo."','".$descricao."')";
            //echo $sql;
        }elseif($_POST['btncadastrar']=="Alterar"){
            $sql="UPDATE tblSobre SET titulo = '".$titulo."', descricao = '".$descricao."',WHERE id = ".$_SESSION['idAlterar'];
         }
  
         
 //echo $sql;
  mysql_query($sql);
  header('location:admSobre.php');

    
        if(isset($_POST['desligar'])){
    session_destroy();
    header('location:../index.php');
    
}
}

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Ligeirinho.com CMS </title>
         <link rel="stylesheet" type="text/css" href="CMS_CSS/cms.css">  
       <script src="../js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript">
            
           
            
            $(document).ready(function(){
                
                $("#criar").click(function(){
                    $(".tblExibicao").toggle();
                });
                
            });
            $(document).ready(function(){
                
                $("#visualizar").click(function(){
                    $(".tblSobre").toggle();
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
                     <form method="post" name="formLogout" action="cms.php">
                         <!--<a href="../1home.php">  -->
                            <button  class="botao" name="desligar" >
                                <img id="btndesligar" style="width:50px;height:50px" src="CMS_IMG/desligar.png" >
                            </button>
                         <!--</a>-->
                     </form>
                 </div>
                 <nav>
                    <h2 id="adcUser">Administrando as Páginas!</h2>
                      <a href="admConteudo.php"> 
                          <img src="CMS_IMG/volts.png">
                     </a>
                     <button class="button" id="criar">Criar::</button>
                     <button class="button" id="visualizar">Visualizar cadastrados::</button>
                     
                    <div id="tblUser">
                        <form method="POST" name="frmSobre" action="admSobre.php">
                            <div id="exibirDiv">
                                <table class="tblExibicao">
                                
                                    <tr>
                                        <td>Titulo:</td>
                                        <td><input  type="text" name="txttitulo" value="<?php echo $titulo;?>"></td>
                                    </tr>
                                   
                                    <tr>
                                        <td>Descrição:</td>
                                        <td>
                                            <textarea  name="txtdescricao" cols="50" rows="11" style="resize:none" maxlength="100"><?php echo $descricao ?></textarea>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" value="<?php echo $btn?>" name="btncadastrar">
                                        </td>
                                    </tr>
                                     

                                </table>
                                 <div id= "tblCadastrados">
                                 
                                
                               
                                <table class="tblSobre" class="tblVisu">
                               
                                   <tr style="background-color:black;">
                                       <td>Titulo</td>
                                       <td>descrição</td>
                                       <td>Editar/apagar</td>
                                       <td>Habilitar/desabilitar</td>
                                       <td>Status</td>
                                    </tr>
                                     <?php
                                $sql="SELECT * FROM tblsobre ORDER BY id DESC";
                                $select = mysql_query($sql);
                                while($lista=mysql_fetch_assoc($select)){
                                    
                                
                                ?>
                                    <tr>
                                      
                                        <td><?php echo ($lista['titulo'])?></td>
                                        <td>
                                            <textarea  readonly="readonly" name="txtDescricao" cols="50" rows="9" style="resize:none"> <?php echo ($lista['descricao'])?></textarea>    
                                        </td>
                                        
                                       <td>
                                         <a href="admSobre.php?modo=editar&codigo=<?php echo $lista['id']?>">
                                             <img style="height:50px" src="CMS_IMG/edit.png"></a>

                                        <a href="admSobre.php?modo=excluir&codigo=<?php echo $lista['id']?>"> 
                                            <img style="height:50px" src="CMS_IMG/delete.png"></a>
                                        </td>
                                        <td>
                                            <a href="admSobre.php?modo=ativo&codigo=<?php echo $lista['id']?>">
                                               <img src="CMS_IMG/ativo.png" style="height:30px"></a>
                                        
                                            <a href="admSobre.php?modo=inativo&codigo=<?php echo $lista['id']?>">
                                                <img src="CMS_IMG/inativo.png" style="height:30px"></a>
                                        </td>
                                        <td><?php 
                                            if($lista['exibir']==1){
                                            echo 'ativo';}
                                            else {
                                        echo 'inativo';}?></td>
                                    </tr>
                                
                                <?php } ?>
                                </table>
                                   
                                
                                 </div>
                            </div>
                            
                        </form> 
                        
                          
                     </div>
                 </nav>
                 
                     
                     
                      
                     
                       
                 
            </section>
            <footer id="rodape">
            </footer> 
        </section>
    
    </body>
</html>