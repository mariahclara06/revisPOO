<?php

include_once("classes/DB.Class.php");


class Categorias {
        private $id;
        private $nome;
        
        public function __construct($id=false){
             if($id){
               $sql = "SELECT * FROM Categorias where id = ?";
               $conexao = DB::conexao();
           $stmt = $conexao->prepare($sql);
           $stmt->bindParam(1,$id, PDO::PARAM_INT);
           $stmt->execute();
           foreach($stmt as $obj){
             $this->setId($obj['id']);
             $this->setNome($obj['nome']);
            }
          }
        }

        public function setid($id){
            $this->id=$id;
       }
       public function getid(){
            return $this->id;
       }
       public function setNome($nome){
            $this->nome=$nome;
       }
       public function getNome(){
            return $this->nome;
       }

       
       public function adicionar(){
          $sql = "INSERT INTO categoria (id, nome,)
                  VALUES(?,?,?,?)";
        try{
            $conexao = DB::conexao();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(1,$this->id);
            $stmt->bindParam(2,$this->nome);
            $stmt->execute();
        }catch(PDOException $e){
             echo "Erro na função adicionar categoria".$e->getMessage();      
            }     
        }
        public static function listar(){
             $sql = "SELECT * FROM categorias";
             $conexao = DB::conexao();
             $stmt = $conexao->prepare($sql);
             $stmt->execute();
             $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
             If ($registros){
                 $objetos = array();
                 foreach($registros as $registro){
                    $temporario = new Produto();
                    $temporario->setid($registro['id']);
                    $temporario->setNome($registro['nome']);
                    $objetos[] = $temporario;
                 }
                 return $objetos;
             }
             return false;
        }
       public function atualizar(){
           if($this->id){
            $sql="UPDATE categorias SET nome = :nome
            WHERE id = :id";

            $stmt = DB::conexão()->prepare($sql);
            $stmt->bindParam(':nome',$this->nome);
            $stmt->bindParam(':id',$this->id);
            $stmt->execute();
           }
      }
      public function excluir(){
          if($this->id){
               $sql = "DELETE FROM categorias WHERE id = :id";
               $stmt = DB::conexao()->prepare($sql);
               $stmt ->bindParam(':id',$this->id);
               $stmt->execute();
      }

    }
}

?>