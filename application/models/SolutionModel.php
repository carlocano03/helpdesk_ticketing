<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class SolutionModel extends CI_Model
{
    var $solutions = 'solutions';
    var $solutions_order = array('solutionTitle', 'solutionDetails', 'videoURL', 'fileURL', 'audioURL', 'addedBy', 'addedDepartment', 'solutionStatus', 'dateAdded');
    var $solutions_search = array('solutionTitle', 'addedBy', 'solutionStatus'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('solutionID' => 'desc'); // default order

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
    
    function getStatus()
    {
        $this->db->group_by('concern_status');
        $this->db->order_by('concern_status', 'ASC');
        return $this->db->get('ticketing')->result();
    }

    public function get_solution()
    {
        $this->get_solution_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->get_solution_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->solutions);
        $this->db->where('addedDepartment', $_SESSION['loggedIn']['department']);
        $this->db->where('is_deleted', NULL);
        return $this->db->count_all_results();
    }

    private function get_solution_query()
    {
        $this->db->from($this->solutions);
        $this->db->where('addedDepartment', $_SESSION['loggedIn']['department']);
        $this->db->where('is_deleted', NULL);
        $i = 0;
        foreach ($this->solutions_search as $item) // loop column 
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

                if (count($this->solutions_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->solutions_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_data_solution($solutionID)
    {
        $this->db->from($this->solutions);
        $this->db->where("solutionID", $solutionID);
        $query = $this->db->get();
        return $query->result();
    }

    function exportSolution()
    {
        $query = $this->db->get('solutions');
        return $query->result_array();
    }

    function fetch_filter_type()
    {
        $this->db->select('*');
        $this->db->from('solutions');
        $this->db->where('is_active', 'Active');
        return $this->db->get();
    }

    function make_query($support, $department, $section, $concern)
    {
        $query = " 
            SELECT * FROM solutions
            WHERE is_active = 'Active'
        ";

        if (isset($support) && !empty($support)) {
            $query .= "
                AND solutionTitle = '" . $_POST['support'] . "'
            ";
        }

        if (isset($department) && !empty($department)) {
            $query .= "
                AND addedDepartment = '" . $department . "'
            ";
        }

        if (isset($concern) && !empty($concern)) {
            $query .= "
                AND solutionTitle = '" . $concern . "'
            ";
        }
        return $query;
    }

    function count_all_data($support, $department, $section, $concern)
    {
        $query = $this->make_query($support, $department, $section, $concern);
        $data = $this->db->query($query);
        return $data->num_rows();
    }

    function fetch_data($limit, $start, $support, $department, $section, $concern)
    {
        $query = $this->make_query($support, $department, $section, $concern);
        $query .= ' LIMIT ' . $start . ', ' . $limit;
        $data = $this->db->query($query);

        $output = '';
        if ($data->num_rows() > 0) {
            foreach ($data->result_array() as $row) {
                $output .= '
                <div class="col-lg-3 pb-3">
                        <div class="card ai-card">
                            <img src="' . base_url('assets/img/ai_support/toms.jpg') . '" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['solutionTitle'] . '</h5>
                                <p class="card-text">' . $row['solutionDetails'] . '</p>
                                <button class="btn btn-view view_solution" id="' . $row['solutionID'] . '"><i class="bi bi-arrow-right-square me-2"></i>View Solutions</button>
                            </div>
                        </div>
                    </div>
                ';
            }
        } else {
            $output = '<div class="alert alert-danger">No Data Found</div>';
        }
        return $output;
    }

    function getsolutionTitle($postData)
    {

        $response = array();

        if (isset($postData['search'])) {
            $this->db->from('solutions');
            $this->db->where('is_active', 'Active');
            $this->db->where("solutionTitle like '%" . $postData['search'] . "%'");
            $records = $this->db->get()->result();

            foreach ($records as $row) {
                $response[] = array(
                    "label" => strtoupper($row->solutionTitle),
                );
            }
        }
        return $response;
    }

    function fetch_employee($department)
    {
        $this->db->where('department', $department);
        $this->db->select("emp_id, CONCAT((f_name),(' '),(l_name)) as fullname");
        $query = $this->db->get('tomsworld.employee');
        $output = '<option value="">Select Assignee</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->emp_id . '|' .$row->fullname. '">' . $row->fullname . '</option>';
        }
        return $output;
    }

    public function get_ticket()
    {
        $this->_get_ticket_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_ticket()
    {
        $this->_get_ticket_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_ticket()
    {
        $this->db->from($this->ticket);
        $this->db->where('request_byID', $_SESSION['loggedIn']['id']);
        return $this->db->count_all_results();
    }

    private function _get_ticket_query()
    {
        if ($this->input->post('department')) {
            $this->db->where('concern_department', $this->input->post('department'));
        }
        if ($this->input->post('status')) {
            $this->db->where('concern_status', $this->input->post('status'));
        }
        $this->db->from($this->ticket);
        $this->db->where('request_byID', $_SESSION['loggedIn']['id']);
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

    function getTicketInfo($ticketNo)
    {
        $this->db->where('ticket_no', $ticketNo);
        return $this->db->get('ticketing')->row();
    }

    function getTicketConcern($ticketNo)
    {
        $this->db->where('ticket_no', $ticketNo);
        return $this->db->get('ticketconcern')->result();
    }

    function getTicketTrail($ticketNo)
    {
        $this->db->where('ticket_no', $ticketNo);
        return $this->db->get('tickettrail')->result();
    }
}
