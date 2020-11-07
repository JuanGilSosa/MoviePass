<?php 

    namespace Database;

    use Models\Users\Member as Member;

    interface IMemberDAO
    {
        function GetAll();
        function Add(Member $member);
        function Delete($memberId);
        function Update(Member $member);
        function mapping($value);
    }

?>