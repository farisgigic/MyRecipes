<?php
require_once __DIR__ . '/BaseDao.class.php';


class UserDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("users");
    }

    public function get_all_users()
    {
        $query = "SELECT * FROM users";
        return $this->query($query, []);
    }

    public function get_user_by_id($id)
    {
        $query = "SELECT * FROM users WHERE id=:id";

        return $this->query_unique($query, [
            "id" => $id
        ]);
    }
    public function add_user($user)
    {
        return $this->insert("users", $user);
    }



    public function delete_user_by_id($id)
    {

        $query = "DELETE FROM users WHERE id =:id";
        $this->execute($query, [
            "id" => $id
        ]);
    }


}