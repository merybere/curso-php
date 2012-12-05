<?php
class animal
{
	public function comer()
	{
		echo "Comer";
	}
	protected function silbar()
	{
		echo "tralarí tralará";
	}
}

class humano extends animal
{
	public $property = "value";
	
	protected function mentir()
	{
		echo "Es que es una amiga";
		$this->property = "Other value";
	}
	
	public function depredador()
	{
		echo "Me voy de caza";
	}
}


class user extends humano
{
	public $name = '';
	protected $amante = array();
	const pi = "3.14159265";
	
	// Constructor de la clase. Se lanza cada vez que se crea un usuario
	// Hemos llamado al parámetro igual que la propiedad ($name), pero se puede
	// porque el parámetro sólo tiene sentido en el ámbito del método.
	function __construct($name)
	{
		$this->name = $name;
	}
	
	// Esta información (protected) sólo le interesa a "los del entorno"
	protected function tenerAmante()
	{
		// self:: hace referencia al molde, a la clase. Es el operador de resolución.
		// $this: hace referencia al objeto tiene sentido cuando el objeto existe
		$this->amante = array('anillo'=>self::pi);
	}
	
	public function irseDeMarcha()
	{
		$this->tenerAmante();
	}
	
	// Como todos conocemos esta función, es una propiedad del molde
	public static function hacerseElLongui()
	{
		parent::mentir();
		parent::silbar();
	}
	
	// Método que se llama cuando se borra el usuario
	function __destruct()
	{
		$this->name = "RIP" . $this->name;
	}
}

// Crear un objeto usuario
$usuario1 = new user("pepito");
$usuario2 = new user("maria");

$usuario1->irseDeMarcha();
$usuario1->hacerseElLongui();
$usuario1->comer();

// No podemos llamar a este método porque dentro de hacerseElLongui se llama al 
// método mentir del padre, que modifica una propiedad del objeto. Como no está
// creado el objeto, no existe $this
//user::hacerseElLongui();

echo "<pre>";
print_r( $usuario1);
echo "</pre>";

