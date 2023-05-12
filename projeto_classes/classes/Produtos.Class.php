<?php

include_once("classes/DB.Class.php");

      class Produto{
           private $id;
           private $categoria_id;
           private $nome;
           private $preco;
           private $quantidade;

       public function __construct($id=false){
           if($id){
           $sql = "SELECT * FROM Produtos where id = ?";
           $conexao = DB::conexao();
           $stmt = $conexao->prepare($sql);
           $stmt->bindParam(1,$id, PDO::PARAM_INT);
           $stmt->execute();
           foreach($stmt as $obj){
             $this->setId($obj['id']);
             $this->setCategoria_id($obj['categoria_id']);
             $this->setNome($obj['nome']);
             $this->setPreco($obj['preco']);
             $this->setQuantidade($obj['quantidade']);
             }
           }
      }

       public function setId($id){
            $this->id=$id;
       }
       public function getId(){
            return $this->id;
       }
       public function setCategoria_id($categoria_id){
          $this->categoria_id=$categoria_id;
       }
       public function getCategoria_id(){
            return $this->categoria_id;
       }
       public function setNome($nome){
            $this->nome=$nome;
       }
       public function getNome(){
            return $this->nome;
       }
       public function setPreco($preco){
            $this->preco=$preco;
       }
       public function getPreco(){
            return $this->preco;
       }
       public function setQuantidade($quantidade){
            $this->quantidade=$quantidade;
       }
       public function getQuantidade(){
            return $this->quantidade;
       }
       
       public function adicionar(){
          $sql = "INSERT INTO produtos (categoria_id, nome, preco, quantidade)
                  VALUES(?,?,?,?)";
        try{
            $conexao = DB::conexao();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(1,$this->categoria_id);
            $stmt->bindParam(2,$this->nome);
            $stmt->bindParam(3,$this->preco);
            $stmt->bindParam(4,$this->quantidade);
            $stmt->execute();
        }catch(PDOException $e){
             echo "Erro na função adicionar produto".$e->getMessage();      
            }     
        }
        public static function listar(){
             $sql = "SELECT * FROM produtos";
             $conexao = DB::conexao();
             $stmt = $conexao->prepare($sql);
             $stmt->execute();
             $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
             If ($registros){
                 $objetos = array();
                 foreach($registros as $registro){
                    $temporario = new Produto();
                    $temporario->setid($registro['id']);
                    $temporario->setCategoria_id($registro['categoria_id']);
                    $temporario->setNome($registro['nome']);
                    $temporario->setPreco($registro['preco']);
                    $temporario->setQuantidade($registro['quantidade']);
                    $objetos[] = $temporario;
                 }
                 return $objetos;
             }
             return false;
        }
        public function atualizar(){
          if($this->id){
               $sql="UPDATE produtos SET nome = :nome
               WHERE id = :id";
   
               $stmt = DB::conexão()->prepare($sql);
               $stmt->bindParam(':nome',$this->nome);
               $stmt->bindParam(':categoria_id',$this->categoria_id);
               $stmt->bindParam(':preco',$this->preco);
               $stmt->bindParam(':quantidade',$this->quantidade);
               $stmt->bindParam(':id',$this->id);
               $stmt->execute();
        }
     }
        public function excluir(){
             if($this->id){
                  $sql = "DELETE FROM produtos WHERE id = :id";
                  $stmt = DB::conexao()->prepare($sql);
                  $stmt ->bindParam(':id',$this->id);
                  $stmt->execute();
             }
        }
     }
?>