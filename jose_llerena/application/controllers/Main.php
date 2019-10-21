<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
 public function __construct()
 {
  parent::__construct();
//  if(!$this->session->userdata('id'))
//  {
//   redirect('login');
//  }
 }

 function index()
 {
  echo '<h1 align="center">Welcome User</h1>';
  echo '<h3 align="center">Use search button to look for specific Entries</h3>';
  echo '<h3 align="center">Use search button with no text to retrieve all entries</h3>';
  if($this->session->id) 
  {
    echo '<p align="center"><a href="'.base_url().'main/logout">Logout</a></p>';
  }
  else
  {
    echo '<p align="center"><a href="'.base_url().'Login">Login</a></p>';
  }
  $data['title'] = 'JOSE PAGE - USER ENTRIES';
  $this->load->view('header',$data);
  $this->load->model('Entry_Model', '', TRUE);
  $data['result'] = $this->Entry_Model->queryRecords();
  $this->load->view('userarea',$data);
  $this->load->view('footer');
 }
 public function insertEntry()
{ 
    $entryTitle = $this->input->post('entryTitle');
    $entryVal = $this->input->post('entryVal');
    $this->load->model('Entry_Model', '', TRUE);
    $this->Entry_Model->insertEntry($entryTitle,$entryVal);
}

public function updateEntry()
{ 
    $entryId = $this->input->post('entryId');
    $entryTitle = $this->input->post('entryTitle');
    $entryVal = $this->input->post('entryVal');
    $this->load->model('Entry_Model', '', TRUE);
    $this->Entry_Model->updateEntry($entryId,$entryTitle,$entryVal);
}

public function queryEntry()
{ 
    $queryText = $this->input->post('queryText');
    $this->load->model('Entry_Model', '', TRUE);
    $this->Entry_Model->queryEntry($queryText);
}

public function userPage()
{ 
    $userId = $this->input->post('userId');
    $this->load->model('Entry_Model', '', TRUE);
    $this->Entry_Model->userPage($userId);
}

public function genTweets()
{ 
    $userId = $this->input->post('userId');
    $this->load->model('Entry_Model', '', TRUE);
    $this->Entry_Model->genTweets($userId);
}

public function hideTweet()
{ 
    $tweetId = $this->input->post('tweetId');
    $tweet = $this->input->post('tweet');
    $this->load->model('Entry_Model', '', TRUE);
    $this->Entry_Model->hideTweet($tweetId,$tweet);
}

public function showTweet()
{ 
    $tweetId = $this->input->post('tweetId');
    $this->load->model('Entry_Model', '', TRUE);
    $this->Entry_Model->showTweet($tweetId);
}

function logout()
 {
  $data = $this->session->all_userdata();
  foreach($data as $row => $rows_value)
  {
   $this->session->unset_userdata($row);
  }
  redirect('Main');
 }
}

?>