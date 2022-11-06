<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model
{
    var $users = 'users';
    var $users_order = array('email', 'name', 'department', 'access_level', 'created_at', 'is_active', 'photo');
    var $users_search = array('email', 'name', 'department', 'access_level', 'created_at', 'is_active'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('id' => 'desc'); // default order

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function existing_account($email)
    {
        $query = $this->db->where('email', $email)->get('users');
        return $query->num_rows();
    }

    public function user_check($username, $password)
    {
        $this->db->where('email', $username);
        $res = $this->db->get('users')->row();
        if (!$res) {
            return false;
        } else {
            $hash = $res->password;
            if ($this->verify_password_hash($password, $hash)) {
                return $res;
            } else {
                return false;
            }
        }
    }

    private function verify_password_hash($password, $hash)
    {
        return password_verify($password, $hash);
    }


    function getUserData()
    {
        $this->db->where('id', $_SESSION['loggedIn']['id']);
        $query = $this->db->get('users');
        return $query->row();
    }
}
