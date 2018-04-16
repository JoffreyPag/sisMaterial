<?php
include_once("Material.php");
    class Consumo extends Material{
        private $quantidade;
        private $idDepartamento;

        //construtor
        function __construct(){}

        public function getQuantidade(){
            return $this->quantidade;
        }

        public function setQuantidade($qtdNova){
            $this->quantidade = $qtdNova;
        }

        public function getidDepartamento($idnova){
            return $this->idDepartamento;
        }

        public function setidDepartamento($idnova){
            $this->idDepartamento = $idnova;
        }
    }
?>