<?php
// Verbindung zur Datenbank herstellen
$db = new mysqli('localhost', 'root', '', 'db_crowler');


$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

if (!empty($keyword)) {
    
    $query = "SELECT domain.Name, kwcount.count
    FROM domain INNER JOIN kwcount ON domain.Did = kwcount.Did INNER JOIN kw ON kw.Kwid = kwcount.Kwid
    WHERE kw.Bezeichnung LIKE '%$keyword%'
    GROUP BY domain.Name
    ORDER BY kwcount.count DESC";

    
    $result = $db->query($query);

    
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    
    echo json_encode($rows);
        
}
else{
    echo "False" ;
}
$db->close();
?>
