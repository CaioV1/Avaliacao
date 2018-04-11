<?php 

    require_once("../Controller/Contato.php");

    class ContatoDAO{
        
        private static function obterConexao(){
            
            if(!$conexao = mysqli_connect("localhost", "root", "bcd127", "db_agenda")){
                
                echo("<font color = 'red'>Não foi possível conectar no Banco de Dados. Contate o administrador.</font>");
                
            }
            
            return $conexao;
            
        }
        
        public function inserir(Contato $contato){
            
            $conexao = ContatoDAO::obterConexao();
            
            $SQL = "INSERT INTO tbl_contato(nome, email, celular) VALUES('".$contato->getNome()."', '".$contato->getEmail()."', '".$contato->getCelular()."')";
                        
            echo($SQL);
            
            mysqli_query($conexao, $SQL);
            
            mysqli_close($conexao);
            
        }
        
        public function obterUm($id){
            
            $conexao = ContatoDAO::obterConexao();
            
            $SQL = "SELECT * FROM tbl_contato WHERE id = ".$id;
            
            $consulta = mysqli_query($conexao, $SQL);
            
            if($resultSet = mysqli_fetch_array($consulta)){
                
                $contato = new Contato();
                
                $contato->setId($resultSet['id']);
                $contato->setNome($resultSet['nome']);
                $contato->setEmail($resultSet['email']);
                $contato->setCelular($resultSet['celular']);
                
            }
            
            mysqli_close($conexao);
            
            return $contato;
            
        }
        
        public function obterTodos(){
            
            $conexao = ContatoDAO::obterConexao(); 
            
            $SQL = "SELECT * FROM tbl_contato";
            
            $consulta = mysqli_query($conexao, $SQL);
            
            $listaContato = array();
            
            $i = 0;
            
            while($resultSet = mysqli_fetch_array($consulta)){
                
                $contato = new Contato();
                
                $contato->setId($resultSet['id']);
                $contato->setNome($resultSet['nome']);
                $contato->setEmail($resultSet['email']);
                $contato->setCelular($resultSet['celular']);
                
                $listaContato[$i] = $contato;
                
                $i++;
                
            }
            
            mysqli_close($conexao);
            
            return $listaContato;
            
        }
        
        
        public function atualizar(Contato $contato){
            
            $conexao = ContatoDAO::obterConexao();
            
            $SQL = "UPDATE tbl_contato SET nome = '".$contato->getNome()."', email = '".$contato->getEmail()."', celular = '".$contato->getCelular()."' WHERE id = ".$contato->getId();
            
            mysqli_query($conexao, $SQL);
            
            mysqli_close($conexao);
            
        }
        
        public function remover($id){
            
            $conexao = ContatoDAO::obterConexao();
            
            $SQL = "DELETE FROM tbl_contato WHERE id = ".$id;
            
            mysqli_query($conexao, $SQL);
            
            mysqli_close($conexao);
            
        }
        
    }

?>