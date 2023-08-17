<?php
// Verbindung zur Datenbank herstellen
$db = new mysqli('localhost', 'root', '', 'db_crowler');


$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

if (!empty($keyword)) {
    
    $query = "SELECT domain.Name , kw.Bezeichnung , kwcount.count
                FROM domain INNER JOIN kwcount ON domain.Did = kwcount.Did INNER JOIN kw ON kw.Kwid = kwcount.Kwid
                WHERE kw.Bezeichnung LIKE '%$keyword%'
                GROUP BY domain.Name, kw.Bezeichnung
                ORDER BY kwcount.count DESC";

    
    $result = $db->query($query);

    echo json_encode($result);
    
}
else{
    echo False ;
}
$db->close();
?>
