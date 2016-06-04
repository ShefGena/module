<?php

class Registrate extends Model
{
    public function save($data, $id = null)
    {

        if (!isset($data['login']) || !isset($data['password']) || !isset($data['email'])) {
            return false;
        }
        $id = (int)$id;
        $login = $this->db->escape($data['login']);
        $password = $this->db->escape($data['password']);
        $email = $this->db->escape($data['email']);

        if ( !$id ) { // Add new record
            $sql = "
                   INSERT INTO users
                   set login = '{$login}',
                       password = '{$password}',
                       email = '{$email}',
                       role = 'user'
           ";
        } else {// Update existing record
            $role = $this->db->escape($data['role']);
            $is_active = $this->db->escape($data['is_active']);
            $sql = "
                   UPDATE users
                   set login = '{$login}',
                       password = '{$password}',
                       email = '{$email}',
                       role = '{$role}',
                       is_active = '{$is_active}'
           ";
        }

        return $this->db->query($sql);
    }

    public function getList(){
        $sql = "SELECT * FROM messages where 1";

        return $this->db->query($sql);
    }


}