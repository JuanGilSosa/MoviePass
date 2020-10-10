<?php 
    namespace DAO;
    use Models\Ubicacion\Pais as Pais;
    class PaisDAO implements IPaisDAO{

        private $lista_paises;
        private $file;

        function __construct(){
            $this->lista_paises = array();
            $this->file = 'Data/paises.json';
        }

        /*
            |**************************************************************************|
            |**NO VEO NECESARIOS ESTOS DOS METODOS POR EL MOMENTO-Depende de la evolucion del proyecto**|
            |*************************************************************************|
 
        public function Add($pais){
            if(!is_null($pais)){
                $this->RetrieveData();
                array_push($this->lista_paises,$pais);
                $this->SaveData();
            }
        }
        
        private function SaveData(){
            $arrayToEncode = array();
            foreach($this->lista_paises as $pais){
                $valuesArray["nombre"] = $pais->getId();
                $valuesArray["id"] = $pais->getCalle();
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->file, $jsonContent);
        }
        */
        private function RetrieveData(){
            if(file_exists($this->file)){
                $jsonContent = file_get_contents($this->file);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                foreach($arrayToDecode as $valuesArray){
                    $pais = new Pais();
                    $pais->setPais($valuesArray["nombre"]);
                    $pais->setId($valuesArray["id"]);
                    array_push($this->lista_paises, $pais);

                }
            }
        }

        public function GetAll(){
            $this->retrieveData();
            return $this->lista_paises;
        }

        public function getForId($id){
            $this->RetrieveData();
            return (array_key_exists($id, $this->lista_paises)) ? $this->lista_paises[$id] : -1;
        }
    }
?>