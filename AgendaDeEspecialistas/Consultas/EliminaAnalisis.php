<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("db_connection.php");

    // get user id
    $ID_Analisis = $_POST['id'];

    // delete User
    $query = "DELETE FROM Tipo_analisis WHERE ID_Analisis = '$ID_Analisis'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}
?>