<?php
class DBController {
    private $host = "localhost";
    private $user = "u155356178_SaludDevCenter";
    private $password = "uE;bAISz;*6c|I4PvEnfSys324\Zavp2zJ:9TLx{]L&QMcmhAdmSCDBSN3iH4UV3D24WMF@2024myV>";
    private $database = "u155356178_saludapos";
    private $conn;

    function __construct() {
        $this->conn = $this->connectDB();
        $this->setTimeZone();
    }

    function connectDB() {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        return $conn;
    }

    function setTimeZone() {
        // Establecer el huso horario a GMT-6
        $sqlSetTimeZone = "SET time_zone = '-6:00'";
        mysqli_query($this->conn, $sqlSetTimeZone);
    }

    function runQuery($query) {
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset)) {
            return $resultset;
        }
    }

    function numRows($query) {
        $result = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

    function executeUpdate($query) {
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
}
?>
