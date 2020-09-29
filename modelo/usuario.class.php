<?php
  class Usuario{

    private $idUsuario;
    private $login;
    private $senha;
    private $tipo;

    public function __construct(){}
    public function __destruct(){}

    public function __get($a){ return $this->$a; }
    public function __set($a,$v){ $this->$a = $v; }

      public function __toString(){
        return nl2br("Codigo: $this->idUsuario
                      login: $this->login
                      Senha: $this->senha
                      Tipo: $this->tipo");
      }



  }
