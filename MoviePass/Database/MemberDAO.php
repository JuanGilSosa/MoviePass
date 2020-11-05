<?php namespace Database; 

    use Models\Users\Member as Member;
    use Database\Connection as Connection;
    use PDOException as PDOException;

    class MemberDAO implements IDAO
    {

        public function Add($member)
        {
            try{
                $con = Connection::getInstance();
                $query = 'INSERT INTO members(dni,email,password,firstName,lastName,creditCardNumber) VALUES(:dni, :email, :password, :firstName, :lastName, :creditCardNumber);';
    
                $params['dni'] = $member->GetDni();
                $params['email'] = $member->GetEmail();
                $params['password'] = $member->GetPassword();
                $params['firstName'] = $member->GetFirstName();
                $params['lastName'] = $member->GetLastName();
                $params['creditCardNumber'] = $member->GetCreditCardNumber();
                return $con->executeNonQuery($query, $params);
            }catch(PDOException $e){
                throw $e;
            }
        }

        public function GetAll()
        {
            try{
                $array = $this->RetrieveData();
                return (!empty($array)) ? $this->mapping($array) : array();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        

        public function Delete($idUser){

        }

        public function Update($user){
            
        }

        public function RetrieveData()
        {
            $query = 'SELECT * FROM members;';
            try{
                $con = Connection::getInstance();
                $array = $con->execute($query);
                return $array;
            }catch(PDOException $e){
                throw $e;
            }
        }

		public function mapping($value){
			$value = is_array($value) ? $value : [];
			$resp = array_map(function ($p){
                $member = new Member(
                    $p['DNI'],$p['email'],$p['password'],$p['firstName'], $p['lastName'],$p['creditCardNumber']
                );
                $member->setId($p['idMember']);
                return $member;
            },$value);
            return count($resp)>1 ? $resp : $resp[0];
        }
    }
?>