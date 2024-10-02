<?php

function connection(){
    $host = "localhost:3306";
    $user = "root";
    $pass = "Ivan14402";

    $bd = "Northwind";

    $connect=mysqli_connect($host, $user, $pass);

    mysqli_select_db($connect, $bd);

    return $connect;

}

$con = connection();

$sql = "SELECT 
p.ProductName AS Product_Name,
(SELECT c.CategoryName FROM Categories c WHERE c.CategoryID = p.CategoryID) AS Name_Category,
p.UnitPrice AS Unit_Price
FROM
Products p
WHERE
    p.UnitPrice > (

    SELECT
        AVG(p2.UnitPrice)
    FROM
        products p2
    WHERE
        p2.CategoryID = p.CategoryID);";
$query = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Tarea 2 PHP</title>
</head>
<body>
    <div class="container mt-5" align="center">
    <h2 class="mb-4">Product Table</h2>
    <table class="table table-dark table-hover">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                <tr>
                    <td> <?= $row["Product_Name"] ?> </td>
                    <td> <?= $row["Name_Category"] ?> </td>
                    <td> <?= $row["Unit_Price"] ?> </td>
                </tr>
                <?php endwhile; ?>  
            </tbody>
        </table>
    </div>
</body>
</html>