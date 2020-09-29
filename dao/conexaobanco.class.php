<?php
class ConexaoBanco extends PDO {

  private static $instance = null;

  public function __construct($dsn, $user, $pass){
    //Construtor da classe pai PDO
    parent::__construct($dsn, $user, $pass);
  }

  public static function getInstance(){
    if(!isset(self::$instance)){
      try{
        /* Cria e retorna uma conexao */
        self::$instance = new ConexaoBanco("mysql:dbname=restaurante;host=localhost","root","");
      }catch(PDOException $e){
        echo "Erro ao conectar! ".$e;
      }//fecha catch
    }//fecha if
    return self::$instance;
  }//fecha método
}
