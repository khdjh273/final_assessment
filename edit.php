<?php
include "db.php";
include "header.php";

//fallback, ?? equals to if else
$id = $_GET['id'] ?? 0;

$sql = $conn->prepare("SELECT * FROM result WHERE id=$id");

$sql->execute();

$row = $sql->get_result()->fetch_assoc();
/*$row = [id, student_name,matric_no....]
        [1,Ali,2022...,
        2,AHmad,2023...]
*/
$student_name = $row['student_name'];
$matric_no = $row['matric_no'];
$subject_name = $row['subject_name'];
$subject_code = $row['subject_code'];
$test_1 = $row['test_1'];
$test_2 = $row['test_2'];
$final_50 = $row['final_50'];

if(isset(($_POST['submit']))){
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


    $sql = $conn ->prepare("UPDATE result SET 
    student_name='$student_name',
    matric_no='$matric_no', 
    subject_name='$subject_name', 
    subject_code='$subject_code', 
    test_1='$test_1', 
    test_2='$test_2', 
    final_50='$final_50', 
    total_100='$total_100', 
    grade='$grade'
    WHERE id=$id");

    if ($sql->execute()) {
        header ("Location: index.php");
    } 
}



?>

<h2>EDIT RESULT</h2>

<?php
include "form.php";
include "footer.php";
?>