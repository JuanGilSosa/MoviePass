<?php
    namespace DAO;

    use Models\Users\Admin as Admin;
    use Models\Users\Member as Member;

    interface IUsersDAO
    {
        function AddAdmin(Admin $admin);
        function AddMember(Member $member);
        function GetAll();
    }
?>