<?php 
// Conexion con la base de datos
class DB{
  public static $instancia=null;
  public static function crearInstancia(){

    if ( !isset(self::$instancia) ) {
      // Propiedad para control de errores
      $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      self::$instancia = new PDO("mysql:host=localhost;dbname=aplicacioncertificados", "root", "", $opciones);
      // echo "Conectado....";
    }
    return self::$instancia;
  }
}

?>