<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('main_model');
        $this->load->model('TicketModel');
        $this->load->model('SolutionModel', 'solution');
        $this->load->database();
        if (!isset($_SESSION['loggedIn'])) {
            redirect('../toms-world');
        }
    }

    //========================================================================================

    public function index()
    {
        $data['critical'] = $this->TicketModel->getCritical();
        $data['high'] = $this->TicketModel->getHigh();
        $data['medium'] = $this->TicketModel->getMedium();
        $data['low'] = $this->TicketModel->getLow();
        $data['posted'] = $this->TicketModel->getPosted();
        $data['finish'] = $this->TicketModel->getFinish();
        $data['ongoing'] = $this->TicketModel->getOngoing();
        $data['pending'] = $this->TicketModel->getPending();
        $this->load->view('partials/__header');
        $this->load->view('main/dashboard', $data);
        $this->load->view('partials/__footer');
        $this->load->view('main/ajax_request/ticketAutomation_request');
    }

    //========================================================================================

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('../toms-world');
    }

    //========================================================================================

    public function accountManagement()
    {
        $this->load->view('partials/__header');
        $this->load->view('main/account_management');
        $this->load->view('partials/__footer');
        $this->load->view('main/ajax_request/account_request');
    }

    //========================================================================================

    public function myProfile()
    {
        $data['userProfile'] = $this->user_model->getUserData();
        $this->load->view('partials/__header');
        $this->load->view('main/user_profile', $data);
        $this->load->view('partials/__footer');
    }

    //========================================================================================

    public function ticketMonitoring()
    {
        $data['department'] = $this->db->order_by('department', 'ASC')->get('tomsworld.department')->result();
        $data['status'] = $this->solution->getStatus();
        $this->load->view('partials/__header');
        $this->load->view('main/ticket_monitoring', $data);
        $this->load->view('partials/__footer');
        $this->load->view('main/ajax_request/ticketAutomation_request');
    }

    //========================================================================================

    public function forms()
    {
        $data['department'] = $this->db->order_by('department', 'ASC')->get('tomsworld.department')->result();
        $this->load->view('partials/__header');
        $this->load->view('main/supplementary_forms', $data);
        $this->load->view('partials/__footer');
        $this->load->view('main/ajax_request/form_request');
    }

    //========================================================================================

    public function analytics()
    {
        // $data['department'] = $this->db->order_by('department', 'ASC')->get('tomsworld.department')->result();
        $this->load->view('partials/__header');
        $this->load->view('main/analytics');
        $this->load->view('partials/__footer');
    }

    //========================================================================================

    public function get_accountData()
    {
        $list = $this->user_model->get_accountData();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $account) {
            $no++;
            $row = array();

            //$row[] = '<button class="btn btn-info btn-sm text-white update_account" id="' . $account->id . '" title="Update Account"><i class="bi bi-pencil-square me-2"></i>Update</button>';
            if ($account->photo != '')
                $row[] = '<img class="box" src="' . base_url('uploaded_file/profile/') . '' . $account->photo . '" alt="Pofile-Picture">';
            else
                $row[] = '<img class="box" src="' . base_url('assets/img/avatar.jpg') . '" alt="Pofile-Picture">';

            $row[] = $account->email;
            $row[] = $account->name;
            $row[] = $account->department;
            $row[] = $account->access_level;
            $row[] = date('F j, Y', strtotime($account->created_at));

            if (isset($account->is_active) && $account->is_active == 'Active') {
                $row[] = '<label class="switch">
							  <input type="checkbox" class="action_session" id="' . $account->id . '" checked>
							  <span class="slider round"></span>
					  	  </label><br>' . $account->is_active . '';
            } else {
                $row[] = '<label class="switch">
						  <input type="checkbox" class="action_session" id="' . $account->id . '">
						  <span class="slider round"></span>
					  	 </label><br>' . $account->is_active . '';
            }

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_model->count_all(),
            "recordsFiltered" => $this->user_model->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
    }

    //========================================================================================

    public function account_activated()
    {
        $error = '';
        $date_update = date('Y-m-d H:i:s');
        if ($this->db->where('id', $_POST['userID'])->update('users', array('is_active' => 'Active', 'updated_at' => $date_update)))
            $error = 'Success';
        else
            $error = 'Error';
        $output = array(
            'success' => $error,
        );
        echo json_encode($output);
    }

    //========================================================================================

    public function account_deactivated()
    {
        $error = '';
        $date_update = date('Y-m-d H:i:s');
        if ($this->db->where('id', $_POST['userID'])->update('users', array('is_active' => 'Inactive', 'updated_at' => $date_update)))
            $error = 'Success';
        else
            $error = 'Error';
        $output = array(
            'success' => $error,
        );
        echo json_encode($output);
    }

    public function exportAccount()
    {
        require_once 'vendor/autoload.php';
        $date_now = date('F j, Y');
        $acctData = $this->main_model->exportAccount();
        $objReader = IOFactory::createReader('Xlsx');
        $fileName = 'Account.xlsx';

        $spreadsheet = $objReader->load(FCPATH . '/assets/template/' . $fileName);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A5', 'AS OF '.strtoupper($date_now));
        $startRow = 8;
        $currentRow = 8;
        foreach ($acctData as $val) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow+1,1);
		    $spreadsheet->getActiveSheet()
                ->setCellValue('A'.$currentRow, $val['email'])
                ->setCellValue('B'.$currentRow, $val['name'])
                ->setCellValue('C'.$currentRow, $val['department'])
                ->setCellValue('D'.$currentRow, $val['access_level'])
                ->setCellValue('E'.$currentRow, $val['is_active'])
                ->setCellValue('F'.$currentRow, $val['created_at']);
            $currentRow++;
        }

        $spreadsheet->getActiveSheet()->removeRow($currentRow, 1);
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        header('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
        header('Content-Disposition: attachment;filename="' . $fileName . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    //========================================================================================
}
