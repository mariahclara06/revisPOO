<?php
    class DB{

     public static function conexao(){
            $conexao = null;         
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $nome_banco = "classes";
         try{

             $conexao = new PDO(
                 "mysql:host=$servidor;dbname=$nome_banco",
                $usuario,
                $senha
             );
             $conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         }catch(PDOException $e){
             echo "Erro de conexão:".$e->getMessage();
         }
         return $conexao;
     }
    }

?>