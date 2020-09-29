<?php
class Validacao{

  public static function validarSabor($v){
    $exp = "/^[a-zA-Zà-ú ]{2,30}$/";
    return preg_match($exp,$v);
  }

  public static function validarValor($v){
    $exp = "/^[0-9]{1,4}$/";
    return preg_match($exp,$v);
  }

  public static function validarTamanho($v){
    $exp = "/^[a-zA-Zà-ú ]{2,30}$/";
    return preg_match($exp,$v);
  }

  public static function validarAdicional($v){
    $exp = "/^[a-zA-Z ]{2,30}$/";
    return preg_match($exp,$v);
  }

  public static function validarSalada($v){
    $exp = "/^[a-zA-Z ]{2,30}$/";
    return preg_match($exp,$v);
  }

  public static function validarNome($v){
    $exp = "/^[a-zA-Zà-ú ]{2,30}$/";
    return preg_match($exp,$v);
  }

  public static function validarIdade($v){
    $exp = "/^[0-9]{2}$/";
    return preg_match($exp,$v);
  }

  public static function validarTelefone($v){
    $exp = "/^[0-9 ]{8,14}$/";
    return preg_match($exp,$v);
  }

  public static function validarCidade($v){
    $exp = "/^[a-zA-Zà-ú ]{2,30}$/";
    return preg_match($exp,$v);
  }

  public static function validarCep($v){
    $exp = "/^[0-9]{6,10}$/";
    return preg_match($exp,$v);
  }

  public static function validarMoto($v){
    $exp = "/^[a-zA-Z 0-9 ]{2,10}$/";
    return preg_match($exp,$v);
  }
}
