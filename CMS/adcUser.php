<?php
// CONEXAO COM O BANCO, ESTA EM UM ARQUIVO SEPARADO
require_once('../moduloConexao.php');
// VARIAVEL DE SESSÃO PARA INICIAR UM VARIAVEL QUE SE DISPONIBILIZA PELO SITE TODO
session_start();
$nome="";
$senha="";
$nivel="";
$btn="Salvar";


if(isset($_GET['modo'])){
	$modo=$_GET['modo'];
		if($modo=='excluir'){
			$cod=$_GET['codigo'];
			$delete='delete from usuarios WHERE id='.$cod;
			mysql_query($delete);
			header('location:adcUser.php');
			
		}else if(isset($_GET['modo'])){
        $modo=$_GET['modo'];
        if($modo=='editar'){
            $cod=$_GET['codigo'];
            
            $_SESSION['idAlterar']=$cod;
            
           $sql ="SELECT u.id,u.nome, u.senha,n.nomeNivel,n.id
                FROM tblniveis AS n 
                INNER JOIN usuarios AS u 
                ON u.nivel = n.id WHERE u.id = " .$cod;
            
            $resultado = mysql_query($sql);
            $valores=mysql_fetch_assoc($resultado);
            $nome = $valores['nome'];
            $senha = $valores['senha'];
            $nivel = $valores['nomeNivel'];
            $idNivel = $valores['id'];

          $btn="Alterar";
             
        }
    }	
}


if(isset($_POST['btncadastrar'])){
    $nome=($_POST['nome']);
    $senha=($_POST['senha']);
    $nivel=($_POST['nivelUser']);
    
    //echo $sql;
    if($_POST['btncadastrar']=="Salvar"){
        $sql="insert into usuarios (nome,senha,nivel) 
        values ('".$nome."',".$senha.",".$nivel.")";
       
         if(mysql_affected_rows() ==1){
             header('location:adcUser.php');
            
         }else{
              echo "<script>alert('erro');</script>";
         } 
    }elseif ($_POST['btncadastrar']=="Alterar") {
        $sql="UPDATE usuarios SET 
        nome = '".$nome."',
        senha = '".$senha."', 
        nivel = ".$nivel."
        WHERE id = ".$_SESSION['idAlterar'];
        
      //echo "ALTERAR REGISTRO";  
    }
    //echo $sql;
    mysql_query($sql);
    header('location:adcUser.php');
}



?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Ligeirinho.com CMS </title>
         <link rel="stylesheet" type="text/css" href="CMS_CSS/cms.css">  
      <script src="../js/jquery-3.2.1.min.js"></script>
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
                    <h1 >Adicionar novo usuário!</h1>
                    <div id="tblUser">
                        <form method="POST" name="frmUser" action="adcUser.php" >
                            <table>
                                <tr>
                                    <td>Nome:</td>
                                    <td> <input required placeholder="Digite o nome do usuário"  type="text" name="nome" value="<?php echo $nome;?>" ></td>
                                </tr>
                                <tr>
                                    <td>Senha:</td>
                                    <td> <input required placeholder="Digite a senha de números" type="text" name="senha" value="<?php echo $senha;?>"></td>
                                </tr>
                                <tr>
                                    <td>Tipo de Conta:</td>
                                    <td> 
                                        <select name="nivelUser">
                                        <?php 
                                            $sql ="SELECT * FROM tblniveis where id >0" ;
                                            
                                            if ($idNivel!='')
                                            {
                                                $sql = $sql . " and id !=".$idNivel; 
                                                ?>
                                                    <option selected value="<?php echo($idNivel) ?>"><?php echo($nivel) ?></option>
                                                <?php
                                                    
                                            }
                                                
                                            $niveis = mysql_query($sql);
                                                                                    
                                            
                                            
                                         
                                            while($lista = mysql_fetch_assoc($niveis)){
                                        ?>
                                            <option value= "
                                                <?php 
                                                    echo($lista['id']);
                                                ?>">
                                                <?php
                                                    echo ($lista['nomeNivel'])
                                                ?>
                                                
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input id="btn" type="submit" name="btncadastrar" value="<?php echo $btn;?>">

                                    </td>
                                   
                                </tr>

                            </table>
                        </form> 
                        <button id="button">Exibir/Ocultar usuários cadastrados::</button>
                          <div id="exibirDiv">
                            <?php 
                                $sql ="SELECT u.id,u.nome, u.senha,n.nomeNivel 
                                    FROM tblniveis AS n 
                                    INNER JOIN usuarios AS u 
                                    ON u.nivel = n.id;" ;
                                $select= mysql_query($sql);
                            ?>
                            <?php
                                while($retornaValores = mysql_fetch_assoc($select)){
                             ?> 
                            <table class="tblExibicao">
                                <tr>
                                    <td>Usuario:
                                        <?php 
                                            echo ($retornaValores['nome'])
                                        ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Senha:
                                        <?php 
                                            echo ($retornaValores['senha'])
                                        ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Nivel:
                                        <?php 
                                            echo ($retornaValores['nomeNivel'])
                                        ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                         <a href="adcUser.php?modo=editar&codigo=<?php echo $retornaValores['id']?>">
                                             <img style="height:50px" src="CMS_IMG/edit.png"></a>

                                        <a href="adcUser.php?modo=excluir&codigo=<?php echo $retornaValores['id']?>"> 
                                            <img style="height:50px" src="CMS_IMG/delete.png"></a>
                                    </td>
                                </tr>

                            </table>
                            <?php
                                }
                            ?>
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