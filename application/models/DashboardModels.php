<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModels extends CI_Model {

    public function getUserData($id)
    {
        $query = $this->db->get_where("tm_users", array("user_id" => $id));
        $data = $query->result_array();
        return array(
            'email'             => $data['0']['email'],
            'full_name'         => $data['0']['full_name'],
            "phone_number"      => $data['0']['phone_number'],
            "last_login"        => $data['0']['last_login'],
            "date_registered"   => $data['0']['date_registered']
        );
    }

    public function addConfigurable($data)
    {
        $this->db->insert("t_configurable", $data);
    }

    public function updateConfigurable($id, $data)
    {
        $this->db->where("data_id", $id);
        $this->db->update("t_configurable", $data);
    }

    public function updateApps($id, $data)
    {
        $this->db->where("application_id", $id);
        $this->db->update("t_application", $data);
    }

    public function updateInternship($id, $data)
    {
        $this->db->where("internship_id", $id);
        $this->db->update("tm_internship", $data);
    }

    public function updateDetailInternship($id, $data)
    {
        $this->db->where("detail_internship_id", $id);
        $this->db->update("tr_internship", $data);
    }

    public function deleteConfigurable($id)
    {
        $this->db->where("data_id", $id);
        $this->db->delete("t_configurable");
    }

    public function deleteApps($id)
    {
        $this->db->where("application_id", $id);
        $this->db->delete("t_application");
    }

    public function deleteInternship($id)
    {
        $this->db->where("internship_id", $id);
        $this->db->delete("tm_internship");

        $this->db->where("internship_id", $id);
        $this->db->delete("tr_internship");
    }

    public function deleteInternshipDetail($id)
    {
        $this->db->where("detail_internship_id", $id);
        $this->db->delete("tr_internship");
    }

    public function deleteAppsImages($id)
    {
        $this->db->where("application_img_id", $id);
        $this->db->delete("t_application_img");   
    }

    public function ConfById($id)
    {
        return $this->db->get_where("t_configurable", array("data_id" => $id));
    }

    public function AppsById($id)
    {
        return $this->db->get_where("t_application", array("application_id" => $id));
    }

    public function getInternById($id)
    {
        return $this->db->get_where("tm_internship", array("internship_id" => $id));
    }

    public function getExpById($id)
    {
        return $this->db->get_where("tm_experience", array("experience_id" => $id));
    }

    public function getDetailIntern($id)
    {
        $this->db->where('internship_id', $id);
        return $this->db->get('tr_internship');
    }

    public function getDetailInternById($id)
    {
        $this->db->where('detail_internship_id', $id);
        return $this->db->get('tr_internship');
    }

    public function getAppsImageById($id)
    {
        return $this->db->get_where("t_application_img", array("application_id" => $id));
    }

    public function getImagesById($id)
    {
        return $this->db->get_where("t_application_img", array("application_img_id" => $id));   
    }

    public function addIntern($data)
    {
        $this->db->insert('tm_internship', $data);
    }

    public function addInternDetail($data)
    {
        $this->db->insert('tr_internship', $data);
    }

    public function addApplication($data)
    {
        $this->db->insert("t_application", $data);
    }

    public function addAppsImage($data)
    {
        $this->db->insert("t_application_img", $data);
    }

    public function getLastId($val)
    {
        switch($val)
        {
            case 't_configurable':
                $query = $this->db->select_max('data_id', 'max')->get('t_configurable')->row();
                $max = $query->max;
            break;

            case 't_application':
                $query = $this->db->select_max('application_id', 'max')->get('t_application')->row();
                $max = $query->max;
            break;

            case 'tm_internship':
                $query = $this->db->select_max('internship_id', 'max')->get('tm_internship')->row();
                $max = $query->max;
            break;

            case 't_application_img':
                $query = $this->db->select_max('application_img_id', 'max')->get('t_application_img')->row();
                $max = $query->max;
            break;

            case 'detail_internship_id':
                $query = $this->db->select_max('detail_internship_id', 'max')->get('tr_internship')->row();
                $max = $query->max;
            break;
        }
        return $max == 0 ? 1 : $max + 1;
    }

    public function uploadImg($method, $typeOfImg)
    {
        if($typeOfImg == "portfolio") :
            $config['upload_path'] = './assets/img/portfolio/';
        elseif($typeOfImg == "apps_img") :
            $config['upload_path'] = './assets/img/application_img/';
        endif;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['overwrite'] = TRUE;
        $config['max_size'] = 1024;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if($this->upload->do_upload('files')){
            return array("result" => 'success', "file" => $this->upload->data());
        }else{
            //return array("result" => 'error', "backtrace" => $this->upload->display_errors());
            if($method == "insert"){
                return array("result" => 'error', "backtrace" => $this->upload->display_errors());
            }else{
                return array("result" => 'error', "file" => array("file_name" => ''), "backtrace" => $this->upload->display_errors() );
            }
        }
    }

}