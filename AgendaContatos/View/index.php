<!DOCTYPE html>

<?php 

    require_once("../Model/ContatoDAO.php");

    $contatoDAO = new ContatoDAO();

    if(isset($_GET['modo'])){
        
        $modo = $_GET['modo'];
        
        $id = $_GET['id'];
        
        if($modo == "excluir"){
            
            $contatoDAO->remover($id);
            
        }
        
    }

?>

<html>
    <head>
        <title>
            Agenda de Contatos
        </title>    
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="CSS/bootstrap.css">
    </head>    
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-1">
                </div>    
                <div class="col-md-10">
                    <ul class="nav nav-tabs">
                      <li role="presentation" class="active"><a href="#">Home</a></li>
                      <li role="presentation"><a href="cadastro.php">Cadastrar</a></li>
                    </ul>
                </div> 
            </div>  
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-10">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Lista de Contatos
                            </h3>    
                        </div>  
                        <div class="panel-body">
                            <table class="table table-hover" style="margin:0px;">
                                <thead>
                                    <tr>
                                      <th scope="col">ID</th>
                                      <th scope="col">Nome</th>
                                      <th scope="col">E-mail</th>
                                      <th scope="col">Celular</th>  
                                      <th scope="col">Excluir</th> 
                                      <th scope="col">Editar</th>     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                        $listaContato = array();
                                    
                                        $listaContato = $contatoDAO->obterTodos();
                                    
                                        foreach($listaContato as $contato){
                                    
                                    ?>
                                    <tr>
                                      <td><?php echo($contato->getId()); ?></td>
                                      <td><?php echo($contato->getNome()); ?></td>
                                      <td><?php echo($contato->getEmail()); ?></td>
                                      <td><?php echo($contato->getCelular()); ?></td>  
                                        <td><a href="index.php?modo=excluir&id=<?php echo($contato->getId()); ?>"><img src="Imagens/excluir_icone.png" style="width:25px;height:25px;"></a></td>
                                      <td><a href="cadastro.php?modo=editar&id=<?php echo($contato->getId()); ?>"><img src="Imagens/editar_icone.png" style="width:25px;height:25px;"></a></td>    
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>    
                        </div>    
                    </div>    
                </div>    
            </div>    
        </div>    
    </body>    
</html>    