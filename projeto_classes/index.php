    <?php
    
    include_once("classes/Categorias.Class.php");
    include_once("classes/Produtos.Class.php");
    include_once("classes/Vendedores.Class.php");
    include_once("classes/Vendas.Class.php");
    include_once("classes/Clientes.Class.php");

    $produtos = Produto::Listar();
        if($produtos){
           foreach($produtos as $produto){
               echo $produto->getId();
               echo"-";
               echo $produto->getCategoria_id();
               echo"-";
               echo $produto->getNome();
               echo"-";
               echo $produto->getPreco();
               echo"-";
               echo $produto->getQuantidade();
               echo"<br/>";
           }
        }

           $categoria = Categorias::Listar();
        if($categoria){
           foreach($categoria as $categoria){
               echo $categoria->getId();
               echo"-";
               echo $categoria->getNome();
               echo"-";
           }
        }
    
           $clientes = Cliente::Listar();
        if($clientes){
           foreach($clientes as $clientes){
               echo $clientes->getId();
               echo"-";
               echo $clientes->getClientes_id();
               echo"-";
               echo $clientes->getNome();
               echo"-";
           }
        }

           $vendas = Vendas::Listar();
        if($vendas){
           foreach($vendas as $vendas){
               echo $vendas->getId();
               echo"-";
               echo $vendas->getCategoria_id();
               echo"-";
               echo $vendas->getNome();
               echo"-";
               echo $vendas->getPreco();
               echo"-";
           }
        }

           $vendedores = Vendedores::Listar();
        if($vendedores){
           foreach($vendedores as $vendedores){
               echo $produto->getId();
               echo"-";
               echo $vendedores->getNome();
               echo"-";
           }
        }
    ?>