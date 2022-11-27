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
        $data['ticketInfo'] = $this->solution->getTicketInfo($ticketNo);
        $data['ticketTrail'] = $this->solution->getTicketTrail($ticketNo);
        $this->load->view('partials/__header');
        $this->load->view('main/ticket_info', $data);
        $this->load->view('partials/__footer');
        $this->load->view('main/ajax_request/ticketAutomation_request');
    }

    public function getTicket()
    {
        $list = $this->TicketModel->getTicket();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ticket) {
            $ticketNo = str_replace(['+', '='], '', $this->encrypt->encode($ticket->ticket_no));
            $no++;
            $row = array();

            $row[] = '<div>'.$ticket->ticket_no.'</div>
                      <span class="edit-span view_ticketInfo" id="'.$ticketNo.'" title="View Ticket"><i class="bi bi-eye-fill me-1"></i>View Ticket</span>';
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
            $row[] = '<textarea id="'.$concern->concern_id.'" class="form-control evaluate_concern">'.$concern->evaluate_concern.'</textarea>';
            $row[] = '<textarea id="'.$concern->concern_id.'" class="form-control add_solutions">'.$concern->solutions.'</textarea>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data
        );
        echo json_encode($output);
    }

}
