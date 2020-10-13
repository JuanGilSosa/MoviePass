<?php

    namespace Controllers;


    class LogInController
    {
        public function LogIn ($email, $password)
        {
            $rta = $this->VerifyMemberAndPassword($email,$password);
            $this->RedirectLogIn($rta);

        }

        public function RedirectLogIn ($message)
        {
            if(isset($_SESSION["loggedUser"]))
            {
                require_once( FRONT_ROOT . "Views/ShowAddCineView");
            }
            else
            {
                //$message = "Sin usuario";
                require_once( FRONT_ROOT . "Views/ShowLogIn");

            }
        }

        public function FindMemberByEmail ($email)
        {
            $loggedMember = null;
            $members = $this->memberDAO->GetAll();

            foreach ($members as $member)
            {
                if($member->getEmail() == $email)
                {
                    return $member;
                }
            }
            return $loggedMember;
        }

        public function VerifyMemberAndPassword($email, $password)
        {
            $rta = "";
            $loggedMember = $this->FindMemberByEmail($email);

            if ($loggedMember != null) 
            {
                if ($loggedMember->getPassword() == $password)
                {
                    $_SESSION["loggedUser"] = $loggedMember;
                }
                else
                {
                    $rta = "Contraseña incorrecta";
                }
            }
            else
            {
                $rta = "Email Incorrecto"; 
            }
                         
            return $rta;
        }

    }

?>