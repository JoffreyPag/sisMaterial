<?php
include_once("Material.php");
    class Permanente extends Material{
        private $acessorio;

        function __construct(){

        }

        public function getAcessorio(){
            return $this->acessorio;
        }
        
        public function setAcessorio($novoAcessorio){
            $this->acessorio = $novoAcessorio;
        }
    }

?>