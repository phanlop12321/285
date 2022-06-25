<?php

session_start();

if (!$_SESSION["UserID"]) {  //check session

  Header("Location: formlogin.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else {
 
$dayTH = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
$monthTH = [null,'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
$monthTH_brev = [null,'ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];


function thai_date_fullmonth($time){   // 19 ธันวาคม 2556
    global $dayTH,$monthTH;   
    $thai_date_return = date("j",$time);   
    $thai_date_return.=" ".$monthTH[date("n",$time)];   
    $thai_date_return.= " ".(date("Y",$time)+543);   
    return $thai_date_return;   
} 


function Convert($amount_number)
{
  $amount_number = number_format($amount_number, 2, ".", "");
  $pt = strpos($amount_number, ".");
  $number = $fraction = "";
  if ($pt === false)
    $number = $amount_number;
  else {
    $number = substr($amount_number, 0, $pt);
    $fraction = substr($amount_number, $pt + 1);
  }

  $ret = "";
  $baht = ReadNumber($number);
  if ($baht != "")
    $ret .= $baht . "บาท";

  $satang = ReadNumber($fraction);
  if ($satang != "")
    $ret .=  $satang . "สตางค์";
  else
    $ret .= "ถ้วน";
  return $ret;
}

function ReadNumber($number)
{
  $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
  $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
  $number = $number + 0;
  $ret = "";
  if ($number == 0) return $ret;
  if ($number > 1000000) {
    $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
    $number = intval(fmod($number, 1000000));
  }

  $divider = 100000;
  $pos = 0;
  while ($number > 0) {
    $d = intval($number / $divider);
    $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : ((($divider == 10) && ($d == 1)) ? "" : ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
    $ret .= ($d ? $position_call[$pos] : "");
    $number = $number % $divider;
    $divider = $divider / 10;
    $pos++;
  }
  return $ret;
}
include('connection.php');

/*$num1 = '3500'; 
$num2 = '120000.50'; 
echo  Convert($num1),"<br>"; 
echo  $num2  . "&nbsp;=&nbsp;" .Convert($num2),"<br>"; 
*/


$i = 1;
$price = 0;
$vat = 0;
$price_abd_vat = 0;



$User = $_SESSION["User"];
//$id = $_SESSION["ID"];
$id = $_GET["create"];

$sql3 = "SELECT * FROM data285 WHERE  id = $id AND ( user = '$User' )";
$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc();

$ID_employee = $row3["Employee"];
$ID_vdlist = $row3["Vender_List"];

$sql = "SELECT * FROM end_data WHERE ID_User = $id AND ( User = '$User' )";
$result = $conn->query($sql);

$sql1 = "SELECT * FROM employee WHERE ID=$ID_employee";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();

$sql2 = "SELECT * FROM vender WHERE vdlist=$ID_vdlist";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();



require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
  'fontDir' => array_merge($fontDirs, [
    'default_font_size' => 16,
    __DIR__ . 'tmp',
  ]),
  'fontdata' => $fontData + [
    'sarabun' => [
      'R' => 'THSarabunNew.ttf',
      'I' => 'THSarabunNew.ttf',
      'B' => 'THSarabunNew Bold.ttf',
      'BI' => 'THSarabunNew BoldItalic.ttf',
    ]
  ],
  'default_font' => 'sarabun'
]);
ob_start();
$mpdf->defaultheaderline = 0;
$mpdf->SetHeader('||หน้าที่ {PAGENO}');


?>
<!doctype html>
<html lang="en">

<head>
  <style type="text/css">

  </style>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Sarabun', sans-serif;
    }
  </style>

</head>


<body style="font-size:16pt; line-height: normal; padding: 0em;" }>
  <img src="img/pea.jpg" width="120" height="120">
  <p style=" position: absolute; top: 49mm; left: 100mm; width: auto;">ถึง&nbsp;&nbsp;&nbsp;ผจก.<?= $row1["pea"]; ?><br>วันที่&nbsp;</p>
  <p>จาก&nbsp;&nbsp;&nbsp;<?= $row1["Rank"]; ?>&nbsp;<?= $row1["Under"]; ?>.<?= $row1["pea"]; ?>
    <br>เลขที่&nbsp;&nbsp;&nbsp;<?= $row1["county"]; ?>&nbsp;<?= $row1["pea"]; ?>(&nbsp;&nbsp;&nbsp;)
    <br>เรื่อง&nbsp;&nbsp;&nbsp;รายงานขอจ้าง
    <br>เรียน&nbsp;&nbsp;&nbsp;ผจก.<?= $row1["pea"]; ?>
    <?php

    if ($row1["Under"] == $row1["pea"]) {
      echo ' ';
    } else {
      echo 'ผ่าน หผ.';
      echo $row1["Under"];
    }
    echo ".";
    echo $row1["pea"];
    ?>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วย&nbsp;<?= $row1["Under"]; ?>.<?= $row1["pea"]; ?>&nbsp;มีความประสงค์จ้างเหมาเอกชน&nbsp;(เฉพาะค่าเเรงงาน)&nbsp;ช่วยงานก่อสร้างขยายเขตระบบจำหน่ายไฟฟ้า
    <?= $row3["Type_Budget"]; ?>&nbsp;ปี&nbsp;<?= $row3["year"]; ?>&nbsp;ซึ่งมีรายละเอียดดังต่อไปนี้
    <br><span style="font-size: 16pt; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.&nbsp;เหตุผลความจำเป็นที่ต้องขอจ้าง</span>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.1&nbsp;ตามอนุมัติงานก่อสร้างเลขที่&nbsp;<?= $row3["Construct"]; ?>&nbsp;&nbsp;ลว. <?php  echo thai_date_fullmonth(strtotime($row3["Construct_Date"]));?> 
    <br>ให้ดำเนินการก่อสร้างงานขยายเขตระบบจำหน่ายไฟฟ้า&nbsp;บริเวณ&nbsp;<?= $row3["Address"]; ?>&nbsp;อนุมัติประมาณการเลขที่&nbsp;<?= $row3["Estimate"]; ?>&nbsp;&nbsp;ลว. <?php  echo thai_date_fullmonth(strtotime($row3["Estimate_Date"]));?>
    <br>WBS.&nbsp;<?= $row3["id"]; ?>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.2&nbsp;เนื่องจาก&nbsp;<?= $row1["Under"]; ?>.<?= $row1["pea"]; ?>&nbsp;มีบุคลากรและยานพาหนะไม่เพียงพอในการก่อสร้างงานขยายเขต&nbsp;<?= $row3["Type_Budget"]; ?>&nbsp;ปี&nbsp;<?= $row3["year"]; ?>
    <br>และเพื่อให้การดำเนินงานแล้วเสร็จตามวัตถุประสงค์ของลูกค้า&nbsp;และรองรับนโยบายโครงการ&nbsp;อย่างมีประสิทธิภาพ
    <br><span style="font-size: 16pt; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;รายละเอียดของพัสดุที่จ้าง</span>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายการพัสดุที่จะจ้าง&nbsp;(&nbsp;ตามเอกสารแนบ&nbsp;2&nbsp;)
    <br><span style="font-size: 16pt; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;ราคากลางของงานที่จะจ้าง</span>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามบันทึกกำหนดราคากลางในการจ้างเหมาก่อสร้างปรับปรุงระบบไฟฟ้า&nbsp;กรณีงานจ้างเหมาเฉพาะค่าแรง
    <br>ตามอนุมัติที่&nbsp;<?= $row3["id"]; ?>&nbsp;(&nbsp;ตามเอกสารแนบ&nbsp;2&nbsp;)&nbsp;มีรายละเอียดดังต่อไปนี้
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.1&nbsp;หมายเลขงาน&nbsp;<?= $row3["id"]; ?>&nbsp;โครงข่าย&nbsp;<?= $row3["id"]; ?>&nbsp;กิจกรรม&nbsp;<?= $row3["id"]; ?>
  </p>


  <table style="border-collapse: collapse;">


    <tr style="border: 1px solid black;">
      <th style="border: 1px solid black; width:5%; text-align: center;" width="5px" rowspan="2">ที่</th>
      <th style="border: 1px solid black; text-align: center;"  rowspan="2">แผนก</th>
      <th style="border: 1px solid black; text-align: center;"  rowspan="2">รายละเอียด</th>
      <th style="border: 1px solid black; text-align: center;" width="5px" rowspan="2">จำนวน</th>
      <th style="border: 1px solid black; text-align: center; "  width="5px" rowspan="2">ราคาต่อหน่วย ไม่รวมภาษี</th>
      <th style="text-align: center;" colspan="3">รวมราคาที่ตกลงจ้าง(บาท)</th>


    </tr>

    <tr style="border: 1px solid black;">


      <td style="border: 1px solid black;" width="5px">ราคาตกลงจ้าง</td>
      <td style="border: 1px solid black;" width="5px">ภาษีฯ 7 %</td>
      <td style="border: 1px solid black;" width="5px">ราคารวมทั้งสิ้น</td>

    </tr>
    <?php


    // output data of each row
    while ($row = $result->fetch_assoc()) {

    ?>
      <tr style="border: 1px solid black;">
        <td style="border: 1px solid black; text-align: center;"><?= $i ?></td>
        <td style="border: 1px solid black;"><?= $row["job"]; ?></td>
        <td style="border: 1px solid black;"><?= $row["name"]; ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $row["quantity"]; ?></td>
        <td style="border: 1px solid black; text-align: right; "><?= "";
                                                                  echo number_format($row["price"], 2); ?></td>
        <td style="border: 1px solid black; text-align: right; "><?= "";
                                                                  echo number_format($row["price_no_v"], 2); ?></td>
        <td style="border: 1px solid black; text-align: right; "><?= "";
                                                                  echo number_format($row["vat"], 2); ?></td>
        <td style="border: 1px solid black; text-align: right; "><?= "";
                                                                  echo number_format($row["price_and_v"], 2); ?></td>

      </tr>
    <?php
      $i = $i + 1;
      $price = $price + $row["price_no_v"];
      $vat = $vat + $row["vat"];
      $price_abd_vat = $price_abd_vat + $row["price_and_v"];
    }


    ?>
    <tr style="border: 1px solid black; ">
      <td></td>
      <td></td>
      <td>ราคารวม (บาท)</td>
      <td></td>
      <td></td>
      <td style="border: 1px solid black; text-align: right; ">
        <?= "";
        echo number_format($price, 2); ?>
      </td>
      <td style="border: 1px solid black; text-align: right; ">
        <?= "";

        echo number_format($vat, 2); ?>
      </td>
      <td style="border: 1px solid black; text-align: right; ">
        <?= "";
        echo number_format($price_abd_vat, 2); ?>
      </td>
    </tr>

    <tr style="border: 1px solid black;  ">
      <td></td>
      <td></td>
      <td>ราคารวมทั้งสิ้น (บาท)</td>
      <td></td>
      <td></td>
      <td style="border: 1px solid black; text-align: right; ">
        <?= "";
        echo number_format($price, 2); ?>
      </td>
      <td style="border: 1px solid black; text-align: right; ">
        <?= "";
        echo number_format($vat, 2);
        ?>
      </td>
      <td style="border: 1px solid black; text-align: right; ">
        <?= "";
        echo number_format($price_abd_vat, 2); ?>
      </td>
    </tr>


  </table>

  <p><br><span style="font-size: 16pt; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.&nbsp;วงเงินที่จะจ้าง</span>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เงินงบประมาณเบิกจากงบลงทุนของ<?= $row3["id"]; ?>จากค่าเเรงในงานก่อสร้างขยายเขตระบบจำหน่ายไฟฟ้า
    <br>บริเวณ&nbsp;<?= $row2["address"]; ?>
    <br>งบประมาณ&nbsp;<?= "";
                      echo number_format($price, 2); ?>&nbsp;บาท&nbsp;ภาษีมูลค่าเพิ่ม&nbsp;<?= "";
                                                                                                  echo number_format($vat, 2); ?>&nbsp;บาท&nbsp;วงเงินรวมภาษีมูลค่าเพิ่ม&nbsp;<?= "";
                                                                                                                                                                                    echo number_format($price_abd_vat, 2); ?>&nbsp;บาท
    <br>(&nbsp;<?= Convert($price_abd_vat); ?>&nbsp;)
    <br><span style="font-size: 16pt; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;กำหนดเวลาที่ต้องการใช้พัสดุ</span>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กำหนดส่งมอบงานแล้วเสร็จ........นับจากวันลงนามในศัญญา
    <br><span style="font-size: 16pt; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.&nbsp;วิธีที่จะจ้างและเหตุผลที่จะต้องจ้างวิธีนั้น</span>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.1&nbsp;พิจารณาเห็นสมควรดำเนินการจัดจ้างโดยวิธีเฉพาะเจาะจง&nbsp;ตามพระราชบัญญัติการจัดซื้อจัดจ้างและ
    <br>การบริหารพัสดุภาครัฐ&nbsp;พ.ศ.2560&nbsp;ตามมาตรา&nbsp;56(2)&nbsp;(ข)&nbsp;เนื่องจากการจัดจ้างครั้งนี้มีราคาไม่เกิน&nbsp;500,000.-บาท&nbsp;และดำเนินการตามระเบียบกระทรวงการคลังว่าด้วยการจัดซื้อจัดจ้าง&nbsp;และการบริหารพัสดุภาครัฐ&nbsp;พ.ศ.2560&nbsp;ข้อ&nbsp;79
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.2&nbsp;พิจารณาเห็นสมควรดำเนินการจัดจ้าง&nbsp;ตามกฏกระทรวง&nbsp;กำหนดพัสดุและวิธีการจัดซื้อจัดจ้างพัสดุที่รัฐ
    <br>ต้องการส่งเสริมหรือสนับสนุน&nbsp;(&nbsp;ฉบับที่&nbsp;2&nbsp;)&nbsp;พ.ศ.&nbsp;2563&nbsp;ข้อ&nbsp;7&nbsp;(2)&nbsp;(ก)&nbsp;และ&nbsp;หมวด&nbsp;7/1&nbsp;พัสดุส่งเสริมการผลิตภายในประเทศ
    <br>ข้อ&nbsp;27/3&nbsp;(3)&nbsp;การจัดจ้างที่มิใช่คนก่อสร้าง
    <br><span style="font-size: 16pt; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7.&nbsp;หลักเกณฑ์การพิจารณาคัดเลือกขอเสนอ</span>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;
    <?php

    $c = $row3["id"];
    if ($c == 1) {
      echo '/';
    }
    ?>&nbsp;)&nbsp;พิจารณาจาราคารวม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;
    <?php

    if ($c == 2) {
      echo '/';
    }
    ?>&nbsp;)&nbsp;พิจารณาจากราค่าต่อรายการ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;
    <?php

    if ($c == 3) {
      echo '/';
    }
    ?>&nbsp;)&nbsp;พิจารณาจากราค่าต่อหน่วย
    <br><span style="font-size: 16pt; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.&nbsp;ข้อเสนออื่นๆ</span>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.1&nbsp;เห็นควรให้เจ้าหน้าที่พัสดุ&nbsp;โดย&nbsp;<?= $row1["Fname"]; ?>&nbsp;<?= $row1["Lname"]; ?>&nbsp;ตำแหน่ง&nbsp;<?= $row1["Rank"];?>&nbsp;<?= $row1["Under"]; ?>.<?= $row1["pea"]; ?>
    <br>เป็นผู้ติดต่อตกลงกับผู้รับจ้างโดยตรง
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.2&nbsp;แต่งตั้งคณะกรรมการกำหนดราคากลางในการจ้างเหมาก่อสร้างระบบไฟฟ้า
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.2.1&nbsp;<?= $row3["FName_Chairman_Center_Price"]; ?>&nbsp;<?= $row3["Lname_Chairman_Center_Price"]; ?>&nbsp;&nbsp;<?= $row3["Rank_C_C"]; ?> ประธานกรรมการ
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.2.2&nbsp;<?= $row3["FName_Director_1"]; ?>&nbsp;<?= $row3["LName_Director_1"]; ?>&nbsp;&nbsp;<?= $row3["Rank_D_C1"]; ?> กรรมการ
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.2.3&nbsp;<?= $row3["FName_Director_2"]; ?>&nbsp;<?= $row3["LName_Director_2"]; ?>&nbsp;&nbsp;<?= $row3["Rank_D_C2"]; ?> กรรมการ
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.3&nbsp;แต่งตั้งคณะกรรมกาตรวจรับพัสดุ/ผู้ตรวจรับพัสดุ
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.3.1&nbsp;<?= $row3["FName_Chairman_Check"]; ?>&nbsp;<?= $row3["LName_Chairman_Check"]; ?>&nbsp;&nbsp;<?= $row3["Rank_C_Check"]; ?>  ประธานกรรมการ
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.3.2&nbsp;<?= $row3["FName_Director_Check1"]; ?>&nbsp;<?= $row3["LName_Director_Check1"]; ?>&nbsp;&nbsp;<?= $row3["Rank_D_Check1"]; ?> กรรมการ
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.3.3&nbsp;<?= $row3["FName_Director_Check2"]; ?>&nbsp;<?= $row3["LName_Director_Check2"]; ?>&nbsp;&nbsp;<?= $row3["Rank_D_Check2"]; ?> กรรมการ
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพิื่อโปรดพิจารณา&nbsp;หากเห็นชอบขอได้โปรดอนุมัติให้ดำเนินการจัดซื้อโดยวิธีเฉพาะเจาะจง
    <br>ตามมาตรา&nbsp;52(2)&nbsp;(ข)&nbsp;ตามรายละเอียดในรายงานขอจ้างดังกล่าวข้างต้น
  </p>
  <table>
    <tbody>



      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td style=" text-align: right; ">ลงชื่อ</td>
        <td>__________________________</td>
        <td></td>
        <td>&nbsp;&nbsp;&nbsp;เจ้าหน้าที่</td>
      </tr>


      <tr>
        <td></td>
        <td style=" text-align: right; ">(</td>
        <td style=" text-align: center;"><?= $row1["Fname"]; ?>&nbsp;<?= $row1["Lname"]; ?></td>
        <td>)</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td style=" text-align: right; ">ตำแหน่ง</td>
        <td style=" text-align: center;"><?= $row1["Rank"]; ?>&nbsp;<?= $row1["Under"]; ?></td>
        <td></td>
        <td></td>
      </tr>



    </tbody>

  </table>
  <br><br>

  <div style="border: 1px solid black; width: 300px;">
    <table>
      <tbody>
        <tr>
          <td style="text-align: center; " colspan="3">เห็นชอบและอนุมัติตามเสนอ</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style=" text-align: right; ">ลงชื่อ</td>
          <td>_______________________________</td>
          <td></td>
        </tr>
        <tr>
          <td style=" text-align: right; ">(</td>
          <td>_______________________________</td>
          <td style=" text-align: left; ">)</td>
          <td></td>
        </tr>
        <tr>
          <td style=" text-align: right; ">ตำแหน่ง</td>
          <td>_______________________________</td>
          <td></td>
        </tr>
        <tr>
          <td style=" text-align: right; ">วันที่</td>
          <td>_______________________________</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="position: absolute; top: auto; left: 97mm; width: auto; font-size: 12px;">
  หมายเหตุ<br>
  -หนังสือรายงานขอซื้อใช้สำหรับวิธีเฉพาะเจาะจง ที่มีวงเงินงบประมาณจัดซื้อแต่หละครั้งไม่เกิน 100,000.-บาท(รวมภาษีมูลค่าเพิ่ม)
  </div>




  <?php
  $html = ob_get_contents();
  $mpdf->WriteHTML($html);
  $mpdf->output("MyreportB.pdf");
  ob_end_flush();

  ?>
  <a href="MyreportB.pdf">Download</a>
  <script type='text/javascript'>
            window.location.href = "MyreportB.pdf";
</script>
  

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>

<?php } ?>