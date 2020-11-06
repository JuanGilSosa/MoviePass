<?php

    namespace Controllers;
    
    use Database\MemberDAO as MemberDAO;
    use Models\Users\Member as Member;

    use Helpers\SessionHelper as SessionHelper;

    class MembersController
    {
        private $membersDAO; 

        public function __construct(){
            $this->membersDAO = new MemberDAO(); 
        }

        public function AddMember($firstName, $lastName, $dni, $email, $password, $checkPassword)
        {

            $message = "";

            $member = $this->FindMemberByEmail($email);
            if(!$member)
            {
                if($password == $checkPassword)
                {
                    $member = new Member($dni, $email, $password, $firstName, $lastName);

                    $bytes = $this->membersDAO->Add($member);
                    
                    if($bytes == false){
                        $message = "No se pudo grabar en este momento.";
                        ViewsController::ShowRegisterForm($message);
                    } 
                    #Grabó correctamente?
                    else
                    {
                        $message = "";
                        ViewsController::ShowLogIn($message);
                    }
                    

                }else{
                    $message = "Error al verificar contraseña.";
                    ViewsController::ShowRegisterForm($message);
                }
            }
            else
            {
                $message = "El email ingresado ya se encuentra registrado.";
                ViewsController::ShowRegisterForm($message);
            }

        } 

        public function FindMemberByEmail ($email)
        {
            $loggedMember = null;

            $members = $this->membersDAO->GetAll($email);
            
            if(is_array($members) && !empty($members)){
                foreach ($members as $member)
                {
                    if($member->GetEmail() == $email)
                    {
                        return $member;
                    }
                }
            }else if(!empty($members)){ #si solo hay un miembro en la base de datos, se devuelve un objeto y no un array
                return $members;    
            }
            return $loggedMember;
        }

        public function VerifyMemberAndPassword($email, $password)
        {
            $rta = "";
            $loggedMember = $this->FindMemberByEmail($email);
            
            if ($loggedMember != null && $loggedMember->GetPassword() == $password) 
            {
                SessionHelper::SetSession('userLogged',$loggedMember);
            }
            else
            {
                $rta = "Datos incorrectos"; 
            }
                         
            return $rta;
        }

        public function Registrando(){
            ViewsController::ShowRegisterForm();
        }


    }

?>