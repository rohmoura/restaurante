<?php
class Cliente{
  private $idCliente;
  private $nome;
  private $idade;
  private $telefone;
  private $cidade;
  private $cep;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){ return $this->$a; }
  public function __set($a,$v){ $this->$a = $v; }

  public function __toString(){
    return nl2br("nome: $this->nome
                  idade: $this->idade
                  telefone: $this->telefone
                  cidade: $this->cidade
                  cep: $this->cep:");
  }


}
