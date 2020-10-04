<?php
    namespace Controllers;

    use DAO\TheaterDAO as TheaterDAO;
    use Models\Theater as Theater;

    class TheaterController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."addTheater.php");
        }

        public function ShowListView()
        {
            $studentList = $this->studentDAO->GetAll();

            require_once(VIEWS_PATH."theaterList.php");
        }

        public function Add($recordId, $firstName, $lastName)
        {
            $student = new Student();
            $student->setRecordId($recordId);
            $student->setfirstName($firstName);
            $student->setLastName($lastName);

            $this->studentDAO->Add($student);

            $this->ShowAddView();
        }
    }
?>