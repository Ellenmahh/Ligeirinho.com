<?php
    require_once('moduloConexao.php');
// DEFININDO AS VARIAVEIS COMO NULA, MAIS NAO DAR ERRO NA INICIALIZAÇÃO DO SITE
    $nome="";
    $telefone="";
    $celular="";
    $email="";
    $sexo="";
    $profissao="";
    $homePage="";
    $LinkFace="";
    $sugestaoCritica="";
    $infoProduto="";
// APOS O BOTAO SER CLICADO...
if(isset($_POST['btnsalvar'])){
    //RESGATAR OS VALORES DIGITADOS E GUARDAR EM VARIAVEIS
    $nome=$_POST['txtnome'];
    $telefone=$_POST['txttel'];
    $celular=$_POST['txtcel'];
    $email=$_POST['email'];
    $sexo=$_POST['rdosexo'];
    $profissao=$_POST['txtprofissao'];
    $homePage=$_POST['txtHomePage'];
    $LinkFace=$_POST['txtFace'];
    $sugestaoCritica=$_POST['txtSugestaoCritica'];
    $infoProduto=$_POST['txtInfo'];
    // INSERT NO BANCO DE DADOS COM AS VARIAVEIS QUE CONTÉM OS VALORES DIGITADOS PELO USER
    $sql="INSERT INTO tblFaleConosco (nome,telefone,celular,email,sexo,profissao,homePage,linkFace,sugestaoOuCritica,infoProdutos)VALUES('".$nome."','".$telefone."','".$celular."','".$email."','".$sexo."','".$profissao."','".$homePage."','".$LinkFace."','".$sugestaoCritica."','".$infoProduto."')";
    // EXECUTANDO O INSERT NO BANCO
    mysql_query($sql);
   // TESTE DE INSERT
    if(mysql_affected_rows() !=-1){
        echo "<script>alert('Enviado com sucesso!');</script>";
        header('location:7FaleConosco.php');
    }else{
        echo "erro";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Ligeirinho.com</title>
         <link rel="stylesheet" type="text/css" href="LigeirinhoCSS/1home.css">
         <link rel="stylesheet" type="text/css" href="LigeirinhoCSS/slider.css">
        <script type="text/javascript">
        
            function validar(caracter,typeblock){
                if(window.event){
                    var letra = caracter.keyCode;
                }else if (caracter.which){
                    var letra = caracter.which ;
                }   if(typeblock=='n'){    	
                        if(letra>= 48 && letra<= 57){
                            //cancele o evento da tecla
                            return false;
                        }
                    }else if(typeblock=='c'){
                        if(letra<48 || letra>57){
                            if(letra!=8 && letra!=127 && letra!=45 && letra!=32 && letra!=40){
                                return false;
                            }
                        }
                    }}
        </script>
    </head>

    <body>
    
    <section style="height:2200px" id="principal">
        <?php
                require_once('moduloMenu.php');
        ?>
       
        
        <section style="height:1092px" id="conteudo">
              
            <?php
                    require_once('moduloRedeSocial.php');
                ?>
            
            <div style="height:1090px; width:1180px" id=produtos>
               <!-- CAMPOS QUE SERAO PREENCHIDOS PELOS USUARIOS-->
                <div id="faleConosco">
                    <form name="frmFaleConosco" method="post" action="7FaleConosco.php" >
                     <table id="tblFaleconosco">
                        <h2>Deixe seu comentário/dúvida/elogio</h2>
                       <tr>
                          <td style="color:#CD5C5C">Nome: *</td>
                           <td>
                               <input required pattern="[a-z A-Z ã Ã á Á õ Õ ó Ó]*" onkeypress="return validar(event,'n');" placeholder="Ex:Maria Madalena" type="text" name="txtnome">
                           </td>
                       </tr>
                        <tr>
                          <td>Telefone: </td>
                           <td>
                               <input pattern="[0-9]({3})[0-9]{4}-[0-9]{4}" placeholder="Ex:(ddd)4618-6302" type="text" name="txttel" onkeypress="return validar(event,'c');">
                           </td>
                       </tr>
                        <tr>
                          <td style="color:#CD5C5C">  Celular: *</td>
                           <td>
                               <input required pattern="[0-9]({3})[0-9]{4}-[0-9]{5}" placeholder="Ex:(ddd)9234-56789" onkeypress="return validar(event,'c');"  type="text" name="txtcel">
                           </td>
                       </tr>
                        <tr>
                          <td style="color:#CD5C5C">  Email: *</td>
                           <td>
                               <input required placeholder="Ex:example@example.com.br" type="email" name="email">
                           </td>
                       </tr>
                       <tr>
                          <td style="color:#CD5C5C">  Sexo: *</td>
                           <td>
                               <input required  type="radio" name="rdosexo" value="f"  />F
                                <input required type="radio" name="rdosexo" value="m"  />M
                           </td>
                       </tr>
                       <tr>
                          <td style="color:#CD5C5C">  Profissão: *</td>
                           <td>
                               <input required placeholder="Ex:programador" type="text" name="txtprofissao">
                           </td>
                       </tr>
                        <tr>
                          <td>  Home Page: </td>
                           <td>
                               <input placeholder="Ex:https://example.com.br" type="text" name="txtHomePage">
                           </td>
                       </tr>
                        <tr>
                          <td>  Link do Facebook: </td>
                           <td>
                               <input placeholder="Ex:https://www.facebook.com/seunome" type="text" name="txtFace">
                           </td>
                       </tr>
                        <tr>
                          <td> Sugestão/Crítica: </td>
                           <td>
                              <textarea placeholder="Aceitamos seu feedback" name="txtSugestaoCritica" cols="50" rows="10" style="resize:none"></textarea>
                           </td>
                       </tr>
                        <tr>
                          <td>Informações de Produtos: </td>
                           <td>
                              <textarea placeholder="Deixe sua dúvida" name="txtInfo" cols="50" rows="10"
                                style="resize:none"></textarea>
                           </td>
                       </tr>
                       <tr>
                           <td><input type="submit" name="btnsalvar" value="Enviar" ></td>
                       </tr>
                       
                     </table>
                    </form>
                    <h6 style="color:#CD5C5C"> * os campos em vermelho são obrigatórios. </h6>
                </div>
                   
            </div>
            <!-- FIM DOS CAMPOS -->
        </section>
        <!-- INICIO RODAPE -->
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
        <!-- FIM RODAPE -->
        
    </section>
    
    </body>
</html>