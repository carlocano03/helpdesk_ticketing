<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SolutionManagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('SolutionModel', 'solution');
        $this->load->database();
        $this->load->library('encrypt');
        if (!isset($_SESSION['loggedIn'])) {
            redirect('../toms-world');
        }
    }

    public function solution()
    {
        $this->load->view('partials/__header');
        $this->load->view('main/solution_management');
        $this->load->view('partials/__footer');
        $this->load->view('main/ajax_request/solution_request');
    }

    public function AIsupport()
    {
        $data['support_data'] = $this->solution->fetch_filter_type();
        $data['department'] = $this->db->group_by('addedDepartment')->get('solutions')->result();
        $data['concern'] = $this->db->group_by('solutionTitle')->get('solutions')->result();

        $this->load->view('partials/__header');
        $this->load->view('main/ai_support', $data);
        $this->load->view('partials/__footer');
        $this->load->view('main/ajax_request/ai_support_request');
    }

    public function ticketing()
    {
        $data['department'] = $this->db->order_by('department', 'ASC')->get('tomsworld.department')->result();
        $data['status'] = $this->solution->getStatus();
        $this->load->view('partials/__header');
        $this->load->view('main/ticket_automation', $data);
        $this->load->view('partials/__footer');
        $this->load->view('main/ajax_request/ticket_request');
    }

    public function ticketInfo()
    {
        $ticketNo = $this->encrypt->decode($_GET['ticketNo']);
        $data['ticketInfo'] = $this->solution->getTicketInfo($ticketNo);
        $data['ticketTrail'] = $this->solution->getTicketTrail($ticketNo);
        $this->load->view('partials/__header');
        $this->load->view('main/view_ticket', $data);
        $this->load->view('partials/__footer');
        $this->load->view('main/ajax_request/ticket_request');
    }

    public function addSolution()
    {
        $message = '';
        $date_created = date('Y-m-d H:i:s');
        $generatedID = 'SLT' . date('Y') . '-' . rand(10, 1000);
        $videoID = 'VD' . time() . rand(10, 1000);
        $audioID = 'AD' . time() . rand(10, 1000);
        $pdfID = 'PDF' . time() . rand(10, 1000);

        //Video Upload
        if (!empty($_FILES['videoFile']['name'])) {
            $extension = explode('.', $_FILES['videoFile']['name']);
            $new_name = $videoID . '.' . $extension[1];
            $config['upload_path'] = 'uploaded_file/solution_file';
            $config['allowed_types'] = 'mp4|jpg|png';
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->display_errors();
            $this->upload->initialize($config);
            if ($this->upload->do_upload('videoFile')) {
                $uploadData = $this->upload->data();
                $videoFile = $uploadData['file_name'];
            } else {
                $videoFile = '';
            }
        } else {
            $videoFile = '';
        }
        //End of video upload

        //Audio Upload
        if (!empty($_FILES['audioFile']['name'])) {
            $extension_audio = explode('.', $_FILES['audioFile']['name']);
            $new_name = $audioID . '.' . $extension_audio[1];
            $config['upload_path'] = 'uploaded_file/solution_file';
            $config['allowed_types'] = 'mp3|jpg|png';
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('audioFile')) {
                $uploadAudio = $this->upload->data();
                $audioFile = $uploadAudio['file_name'];
            } else {
                $audioFile = '';
            }
        } else {
            $audioFile = '';
        }
        //End of audio upload

        //PDF Upload
        if (!empty($_FILES['pdfFile']['name'])) {
            $extension = explode('.', $_FILES['pdfFile']['name']);
            $new_name = $pdfID . '.' . $extension[1];
            $config['upload_path'] = 'uploaded_file/solution_file';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('pdfFile')) {
                $uploadPDF = $this->upload->data();
                $pdfFile = $uploadPDF['file_name'];
            } else {
                $pdfFile = '';
            }
        } else {
            $pdfFile = '';
        }
        //End of PDF upload

        $status_query  = $this->db->query("
                         SELECT * FROM tomsworld.users
                         WHERE users.is_active='Active'
        ");
        $count = $status_query->num_rows();
        foreach ($status_query->result() as $row) {
            $add_notif[] = array(
                'user_id' => $row->id,
                'notif_title' => 'Added new solution',
                'notif_message' => 'created a new solutions ' . $generatedID,
                'added_by' => $_SESSION['loggedIn']['name'],
                'added_by_userID' => $_SESSION['loggedIn']['id'],
                'date_added' => $date_created,
            );
        }

        $insert_solution = array(
            'solutionReference' => $generatedID,
            'solutionDetails' => $this->input->post('solutionDetails'),
            'solutionTitle' => $this->input->post('solutionTitle'),
            'solutionInstructions' => $this->input->post('solutionInstructions'),
            'videoURL' => $videoFile,
            'fileURL' => $pdfFile,
            'audioURL' => $audioFile,
            'addedBy' => $_SESSION['loggedIn']['name'],
            'addedUserID' => $_SESSION['loggedIn']['id'],
            'addedDepartment' => $_SESSION['loggedIn']['department'],
            'solutionStatus' => 'For Approval',
            'dateAdded' => $date_created,
        );

        if ($this->db->insert('solutions', $insert_solution)) {
            $this->db->insert_batch('tomsworld.notification', $add_notif);
            $message = '';
        } else {
            $message = 'Error';
        }

        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }

    public function get_solution()
    {
        $list = $this->solution->get_solution();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $solution) {

            $query = $this->db->query("SELECT photo FROM users WHERE id='" . $solution->addedUserID . "'");
            $res = $query->row();

            $no++;
            $row = array();

            $row[] = '<button class="btn btn-outline-success btn-sm view_solution" id="' . $solution->solutionID . '"><i class="bi bi-folder2-open me-2"></i>View Solution</button>
                      <button class="btn btn-danger text-white btn-sm delete_solution" id="' . $solution->solutionID . '"><i class="bi bi-trash-fill"></i></button>';
            $row[] = $solution->solutionReference;
            $row[] = $solution->solutionTitle;
            $row[] = $solution->solutionDetails;
            $row[] = $solution->solutionStatus;


            if (isset($res->photo) && $res->photo != '')
                $row[] = '<img class="box" src="' . base_url('../toms-world/uploaded_file/profile/') . '' . $res->photo . '" alt="Pofile-Picture">' . ' ' . $solution->addedBy;
            else
                $row[] = '<img class="box" src="' . base_url('../toms-world/assets/img/avatar.jpg') . '" alt="Pofile-Picture">' . ' ' . $solution->addedBy;

            $row[] = $solution->dateAdded;
            if ($solution->solutionStatus == 'Posted') {
                if ($solution->is_active == 'Active') {
                    $row[] = '<label class="switch">
							  <input type="checkbox" class="action_session" id="' . $solution->solutionID . '" checked>
							  <span class="slider round"></span>
					  	  </label><br>' . $solution->is_active . '';
                } else {
                    $row[] = '<label class="switch">
						  <input type="checkbox" class="action_session" id="' . $solution->solutionID . '">
						  <span class="slider round"></span>
					  	 </label><br>' . $solution->is_active . '';
                }
            } else {
                $row[] = '';
            }


            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->solution->count_all(),
            "recordsFiltered" => $this->solution->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function get_data_solution()
    {
        $video = '';
        $audio = '';
        $sol = '';
        $posted = '';
        $data = $this->solution->get_data_solution($_POST["solutionID"]);
        foreach ($data as $row) {

            $video .= '
                <video width="100%" height="380" controls>
                    <source src="' . base_url('uploaded_file/solution_file/' . $row->videoURL) . '" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            ';
            $audio .= '
                <audio controls class="right-width">
                    <source src="' . base_url('uploaded_file/solution_file/' . $row->audioURL) . '" type="audio/mpeg">
                    Your browser does not support the <code>audio</code> element.
                </audio>
            ';
            $sol .= '
                <h5>' . $row->solutionTitle . '</h5>
                <p>' . nl2br($row->solutionInstructions) . '</p>

                <button class="btn btn-success btn-sm download_attachment" title="Download attachment" data-url="' . $row->fileURL . '"><i class="bi bi-download me-2"></i>Download Attachment</button>
            ';
            $posted = $row->solutionStatus;
        }

        $data = array(
            'video' => $video,
            'audio' => $audio,
            'sol' => $sol,
            'posted' => $posted,
        );

        echo json_encode($data);
    }

    public function approved_solution()
    {
        $message = '';
        $approved_solution = array(
            'solutionStatus' => 'Posted',
            'is_active' => 'Active',
        );
        $this->db->where('solutionID', $this->input->post('solutionID'))->update('solutions', $approved_solution);
        $message = 'Success';

        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }

    public function solution_activated()
    {
        $error = '';
        if ($this->db->where('solutionID', $_POST['solutionID'])->update('solutions', array('is_active' => 'Active')))
            $error = 'Success';
        else
            $error = 'Error';
        $output = array(
            'success' => $error,
        );
        echo json_encode($output);
    }

    public function solution_deactivated()
    {
        $error = '';
        if ($this->db->where('solutionID', $_POST['solutionID'])->update('solutions', array('is_active' => 'Inactive')))
            $error = 'Success';
        else
            $error = 'Error';
        $output = array(
            'success' => $error,
        );
        echo json_encode($output);
    }

    public function delete_solution()
    {
        $error = '';
        $date_update = date('Y-m-d H:i:s');
        if ($this->db->where('solutionID', $_POST['solutionID'])->update('solutions', array('is_deleted' => 'YES', 'deleted_at' => $date_update)))
            $error = 'Success';
        else
            $error = 'Error';
        $output = array(
            'success' => $error,
        );
        echo json_encode($output);
    }

    public function exportSolution()
    {
        require_once 'vendor/autoload.php';
        $date_now = date('F j, Y');
        $acctData = $this->solution->exportSolution();
        $objReader = IOFactory::createReader('Xlsx');
        $fileName = 'Solution Data.xlsx';

        $spreadsheet = $objReader->load(FCPATH . '/assets/template/' . $fileName);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A5', 'AS OF ' . strtoupper($date_now));
        $startRow = 8;
        $currentRow = 8;
        foreach ($acctData as $val) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow + 1, 1);
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $currentRow, $val['solutionReference'])
                ->setCellValue('B' . $currentRow, $val['solutionTitle'])
                ->setCellValue('C' . $currentRow, $val['solutionDetails'])
                ->setCellValue('D' . $currentRow, $val['solutionInstructions'])
                ->setCellValue('E' . $currentRow, $val['solutionStatus'])
                ->setCellValue('F' . $currentRow, $val['addedBy'])
                ->setCellValue('G' . $currentRow, $val['addedDepartment'])
                ->setCellValue('H' . $currentRow, $val['is_active'])
                ->setCellValue('I' . $currentRow, $val['dateAdded'])
                ->setCellValue('J' . $currentRow, $val['is_deleted'])
                ->setCellValue('K' . $currentRow, $val['deleted_at']);
            $currentRow++;
        }

        $spreadsheet->getActiveSheet()->removeRow($currentRow, 1);
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        header('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
        header('Content-Disposition: attachment;filename="' . $fileName . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    function fetch_data()
    {
        $support = $this->input->post('support');
        $department = $this->input->post('department');
        $section = $this->input->post('section');
        $concern = $this->input->post('concern');

        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = '#';
        $config['total_rows'] = $this->solution->count_all_data($support, $department, $section, $concern);
        $config['per_page'] = 8;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='active'><a href='#'>";
        $config['cur_tag_close'] = "</a></li>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 3;
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $start = ($page - 1) * $config['per_page'];
        $output = array(
            'pagination_link' => $this->pagination->create_links(),
            'product_list' => $this->solution->fetch_data($config['per_page'], $start, $support, $department, $section, $concern),
        );
        echo json_encode($output);
    }

    public function getsolutionTitle()
    {
        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->solution->getsolutionTitle($postData);

        echo json_encode($data);
    }

    public function fetch_employee()
    {
        if ($this->input->post('department')) {
            echo $this->solution->fetch_employee($this->input->post('department'));
        }
    }

    public function addTicket()
    {
        $message = '';
        $date_created = date('Y-m-d H:i:s');
        $generatedTicket = 'TN-' . date('my') . rand(10, 1000);

        $add_notif = array(
            'user_id' => $this->input->post('empID'),
            'notif_title' => 'Ticket Automation',
            'notif_message' => 'added to your ticket list ' . $generatedTicket,
            'added_by' => $_SESSION['loggedIn']['name'],
            'added_by_userID' => $_SESSION['loggedIn']['id'],
            'date_added' => $date_created,
        );

        $insert_ticket = array(
            'ticket_no' => $generatedTicket,
            'concern_department' => $this->input->post('dept'),
            'concern_person' => $this->input->post('concernPerson'),
            'concern_personID' => $this->input->post('empID'),
            'concern_level' => $this->input->post('level'),
            'concern_status' => 'Pending',
            'request_by' => $_SESSION['loggedIn']['name'],
            'request_byID' => $_SESSION['loggedIn']['id'],
            'request_department' => $_SESSION['loggedIn']['department'],
            'date_added' => $date_created,
        );

        $insert_trail = array(
            'ticket_no' => $generatedTicket,
            'ticket_status' => 'Ticket submitted successfully. Waiting for the response of concern person.',
            'remarks' => 'Submitted',
            'date_added' => $date_created,
        );

        if ($this->db->insert('ticketing', $insert_ticket)) {
            //Insert Concern List
            $tableConcern = $this->input->post('data_table');
            for ($i = 0; $i < count($tableConcern); $i++) {
                $data[] = array(
                    'ticket_no' => $generatedTicket,
                    'concern' => $tableConcern[$i]['concern'],
                );
                $this->db->insert('ticketconcern', $data[$i]);
            }
            $this->db->insert('tickettrail', $insert_trail);
            $this->db->insert('tomsworld.notification', $add_notif);
            $message = 'Success';
        } else {
            $message = 'Error';
        }

        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }

    public function get_ticket()
    {
        $list = $this->solution->get_ticket();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $concern) {
            $ticketNo = $this->encrypt->encode($concern->ticket_no);
            $no++;
            $row = array();
            
            $row[] = '<div>'.$concern->ticket_no.'</div>
                      <span class="edit-span view_ticket" id="'.$ticketNo.'" title="View Ticket"><i class="bi bi-eye-fill me-1"></i>View Ticket</span>';
            $row[] = $concern->concern_person;
            $row[] = $concern->concern_department;
            $row[] = date('D M j, Y h:i a', strtotime($concern->date_added));
            $row[] = $concern->concern_status;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->solution->count_all_ticket(),
            "recordsFiltered" => $this->solution->count_filtered_ticket(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function getNotif()
    {

        $output = '';
        $userID = $_SESSION['loggedIn']['id'];
        if (isset($_POST['view'])) {
            if ($_POST["view"] != '') {
                $this->db->where('notification.user_id', $_SESSION['loggedIn']['id']);
                $this->db->where('notification.seen_status', '0');
                $this->db->update('tomsworld.notification', array('seen_status' => '1'));
            }

            $query = $this->db->query("
                        SELECT *
                        FROM tomsworld.notification WHERE notification.user_id='" . $userID . "'
                        AND notification.seen_status='0' OR notification.user_id='All'
                        ORDER BY notification.notif_id DESC LIMIT 5
                        ");

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {

                    $this->db->where('employee.emp_id', $row->added_by_userID);
                    $query = $this->db->get('tomsworld.employee');
                    $res = $query->row();
                    $date_created = date('D M j, Y g:i a', strtotime($row->date_added));
                    if ($userID == $row->added_by_userID) {
                        $added_by = 'You are';
                    } else {
                        $added_by = $row->added_by;
                    }

                    $output .= '
                    
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <img class="box me-2" src="' . base_url('../toms-world/uploaded_file/profile/') . '' . $res->profile_pic . '" alt="Pofile-Picture">
                            <div>
                                <h4>' . $added_by . '</h4>
                                <p>' . $row->notif_message . '</p>
                                <p>' . $date_created . '</p>
                            </div>
                        </li>
                    ';
                }
            } else {
                $output .= '<li class="dropdown-header">
                                No Notification Found
                            </li>';
            }

            $status_query  = $this->db->query("
                        SELECT *
                        FROM tomsworld.notification WHERE notification.user_id='" . $userID . "' 
                        AND notification.seen_status='0' OR notification.user_id='All'
                        ");
            $count = $status_query->num_rows();

            $data = array(
                'notification' => $output,
                'unseen_notification'  => $count
            );
            echo json_encode($data);
        } // end of first if
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

    public function getTicketInformation()
    {
        $ticketNo  = $this->uri->segment(3);
        $list = $this->solution->getTicketConcern($ticketNo);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $concern) {
            $no++;
            $row = array();
            
            if ($concern->update_by == NULL) {
                $row[] = $concern->concern;
            } else {
                $row[] = '<div>'.$concern->concern.'</div>
                          <span class="text-danger"><small><b>Updated by:</b> '.$concern->update_by.'</small></span>';
            }
            
            $row[] = $concern->evaluate_concern;
            $row[] = $concern->solutions;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data
        );
        echo json_encode($output);
    }

    public function updateLevel()
    {
        $date_created = date('Y-m-d H:i:s');
        $message = '';
        if ($this->db->where('ticket_no', $this->input->post('ticketNo'))->update('ticketing', array('concern_level' => $this->input->post('level')))) {
            $this->db->where('ticket_no', $this->input->post('ticketNo'))->update('ticketing', array('date_last_update' => $date_created));
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

    public function evaluateConcern()
    {
        $this->db->where('concern_id', $this->input->post('concernID'));
        $res = $this->db->get('ticketconcern')->row();
        $date_created = date('Y-m-d H:i:s');
        $message = '';
        $evaluateConcern = array(
            'evaluate_concern' => $this->input->post('evaluateConcern'),
            'update_by' => $_SESSION['loggedIn']['name'],
            'update_byID' => $_SESSION['loggedIn']['id'],
        );
        if ($this->db->where('concern_id', $this->input->post('concernID'))->update('ticketconcern', $evaluateConcern)) {
            $this->db->where('ticket_no', $res->ticket_no)->update('ticketing', array('date_last_update' => $date_created));
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

    public function add_solutions()
    {
        $this->db->where('concern_id', $this->input->post('concernID'));
        $res = $this->db->get('ticketconcern')->row();
        $date_created = date('Y-m-d H:i:s');
        $message = '';
        $addSolutions = array(
            'solutions' => $this->input->post('solutions'),
            'update_by' => $_SESSION['loggedIn']['name'],
            'update_byID' => $_SESSION['loggedIn']['id'],
        );
        if ($this->db->where('concern_id', $this->input->post('concernID'))->update('ticketconcern', $addSolutions)) {
            $this->db->where('ticket_no', $res->ticket_no)->update('ticketing', array('date_last_update' => $date_created));
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }
}
