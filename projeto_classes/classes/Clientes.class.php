<?php

include_once("classes/DB.Class.php");

      class Cliente{
           private $id;
           private $clientes_id;
           private $nome;
           

       public function __construct($id=false){
           if($id){
           $sql = "SELECT * FROM Clientes where id = ?";
           $conexao = DB::conexao();
           $stmt = $conexao->prepare($sql);
           $stmt->bindParam(1,$id, PDO::PARAM_INT);
           $stmt->execute();
           foreach($stmt as $obj){
             $this->setId($obj['id']);
             $this->setClientes_id($obj['clientes_id']);
             $this->setNome($obj['nome']);
             }
           }
      }

       public function setId($id){
            $this->id=$id;
       }
       public function getId(){
            return $this->id;
       }
       public function setClientes_id($clientes_id){
          $this->clientes_id=$clientes_id;
       }
       public function getClientes_id(){
            return $this->clientes_id;
       }
       public function setNome($nome){
            $this->nome=$nome;
       }
       public function getNome(){
            return $this->nome;
       }

       public function adicionar(){
          $sql = "INSERT INTO produtos (id, cliente_id, nome)
                  VALUES(?,?,?,?)";
        try{
            $conexao = DB::conexao();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(1,$this->id);
            $stmt->bindParam(1,$this->cliente_id);
            $stmt->bindParam(2,$this->nome);
            $stmt->execute();
        }catch(PDOException $e){
             echo "Erro na função adicionar cliente".$e->getMessage();      
            }     
        }
        public static function listar(){
             $sql = "SELECT * FROM clientes";
             $conexao = DB::conexao();
             $stmt = $conexao->prepare($sql);
             $stmt->execute();
             $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
             If ($registros){
                 $objetos = array();
                 foreach($registros as $registro){
                    $temporario = new Produto();
                    $temporario->setid($registro['id']);
                    $temporario->setClientes_id($registro['clientes_id']);
                    $temporario->setNome($registro['nome']);
                    $objetos[] = $temporario;
                 }
                 return $objetos;
             }
             return false;
        }
        public function atualizar(){
          if($this->id){
               $sql="UPDATE clientes SET nome = :nome
               WHERE id = :id";
   
               $stmt = DB::conexão()->prepare($sql);
               $stmt->bindParam(':nome',$this->nome);
               $stmt->bindParam(':clientes_id',$this->clientes_id);
               $stmt->bindParam(':id',$this->id);
               $stmt->execute();
        }
     }
        public function excluir(){
          if($this->id){
               $sql = "DELETE FROM clientes WHERE id = :id";
               $stmt = DB::conexao()->prepare($sql);
               $stmt ->bindParam(':id',$this->id);
               $stmt->execute();
        }
     }
}

      ?>