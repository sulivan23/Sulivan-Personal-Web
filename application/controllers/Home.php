<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("HomeModels");
		$this->load->library("customfunction");
	}

	protected function getModels($value)
	{
		switch($value){
			case 'home':
				$models = $this->HomeModels->home()->result();
			break;

			case 'about':
				$models = $this->HomeModels->configurable("about")->result();
			break;

			case 'skills':
				$models = $this->HomeModels->skills()->result();
			break;

			case 'education':
				$models = $this->HomeModels->education()->result();
			break;
			
			case 'internship':
				$models = $this->HomeModels->internship()->result();
			break;

			case 'detail_intern':
				$models = $this->HomeModels->internshipDetail()->result();
			break;

			case 'experience':
				$models = $this->HomeModels->experience()->result();
			break;

			case 'detail_experience':
				$models = $this->HomeModels->experienceDetail()->result();
			break;

			case 'portfolio':
				$models = $this->HomeModels->portfolio()->result();
			break;

			default:
				$models = $this->HomeModels->configurable($value)->row();
			break;
		}
		return $models;
	}

	public function index()
	{
		$data = array(
			"title" 			=> "My Personal Web",
			"my_name" 			=> "Irvan Sulistio",
			"home" 				=> $this->getModels("home"),
			"about" 			=> $this->getModels("about"),
			"job" 				=> $this->getModels("job"),
			"desc"				=> $this->getModels("describe"),
			"little_desc"		=> $this->getModels("Little Description"),
			'skills'			=> $this->getModels("skills"),
			'education'			=> $this->getModels("education"),
			"internship"		=> $this->getModels("internship"),
			"detail_intern"		=> $this->getModels("detail_intern"),
			"experience"		=> $this->getModels("experience"),
			"detail_experience"	=> $this->getModels("detail_experience"),
			"location"			=> $this->getModels("Location"),
			"email"				=> $this->getModels("Email"),
			"phone"				=> $this->getModels("Phone"),
			"photo_about"		=> $this->getModels("Photo Default"),
			"portfolio"			=> $this->getModels("portfolio"),
			"token"				=> $this->security->get_csrf_hash(),
			"token_name"		=> $this->security->get_csrf_token_name()
		);
		return view('indexprofile', $data);
	}

	public function sendMail()
	{
		$token_name = $this->security->get_csrf_token_name();
		$token = $this->security->get_csrf_hash();
		$this->form_validation->set_rules("name",'Your name', "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("subject", "Subject", "required|min_length[5]");
		$this->form_validation->set_rules("message", "Message", "required|min_length[5]");
		if($this->form_validation->run() == FALSE){
			$text = strip_tags(validation_errors());
			$msg = "Warning";
		}else{
			$name = $this->input->post("name");
			$email = $this->input->post("email");
			$subject = $this->input->post("subject");
			$message = $this->input->post("message");
			$mail = new PHPMailer;
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPOptions = array(
				'ssl' => array (
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			//$mail->SMTPDebug=0;
			$mail->Host = 'webmail.irvansulistio.com'; //SMTP server
			$mail->Port = 587; //smtp port
			$mail->SMTPAuth = true;
			$mail->isHTML(true);
			$mail->SMTPSecure = 'tls';
			$mail->Username = "mail@irvansulistio.com";
			$mail->Password = "281108dety";
			$mail->From = "mail@irvansulistio.com"; //sender's gmail address
			$mail->FromName = $name;
			$mail->AddAddress("mail@irvansulistio.com");//receiver's e-mail address
			$mail->AddCC($email);
			$mail->Subject = $subject;//e-mail subject
			$mail->Body = $message;//e-mail message
			if(!$mail->Send()){
				$text = $mail->ErrorInfo;
				$msg = "Warning";
			}else{
				$text = "Email has been sent.";
				$msg = "Success";
			}
		}
		$callback = array(
			"text"	=> $text,
			"msg"	=> $msg,
			"token"	=> $token,
			"token_name"=> $token_name
		);
		echo json_encode($callback);
	}

	public function portfolio_details($id)
	{
		$data = array(
			"title" 			=> "Portfolio Details",
			"my_name" 			=> "Irvan Sulistio",
		);
		$this->load->view("my_sidebar", $data);
		$this->load->view("portfolio_details", $data);
	}
}
