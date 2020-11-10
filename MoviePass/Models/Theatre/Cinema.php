<?php 

    namespace Models\Theatre;
    
    class Cinema{
        
        private $id;
        private $name;
        private $price;
        private $capacity;
        private $type;
        private $active;

        public function __construct($id, $name, $price, $capacity, $type){
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->capacity = $capacity;
            $this->type = $type;
            $this->active = true;
        }
        
        public function SetId($id){$this->id = $id;}

        public function SetName($name){$this->name = $name;}

        public function SetPrice($price){$this->price = $price;}
        
        public function SetCapacity($capacity){$this->capacity = $capacity;}

        public function SetType($type){$this->type = $type;}
        
        public function SetActive($active){$this->active = $active;}

        public function GetId(){return $this->id;}

        public function GetName(){return $this->name;}
        
        public function GetPrice(){return $this->price;}
        
        public function GetCapacity(){return $this->capacity;}

        public function GetType(){return $this->type;}

        public function GetActive(){return $this->active;}
    }
