<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];

}else{
    echo"id 안받아짐";
}

require($_SERVER['DOCUMENT_ROOT'].'/job//snoopy/snoopy/Snoopy.class.php');

//스누피를 생성
$snoopy = new Snoopy;

//스누피의 fetch함수로 ID값 긁기
$snoopy->fetch('http://www.saramin.co.kr/zf_user/jobs/view?rec_idx='.$id);
 
preg_match('/<div class="comp_tool">(.*?)<\/div>/is',$snoopy->results, $text);
 //페이지의 ID를 토대로 진짜 데이터가 있는 ID값을 받아옴
$dom = new DOMDocument;
$dom->loadHTML($text[0]);
foreach ($dom->getElementsByTagName('a') as $node) {
    $real_id = $node->getAttribute( 'href' );
}
$real_id = explode("/",$real_id);
$real_id = $real_id[5];

//진짜 데이터가 있는 ID를 토대로 다시 크롤링
$snoopy->fetch('http://www.saramin.co.kr/zf_user/recruit/company-info-view?idx='.$real_id);

preg_match('/<div class="table_col_type1">(.*?)<\/div>/is',$snoopy->results, $text1);
$text1 = explode('<a href="#none" class="ico_wrap">',$text1[0]);
$text1 = explode('<caption>',$text1[0]);
$text2 = explode('</caption>',$text1[1]);

echo $text1[0].$text2[1];
?>
