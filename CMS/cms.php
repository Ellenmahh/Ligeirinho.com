<?php
// VARIAVEL DE SESSÃO PARA INICIAR UM VARIAVEL QUE SE DISPONIBILIZA PELO SITE TODO
session_start();
if(isset($_POST['desligar'])){
    session_destroy();
    header('location:../index.php');
    
}


?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Ligeirinho.com CMS </title>
         <link rel="stylesheet" type="text/css" href="CMS_CSS/cms.css">  
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
                 <nav id="menuConteudo">
                    <a href="admConteudo.php">
                        <img  src="CMS_IMG/admConteudo.png" alt="Adm Conteudo" title="Adm Conteudo">
                     </a>         
                    <a href="admFaleConosco.php">
                        <img  src="CMS_IMG/admFaleConosco.png" alt="Adm Fale Conosco" title="Adm Fale Conosco">
                     </a>
                    <img  src="CMS_IMG/admProdutos.png" alt="Adm Produtos" title="Adm Produtos">
                    <a href="cadastrarUserOuNivel.php">
                        <img  src="CMS_IMG/admUser.png" alt="Adicionar usuário" title="Adicionar Usuário" >
                    </a>
                 </nav>
                     
                     
                      
                     
                       
                 
            </section>
            <footer id="rodape">
            </footer> 
        </section>
    
    </body>
</html>