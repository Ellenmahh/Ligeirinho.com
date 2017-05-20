<?php
// VARIAVEL DE SESSÃO PARA INICIAR UM VARIAVEL QUE SE DISPONIBILIZA PELO SITE TODO
session_start();


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
                     <a href="../1home.php">  <img id ="btndesligar" src="CMS_IMG/desligar.png" > </a>
                 </div>
                 <nav >
                    <a href="admConteudo.php">
                        <img  src="CMS_IMG/admConteudo.png" alt="Adm Conteudo" title="Adm Conteudo">
                     </a>         
                    <a href="cms.php"> <img src="CMS_IMG/volts.png"></a>
                 </nav>
                 <div id="menuPrincipal">
                     <a href="esporteDestaque.php">
                        <img  src="CMS_IMG/esporte.png" alt="Esporte em destaque" title="Esporte em destaque">
                    </a>
                    <a href="admSobre.php">
                        <img  src="CMS_IMG/sobre.png" alt="Sobre a corrida" title="Sobre a corrida">
                    </a>
                     <a href="admPromocao.php">
                        <img  src="CMS_IMG/promo.png" alt="Promoção" title="Promoção">
                     </a>
                    <a href="kits.php"> 
                            <img  src="CMS_IMG/kits.png" alt="Kits para corrida" title="Kits para corrida">
                     </a>
                     <a href="corridaMes.php"> 
                            <img  src="CMS_IMG/corrida.png" alt="Corrida do mês" title="Corrida do mês" >
                     </a>
                     
                     
                 
                 </div>
            </section>
           
        </section>
         <footer id="rodape">
               
            </footer> 
    
    </body>
</html>