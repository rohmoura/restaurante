<?php
require 'conexaobanco.class.php';
class XisDAO { //DATA ACCESS OBJECT

  private $conexao = null;

  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function cadastrarXis($xis){
    try{
      $stat = $this->conexao->prepare("insert into xis(idxis,sabor,valor,tamanho,adicional,salada)values(null,?,?,?,?,?)");

      $stat->bindValue(1,$xis->sabor);
      $stat->bindValue(2,$xis->valor);
      $stat->bindValue(3,$xis->tamanho);
      $stat->bindValue(4,$xis->adicional);
      $stat->bindValue(5,$xis->salada);

      $stat->execute();

    }catch(PDOException $e){
      echo "Erro ao cadastrar! ".$e;
    }
  }//fecha método

  public function buscarXis(){
    try{
      $stat = $this->conexao->query("select * from xis");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,'Xis');
      return $array;
    }catch(PDOException $e){
      echo "Erro ao buscar xis! ".$e;
    }//fecha catch
  }//fecha buscarLivros

  public function deletarXis($id){
    try{
      $stat = $this->conexao->prepare("delete from xis where idxis = ?");
      $stat->bindValue(1, $id);
      $stat->execute();
    }catch(PDOException $e){
      echo "Erro ao deletar xis! ".$e;
    }//fecha catch
  }//fecha deletarLivro

  public function filtrar($query){
    try{
      $stat = $this->conexao->query("select * from xis ".$query);
      $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Xis');
      return $array;
    }catch(PDOException $e){
      echo "error ao filtrar xis".$e;
    }//fecha catch
  }//fecha metodo

  public function alterarXis($xis) {
    try {
      $stat = $this->conexao->prepare("update xis set sabor=?, valor=?, tamanho=?, adicional=?, salada=? where idxis=?");

      $stat->bindValue(1, $xis->sabor);
      $stat->bindValue(2, $xis->valor);
      $stat->bindValue(3, $xis->tamanho);
      $stat->bindValue(4, $xis->adicional);
      $stat->bindValue(5, $xis->salada);
      $stat->bindValue(6, $xis->idXis);

      $stat->execute();
    } catch(PDOException $e) {
      echo "Erro ao alterar! ".$e;
    }//fecha catch
  }//fecha método

}//fecha classe
