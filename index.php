<?php include 'db_connect.php';?>

<?PHP
session_start();
$mgs='';
$score = 0;

// مصفوفة الإجابات الصحيحة 
$correct_answers = [
    'q1' => 'b',
    'q2' => 'b',
    'q3' => 'c',
    'q4' => 'b',
    'q5' => 'c',
    'q6' => 'c',
    'q7' => 'b',
    'q8' => 'b',
    'q9' => 'c',
	'q10' => 'b',
	'q11' => 'a',
	'q12' => 'c',
	'q13' => 'b',
	'q14' => 'a',
];


if(isset($_POST['submit_ptn']))
{

	$school_name=$_POST['school_name'];
	$student_name=$_POST['student_name'];
	$wilaya=$_POST['wilaya'];
	$class=$_POST['class'];

	$user_answers = [
    'q1' => isset($_POST['q1']) ? $_POST['q1'] : '',
    'q2' => isset($_POST['q2']) ? $_POST['q2'] : '',
    'q3' => isset($_POST['q3']) ? $_POST['q3'] : '',
    'q4' => isset($_POST['q4']) ? $_POST['q4'] : '',
    'q5' => isset($_POST['q5']) ? $_POST['q5'] : '',
    'q6' => isset($_POST['q6']) ? $_POST['q6'] : '',
    'q7' => isset($_POST['q7']) ? $_POST['q7'] : '',
    'q8' => isset($_POST['q8']) ? $_POST['q8'] : '',
    'q9' => isset($_POST['q9']) ? $_POST['q9'] : '',
	'q10' => isset($_POST['q10']) ? $_POST['q10'] : '',
	'q11' => isset($_POST['q11']) ? $_POST['q11'] : '',
	'q12' => isset($_POST['q12']) ? $_POST['q12'] : '',
	'q13' => isset($_POST['q13']) ? $_POST['q13'] : '',
	'q14' => isset($_POST['q14']) ? $_POST['q14'] : '',
];
	

    foreach ($correct_answers as $qName => $correctLetter) {
        if (isset($user_answers[$qName]) && $user_answers[$qName] === $correctLetter) {
            $score++;
        }
    }

    $sql = "INSERT INTO table3 (school_name, student_name, wilaya, class,
                q1, q2, q3, q4, q5, q6, q7, q8, q9,q10,q11,q12,q13,q14, score) 
		    VALUES (
                '$school_name', '$student_name', '$wilaya', '$class',
                '{$user_answers['q1']}','{$user_answers['q2']}','{$user_answers['q3']}',
                '{$user_answers['q4']}','{$user_answers['q5']}','{$user_answers['q6']}',
                '{$user_answers['q7']}','{$user_answers['q8']}','{$user_answers['q9']}',
				'{$user_answers['q10']}','{$user_answers['q11']}','{$user_answers['q12']}',
				'{$user_answers['q13']}','{$user_answers['q14']}', $score)";

    $sql_query = mysqli_query($db_connect, $sql);

    if ($sql_query) {
        $_SESSION['score'] = $score;
        $_SESSION['total'] = count($correct_answers);

        header("Location: result.php");
        exit;
    } else {
        $mgs = 'فشل عملية إدخال البيانات';
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>المسابقة الثقافية الصحية</title>
<style>	 
	body {
    	font-family: "Cairo", sans-serif;
    	background-color: #f7f9fb;
   	 	margin: 0;
    	padding: 20px;
    	direction: rtl;
		}
	.container {
    	max-width: 900px;
    	background: #C8CBA2;
    	margin: auto;
    	padding: 30px;
    	border-radius: 15px;
    	box-shadow: 0 0 10px rgba(0,0,0,0.1);
		}
	h1 {
    	text-align: center;
    	color: #0a6ebd;
		}
	label {
    	display: block;
    	margin: 8px 0;
		}
	.question {
    	margin-top: 20px;
    	padding: 15px;
    	background: #D6D69F;
    	border-radius: 10px;
		}
	button {
    	background-color: #BFC58E;
    	color: white;
    	padding: 10px 20px;
    	border: none;
    	border-radius: 8px;
    	font-size: 16px;
    	cursor: pointer;
		}
	button:hover {
   	 	background-color: #646651;
		}
	@media (max-width: 600px) {
    body {
        padding: 10px;
    	}
    .container {
        padding: 15px;
    	}
    h1 {
        font-size: 1.3em;
   	 	}
    button {
        width: 100%;
        font-size: 18px;
        padding: 14px;
    	}
	}
    .result-box {
        max-width: 500px;
        margin: 40px auto;
        text-align: center;
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 30px 20px;
        border: 1px solid #ddd;
    }

    .result-icon {
        font-size: 40px;
        margin-bottom: 10px;
        color: #28a745; 
    }

    .result-box h2 {
        margin: 0 0 15px;
        color: #333;
    }

    .result-text {
        font-size: 18px;
        margin-bottom: 25px;
    }

    .result-text .score {
        font-weight: bold;
        color: #28a745; 
    }

    .result-text .total {
        font-weight: bold;
    }

    .btn-back {
        display: inline-block;
        padding: 10px 25px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
    }

    .btn-back:hover {
        background-color: #0056b3;
    }
</style>
</head>

<body>
	
<div class="container">
	<h2 align="center"> المسابقة الثقافية الصحية حول اليوم العالمي لمرض السكري</h2><br><br>
	<p align="center">"تمكين الجميع من العناية بمرض السكري"</p>
	<h1><?php echo $mgs; ?></h1>
	<form method="post" action="index.php"> 
<div class="section">
	
    <h3>البيانات الأساسية</h3>

    <label>اسم المدرسة:</label>
    <input type="text" name="school_name" required style="width: 98%; padding: 8px;">

	
	<label>اسم الطالب:</label>
    <input type="text" name="student_name" required style="width: 98%; padding: 8px;">
	
	<label>الولاية:</label>
   	 	<select name="wilaya" required style="width: 100%; padding: 8px;">
			<option></option>
			<option value="liwa">لوى</option>
			<option value="suhar">صحار</option>
			<option value="saham">شناص</option>
			<option value="saham">صحم</option>
			<option value="saham">الخابورة</option>
			<option value="saham">السويق</option>
		 </select>
	
	<label>الصف الدراسي:</label>
   	 	<select name="class" required style="width: 100%; padding: 8px;">
			<option></option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		 </select>
	
    
	<div class="question">
		<label>1.متى يُصادف اليوم العالمي لمرض السكري؟</label>
    	<label><input type="radio" name="q1" value="a" > 10 أكتوبر</label>
    	<label><input type="radio" name="q1" value="b"> 14 نوفمبر</label>
    	<label><input type="radio" name="q1" value="c"> 1 ديسمبر</label>
	</div>	
	<div class="question">
		<label>2.ما هو لون شعار اليوم العالمي للسكري؟</label>
    	<label><input type="radio" name="q2" value="a" > الأحمر </label>
    	<label><input type="radio" name="q2" value="b"> الأزرق </label>
    	<label><input type="radio" name="q2" value="c"> الأخضر </label>
	</div>
	<div class="question">
		<label>3.ما هو الهرمون الذي يساعد على تنظيم مستوى السكر في الدم؟</label>
    	<label><input type="radio" name="q3" value="a" > الأدرينالين</label>
    	<label><input type="radio" name="q3" value="b"> الإنسولين</label>
    	<label><input type="radio" name="q3" value="c"> التستوستيرون</label>
	</div>
	<div class="question">
		<label>4.أين يُنتَج الإنسولين في الجسم؟</label>
    	<label><input type="radio" name="q4" value="a" > الكبد</label>
    	<label><input type="radio" name="q4" value="b"> البنكرياس</label>
    	<label><input type="radio" name="q4" value="c"> المعدة</label>
	</div>
	<div class="question">
		<label>5.ما هو الاسم الطبي لارتفاع نسبة السكر في الدم؟ </label>
    	<label><input type="radio" name="q5" value="a" > نقص السكر في الدم </label>
    	<label><input type="radio" name="q5" value="b"> فقر الدم</label>
    	<label><input type="radio" name="q5" value="c"> فرط سكر الدم </label>
	</div>
	<div class="question">
		<label>6.أي من الأعراض التالية يعد من الأعراض الشائعة لمرض السكري؟ </label>
    	<label><input type="radio" name="q6" value="a" > فقدان التوازن </label>
    	<label><input type="radio" name="q6" value="b"> اصفرار الجلد </label>
    	<label><input type="radio" name="q6" value="c"> زيادة العطش والتبول </label>
	</div>
	<div class="question">
		<label>7.ما الفرق الأساسي بين السكري من النوع الأول والنوع الثاني؟ </label>
    	<label><input type="radio" name="q7" value="a" > النوع الأول يصيب الأطفال فقط</label>
    	<label><input type="radio" name="q7" value="b"> النوع الأول لا يُنتج الجسم فيه الإنسولين، بينما النوع الثاني لا يستخدمه جيدًا </label>
    	<label><input type="radio" name="q7" value="c"> لا يوجد فرق بينهما </label>
	</div>
	<div class="question">
		<label>8.ما هو المعدل الطبيعي لسكر الدم عند الصيام؟ </label>
    	<label><input type="radio" name="q8" value="a" > أقل من 70 ملغ/دل</label>
    	<label><input type="radio" name="q8" value="b"> بين 70 و100 ملغ/دل </label>
		<label><input type="radio" name="q8" value="c"> أكثر من 150 ملغ/دل</label>
	</div>
	<div class="question">
		<label>9.من المضاعفات الشائعة لمرض السكري على المدى الطويل:</label>
    	<label><input type="radio" name="q9" value="a" > أمراض الكلى والعين والقلب </label>
    	<label><input type="radio" name="q9" value="b"> نزلات البرد </label>
    	<label><input type="radio" name="q9" value="c"> الحساسية الموسمية </label>
	</div>
	<div class="question">
		<label>10.ما الهدف الرئيسي من اليوم العالمي لمرض السكري؟</label>
    	<label><input type="radio" name="q10" value="a" > بيع الأدوية </label>
    	<label><input type="radio" name="q10" value="b"> رفع الوعي حول المرض والوقاية منه </label>
    	<label><input type="radio" name="q10" value="c"> تشجيع الناس على تناول الحلويات </label>
	</div>
	<div class="question">
		<label>11.ما أبرز عوامل خطر الإصابة بالنوع الثاني من السكري؟</label>
    	<label><input type="radio" name="q11" value="a" > قلة النشاط البدني وزيادة الوزن </label>
    	<label><input type="radio" name="q11" value="b"> كثرة شرب الماء </label>
    	<label><input type="radio" name="q11" value="c"> النوم المبكر </label>
	</div>
	<div class="question">
		<label>12.ما اسم الجهاز المستخدم لقياس مستوى السكر في الدم؟</label>
    	<label><input type="radio" name="q12" value="a" > الترمومتر </label>
    	<label><input type="radio" name="q12" value="b"> جهاز الضغط </label>
    	<label><input type="radio" name="q12" value="c"> جهاز الجلوكوميتر </label>
	</div>
	<div class="question">
		<label>13.ما هو نوع المرض الذي يُصنف تحته السكري؟</label>
    	<label><input type="radio" name="q14" value="a" > مرض معدٍ </label>
    	<label><input type="radio" name="q14" value="b"> مرض مزمن غير معدٍ </label>
    	<label><input type="radio" name="q14" value="c"> مرض نفسي </label>
	</div>
	<div class="question">
		<label>14.أي مما يلي يساعد على الوقاية من مرض السكري؟</label>
    	<label><input type="radio" name="q13" value="a" > تناول طعام صحي وممارسة الرياضة </label>
    	<label><input type="radio" name="q13" value="b"> الإكثار من الحلويات </label>
    	<label><input type="radio" name="q13" value="c"> الجلوس لفترات طويلة </label>
	</div>
	<div class="question">
		<center>
			<button type="submit" name="submit_ptn" style="width: 50%; padding: 8px;">إرسال  </button>
		</center>
	</div>
	
</form>
	
</div>
</body>
</html>