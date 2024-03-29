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

$sql4 = "SELECT * FROM end_data WHERE ID_User = $id AND ( User = '$User' )";
$result4 = $conn->query($sql4);




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

<body style="font-size:16pt">
  <img src="img/pea.jpg" width="150" height="150">
  <p>จาก&nbsp;&nbsp;&nbsp;<?= $row1["Rank"]; ?>&nbsp;<?= $row1["Under"]; ?>.<?= $row1["pea"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;ผจก.<?= $row1["pea"]; ?>
    <br>เลขที่&nbsp;&nbsp;&nbsp;<?= $row1["county"]; ?>&nbsp;<?= $row1["pea"]; ?>(&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่&nbsp;&nbsp;&nbsp;....
    <br>เรื่อง&nbsp;&nbsp;&nbsp;รายงานผลการพิจารณาและขออนุมัติสั่งจ้าง
    <br>เรียน&nbsp;&nbsp;&nbsp;ผจก.<?= $row1["pea"]; ?>
    <?php

if ($row1["Under"] == $row1["pea"]) {
  echo ' ';
} else {
  echo 'ผ่าน หผ.';
  echo $row1["Under"];
}
echo".";
echo $row1["pea"];
$monney = 0;
while ($row4 = $result4->fetch_assoc()) {
  $row4["price"] = floor(($row4["price"]*$row3["PERCENT"])/100);

  $monney = ($row4["price"]*$row4["quantity"])+$monney;

}
?>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ได้ดำเนินการจัดจ้างเหมาเอกชน (เฉพาะค่าแรงงาน) ช่วยก่อสร้างขยายเขตระบบจำหน่ายไฟฟ้างบผู้ใช้ไฟ ปี&nbsp;<?= $row3["year"]; ?> บริเวณ&nbsp;<?= $row3["Address"]; ?>&nbsp;โดยวิธีเฉพาะเจาะจง ตามอนุมัติที่<?= $row1["county"]; ?>&nbsp;<?= $row1["pea"]; ?>(&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลว.
    <br>ขอรายงานผลการพิจารณาขอจ้าง ดังนี้
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. สืบราคาด้วยวาจา จากผู้รับจ้าง จำนวน 1 ราย
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.1 <?= $row2["fname"]; ?>&nbsp;&nbsp;<?= $row2["lname"]; ?>&nbsp; เสนอราคาตามเอกสารแนบ ดังนี้
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนเงิน <?php echo number_format($monney,2); ?> บาท (ราคารวมภาษีมูลค่าเพิ่ม)
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. ผู้เสนอราคา <?= $row2["fname"]; ?>&nbsp;&nbsp;<?= $row2["lname"]; ?> เนื่องจาก มีผู้เสนอราคาเพียงรายเดียว และได้ลงทะเบียนเป็นผู้ประกอบการวิสหกิจขนาดกลางและขนาดย่อม (SME) ตามหนังสือรับรองการขึ้นทะเบียนสมาชิก SME เลขที่ <?= $row2["sme"]; ?>&nbsp;&nbsp;ลว. <?php  echo thai_date_fullmonth(strtotime($row2["smedate"]));?>&nbsp;ซึ่งมีคุณสมบัติถูกต้องตามหลักเกณ์ที่ กฟภ.ระบุ ดังนี้
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.1 หมายเลขงาน C-65-B-UTDCS.006.02.2(SL-C-I)โครงข่าย 8004014549 กิจกรรม 0030
  </p>

  <table style="border-collapse: collapse;">


    <tr style="border: 1px solid black;">
      <th style="border: 1px solid black; width:5%; text-align: center;" width="5px" rowspan="2">ที่</th>
      <th style="border: 1px solid black; text-align: center;" rowspan="2">แผนก</th>
      <th style="border: 1px solid black; text-align: center;" rowspan="2">รายละเอียด</th>
      <th style="border: 1px solid black; width:9%; text-align: center;" width="5px" rowspan="2">จำนวน</th>
      <th style="border: 1px solid black; text-align: center;" width="5px" rowspan="2">ราคาต่อหน่วย ไม่รวมภาษี</th>
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

      $row["price"] = floor(($row["price"]*$row3["PERCENT"])/100);

    ?>
      <tr style="border: 1px solid black;">
        <td style="border: 1px solid black; text-align: center;"><?= $i ?></td>
        <td style="border: 1px solid black;"><?= $row["job"]; ?></td>
        <td style="border: 1px solid black;"><?= $row["name"]; ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $row["quantity"]; ?></td>
        <td style="border: 1px solid black; text-align: right; "><?php echo number_format($row["price"],2); ?> </td>
        <td style="border: 1px solid black; text-align: right; "><?php echo number_format($row["price"]*$row["quantity"],2);?></td>
        <td style="border: 1px solid black; text-align: right; ">-</td>
        <td style="border: 1px solid black; text-align: right; "><?php echo number_format($row["price"]*$row["quantity"],2);?></td>

      </tr>
    <?php
      $i = $i + 1;
      $price = $price + ($row["price"]*$row["quantity"]);
      $price_abd_vat = $price_abd_vat + $row["price_and_v"];
      
    }

    $percent = number_format($price/$price_abd_vat*100,2);


    ?>
    <tr style="border: 1px solid black; ">
      <td></td>
      <td></td>
      <td>ราคารวม (บาท)</td>
      <td></td>
      <td></td>
      <td style="border: 1px solid black; text-align: right; ">
        <?php echo number_format($price,2); ?>
      </td>
      <td style="border: 1px solid black; text-align: right; ">
        -
      </td>
      <td style="border: 1px solid black; text-align: right; ">
        <?php echo number_format($price,2); ?>
      </td>
    </tr>
    <tr style="border: 1px solid black;  ">
      <td></td>
      <td></td>
      <td>ราคารวมทั้งสิ้น (บาท)</td>
      <td></td>
      <td></td>
      <td style="border: 1px solid black; text-align: right; ">
        <?php echo number_format($price,2); ?>
      </td>
      <td style="border: 1px solid black; text-align: right; ">
        -
      </td>
      <td style="border: 1px solid black; text-align: right; ">
        <?php echo number_format($price,2); ?>
      </td>
    </tr>

  </table>

  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;พิจารณาแล้ว เห็นควรจัดจ้าง จากผู้เสนอราคาดังกล่าว เป็นจำนวนเงิน <?php echo number_format($price,2); ?> บาท ภาษีมูลค่าเพิ่ม 0 บาท ราคาไม่รวมภาษีมูลค่าเพิ่ม <?php echo number_format($price,2); ?> บาท คิดเป็นเปอร์เซ็นต์การจ้าง <?= $percent; ?> % ของราคากลางและต่ำกว่าราคากลาง <?= 100-$percent; ?>&nbsp;%
    ต่ำกว่าราคากลางรวมไม่ภาษีมูลค่าเพิ่ม เป็นเงิน .....บาท (.....-.....)และต่ำกว่าวงเงิน งบประมาณค่าเเรง ไม่รวมภาษีมูลค่าเพิ่ม เป็นเงิน .........บาท (.....-......)
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นชอบขอได้โปรดอนุมัติจัดจ้าง จากผู้เสนอราคาดังกล่าว
  </p>
  <table>
    <tbody>
      <tr>
        <td style="text-align: center; " colspan="3">เห็นชอบและอนุมัติตามเสนอ</td>

      </tr>


      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td style=" text-align: right; ">ลงชื่อ</td>
        <td>_______________________________</td>
        <td>เจ้าหน้าที่</td>
      </tr>


      <tr>
        <td style=" text-align: right; ">ลงชื่อ</td>
        <td>_______________________________</td>
        <td></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td style=" text-align: right; ">(</td>
        <td>_______________________________</td>
        <td>)</td>
      </tr>



      <tr>
        <td style=" text-align: right; ">(</td>
        <td>_______________________________</td>
        <td style=" text-align: left; ">)</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td style=" text-align: right; ">ตำแหน่ง</td>
        <td>_______________________________</td>
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
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <th style=" text-align: right; font-size: 12px; ">หมายเหตุ</th>
        <td style=" font-size: 12px;" colspan="3">-หนังสือรายงานขอซื้อใช้สำหรับวิธีเฉพาะเจาะจง ที่มีวงเงินงบประมาณจัดซื้อแต่หละครั้งไม่เกิน 100,000.-บาท(รวมภาษีมูลค่าเพิ่ม)</td>
        <td></td>
      </tr>
    </tbody>

  </table>
  <?php
  $html = ob_get_contents();
  $mpdf->WriteHTML($html);
  $mpdf->output("Myreport.pdf");
  ob_end_flush();
  ?>
  <a href="Myreport.pdf">Download</a>

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