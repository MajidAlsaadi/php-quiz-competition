<?php
session_start();

// إذا لم توجد نتيجة، نرجع للمسابقة
if (!isset($_SESSION['score']) || !isset($_SESSION['total'])) {
    header("Location:index.php");
    exit;
}

$score = $_SESSION['score'];
$total = $_SESSION['total'];

// نحذفهم حتى لا تتكرر النتيجة عند التحديث
unset($_SESSION['score']);
unset($_SESSION['total']);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>نتيجة المسابقة</title>

<style>
    body {
        font-family: Tahoma, Arial;
        direction: rtl;
        text-align: center;
        background: #f8f9fa;
        margin-top: 50px;
    }

    .result-box {
        max-width: 500px;
        background: white;
        padding: 30px;
        margin: auto;
        border-radius: 10px;
        box-shadow: 0 0 10px #ddd;
    }

    .ok {
        font-size: 50px;
        color: #28a745;
    }

    .btn-back {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 25px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 16px;
    }

    .btn-back:hover {
        background: #0056b3;
    }
</style>

</head>

<body>

<div class="result-box">
    <div class="ok">✔</div>
    <h2>تم إرسال إجاباتك بنجاح</h2>

    <p style="font-size: 20px;">
        درجتك هي:
        <strong style="color:#28a745;"> <?php echo $score; ?> </strong>
        من
        <strong><?php echo $total; ?></strong>
    </p>

    <a href="index.php" class="btn-back">العودة إلى المسابقة</a>
</div>

</body>
</html>
