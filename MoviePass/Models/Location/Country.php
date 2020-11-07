<?php

    namespace Models\Location;

    class Country
    {
        private $id;
        private $name;

        public function __construct ($id="", $name = ""){
            $this->id = (int)$id;
            $this->name = $name;
        }        

        public function GetId() {
            return $this->id;
        }

        public function GetName() {
            return $this->name;
        }

        public function SetId($id) {
            $this->id = (int)$id;
        }

        public function SetName($name) {
            $this->name = $name;
        }
    }
?>