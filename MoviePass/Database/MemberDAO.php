<?php namespace Database; 

    use Models\Users\Member as Member;
    use Database\Connection as Connection;

    class MemberDAO implements IDAO
    {

        public function Add($member)
        {
            try{
                $con = Connection::getInstance();
                $query = 'INSERT INTO members(dni,email,password,firstName,lastName,numeroTarjetaDeCredito) VALUES(:dni, :email, :password, :firstName, :lastName, :numeroTarjetaDeCredito);';
    
                $params['dni'] = $member->getDni();
                $params['email'] = $member->getEmail();
                $params['password'] = $member->getPassword();
                $params['firstName'] = $member->getFirstName();
                $params['lastName'] = $member->getLastName();
                $params['numeroTarjetaDeCredito'] = $member->getNumeroTarjetaDeCredito();
                return $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                throw $e;
            }
        }

        public function GetAll()
        {
            try{
                $array = $this->RetrieveData();
                
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return (!empty($array)) ? $this->mapping($array) : false;
        }
        

        public function Delete($idUser){

        }

        public function Update($user){
            
        }

        public function RetrieveData()
        {
            $query = 'SELECT * FROM Members;';
            try{
                $con = Connection::getInstance();
                $array = $con->execute($query);
            }catch(PDOException $e){
                throw $e;
            }
            return $array;
        }

		public function mapping($value){
			$value = is_array($value) ? $value : [];
			$resp = array_map(function ($p){
                $member = new Member(
                    $p['DNI'],$p['email'],$p['password'],$p['firstName'], $p['lastName'],$p['numeroTarjetaDeCredito']
                );
                $member->setId($p['idMember']);
                return $member;
            },$value);
            return count($resp)>1 ? $resp : reset($resp);
        }
    }
?>