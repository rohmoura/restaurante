<?php
require 'conexaobanco.class.php';
class EntregadorDAO { //DATA ACCESS OBJECT

  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function cadastrarEntregador($entregador){
    try{
      $stat = $this->conexao->prepare("insert into entregador(idEntregador,nome,idade,telefone,cidade,moto)values(null,?,?,?,?,?)");

      $stat->bindValue(1,$entregador->nome);
      $stat->bindValue(2,$entregador->idade);
      $stat->bindValue(3,$entregador->telefone);
      $stat->bindValue(4,$entregador->cidade);
      $stat->bindValue(5,$entregador->moto);

      $stat->execute();

    }catch(PDOException $e){
      echo "Erro ao cadastrar! ".$e;
    }
  }//fecha método

  public function buscarEntregador(){
    try{
      $stat = $this->conexao->query("select * from entregador");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,'Entregador');
      return $array;
    }catch(PDOException $e){
      echo "Erro ao buscar entregador! ".$e;
    }//fecha catch
  }//fecha buscarLivros

  public function deletarEntregador($id){
    try{
      $stat = $this->conexao->prepare("delete from entregador where idEntregador = ?");
      $stat->bindValue(1, $id);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao deletar entregador! ".$e;
    }//fecha catch
  }//fecha deletarLivro

  public function filtrar($query){
    try{
      $stat=$this->conexao->query("select * from entregador ".$query);
      $array=$stat->fetchAll(PDO::FETCH_CLASS, 'Entregador');
      return $array;
    }catch(PDOException $e){
      echo "Erro ao fitrar".$e;
    }
  }

  public function alterarEntregador($entregador) {
    try {
      $stat = $this->conexao->prepare("update entregador set nome=?, idade=?, telefone=?, cidade=?, moto=? where idEntregador=?");


      $stat->bindValue(1,$entregador->nome);
      $stat->bindValue(2,$entregador->idade);
      $stat->bindValue(3,$entregador->telefone);
      $stat->bindValue(4,$entregador->cidade);
      $stat->bindValue(5,$entregador->moto);
      $stat->bindValue(6, $entregador->idEntregador);

      $stat->execute();
    } catch(PDOException $e) {
      echo "Erro ao alterar! ".$e;
    }//fecha catch
  }//fecha método

}//fecha classe
