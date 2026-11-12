<?php
include "db.php";
include "header.php";

if(isset($_POST['submit'])){
    $student_name = $_POST['student_name'];
    $matric_no = $_POST['matric_no'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $test_1 = $_POST['test_1'];
    $test_2 = $_POST['test_2'];
    $final_50 = $_POST['final_50'];

    $total_100 = $test_1 + $test_2 + $final_50;
    //80-100 = A
    //65-79 = B
    //50-64 = C
    //40-49 = D
    //0-39 = E

    if($total_100 >= 80)
        $grade = 'A';
    else if ($total_100 >= 65)
        $grade = 'B';
    else if ($total_100 >= 50)
        $grade = 'C';
    else if ($total_100 >= 40)
        $grade = 'D';
    else
        $grade = 'E';


    $sql = $conn ->prepare("INSERT INTO result (student_name, matric_no, subject_name, subject_code, test_1, test_2, final_50, total_100, grade)
    VALUES ('$student_name', '$matric_no', '$subject_name', '$subject_code', $test_1, $test_2, $final_50, $total_100, '$grade')");

    if ($sql->execute()) {
        header ("Location: index.php");
    }
}

$student_name = "";
$matric_no = "";
$subject_name = "";
$subject_code = "";
$test_1 = "";
$test_2 = "";
$final_50 = "";
?>

<h2>ADD RESULT</h2>

<?php
include "form.php";
include "footer.php";
?>
