<?php

    namespace Controllers;

    use DAO\AdminDAO as AdminDAO;
    use DAO\MemberDAO as MemberDAO;
    use Models\Users\Member as Member;
    use Models\Users\Admin as Admin;

    use Database\MemberDAO as MemberDAODB;

    class MembersController
    {

        //FIJENSE SI QUIEREN CONTROLAR TODO EN UNO O DIVIDIRLO EN DOS, CREO QUE SERIA MEJOR TENER DOS CONTROLES, AHORA LO DEJO ACA PARA NO OLVIDAR DE HACERLO
        //DE DIVIDIRLO EN DOS VAMOS A TENER QUE PONER LAS FUNCIONES DE LOGIN EN OTRO CONTROLLER, 
        private $membersDAO; 
        private $membersDAODB;

        public function __construct(){
            $this->membersDAO = new MemberDAO(); 
            $this->membersDAODB = new MemberDAODB();
        }

        public function AddMember($firstName, $lastName, $dni, $email, $password, $checkPassword)
        {

            $message = "";

            $existeUsuario = $this->FindMemberByEmail($email);
            if(!$existeUsuario)
            {
                if($password == $checkPassword)
                {
                    $member = new Member($dni, $email, $password, $firstName, $lastName);

                    $bytes = $this->membersDAODB->Add($member);
                    
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

            $members = $this->membersDAODB->GetAll();
            if(!empty($members)){
                foreach ($members as $member)
                {
                    echo '<script>console.log("sali del getall()");</script>';
                    if($member->getEmail() == $email)
                    {
                        return $member;
                    }
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
                    $_SESSION["userLogged"] = $loggedMember;
                }
                else
                {
                    $rta = "Datos incorrecta";
                }
            }
            else
            {
                $rta = "Datos Incorrecto"; 
            }
                         
            return $rta;
        }

        public function Registrando(){
            ViewsController::ShowRegisterForm();
        }


    }

?>