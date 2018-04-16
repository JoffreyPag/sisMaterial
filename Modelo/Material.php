<?php
    class Material{
        private $id;
        private $especificacao;

        function __construct(){}

        public function getId(){
            return $this->id;
        }
        public function setId($novaId){
            $this->id = $novaId;
        }
        public function getEspecificacao(){
            return $this->especificacao;
        }
        public function setEspecificacao($novaEspecificacao){
            $this->especificacao = $novaEspecificacao;
        }
    }
?>