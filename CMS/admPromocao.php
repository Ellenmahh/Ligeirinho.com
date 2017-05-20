<?php
// CONEXAO COM O BANCO, ESTA EM UM ARQUIVO SEPARADO
require_once('../moduloConexao.php');
// VARIAVEL DE SESSÃO PARA INICIAR UM VARIAVEL QUE SE DISPONIBILIZA PELO SITE TODO
session_start();
$porcentagem="";
$produto="";
$idproduto=0;
$btn="Salvar";

if(isset($_GET['modo'])){
	$modo=$_GET['modo'];
		if($modo=='excluir'){
			$cod=$_GET['codigo'];
			$delete='delete from tblpromocao WHERE idPromocao='.$cod;
			//echo $delete;
            mysql_query($delete);
			header('location:admPromocao.php');
			
		}
    else if(isset($_GET['modo'])){
        $modo=$_GET['modo'];
        if($modo=='editar'){
            $cod=$_GET['codigo'];
            $_SESSION['idAlterar']=$cod;
            
            $sql ="select tblpromocao.*, p.nome from produtos as p inner join tblpromocao 
            on p.idProduto = tblpromocao.idProdutos where idPromocao=" .$cod;
            
            $resultado = mysql_query($sql);
            $valores=mysql_fetch_assoc($resultado);
            
            $idproduto = $valores['idProdutos'];
            $nomeProdutos = $valores['nome'];
            
            $porcentagem = $valores['porcentagem'];
           
            $btn="Alterar";
        }
        else if (isset($_GET['modo'])){
            $modo=$_GET['modo'];
            if($modo=='ativo'){
                $cod=$_GET['codigo'];
                $_SESSION['idAtivo']=$cod;
                
                $sql = "UPDATE tblpromocao SET exibir = 1 WHERE idPromocao = ".$cod;
                //echo $sql;
                mysql_query($sql);
                header('location:admPromocao.php');
            }else if($modo=='inativo'){
                $cod=$_GET['codigo'];
                $_SESSION['idInativo']=$cod;
                $sql="UPDATE tblpromocao SET exibir = 0 WHERE idPromocao=".$cod;
                //echo $sql;
               mysql_query($sql);
               header('location:admPromocao.php');
            }
        }
        }
    }	


if(isset($_POST['btncadastrar'])){
    
        $produto=$_POST['produtos'];
        $porcentagem=$_POST['txtPorcentagem'];
      
    
    if($_POST['btncadastrar']=="Salvar"){
        $sql="INSERT INTO tblpromocao (idProdutos,porcentagem) VALUES(".$produto.",".$porcentagem.")";
             //echo $sql;
            
           header('location:admPromocao.php');
           
    }
    
    elseif($_POST['btncadastrar']=="Alterar"){
            $sql="UPDATE tblpromocao SET 
            idProdutos = ".$produto.", 
            porcentagem = ".$porcentagem."
           
            WHERE idPromocao= ".$_SESSION['idAlterar'];
            
        
      //echo "ALTERAR REGISTRO"; 
        
    }
    //echo $sql;
    mysql_query($sql);
    header('location:admPromocao.php');
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
                        <form method="POST" name="frmPromocao" action="admPromocao.php" enctype="multipart/form-data" >
                            <div id="exibirDiv">
                                <table class="tblExibicao">
                                
                                
                                   
                                    <tr>
                                        <td>Nome:</td>
                                        <td>
                                            <select name="produtos">
                                                
                                                <?php
                                                if($modo=='editar'){
                                                ?>
                                                    <option selected value="<?php echo ($idproduto) ?>"> 
                                                    <?php echo ($nomeProdutos) ?>
                                                
                                                </option>
                                                
                                                
                                                
                                            <?php
                                            }else{
                                                ?>
                                                <option selected value=""> Selecione um Item </option>
                                                    
                                             <?php
                                                }
                                                
                                                
                                                $sql = "SELECT * FROM produtos WHERE idProduto <> ".$idproduto ;
                                                $select = mysql_query($sql);
                                                while($lista = mysql_fetch_assoc($select)){
                                            ?>
                                                <option value="<?php echo ($lista['idProduto']) ?>"> 
                                                    <?php echo ($lista['nome']) ?>
                                                
                                                </option>
                                            <?php } ?>
                                            </select>
                                           
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Porcentagem: R$</td>
                                        <td><input type="text"  placeholder="Digite a porcentagem   " name="txtPorcentagem"  value="<?php echo $porcentagem?>"></td>
                                    </tr>
                                   
                                    <tr>
                                        <td>
                                            <input type="submit" value="<?php echo $btn?>" name="btncadastrar">
                                        </td>
                                    </tr>
                                    
                                     

                                </table>
                                 <div id= "tblCadastrados">
                                 
                                <?php
                                $sql="select pr.idPromocao, pr.exibir as exibir_Promocao, p.imagem,p.nome,p.descricao, round(pr.porcentagem * p.preco/100) as PRECO,
                                p.exibir
                                from produtos as p
                                inner join tblpromocao as pr on idProdutos = idProduto;";
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
                                             <textarea  readonly="readonly"  name="txtDescricao" cols="30" rows="9" style="resize:none"><?php echo ($lista['descricao'])?>
                                            </textarea></td>
                                        <td><?php echo ($lista['PRECO'])?></td>
                                       <td>
                                         <a href="admPromocao.php?modo=editar&codigo=<?php echo $lista['idPromocao']?>">
                                             <img style="height:50px" src="CMS_IMG/edit.png"></a>

                                        <a href="admPromocao.php?modo=excluir&codigo=<?php echo $lista['idPromocao']?>"> 
                                            <img style="height:50px" src="CMS_IMG/delete.png"></a>
                                        </td>
                                        <td>
                                            <a href="admPromocao.php?modo=ativo&codigo=<?php echo $lista['idPromocao']?>">
                                               <img src="CMS_IMG/ativo.png" style="height:30px"></a>
                                        
                                            <a href="admPromocao.php?modo=inativo&codigo=<?php echo $lista['idPromocao']?>">
                                                <img src="CMS_IMG/inativo.png" style="height:30px"></a>
                                        </td>
                                        <td><?php 
                                            if($lista['exibir_Promocao']==1){
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