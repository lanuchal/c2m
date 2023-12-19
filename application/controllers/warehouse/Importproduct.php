<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Importproduct extends MY_Controller {


 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('warehouse/importproduct_model');

     if(!isset($_SESSION['owner_id'])){
            header( "location: ".$this->base_url );
        }
        
    }

	public function index()
	{
		

$data['tab'] = 'importproduct';
$data['title'] = 'Import Product';
		$this->warehouselayout('warehouse/importproduct',$data);
}



 function Add()
    {
 
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}		

$header_code = time();

for($i=1;$i<=count($data['productimportlist']) ;$i++){


$data['importproduct_header_code'] = $header_code;
$data['importproduct_header_date'] = $header_code;

	if($data['productimportlist'][$i-1]['product_id']!='' && $data['productimportlist'][$i-1]['importproduct_detail_num']!='0'){
$data['productimportlist'][$i-1]['importproduct_header_code'] = $header_code;
$data['productimportlist'][$i-1]['importproduct_detail_date'] = $header_code;
	
if($this->importproduct_model->Adddetail($data['productimportlist'][$i-1])){
$this->importproduct_model->Updateproductimportstock($data['productimportlist'][$i-1]);
}




if($i==1){
$this->importproduct_model->Addheader($data);

}

}

}

  
}



function Get()
    {

$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
} 

echo  $this->importproduct_model->Get($data);
        
	}



    function Getimportone()
    {
 
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}       

echo  $this->importproduct_model->Getimportone($data);
      
}



  function Deleteimportlist()
    {
 
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}       


$resault =  $this->importproduct_model->Getimportone2($data);


foreach ($resault as $row)
{

 $data2['product_id'] = $row->product_id;
 $data2['detailpricebase'] = $row->importproduct_detail_pricebase;
  $data2['detailnum'] =   $row->importproduct_detail_num;

$this->importproduct_model->Updateproductdeletestock($data2);


    }

$this->importproduct_model->Deleteimportlist($data);
      
}



function Findproduct()
    {

$data = json_decode(file_get_contents("php://input"),true);
echo  $this->importproduct_model->Findproduct($data);
        
    }

    





	}

