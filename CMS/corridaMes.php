<?php
// CONEXAO COM O BANCO, ESTA EM UM ARQUIVO SEPARADO
require_once('../moduloConexao.php');
// VARIAVEL DE SESSÃO PARA INICIAR UM VARIAVEL QUE SE DISPONIBILIZA PELO SITE TODO
session_start();
$nome="";
$preco="";
$descricao="";
$btn="Salvar";

if(isset($_GET['modo'])){
	$modo=$_GET['modo'];
		if($modo=='excluir'){
			$cod=$_GET['codigo'];
			$delete='delete from tblCorridaMes WHERE id='.$cod;
			//echo $delete;
            mysql_query($delete);
			header('location:corridaMes.php');
			
		}else if(isset($_GET['modo'])){
        $modo=$_GET['modo'];
        if($modo=='editar'){
            $cod=$_GET['codigo'];
            $_SESSION['idAlterar']=$cod;
            $sql ="SELECT * from tblCorridaMes where id=" .$cod;
            $resultado = mysql_query($sql);
            $valores=mysql_fetch_assoc($resultado);
            $imagem = $valores['imagem'];
            $nome = $valores['nome'];
            $descricao = $valores['descricao'];
            $preco = $valores['preco'];
            $btn="Alterar";
        }else if (isset($_GET['modo'])){
            $modo=$_GET['modo'];
            if($modo=='ativo'){
                $cod=$_GET['codigo'];
                $_SESSION['idAtivo']=$cod;
                $sql = "UPDATE tblCorridaMes SET exibir = 1 WHERE id=".$cod;
                //echo $sql;
                mysql_query($sql);
                header('location:corridaMes.php');
            }else if($modo=='inativo'){
                $cod=$_GET['codigo'];
                $_SESSION['idInativo']=$cod;
                $sql="UPDATE tblCorridaMes SET exibir = 0 WHERE id=".$cod;
                 mysql_query($sql);
                header('location:corridaMes.php');
            }
        }
        }
    }	


if(isset($_POST['btncadastrar'])){
    
        $nome_arq = basename ($_FILES['fleFoto']['name']);
    
        $nome=$_POST['txtNome'];
        $preco=$_POST['txtPreco'];
        $descricao=$_POST['txtDescricao'];

        $caminho = "CMS_IMG/";
        $nome_arquivo = $caminho . $nome_arq;
        $extensao = strtolower(substr($nome_arq,strlen($nome_arq)-3,3));
    
    
    if($_POST['btncadastrar']=="Salvar"){
        
        if($extensao == 'jpg' || $extensao == 'png'){
            if(move_uploaded_file($_FILES['fleFoto']['tmp_name'], $nome_arquivo)){
                $sql="INSERT INTO tblCorridaMes (imagem,nome,preco,descricao) VALUES
                ('".$nome_arquivo."','".$nome."',".$preco.",'".$descricao."')";
            }
                //echo $sql;
            
            header('location:corridaMes.php');
        }    
    }elseif($_POST['btncadastrar']=="Alterar"){
        if($_FILES['fleFoto']['error']==0){
            $uploaddir = "CMS_IMG/"; 
			$nome_arq = basename($_FILES['fleFoto']['name']);
			$temp_name = $_FILES['fleFoto']['tmp_name'];
			$uploadfile = $uploaddir . $nome_arq;
             if(move_uploaded_file($_FILES['fleFoto']['tmp_name'], $nome_arquivo)){
            $sql="UPDATE tblCorridaMes SET 
            imagem = '".$nome_arquivo."',
            nome = '".$nome."', 
            descricao = '".$descricao."',
            preco = ".$preco."
            WHERE id = ".$_SESSION['idAlterar'];
             }
        }else{
            $sql="UPDATE tblCorridaMes SET 
           
            nome = '".$nome."', 
            descricao = '".$descricao."',
            preco = ".$preco."
            WHERE id = ".$_SESSION['idAlterar'];
            
        }
      //echo "ALTERAR REGISTRO"; 
        
    }
    //echo $sql;
    mysql_query($sql);
    header('location:corridaMes.php');
}
    
    if(isset($_POST['desligar'])){
    session_destroy();
    header('location:../index.php');
    
}
//}

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Ligeirinho.com CMS </title>
         <link rel="stylesheet" type="text/css" href="CMS_CSS/cms.css">  
      <script src="../js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript">
            
            function addVirgula(naInputDigitada){
              if(naInputDigitada.value.length ==2)/*naInputDigitada.value.length==2)*/{
                naInputDigitada.value += '.';
              }
            }
            
            $(document).ready(function(){
                
                $("#criar").click(function(){
                    $(".tblExibicao").toggle();
                });
                
            });
            $(document).ready(function(){
                
                $("#visualizar").click(function(){
                    $(".tblVisu").toggle();
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
                    <h1 id="adcUser">Administrando as Páginas!</h1>
                      <a href="admConteudo.php"> 
                          <img src="CMS_IMG/volts.png">
                     </a>
                     <button class="button" id="criar">Criar::</button>
                     <button class="button" id="visualizar">Visualizar cadastrados::</button>
                     
                    <div id="tblUser">
                        <form method="POST" name="frmEsporte" action="corridaMes.php" enctype="multipart/form-data" >
                            <div id="exibirDiv">
                                <table class="tblExibicao">
                                
                                
                                    <tr> 
                                        <td>Imagem:</td>
                                        <td> <input type="file" name="fleFoto"> </td>
                                      
                                        <td class="imagemm"> 
                                     <?php if($btn == "Alterar"){?>
                                            <img src="<?php echo $imagem?>"        style="width:200px;height:150px">
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nome:</td>
                                        <td><input type="text" name="txtNome" value="<?php echo $nome;?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Preço: R$</td>
                                        <td><input type="text"  name="txtPreco" onkeyup="addVirgula(this);" value="<?php echo $preco?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Descrição:</td>
                                        <td>
                                            <textarea  name="txtDescricao" cols="30" rows="5" style="resize:none" maxlength="100"><?php echo $descricao ?></textarea>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" value="<?php echo $btn?>" name="btncadastrar">
                                        </td>
                                    </tr>
                                     

                                </table>
                                 <div id= "tblCadastrados">
                                 
                                <?php
                                $sql="SELECT * FROM tblCorridaMes ORDER BY id DESC";
                                $select = mysql_query($sql);
                                while($lista=mysql_fetch_assoc($select)){
                                    
                                
                                ?>
                               
                                <table class="tblVisu">
                                   <tr style="background-color:black;">
                                       <td>imagem</td>
                                       <td>nome</td>
                                       <td>descrição</td>
                                       <td>preço</td>
                                       <td>Editar/apagar</td>
                                       <td>Habilitar/desabilitar</td>
                                       <td>Status</td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <img src="
                                                   <?php echo ($lista['imagem'])?>
                                                  "style="width:200px;height:150px">
                                        </td>
                                        <td><?php echo ($lista['nome'])?></td>
                                        <td>
                                             <textarea readonly="readonly"  name="txtDescricao" cols="30" rows="9" style="resize:none"><?php echo ($lista['descricao'])?>
                                            </textarea></td>
                                        <td><?php echo ($lista['preco'])?></td>
                                       <td>
                                         <a href="corridaMes.php?modo=editar&codigo=<?php echo $lista['id']?>">
                                             <img style="height:50px" src="CMS_IMG/edit.png"></a>

                                        <a href="corridaMes.php?modo=excluir&codigo=<?php echo $lista['id']?>"> 
                                            <img style="height:50px" src="CMS_IMG/delete.png"></a>
                                        </td>
                                        <td>
                                            <a href="corridaMes.php?modo=ativo&codigo=<?php echo $lista['id']?>">
                                               <img src="CMS_IMG/ativo.png" style="height:30px"></a>
                                        
                                            <a href="corridaMes.php?modo=inativo&codigo=<?php echo $lista['id']?>">
                                                <img src="CMS_IMG/inativo.png" style="height:30px"></a>
                                        </td>
                                        <td><?php 
                                            if($lista['exibir']==1){
                                            echo 'ativo';}
                                            else {
                                        echo 'inativo';}?></td>
                                    </tr>
                                
                                
                                </table>
                                   
                                <?php } ?>
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