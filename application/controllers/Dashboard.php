<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $data=[];
    protected $token, $token_name;

    public function __construct()
    {
        parent::__construct();
        $this->load->library("customfunction");
        $this->load->model("dashboardmodels");
        $this->load->model("homemodels");
        $this->token = $this->security->get_csrf_hash();
        $this->token_name = $this->security->get_csrf_token_name();
        if($this->session->userdata("user_id") == NULL){
            $this->customfunction->alert("danger", "Anda belum login");
            $this->customfunction->redirect(base_url("auth"));
        }else{
            $userdata = $this->dashboardmodels->getUserData($this->session->userdata('user_id'));
            $this->data = array(
                'title'     => "Sulivan Dashboard",
                "full_name" => $userdata['full_name'],
            );
        }
    }

    public function index()
    {
        return view("dashboard/main_dashboard", $this->data);
    }

    public function configurable()
    {
        $this->data['token'] = $this->token;
        $this->data['token_name'] = $this->token_name;
        $this->data['get_configurable'] = $this->homemodels->configurable()->result(); 
        return view("dashboard/configurable", $this->data);
    }

    public function apps()
    {
        $this->data['token'] = $this->token;
        $this->data['token_name'] = $this->token_name;
        $this->data['get_apps'] = $this->homemodels->portfolio()->result(); 
        return view("dashboard/my_apps", $this->data);
    }

    public function add_apps()
    {
        $this->form_validation->set_rules("app_name", "Application Name", "required|min_length[5]");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("category", "Category", "required");
        $this->form_validation->set_rules("url", "URL", "required|valid_url");
        $this->form_validation->set_rules("project_date", "Project Date", "required");
        $this->form_validation->set_rules("type", "Type", "required");
        if($this->form_validation->run() == TRUE) :
            $uploadImg = $this->dashboardmodels->uploadImg("insert", 'portfolio');
            $data = array(
                'application_id'    => $this->dashboardmodels->getLastId("t_application"),
                'application_name'  => $this->customfunction->post("app_name"),
                'walpaper'          => $uploadImg['file']['file_name'],
                'description'       => $this->customfunction->post("description"),
                'requirements'      => $this->customfunction->post("requirement"),
                'category'          => $this->customfunction->post("category"),
                'url'               => $this->customfunction->post("url"),
                'client'            => $this->customfunction->post("client"),
                'project_date'      => $this->customfunction->post("project_date"),
                'type'              => $this->customfunction->post("type"),
                'date_time'         => $this->customfunction->today()
            );
            if($uploadImg['result'] == "success") :
                $this->dashboardmodels->addApplication($data);
                $text = "Record has been added";
                $msg = "Success";
            else :
                $text = $uploadImg['backtrace'];
                $msg = "Warning";
            endif;
        else :
            if(validation_errors() == "") :
                $txt = "Invalid Request".$uploadImg['backtrace'];
                redirect(base_url("dashboard/error"));
            else :
                $txt = validation_errors();
            endif;
            $text = $txt;
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
    }

    public function edit_apps($id)
    {
        $this->form_validation->set_rules("application_name", "Application Name", "required|min_length[5]");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("category", "Category", "required");
        $this->form_validation->set_rules("url", "URL", "required|valid_url");
        $this->form_validation->set_rules("project_date", "Project Date", "required");
        $this->form_validation->set_rules("type", "Type", "required");
        if($this->form_validation->run() == TRUE) :
            $rows = $this->dashboardmodels->AppsById($id)->row();
            $data = array(
                'application_name'  => $this->customfunction->post("application_name"),
                'description'       => str_replace("\n", "<br>", $this->input->post("description")),
                'requirements'      => str_replace("\n", "<br>", $this->input->post("requirement")),
                'category'          => $this->customfunction->post("category"),
                'url'               => $this->customfunction->post("url"),
                'client'            => $this->customfunction->post("client"),
                'project_date'      => $this->customfunction->post("project_date"),
                'type'              => $this->customfunction->post("type"),
                'date_time'         => $this->customfunction->today()
            );
            if(@($_FILES['files']['name']) !== "") ://jika walpaper mau diupdate/diganti
                $uploadImg = $this->dashboardmodels->uploadImg("update", 'portfolio');
                $img = $uploadImg['file']['file_name'];
                $data['walpaper'] = $img;
                if($uploadImg['result'] == "success") :
                    @(unlink(FCPATH.'assets/img/portfolio/'.$rows->walpaper));
                    $this->dashboardmodels->updateApps($id, $data);
                    $text = "Record has been updated";
                    $msg = "Success";
                else :
                    $text = $uploadImg['backtrace'];
                    $msg = "Warning";
                endif;
            else : //jika walpaper tidak diganti ambil gambar yang lama
                $img = $rows->walpaper;
                $data['walpaper'] = $img;
                $update = $this->dashboardmodels->updateApps($id, $data);
                $text = "Record has been updated";
                $msg = "Success";
            endif;
        else :
            if(validation_errors() == "") :
                $txt = "Invalid Request";
            else :
                $txt = validation_errors();
            endif;
            $text = $txt;
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
    }

    public function delete_apps($id)
    {
        $data = $this->dashboardmodels->AppsById($id)->row();
        unlink(FCPATH."assets/img/portfolio/".$data->walpaper);
        $delete = $this->dashboardmodels->deleteApps($id);
        if($this->dashboardmodels->AppsById($id)->num_rows() == 0) :
            $text = "Record has been deleted";
            $msg = "Success";
        else :
            $text = "Delete record failed";
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
    }

    public function getConfById()
    {
        $id = $this->input->post("id");
        $data = $this->dashboardmodels->ConfById($id)->result_array();
        $callback = array(
            'value' => $data['0']['value'],
            'desc'  => $data['0']['description'],
            'content' => $data['0']['content'],
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
        if($id == NULL){
            redirect(base_url("dashboard/error"));
        }
    }

    public function getAppsById()
    {
        $id = $this->input->post("id");
        if($id == NULL){
            redirect(base_url("dashboard/error"));
        }
        $data = $this->dashboardmodels->AppsById($id)->row();
        $callback = array(
            'application_id'    => $data->application_id,
            'application_name'  => $data->application_name,
            'files'             => $data->walpaper,
            'description'       => $data->description,
            'requirement'       => $data->requirements,
            'category'          => $data->category,
            'url'               => $data->url,
            'client'            => $data->client,
            'project_date'      => $data->project_date,
            'type'              => $data->type,
            'date_time'         => $data->date_time,
            'token'             => $this->token,
            'token_name'        => $this->token_name
        );
        echo json_encode($callback);
    }

    public function add_configurable()
    {
        $this->form_validation->set_rules("value", "Value", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("content", "Content", "required");
        if($this->form_validation->run() == TRUE) :
            $data = array(
                'data_id'       => $this->dashboardmodels->getLastId("t_configurable"),
                'value'         => $this->customfunction->post("value"),
                'description'   => $this->customfunction->post("description"),
                'content'       => $this->customfunction->post("content")
            );
            $this->dashboardmodels->addConfigurable($data);
            $text = "Record has been added";
            $msg = "Success";
        else :
            if(validation_errors() == "") :
                $txt = "Invalid Request";
            else :
                $txt = validation_errors();
            endif;
            $text = $txt;
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback, JSON_PRETTY_PRINT);
    }

    public function edit_configurable($id)
    {
        $this->form_validation->set_rules("value", "Value", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("content", "Content", "required");
        if($this->form_validation->run() == TRUE) :
            $data = array(
                'value'         => $this->customfunction->post("value"),
                'description'   => $this->customfunction->post("description"),
                'content'       => $this->customfunction->post("content")
            );
            $this->dashboardmodels->updateConfigurable($id, $data);
            $text = "Record has been updated";
            $msg = "Success";
        else :
            if(validation_errors() == "") :
                $txt = "Invalid Request";
                redirect(base_url("dashboard/error"));
            else :
                $txt = strip_tags(validation_errors());
            endif;
            $text = $txt;
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
    }
    
    public function delete_configurable()
    {
        $id = $this->input->post('id');
        $delete = $this->dashboardmodels->deleteConfigurable($id);
        if($this->dashboardmodels->ConfById($id)->num_rows() == 0) :
            $text = "Record has been deleted";
            $msg = "Success";
        else :
            $text = "Delete record failed";
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
        if($id == NULL){
            redirect(base_url("dashboard/error"));
        }
    }

    public function internship()
    {
        $this->data['token'] = $this->token;
        $this->data['token_name'] = $this->token_name;
        $this->data['get_intern'] = $this->homemodels->internship()->result(); 
        return view('dashboard/internship', $this->data);
    }

    public function experience()
    {
        $this->data['token'] = $this->token;
        $this->data['token_name'] = $this->token_name;
        $this->data['get_experience'] = $this->homemodels->experience()->result(); 
        return view('dashboard/experience', $this->data);
    }

    public function getExpById()
    {
        $id = $this->input->post("id");
        $data = $this->dashboardmodels->getExpByiD($id)->row();
        $callback = array(
            'company'               => $data->company,
            'start_date'            => $data->start_date,
            'finish_date'           => $data->finish_date,
            'description'           => $data->description,
            'job_position'          => $data->job_position,
            'token'                 => $this->token,
            'token_name'            => $this->token_name
        );
        echo json_encode($callback);
        if($id == NULL):
            redirect(base_url("dashboard/error"));
        endif;
    }

    public function getInternById()
    {
        $id = $this->input->post("id");
        $data = $this->dashboardmodels->getInternById($id)->row();
        $callback = array(
            'company'               => $data->company,
            'start_date'            => $data->start_date,
            'finish_date'           => $data->finish_date,
            'description'           => $data->description,
            'internship_position'   => $data->internship_position,
            'token'                 => $this->token,
            'token_name'            => $this->token_name
        );
        echo json_encode($callback);
        if($id == NULL):
            redirect(base_url("dashboard/error"));
        endif;
    }

    public function getDetailIntern()
    {
        $intern = "intern_detail";
        $id = $this->customfunction->post("id");
        $data = $this->dashboardmodels->getDetailIntern($id)->result();
        if($this->dashboardmodels->getDetailIntern($id)->num_rows() == 0){
            $callback[] = array(
                'data'              => $intern,
                'token'             => $this->token,
                'token_name'        => $this->token_name
            );
        }
        foreach($data as $rows){
            $callback[] = array(
                'data'              => $intern,
                'detail_intern_id'  => $rows->detail_internship_id,
                'intern_id'         => $rows->internship_id,
                'job_desc'          => $rows->job_desc,
                'date_time'         => $rows->date_time,
                'token'             => $this->token,
                'token_name'        => $this->token_name
            );
        }
        echo json_encode($callback, JSON_PRETTY_PRINT);
        if($id == NULL):
            redirect(base_url("dashboard/error"));
        endif;
    }

    public function getDetailInternById()
    {
        $id = $this->input->post("id");
        $data = $this->dashboardmodels->getDetailInternById($id)->row();
        $callback = array(
            'detail_internship_id'  => $data->detail_internship_id,
            'job_desc'              => $data->job_desc,
            'token'                 => $this->token,
            'token_name'            => $this->token_name
        );
        echo json_encode($callback);
    }

    public function add_intern()
    {
        $this->form_validation->set_rules("company", "Company", "required|min_length[5]");
        $this->form_validation->set_rules("start_date", "Start_date", "required");
        $this->form_validation->set_rules("finish_date", "Finish_date", "required");
        $this->form_validation->set_rules("description", "Description", "required|min_length[10]|max_length[250]");
        $this->form_validation->set_rules("internship_position", "Internship Position", "required");
        if($this->form_validation->run() == TRUE) :
            $data = array (
                'internship_id'         => $this->dashboardmodels->getLastId('tm_internship'),
                'company'               => $this->customfunction->post('company'),
                'start_date'            => $this->customfunction->post('start_date'),
                'finish_date'           => $this->customfunction->post('finish_date'),
                'description'           => $this->customfunction->post('description'),
                'internship_position'   => $this->customfunction->post('internship_position'),
                'date_time'             => $this->customfunction->today()
            );
            $this->dashboardmodels->addIntern($data);
            $text = "Record has been added";
            $msg = "Success";
        else :
            if(validation_errors() == "") :
                $txt = "Invalid Request";
                redirect(base_url("dashboard/error"));
            else :
                $txt = validation_errors();
            endif;
            $text = $txt;
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback, JSON_PRETTY_PRINT);
    }

    public function delete_intern()
    {
        $id = $this->input->post('id');
        $delete = $this->dashboardmodels->deleteInternship($id);
        if($this->dashboardmodels->getInternById($id)->num_rows() == 0) :
            $text = "Record has been deleted";
            $msg = "Success";
        else :
            $text = "Delete record failed";
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
        if($id == NULL){
            redirect(base_url("dashboard/error"));
        }
    }

    public function edit_intern($id)
    {
        $this->form_validation->set_rules("company", "Company", "required|min_length[5]");
        $this->form_validation->set_rules("start_date", "Start_date", "required");
        $this->form_validation->set_rules("finish_date", "Finish_date", "required");
        $this->form_validation->set_rules("description", "Description", "required|min_length[10]|max_length[250]");
        $this->form_validation->set_rules("internship_position", "Internship Position", "required");
        if($this->form_validation->run() == TRUE) :
            $data = array (
                'company'               => $this->customfunction->post('company'),
                'start_date'            => $this->customfunction->post('start_date'),
                'finish_date'           => $this->customfunction->post('finish_date'),
                'description'           => $this->customfunction->post('description'),
                'internship_position'   => $this->customfunction->post('internship_position'),
                'date_time'             => $this->customfunction->today()
            );
            $this->dashboardmodels->updateInternship($id, $data);
            $text = "Record has been updated";
            $msg = "Success";
        else :
            if(validation_errors() == "") :
                $txt = "Invalid Request";
                redirect(base_url("dashboard/error"));
            else :
                $txt = strip_tags(validation_errors());
            endif;
            $text = $txt;
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
    }

    public function add_intern_detail()
    {
        $this->form_validation->set_rules("job_desc", "Job Description", "required|min_length[5]");
        if($this->form_validation->run() == TRUE) :
            $internship_id = $this->customfunction->post('internship_id');
            $data = array (
                'detail_internship_id'  => $this->dashboardmodels->getLastId('detail_internship_id'),
                'internship_id'         => $internship_id,
                'job_desc'              => $this->customfunction->post('job_desc'),
                'date_time'             => $this->customfunction->today()
            );
            if($this->dashboardmodels->getInternById($internship_id)->num_rows() == 0 ){
                $text = "You must select the record first";
                $msg = "Warning";
            }else{
                $this->dashboardmodels->addInternDetail($data);
                $text = "Record has been added";
                $msg = "Success";
            }
        else :
            if(validation_errors() == "") :
                $txt = "Invalid Request";
                redirect(base_url("dashboard/error"));
            else :
                $txt = validation_errors();
            endif;
            $text = $txt;
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback, JSON_PRETTY_PRINT);
    }

    public function edit_detail_intern($id)
    {
        $this->form_validation->set_rules("job_desc", "Job Description", "required|min_length[10]");
        if($this->form_validation->run() == TRUE) :
            $data = array (
                'job_desc' => $this->customfunction->post('job_desc'),
            );
            $this->dashboardmodels->updateDetailInternship($id, $data);
            $text = "Record has been updated";
            $msg = "Success";
        else :
            if(validation_errors() == "") :
                $txt = "Invalid Request";
                redirect(base_url("dashboard/error"));
            else :
                $txt = strip_tags(validation_errors());
            endif;
            $text = $txt;
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
    }

    public function delete_intern_detail()
    {
        $id = $this->input->post('id');
        $delete = $this->dashboardmodels->deleteInternshipDetail($id);
        if($this->dashboardmodels->getDetailInternById($id)->num_rows() == 0) :
            $text = "Record has been deleted";
            $msg = "Success";
        else :
            $text = "Delete record failed";
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
        if($id == NULL){
            redirect(base_url("dashboard/error"));
        }
    }

    public function images($id)
    {
        $this->data['token'] = $this->token;
        $this->data['token_name'] = $this->token_name;
        $this->data['apps'] = $this->dashboardmodels->AppsById($id)->row();
        $this->data['get_apps_img'] = $this->dashboardmodels->getAppsImageById($id)->result(); 
        if($this->dashboardmodels->AppsById($id)->num_rows() == 0){
            redirect(base_url("dashboard/error"));
        }else{
            return view('dashboard/screencapture', $this->data);
        }
    }

    public function add_image()
    {
        $uploadImg = $this->dashboardmodels->uploadImg("insert", 'apps_img');
        if($uploadImg['result'] == "success") :
            $files = $uploadImg['file']['file_name'];
            $ext = $uploadImg['file']['file_ext'];
            $size = $_FILES['files']['size'];
            $app_img_id = $this->dashboardmodels->getLastId('t_application_img');
            $apps_id = $this->customfunction->post("apps_id");
            if($this->dashboardmodels->AppsById($apps_id)->num_rows() > 0) :
                $data = array(
                    'application_img_id'    => $app_img_id,
                    'application_id'        => $apps_id,
                    'value'                 => $files,
                    'extension'             => $ext,
                    'size'                  => $size,
                    'created_date'          => $this->customfunction->today()
                );
                $this->dashboardmodels->addAppsImage($data);
                $text = "Image has been added";
                $msg = "Success";
            else :
                $text = "Application not found";
                $msg = "Warning";
            endif;
        else :
            $text = $uploadImg['backtrace'];
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
    }

    public function delete_image()
    {
        $id = $this->input->post('id');
        $rows = $this->dashboardmodels->getImagesById($id)->row();
        $unlink = unlink(FCPATH.'assets/img/application_img/'.$rows->value);
        $delete = $this->dashboardmodels->deleteAppsImages($id);
        if($this->dashboardmodels->getImagesById($id)->num_rows() == 0) :
            $text = "Image has been deleted";
            $msg = "Success";
        else :
            $text = "Delete image failed";
            $msg = "Warning";
        endif;
        $callback = array(
            'text'          => $text,
            'msg'           => $msg,
            'token'         => $this->token,
            'token_name'    => $this->token_name
        );
        echo json_encode($callback);
        if($id == NULL){
            redirect(base_url("dashboard/error"));
        }
    }
}
