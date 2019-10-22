<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
 private $valDirAccess = 0;
 function index()
 {
  echo '<h1 align="center">Welcome User</h1>';
  echo '<h3 align="center">This is the page for testing different kind of entries</h3>';
  $this->load->library('unit_test');
  $this->valDirAccess = 1;
  $this->testEntry();
 }

public function testEntry()
    {
        if ($this->valDirAccess == 0) 
        {
            echo "No direct access";
            return false;
        }
        echo date("Y-m-d h:i:sa");
        $this->load->model('Test_model', '', TRUE);
        $this->testValues("test 1","this is test number 1",0);
        $this->testValues("'''''test 1'''''","this is test number 1@@@@!\"#$%&/(=?¡¿}+{-.,;:_|¬|@·~½¬{[]}\\",'0');
        $this->testValues("test 123456789012345678901234567890","this is test number 1",'lo');
        $this->testValues(0,0,0);
        $this->testValues("Y-m-d h:i:sa","Y-m-d h:i:sa","Y-m-d h:i:sa");
    }
public function testValues($title,$entry,$userId)
    {
        
        $data = array(
            'title'  => $title,
            'entry'  => $entry,
            'entry_date' => date("Y-m-d h:i:sa"),
            'user_id' => $userId
        );
        $testName = "Insert Entries Test";
        $test = $this->Test_model->testEntry($data);
        $expectedResult = $this->Test_model->lastId();
        $result = $this->unit->run($test, $expectedResult, $testName);
        echo $result;
        $this->Test_model->deleteId($expectedResult);
    }

}

?>