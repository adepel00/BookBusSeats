<?php
	class BBDDManager{
		private static $instance;
		private static $conexion;

		private function __construct(){
			$this->openConectionBBDD();
		}

		public static function getInstance(){
			if (  !self::$instance instanceof self){
				self::$instance = new self;
			}
			return self::$instance;
		}

		function openConectionBBDD(){
			$server = 'localhost';
			$username = 'prueba';
			$password = 'prueba';
			$database_name = 'plazasbuses';
			
			$this->conexion = new mysqli($server,$username,$password,$database_name);

			if ($this->conexion->connect_error) { 
				alert('Error de Conexión con la base de datos');
			}
		}

		function closeConectionBBDD(){
			$this->conexion->close();
		}

		function readDestinos(){
			$query = 'SELECT * FROM destinos';		
			return $this->conexion->query($query);
		}

		function readAsientos(){
			$query = 'SELECT * FROM asientos';
			return $this->conexion->query($query);
		}

		function readClientes(){
			$query = 'SELECT * FROM clientes';
			return $this->conexion->query($query);
		}

		function insertAsiento($destino, $asiento, $dniUsuario){
			$query = "INSERT INTO asientos (Destino, Asiento, DNIUsuario) VALUES ('".$destino."', '".$asiento."', '".$dniUsuario."')";
			return $this->conexion->query($query);
		}

		function insertCliente($dniUsuario, $nombre, $email){
			$query = "INSERT INTO clientes (DNIUsuario, Nombre, Email) VALUES ('".$dniUsuario."', '".$nombre."', '".$email."')";
			return $this->conexion->query($query);
		}
	}
?>

