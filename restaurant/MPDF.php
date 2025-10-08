<?php 
require_once __DIR__ . '/vendor/autoload.php';  // โหลด mPDF
include '../db.php';

$id = $_GET['id']; ; 
$stmt = $conn->prepare('SELECT * FROM `order` WHERE id = ?');
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare('SELECT order_item.*,product.name as pro_name FROM order_item LEFT JOIN product ON order_item.pro_id = product.id  WHERE order_item.order_id = ?');
$stmt->execute([$id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

// สร้างข้อมูลใบเสร็จในรูปแบบ HTML
$date = "";
$date .= "<html><body>";
$date .= "<h1 style='text-align: center;'>ใบเสร็จ</h1>";
$date .= "<table style='width: 100%; border: 1px solid #000; border-collapse: collapse; margin-top: 20px;'>";
$date .= "<tr><td style='padding: 8px; font-weight: bold;'>Order ID</td><td style='padding: 8px;'>".$row['id']."</td></tr>";
$date .= "<tr><td style='padding: 8px; font-weight: bold;'>Name</td><td style='padding: 8px;'>".$row['name']."</td></tr>";
$date .= "<tr><td style='padding: 8px; font-weight: bold;'>Address</td><td style='padding: 8px;'>".$row['address']."</td></tr>";
$date .= "<tr><td style='padding: 8px; font-weight: bold;'>Phone</td><td style='padding: 8px;'>".$row['phone']."</td></tr>";
$date .= "<tr><td style='padding: 8px; font-weight: bold;'>Email</td><td style='padding: 8px;'>".$row['email']."</td></tr>";
$date .= "</table>";

// ถ้ามีข้อมูลจาก order_item ให้แสดง
if ($order) {
    $date .= "<h2 style='margin-top: 20px;'>Order Items</h2>";
    $date .= "<table style='width: 100%; border: 1px solid #000; border-collapse: collapse;'>";
    $date .= "<tr><th style='padding: 8px;'>Item</th><th style='padding: 8px;'>Quantity</th><th style='padding: 8px;'>Price</th><th style='padding: 8px;'>Total</th></tr>";
    // สมมุติว่าใน `order_item` มีหลายแถว ให้ใช้การวนลูปแสดงรายการ
    do {
        $date .= "<tr>";
        $date .= "<td style='padding:center;'>".$order['pro_name']."</td>";  // ใช้ชื่อสินค้าจาก `order_item`
        $date .= "<td style='justify-content:center;'>".$order['quantity']."</td>";
        $date .= "<td style='justify-content:center;'>".$order['price']."</td>";
        $date .= "<td style='justify-content:center;'>".$order['quantity'] * $order['price']."</td>";
        $date .= "</tr>";
    } while ($order = $stmt->fetch(PDO::FETCH_ASSOC));
    $date .= "</table>";
}

$date .= "</body></html>";

// สร้าง PDF

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ], 
    'default_font' => 'sarabun'
]);
 // สิ้นสุดคำสั่ง Export ไฟล์ PDF ในส่วนบน เริ่มกำหนดตำแหน่งเริ่มต้นในการนำเนื้อหามาแสดงผลผ่าน
$mpdf->SetFont('sarabun','',14);
ob_start();  //ฟังก์ชัน ob_start()


$mpdf->WriteHTML($date);  // เขียน HTML ลงใน PDF
$mpdf->Output("receipt.pdf", "D");  // สร้าง PDF และดาวน์โหลด

?>


