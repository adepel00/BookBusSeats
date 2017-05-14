<?php  
	class AsientoOcupado{
		public $destino;
		public $numero;
		public $nifUsuario;

		public function __construct($destino, $numero, $nifUsuario){
			$this->destino = $destino;
			$this->numero = $numero;
			$this->nifUsuario = $nifUsuario;
		}
	}
?>