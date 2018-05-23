<?php
if(isset($_GET['company'])){
    $company = $_GET['company'];
}else{
    echo"company 없음";
}
$client_id="ZMxNErIkZJyzyMEcDdKB";
$client_secret="e6QCET2MLN";

$query=urlencode($company);
$display="5";
$start="1";
$is_post = true;
$output="xml" ;//json,xml

$url="https://openapi.naver.com/v1/search/local.json";
$qry_str = "?&query=".$query."&start=".$start."&display".$display;
$headers = array("X-Naver-Client-Id: ".$client_id, "X-Naver-Client-Secret: ".$client_secret); //ClientID, SECRET

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url.$qry_str);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_GET, $is_post);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$data = curl_exec ($ch);
curl_close ($ch);

//foreach($object->channel->item as $data){
//echo $data->title;
//}
$data = explode("[",$data);
$data = $data[1];
$data = explode("},",$data);
$data = $data[0];
$data = "[".$data."}]";

echo $data;
?>