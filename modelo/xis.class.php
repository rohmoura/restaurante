<?php
class Xis{
  private $idXis;
  private $sabor;
  private $valor;
  private $tamanho;
  private $adicional;
  private $salada;

  public function __construct(){}
  public function __destruct(){}

  public function __get($a){ return $this->$a; }
  public function __set($a,$v){ $this->$a = $v; }

  public function __toString(){
    return nl2br("Sabor: $this->sabor
                  Valor: $this->valor
                  Tamanho: $this->tamanho
                  Adicional: $this->adicional
                  Salada: $this->salada");
  }


}
