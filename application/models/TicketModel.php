<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class TicketModel extends CI_Model
{
    var $ticket = 'ticketing';
    var $ticket_order = array('ticket_no', 'concern', 'concern_person', 'concern_department', 'concern_remarks', 'expected_accomplish', 'concern_status');
    var $ticket_search = array('ticket_no', 'concern', 'concern_person', 'concern_department', 'concern_remarks', 'expected_accomplish', 'concern_status'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order_ticket = array('ticket_id' => 'desc'); // default order
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

    public function getTicket()
    {
        $this->_get_ticket_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_ticket_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->ticket);
        $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('concern_status !=', 'Posted');
        $this->db->where('concern_status !=', 'Closed');
        return $this->db->count_all_results();
    }

    private function _get_ticket_query()
    {
        if ($this->input->post('department')) {
            $this->db->where('request_department', $this->input->post('department'));
        }
        if ($this->input->post('status')) {
            $this->db->where('concern_status', $this->input->post('status'));
        }
        if ($this->input->post('from') && $this->input->post('to')) {
            $this->db->where('DATE(date_added) >=', $this->input->post('from'));
            $this->db->where('DATE(date_added) <=', $this->input->post('to'));
        }
        $this->db->from($this->ticket);
        $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('concern_status !=', 'Posted');
        $this->db->where('concern_status !=', 'Closed');
        $i = 0;
        foreach ($this->ticket_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->ticket_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->ticket_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_ticket)) {
            $order = $this->order_ticket;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function getCritical()
    {
        $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('concern_level', 'Critical');
        $this->db->where('concern_status !=', 'Received');
        $query = $this->db->get('ticketing');
        return $query->num_rows();
    }
    function getHigh()
    {
        $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('concern_level', 'High');
        $this->db->where('concern_status !=', 'Received');
        $query = $this->db->get('ticketing');
        return $query->num_rows();
    }
    function getMedium()
    {
        $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('concern_level', 'Medium');
        $this->db->where('concern_status !=', 'Received');
        $query = $this->db->get('ticketing');
        return $query->num_rows();
    }
    function getPosted()
    {
        $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('concern_status', 'Posted');
        $query = $this->db->get('ticketing');
        return $query->num_rows();
    }
    function getLow()
    {
        $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('concern_level', 'Low');
        $this->db->where('concern_status !=', 'Received');
        $query = $this->db->get('ticketing');
        return $query->num_rows();
    }
    function getPending()
    {
        $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('concern_status', 'Pending');
        $query = $this->db->get('ticketing');
        return $query->num_rows();
    }
    function getOngoing()
    {
        $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('concern_status', 'Ongoing');
        $query = $this->db->get('ticketing');
        return $query->num_rows();
    }
    function getFinish()
    {
        $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        $this->db->where('concern_status', 'Received');
        $query = $this->db->get('ticketing');
        return $query->num_rows();
    }

    function getOngoingStatus($ticketNo)
    {
        $where = "(ticket_no='".$ticketNo."' AND remarks ='Ongoing Process')";
        $this->db->from('tickettrail');
        $this->db->where($where);
        return $this->db->count_all_results();

        // $this->db->from($this->ticket);
        // $this->db->where('concern_personID', $_SESSION['loggedIn']['id']);
        // return $this->db->count_all_results();
    }

}
