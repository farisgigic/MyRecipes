<?php
require_once __DIR__ . '/../dao/UserDao.class.php';

class UserService
{

    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function get_all_users()
    {

        return $this->userDao->get_all_users();
    }
    public function get_user_by_id($id)
    {
        return $this->userDao->get_user_by_id($id);
    }

    public function add_user($user)
    {
        $user["password"] = password_hash($user["password"], PASSWORD_BCRYPT);
        return $this->userDao->add_user($user);
    }

    public function delete_user_by_id($id)
    {
        $this->userDao->delete_user_by_id($id);
    }

}