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
        <script  src="js/slider.js"> </script>
         <script type="text/javascript" src="js/jquery.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
      <script>
            
    $(document).ready(function(){

        $("#menu").click(function(){
            
            $(".ulMenu").toggle();
        });

    });
 </script>   
 <script>
    $(document).ready(function() {

      $(".ver").click(function() {
        $(".modalContainer").fadeIn();
        //slideToggle
        //toggle
        //FadeIn
      });
    });
        function Modal(idIten){
            
            $.ajax({
                type: "POST",
                url: "indexModal.php",
                data: {id:idIten},
                success: function(dados){
                    $('.modal').html(dados);
                }
            });
        }
    </script>
    </head>
    <body>
          <div class="modalContainer">
            <div class="modal">
            <?php
                //echo ($_POST['id']);
                ?>    
            </div>
        </div>	
        <!-- JAVA SCRIPT SLIDE SHOW-->
    <script type="text/javascript">
        function setaImagem(){
            var settings = {
                primeiraImg: function(){
                    elemento = document.querySelector("#slider a:first-child");
                    elemento.classList.add("ativo");
                    this.legenda(elemento);

                },

                slide: function(){
                    elemento = document.querySelector(".ativo");

                    if(elemento.nextElementSibling){
                        elemento.nextElementSibling.classList.add("ativo");

                        elemento.classList.remove("ativo");
                    }else{
                        elemento.classList.remove("ativo");
                        settings.primeiraImg();
                    }

                },

                proximo: function(){
                    clearInterval(intervalo);
                    elemento = document.querySelector(".ativo");

                    if(elemento.nextElementSibling){
                        elemento.nextElementSibling.classList.add("ativo");
                        settings.legenda(elemento.nextElementSibling);
                        elemento.classList.remove("ativo");
                    }else{
                        elemento.classList.remove("ativo");
                        settings.primeiraImg();
                    }
                    intervalo = setInterval(settings.slide,4000);
                },

                anterior: function(){
                    clearInterval(intervalo);
                    elemento = document.querySelector(".ativo");

                    if(elemento.previousElementSibling){
                        elemento.previousElementSibling.classList.add("ativo");
                        settings.legenda(elemento.previousElementSibling);
                        elemento.classList.remove("ativo");
                    }else{
                        elemento.classList.remove("ativo");						
                        elemento = document.querySelector("a:last-child");
                        elemento.classList.add("ativo");
                        this.legenda(elemento);
                    }
                    intervalo = setInterval(settings.slide,4000);
                },

                legenda: function(obj){
                    var legenda = obj.querySelector("img").getAttribute("alt");
                    document.querySelector("figcaption").innerHTML = legenda;
                }

            }

            //chama o slide
            settings.primeiraImg();

            //chama a legenda
            settings.legenda(elemento);



            //chama o slide à um determinado tempo
            var intervalo = setInterval(settings.slide,4000);
            document.querySelector(".next").addEventListener("click",settings.proximo,false);
            document.querySelector(".prev").addEventListener("click",settings.anterior,false);
        }

        window.addEventListener("load",setaImagem,false);
    </script>
        <!-- FIM JAVA SCRIPT SLIDE SHOW-->
    <section id="principal">
        <!-- MENU PRINCIPAL, ESTA EM UM ARQUIVO SEPARADO PARA MELHOR ORGANIZAÇÃO-->
        <?php
            require_once('moduloMenu.php');
        ?>
        <!-- SLIDE SHOW-->
        <section id="slider">
            <div id="camada">
               <figure>
                       <span class="trs next"></span>
                       <span class="trs prev"></span>
                       <div id="slider2">
                          <a href="#" class="trs"><img style="width:1000 height:400" src="img/derua.jpg" alt="13º Corrida de Rua de Sorocaba" title="Corrida de Rua"></a>
                          <a href="#" class="trs"><img style="width:1000 height:400" src="img/corrida.jpg" alt="Encontre amigos para correr perto de você" title="Encontre amigos para correr perto de você"></a>
                           <a href="#" class="trs"><img style="width:1000 height:400" src="img/bike.jpg" alt="Corrida de Rua" title="Corrida de Rua"></a>
                           <a href="#" class="trs"><img style="width:1000 height:400" src="img/escalada.jpg" alt="Participe da 23º Corrida de bike" title="Corrida de Bike"></a>
                           <a href="#" class="trs"><img style="width:1000 height:400" src="img/ultimasVagas.png" alt="Corrida de Rua" title="Ultimas Vagas"></a>

                       </div>
                        <figcaption></figcaption>
                    </figure>
                </div>
        </section>
        <!-- FIM SLIDE SHOW-->
        
        <!-- CONTEUDO-->
         <section style="height:1600px;" id="conteudo">
              <!-- REDES SOCIAIS, ESTA EM UM ARQUIVO SEPARADO-->
            <?php
                require_once('moduloRedeSocial.php');
            ?>
              <form method="POST" name="index" action="index.php" >
            <!-- PRODUTOS A VENDA -->
            <div style="height:1590px;" id=produtos>
                <?php

                    $sql = "SELECT * FROM produtos WHERE exibir = 1 ";
                    $select = mysql_query($sql);
                    while($lista = mysql_fetch_assoc($select)){
                        
                    ?>
               <div class="tabela">
                   <div>
                        <img style="width:300px; height:200px" src="CMS/<?php echo $lista['imagem']?>" alt="logo">
                    </div>
                    <div> Nome:<?php echo $lista['nome']?> </div>
                    <div> Descrição: <?php echo $lista['descricao']?>  </div>
                    <div> Preço: <?php echo $lista['preco']?> </div>
                    <div class="detalhes">
                        <p> Garanta sua inscrição! </p>
                         <a href="index.php#produtos" class="ver" onclick="Modal(<?php  echo($lista["idProduto"])?>)"> Clique aqui </a>
                    </div>   
                </div>
                  <?php } ?>
            </div>
                  </form>
             <!-- FIM PRODUTOS A VENDA -->
             
             <!--  ATALHO PARA OS PRODUTOS A VENDA-->
            <nav style="height:1600px;" id="menuLateral">
                
                <ul class="lstproduto">
                <?php
                    $sql="SELECT * FROM categoria";
                    $select=mysql_query($sql);
                    while($rs=mysql_fetch_array($select)){
                ?>
                        <li><?php echo ($rs['categoria'])?> 

                            <ul class="subcategoria"> 
                                <?php
                                $banco="SELECT * FROM subcategoria where idcat=".$rs['idcategoria'];
                                $exec=mysql_query($banco);
                                while($result=mysql_fetch_array($exec)){

                                ?>
                                <a href="index.php?abrir_produtos=<?php echo ($result['idsub'])?>"><li><?php echo ($result['subcategoria'])?> </li></a>
                            <?php }?> 
                            </ul>
                        </li>
                <?php } ?>
                    </ul>
			
            
            </nav>  
             <!-- FIM DE ATALHOS -->
        </section>
        <!-- FIM CONTEUDO -->
            <!--  R O D A P E-->
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
                <div style="color:white"> Formas de pagamento:<img  style="width:300px" src="img/bandeiras.png" alt="Formas de pagamento"></div>
                <div style="color:white">Trabalhe conosco: jobs@ligeirinho.com</div>
            </div>
            
        </footer> 
        <!-- F I M   R O D A P E-->
    </section>
    
    </body>
</html>