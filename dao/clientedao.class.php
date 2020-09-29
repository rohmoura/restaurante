<?php
require 'conexaobanco.class.php';
class ClienteDAO { //DATA ACCESS OBJECT

  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function cadastrarCliente($cli){
    try{
      $stat = $this->conexao->prepare("insert into cliente(idcliente,nome,idade,telefone,cidade,cep)values(null,?,?,?,?,?)");

      $stat->bindValue(1,$cli->nome);
      $stat->bindValue(2,$cli->idade);
      $stat->bindValue(3,$cli->telefone);
      $stat->bindValue(4,$cli->cidade);
      $stat->bindValue(5,$cli->cep);

      $stat->execute();

    }catch(PDOException $e){
      echo "Erro ao cadastrar! ".$e;
    }
  }//fecha método

  public function buscarCliente(){
    try{
      $stat = $this->conexao->query("select * from cliente");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,'Cliente');
      return $array;
    }catch(PDOException $e){
      echo "Erro ao buscar cliente! ".$e;
    }//fecha catch
  }//fecha buscarLivros

  public function deletarCliente($id){
    try{
      $stat = $this->conexao->prepare("delete from cliente where idcliente = ?");
      $stat->bindValue(1, $id);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao deletar cliente! ".$e;
    }//fecha catch
  }//fecha deletarLivro

  public function filtrar($query){
    try{

      $stat=$this->conexao->query("select * from cliente ".$query);
      $array=$stat->fetchAll(PDO::FETCH_CLASS, 'Cliente');
      return $array;
    }catch(PDOException $e){
      echo "Erro ao fitrar".$e;
    }
  }

  public function alterarCliente($cli) {
    try {
      $stat = $this->conexao->prepare("update cliente set nome=?, idade=?, telefone=?, cidade=?, cep=? where idCliente=?");

      echo $cli;

      $stat->bindValue(1,$cli->nome);
      $stat->bindValue(2,$cli->idade);
      $stat->bindValue(3,$cli->telefone);
      $stat->bindValue(4,$cli->cidade);
      $stat->bindValue(5,$cli->cep);
      $stat->bindValue(6,$cli->idCliente);

      $stat->execute();
    } catch(PDOException $e) {
      echo "Erro ao alterar! ".$e;
    }//fecha catch
  }//fecha método

}//fecha classe
