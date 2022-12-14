<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FormController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('FormModel', 'forms');
        $this->load->library('encrypt');
        $this->load->database();
        if (!isset($_SESSION['loggedIn'])) {
            redirect('../toms-world');
        }
    }

    public function getForms()
    {
        $list = $this->forms->getForms();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $forms) {
            $no++;
            $row = array();

            $row[] = '<div>' . $forms->doc_no . '</div>
                      <span class="edit-span download_forms" id="' . $forms->id . '" title="Download Forms"><i class="bi bi-download me-1"></i>Download Forms</span>';
            $row[] = $forms->doc_type;
            $row[] = $forms->doc_name;
            $row[] = $forms->department;
            $row[] = date('D M j, Y h:i a', strtotime($forms->date_created));
            $row[] = date('D M j, Y h:i a', strtotime($forms->date_update));

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->forms->count_all(),
            "recordsFiltered" => $this->forms->count_filtered(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function addForms()
    {
        $message = '';
        $date_created = date('Y-m-d H:i:s');

        //PDF Upload
        if (!empty($_FILES['inpFile']['name'])) {
            $new_name = str_replace(' ', '_', $_FILES['inpFile']['name']);
            $config['upload_path'] = 'uploaded_file/forms';
            $config['allowed_types'] = 'pdf|docx|doc|xls|csv|xlsx';
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('inpFile')) {
                $uploadPDF = $this->upload->data();
                $uploadFile = $uploadPDF['file_name'];
            } else {
                $uploadFile = '';
            }
        } else {
            $uploadFile = '';
        }
        //End of PDF upload

        $insert_forms = array(
            'doc_no' => $this->input->post('doc_no'),
            'doc_type' => $this->input->post('doc_type'),
            'doc_name' => $this->input->post('doc_name'),
            'doc_availability' => $this->input->post('doc_availability'),
            'date_created' => $date_created,
            'department' => $this->input->post('department'),
            'upload_byID' => $_SESSION['loggedIn']['id'],
            'uploade_by' => $_SESSION['loggedIn']['name'],
            'doc_path' => $uploadFile,
        );

        if ($this->db->insert('supplementary_forms', $insert_forms)) {
            $message = '';
        } else {
            $message = 'Error';
        }

        $output = array(
            'message' => $message,
        );
        echo json_encode($output);
    }

    public function downloadForms()
    {
        $doc_id = $_GET['docID'];
        $this->load->helper('download');
        $fileInfo = $this->forms->getFormsData($doc_id);
        $file = 'uploaded_file/forms/' . $fileInfo->doc_path;
        force_download($file, NULL);
    }
}
