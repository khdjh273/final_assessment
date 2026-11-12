<?php
include "db.php";
include "auth.php";

$search = $_GET['search'] ?? "";

// %$search -> ENDS WITH the search text.
//             "ah" finds "Aminah" and "Farah", but not "Ahmad".
// $searchfo -> STARTS WITH the search text.
//              "Am" finds "Aminah" and "Amir", but not "Hamid".
// %$search% -> CONTAINS the search text anywhere.
//              "mi" finds "Aminah", "Amir" and "Jamil".
//This is the usual choice for a Search box.

// %$search%, eg: Also, %Al = Ali, Albert, Alan etc
$like = "%$search%";


// $sql = $conn ->prepare("SELECT * FROM result");
$sql = $conn ->prepare("SELECT * FROM result
WHERE student_name LIKE ? OR matric_no LIKE ? 
OR subject_name LIKE ? OR subject_code LIKE ?");

$sql->bind_param("ssss", $like, $like, $like, $like);
// s = string, i = integer, d = double

$sql->execute();

$result = $sql->get_result();


include "header.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessment - Grading System</title>
</head>
<body>


    <h2>Student Records</h2>

    <a href="add.php">+ Add result </a><br><br>

    <form method="get">
        <input type="text" name="search" placeholder="Search by name or ID"
        value="<?php $search ?>">
        <button type="submit">Search</button>
        <a href="index.php">Show All</a>
    </form>
    <div>
        <table border="1">
            <tr>
                <th>No.</th>
                <th>Student Name</th>
                <th>Matric No.</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Test 1 (20%)</th>
                <th>Test 2 (30%)</th>
                <th>Final (50%)</th>
                <th>Total (100%)</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>

            <?php
            $no = 1; //$no++ = $no
            // if else, while loop, for loop, switch case
            while ($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>" . $row['matric_no'] . "</td>";
                echo "<td>" . $row['subject_name'] . "</td>";
                echo "<td>" . $row['subject_code'] . "</td>";
                echo "<td>" . $row['test_1'] . "</td>";
                echo "<td>" . $row['test_2'] . "</td>";
                echo "<td>" . $row['final_50'] . "</td>";
                echo "<td>" . $row['total_100'] . "</td>";
                echo "<td>" . $row['grade'] . "</td>";
                echo "<td>";
                echo "<button> <a href='edit.php?id=" . $row['id'] . "'>Edit</a></button>";

                echo "<form method='post' action= 'delete.php'
                onsubmit='return confirm(\"Are you sure you want to delete this record?\");'>";
                echo "<input type='hidden' name='delete' value='" . $row['id'] . "'>";
                echo "<button type='submit'>Delete</button>";
                echo "</form>";

                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>


    
</body>
</html>

<?php
include "footer.php";
?>