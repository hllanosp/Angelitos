<?php 
	
	class GenerarPass{
		private $cadena;
		private $longitud;
		private $passw;

		public function __consturct(){
			$this ->cadena = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			this -> passw = '';
		}

		public function newPass($long){
			$lng_cadena = strlen($this -> cadena);
			$this -> $long;

			for ($i=0; $i <  $this ->longitud; $i++) { 
				$aleatorio = mt_rand(0, $lng_cadena-1);
				this ->passw .= substr($this ->cadena , $aleatorio , 1);
				return $this.passw;
			}
		}

	}
 ?>