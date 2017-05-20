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
                 <nav id="tblnivelUser">
                   
                    <a href="adcUser.php">
                       <button class="btnUser">
                            <h2 style="color:#B8860B">Adiconar novo usuário</h2>
                       </button>
                    </a> 
                     
                      <a href="adcNivel.php">
                       <button class="btnUser">
                            <h2 style="color:#B8860B">Adiconar novo Nivel</h2>
                       </button>
                    </a> 
                    
                         
                 </nav>
                     
                <div>
                    <a href="admConteudo.php"> <img src="CMS_IMG/volts.png"></a>						
                </div>
        
            </section>
            <footer id="rodape">
            </footer> 
        </section>
    
    </body>
</html>