<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Ticket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('TicketModel');
        $this->load->model('SolutionModel', 'solution');
        $this->load->library('encrypt');
        $this->load->database();
        if (!isset($_SESSION['loggedIn'])) {
            redirect('../toms-world');
        }
    }

    public function createTicket()
    {
        $data['department'] = $this->db->group_by('department')->get('tomsworld.department')->result();
        $this->load->view('partials/__header');
        $this->load->view('main/create_newTicket', $data);
        $this->load->view('partials/__footer');
        $this->load->view('main/ajax_request/ticket_request');
    }

    public function ticketInformation()
    {
        $ticketNo = $this->encrypt->decode($_GET['ticketNo']);
        $ongoing = $this->TicketModel->getOngoingStatus($ticketNo);
        if ($ongoing >= 1) {
            $data['count_solutions'] = $this->solution->getCountSolutions($ticketNo);
            $data['count_concern'] = $this->solution->getCountConcern($ticketNo);
            $data['count_system'] = $this->solution->getCountSupportSystem($ticketNo);
            $data['ticketInfo'] = $this->solution->getTicketInfo($ticketNo);
            $data['ticketTrail'] = $this->solution->getTicketTrail($ticketNo);
            $data['department'] = $this->db->group_by('department')->get('tomsworld.department')->result();
            $this->load->view('partials/__header');
            $this->load->view('main/ticket_info', $data);
            $this->load->view('partials/__footer');
            $this->load->view('main/ajax_request/ticketAutomation_request');
        } else {
            $date_created = date('Y-m-d H:i:s');
            $insert_trail = array(
                'ticket_no' => $ticketNo,
                'ticket_status' => 'Concern person is already seen your ticket request.',
                'remarks' => 'Ongoing Process',
                'date_added' => $date_created,
            );
            $this->db->insert('tickettrail', $insert_trail);
            $this->db->where('ticket_no', $ticketNo)->update('ticketing', array('concern_status' => 'Ongoing'));

            $data['count_solutions'] = $this->solution->getCountSolutions($ticketNo);
            $data['count_concern'] = $this->solution->getCountConcern($ticketNo);
            $data['count_system'] = $this->solution->getCountSupportSystem($ticketNo);
            $data['ticketInfo'] = $this->solution->getTicketInfo($ticketNo);
            $data['ticketTrail'] = $this->solution->getTicketTrail($ticketNo);
            $data['department'] = $this->db->group_by('department')->get('tomsworld.department')->result();
            $this->load->view('partials/__header');
            $this->load->view('main/ticket_info', $data);
            $this->load->view('partials/__footer');
            $this->load->view('main/ajax_request/ticketAutomation_request');
        }
    }

    public function getTicket()
    {
        $list = $this->TicketModel->getTicket();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ticket) {
            $ticketNo = $this->encrypt->encode($ticket->ticket_no);
            $no++;
            $row = array();

            $row[] = '<div>' . $ticket->ticket_no . '</div>
                      <span class="edit-span view_ticketInfo" id="' . $ticketNo . '" title="View Ticket"><i class="bi bi-eye-fill me-1"></i>View Ticket</span>';
            $row[] = $ticket->request_by;
            $row[] = $ticket->request_department;
            $row[] = date('D M j, Y h:i a', strtotime($ticket->date_added));
            $row[] = $ticket->concern_status;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->TicketModel->count_all(),
            "recordsFiltered" => $this->TicketModel->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function getTicketInfo()
    {
        $ticketNo  = $this->uri->segment(3);
        $list = $this->solution->getTicketConcern($ticketNo);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $concern) {
            $no++;
            $row = array();

            $row[] = $concern->concern;
            $row[] = '<textarea id="' . $concern->concern_id . '" class="form-control evaluate_concern">' . $concern->evaluate_concern . '</textarea>';
            
            if ($concern->support_system == NULL) {
                $row[] = '<textarea id="' . $concern->concern_id . '" class="form-control add_solutions mb-2">' . $concern->solutions . '</textarea>
                      <select class="form-select form-select-sm support_system" id="'. $concern->concern_id .'">
                        <option value="">Select Support System</option>
                        <option value="Via Email">Via Email</option>
                        <option value="Phone Call">Phone Call</option>
                        <option value="Remote">Remote</option>
                        <option value="Onsite">Onsite</option>
                      </select>';
            } else {
                $row[] = '<textarea id="' . $concern->concern_id . '" class="form-control add_solutions mb-2">' . $concern->solutions . '</textarea>
                          <span class="text-danger"><b>Support System: </b>'.$concern->support_system.'</span>';
            }
            

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data
        );
        echo json_encode($output);
    }

    public function trasferTicket()
    {
        $date_created = date('Y-m-d H:i:s');
        $message = '';
        $trans_options = $this->input->post('transfer_options');
        switch ($trans_options) {
            case 'other_department':
                $person = explode('|', $this->input->post('assignee'));
                $updateDept = array(
                    'concern_department' => $this->input->post('trans_dept'),
                    'concern_person' => $person[1],
                    'concern_personID' => $person[0],
                );
                $insert_trail = array(
                    'ticket_no' => $this->input->post('ticketNo'),
                    'ticket_status' => 'Ticket transferred to other department.',
                    'remarks' => 'Transferred to other department',
                    'date_added' => $date_created,
                );
                if ($this->db->where('ticket_no', $this->input->post('ticketNo'))->update('ticketing', $updateDept)) {
                    $this->db->insert('tickettrail', $insert_trail);
                    $message = 'Success';
                }
                break;

            default:
                $co_employee = explode('|', $this->input->post('co_employee'));
                $updateEmp = array(
                    'concern_person' => $co_employee[1],
                    'concern_personID' => $co_employee[0],
                );
                $insert_trail = array(
                    'ticket_no' => $this->input->post('ticketNo'),
                    'ticket_status' => 'Ticket transferred to co-employee.',
                    'remarks' => 'Transferred',
                    'date_added' => $date_created,
                );
                if ($this->db->where('ticket_no', $this->input->post('ticketNo'))->update('ticketing', $updateEmp)) {
                    $this->db->insert('tickettrail', $insert_trail);
                    $message = 'Success';
                }
                break;
        }
        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }
}
