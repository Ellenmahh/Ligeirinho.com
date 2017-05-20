<?php
// CONEXAO COM O BANCO, ESTA EM UM ARQUIVO SEPARADO
require_once('../moduloConexao.php');
// VARIAVEL DE SESSÃO PARA INICIAR UM VARIAVEL QUE SE DISPONIBILIZA PELO SITE TODO
session_start();

// quando o botao ok do login for clicado
if(isset($_GET['btnok'])){
	$nome=$_GET['txtnome'];
    $_SESSION['txtnome']=$nome;
	$senha=$_GET['txtsenha'];
// o AND serve para usar o where mais de uma vez
$sql="SELECT * from usuarios WHERE nome = '". $nome ."' AND senha = '".$senha."'";
//executando o select
  mysql_query($sql);
   //ao fazer o login, foi verificado se usuario e senha DIGITADOS estao no banco
    // se sim entra no cms 
    if(mysql_affected_rows() ==1){
       header("location:cms.php");
        
    }else{

    echo "<script>alert('USER NÃO CADASTRADO');</script>";
    header("location:../1home.php");
    
    }
}

?>