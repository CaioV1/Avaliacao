<!DOCTYPE html>

<?php 

    require_once("../Controller/Contato.php");
    require_once("../Model/ContatoDAO.php");

    $contatoDAO = new ContatoDAO();

    $contato = new Contato;

    session_start();

    $modo = "inserir";

    if(isset($_GET['btn_salvar'])){
        
        $contato->setNome($_GET['txt_nome']);
        $contato->setEmail($_GET['txt_email']);
        $contato->setCelular($_GET['txt_celular']);
        
        if($contato->getNome() == "" || $contato->getEmail() == "" || $contato->getCelular() == ""){
            
            echo("<font color = 'red'>Preencha todos os campos.</font>");
            
        } else {
        
            $modo = $_SESSION['modo'];

            if($modo == "inserir"){

                $contatoDAO->inserir($contato);

            }else if($modo == "editar"){

                $contato->setId($_SESSION['id']);

                $contatoDAO->atualizar($contato);

            }  

            header("location:index.php");
            
        }    
        
    }

    if(isset($_GET['btn_cancelar'])){
        
        header("location:index.php");
        
    }

    if(isset($_GET['modo'])){
        
        $modo = $_GET['modo'];
        
        $id = $_GET['id'];
        
        if($modo == "editar"){
            
            $contato = new Contato();
            
            $contato = $contatoDAO->obterUm($id);
            
            $_SESSION['modo'] = $modo;
            
            $_SESSION['id'] = $contato->getId();
            
        } 
        
    } else {
        
        $_SESSION['modo'] = "inserir";
        
    }

?>

<html>
    <head>
        <title>
            Cadastro de Contatos
        </title>    
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="CSS/bootstrap.css">
    </head>    
    <body>
        <form name="frm_contato" method="get" action="cadastro.php">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                    </div>    
                    <div class="col-md-8">
                        <ul class="nav nav-tabs">
                          <li role="presentation"><a href="index.php">Home</a></li>
                          <li role="presentation" class="active"><a href="cadastro.php"><?php  echo ($modo=="editar" ? "Atualização" : "Cadastro"); ?></a></li>
                        </ul>
                    </div> 
                </div>   
                <div class="row">
                    <div class="col-md-2">
                    </div> 
                    <div class="col-md-8">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <?php  echo ($modo=="editar" ? "Atualização" : "Cadastro"); ?> de Contato
                                </h3>    
                            </div>  
                            <div class="panel-body">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Nome</span>
                                    <input type="text" class="form-control" placeholder="Digite o nome do usuário" aria-describedby="basic-addon1" name="txt_nome" value = "<?php echo($contato->getNome()); ?>">
                                </div>
                                <div class="input-group" style="margin-top:20px;">
                                  <span class="input-group-addon" id="basic-addon1">E-mail</span>
                                  <input type="text" class="form-control" placeholder="Digite o e-mail do contato. Ex: demonstracao@exemplo.com" aria-describedby="basic-addon1" name="txt_email" value = "<?php echo($contato->getEmail()); ?>">
                                </div>
                                <div class="input-group" style="margin-top:20px;">
                                  <span class="input-group-addon" id="basic-addon1">Celular</span>
                                  <input type="text" class="form-control" placeholder="Digite o celular do contato. Ex: (11) 98877-6655" aria-describedby="basic-addon1" name="txt_celular" value = "<?php echo($contato->getCelular()); ?>">
                                </div>
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-success" name="btn_salvar" style="margin-top:20px;margin-left:10px;" value="<?php  echo ($modo=="editar" ? "Atualizar" : "Cadastrar"); ?>">
                                </div> 
                                <div class="col-md-2">
                                    <button name="btn_cancelar" class="btn btn-danger" style="margin-top:20px;margin-left:10px;">
                                        Cancelar
                                    </button>
                                </div>
                            </div>    
                        </div>    
                    </div>    
                </div>    
            </div>  
        </form>    
    </body>    
</html>    