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
        $this->load->database();
        if (!isset($_SESSION['loggedIn'])) {
            redirect('../toms-world');
        }
    }

    public function getTicket()
    {
        $list = $this->TicketModel->getTicket();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ticket) {
            $no++;
            $row = array();

            $row[] = $ticket->ticket_no;

            if ($ticket->concern_status == 'Done') {
                $dateStart = new DateTime($ticket->service_start);
                $dateEnd = new DateTime($ticket->date_accomplished);
                $dateDiff = $dateStart->diff($dateEnd);
                $row[] = '<div>' . date('D, M j, Y g:i a', strtotime($ticket->date_added)) . '</div>
                          <small class="text-muted"><b>Accomplished: </b>' . date('D, M j, Y', strtotime($ticket->date_accomplished)) . '</small>';
            } else {
                $row[] = date('D, M j, Y g:i a', strtotime($ticket->date_added));
            }

            if ($ticket->concern_level == 'Critical')
                $row[] = '<span class="badge bg-danger">' . $ticket->concern_level . '</span>';
            elseif ($ticket->concern_level == 'High')
                $row[] = '<span class="badge bg-warning">' . $ticket->concern_level . '</span>';
            elseif ($ticket->concern_level == 'Medium')
                $row[] = '<span class="badge bg-info">' . $ticket->concern_level . '</span>';
            else
                $row[] = '<span class="badge bg-primary">' . $ticket->concern_level . '</span>';

            if ($ticket->concern_status == 'Done')
                $row[] = '<span class="badge bg-success">Finished</span>';
            else
                $row[] = '<select class="text-muted concern" id="' . $ticket->ticket_id . '" data-request="' . $ticket->request_byID . '" data-ticket="' . $ticket->ticket_no . '">
                            <option value="" selected>' . $ticket->concern_status . '</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Cancel">Cancel</option>';

            $row[] = '<b>' . $ticket->concern . '</b>
                      <div>' . $ticket->concern_remarks . '</div>';
            $row[] = $ticket->request_by;

            if ($ticket->concern_status == 'Ongoing')
                $row[] = '<button class="btn btn-success btn-sm done_ticket" id="' . $ticket->ticket_id . '" data-request="' . $ticket->request_byID . '" data-ticket="' . $ticket->ticket_no . '"><i class="bi bi-check2-square me-2"></i>Done</button>';
            elseif ($ticket->concern_status == 'Cancel')
                $row[] = '<span class="badge bg-danger">Cancelled</span>';
            elseif ($ticket->concern_status == 'Done')
                $row[] = '<span class="badge bg-success">Done</span>';
            else
                $row[] = '';

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

    public function updateStatus()
    {
        $ticketID = $this->input->post('ticketID');
        $concernStatus = $this->input->post('concernStatus');
        $requestBy = $this->input->post('requestBy');
        $ticketNo = $this->input->post('ticketNo');
        $date_created = date('Y-m-d H:i:s');
        $message = '';

        switch ($concernStatus) {
            case 'Ongoing':
                $add_notif = array(
                    'user_id' => $requestBy,
                    'notif_title' => 'Ongoing process',
                    'notif_message' => 'Ticket no. ' . $ticketNo . ' ongoing process',
                    'added_by' => $_SESSION['loggedIn']['name'],
                    'added_by_userID' => $_SESSION['loggedIn']['id'],
                    'date_added' => $date_created,
                );

                if ($this->db->where('ticket_id', $ticketID)->update('ticketing', array('concern_status' => $concernStatus, 'service_start' => $date_created))) {
                    $this->db->insert('tomsworld.notification', $add_notif);
                    $message = 'Success';
                } else {
                    $message = '';
                }

                break;

            case 'Cancel':
                $add_notif = array(
                    'user_id' => $requestBy,
                    'notif_title' => 'Cancel ticket',
                    'notif_message' => 'Ticket no. ' . $ticketNo . ' is canceled',
                    'added_by' => $_SESSION['loggedIn']['name'],
                    'added_by_userID' => $_SESSION['loggedIn']['id'],
                    'date_added' => $date_created,
                );

                if ($this->db->where('ticket_id', $ticketID)->update('ticketing', array('concern_status' => $concernStatus))) {
                    $this->db->insert('tomsworld.notification', $add_notif);
                    $message = 'Success';
                } else {
                    $message = '';
                }
                break;
        }
        $output = array(
            'success' => $message,
        );
        echo json_encode($output);
    }

    public function doneTicket()
    {
        $ticketID = $this->input->post('ticketID');
        $requestBy = $this->input->post('requestBy');
        $ticketNo = $this->input->post('ticketNo');
        $date_created = date('Y-m-d H:i:s');
        $message = '';

        $add_notif = array(
            'user_id' => $requestBy,
            'notif_title' => 'Ticket accomplished',
            'notif_message' => 'Ticket no. ' . $ticketNo . ' is accomplished',
            'added_by' => $_SESSION['loggedIn']['name'],
            'added_by_userID' => $_SESSION['loggedIn']['id'],
            'date_added' => $date_created,
        );

        if ($this->db->where('ticket_id', $ticketID)->update('ticketing', array('concern_status' => 'Done', 'date_accomplished' => $date_created))) {
            $this->db->insert('tomsworld.notification', $add_notif);
            $message = 'Success';
        } else {
            $message = '';
        }
        $output = array(
            'success' => $message,
        );
        echo json_encode($output);
    }
}
