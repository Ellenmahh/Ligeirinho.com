<?php
require_once('moduloConexao.php');



?>


<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Ligeirinho.com</title>
         <link rel="stylesheet" type="text/css" href="LigeirinhoCSS/1home.css">
         <link rel="stylesheet" type="text/css" href="LigeirinhoCSS/slider.css">
        
        
    </head>

    <body>
    
    <section id="principal">
        <?php
                require_once('moduloMenu.php');
        ?>
       
        
        <section style="height:1600px" id="conteudo">
              
            <?php
                    require_once('moduloRedeSocial.php');
                ?>
            
            <div style="height:1590px; width:1180px" id=produtos>
                
                <div id="textoNoticia">
                    <?php
                    
                $sql = "SELECT * FROM tblsobre WHERE exibir = 1 ";
                $select = mysql_query($sql);
                while($lista = mysql_fetch_assoc($select)){
                    ?>
                   <h2 style="text-align:center"><?php echo $lista['titulo']?></h2>
                      <p><?php echo $lista['descricao']?><br><br></p>
                    
                    <?php }?>
                </div>
                     
                     
                     
            </div>
                 
                 
                        
            </div>
            <nav style="display:none" id="menuLateral">
                <ul>
                    <li>item 1</li>
                    <li>item 2</li>
                
                </ul>
         
            </nav>
               
           
           
            
           
        </section>
        <footer id="rodape">
            <div id="phoneapp">
                <div class="phone">
                    <img  style="width:300px" src="img/phoneapp.png" alt="Baixe nosso app">

                </div>
                <div class="phone">
                    <h1>Treine com nosso novo aplicativo no seu celular</h1> 

                    <h1> <a href="#"> Conheça nosso aplicativo </a></h1>

                </div>
            </div>
            <div id="patrocinadores">
                <h1>Patrocinadores</h1>
                <img  src="img/silvestre.png" alt="São Silvestre">
                <img  src="img/globoEsporte.png" alt="Globo esporte">             
                <img  src="img/band.png" alt="Band Tv">
                <img   src="img/caixa.png" alt="Caixa Econômica">
                <div style="color:white"> Formas de pagamento:<img  style="width:400px" src="img/bandeiras.png" alt="Formas de pagamento"></div>
                <div style="color:white">Trabalhe conosco: jobs@ligeirinho.com</div>
            </div>
            
        </footer> 
        
    </section>
    
    </body>
</html>