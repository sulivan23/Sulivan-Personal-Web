<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModels extends CI_Model {

	public function home()
	{
		return $this->db->get("t_home");
	}

	public function configurable($value=FALSE)	
	{	
		if($value){
			$this->db->where("content",$value);
		}
		return $this->db->get("t_configurable");
	}

	public function skills()
	{
		$this->db->order_by("skills_id", "asc");
		return $this->db->get("t_skills");
	}

	public function education()
	{
		$this->db->order_by("start_date", "desc")->select("education_name, DATE_FORMAT(start_date,'%M %Y') as start_year,
		NVL(DATE_FORMAT(finish_date, '%M %Y'),'Present') as finish_year, description,field ")->from("tm_education");
		return $this->db->get();
	}

	public function internship()
	{
		$this->db->order_by("date_time", "desc")->select("DATE_FORMAT(start_date,'%M %Y') as start_year,
		NVL(DATE_FORMAT(finish_date, '%M %Y'),'Present') as finish_year, company, description, internship_position
		,internship_id, date_time");
		return $this->db->get("tm_internship");
	}

	public function internshipDetail()
	{
		return $this->db->get("tr_internship");
	}

	public function experience()
	{
		$this->db->order_by("experience_id", "desc")->select("experience_id, company, DATE_FORMAT(start_date, '%M %Y') as start_year,
		NVL(DATE_FORMAT(finish_date,'%M %Y'), 'Present') as finish_year, job_position, 
		TIMESTAMPDIFF(YEAR, start_date, NVL(finish_date, DATE_FORMAT(now(),'%Y-%m-%d'))) AS year,
		TIMESTAMPDIFF(MONTH, start_date, NVL(finish_date, DATE_FORMAT(now(),'%Y-%m-%d'))) % 12 AS month, description, date_time  ");
		return $this->db->get("tm_experience");
	}

	public function experienceDetail()
	{
		return $this->db->get("tr_experience");
	}

	public function portfolio()
	{
		$this->db->order_by("application_id", "desc");
		return $this->db->get("t_application");
	}
	
}
