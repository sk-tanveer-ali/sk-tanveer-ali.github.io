<?php

//// Displaying errors
ini_set('display_errors', '1');

//connect to db
require_once "_includes/db_connect.php";

$query = "SELECT * FROM expense
                    JOIN category 
                    ON expense.category_id = category.category_id 
                    ORDER BY added_on DESC";

//$query = "SELECT * FROM expense, category WHERE expense.category_id = category.category_id ";

//$stmt = mysqli_prepare($link, "SELECT id, expense_name, amount, details, added_on FROM expense");

$stmt = mysqli_prepare($link, $query);

//execute the statment / query from above
mysqli_stmt_execute($stmt);

//get results
$result = mysqli_stmt_get_result($stmt);

$results = array();

//loop through
while ($row = mysqli_fetch_assoc($result)) {
    $results[] = $row;
}

//encode $ display json
echo json_encode($results);

//close the link to the db
mysqli_close($link);

?>