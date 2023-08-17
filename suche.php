<?php
// Verbindung zur Datenbank herstellen
$db = new mysqli('localhost', 'root', '', 'db_crowler');


$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

if (!empty($keyword)) {
    
    $query = "SELECT page_id, page_title, COUNT(*) AS keyword_count
              FROM pages
              WHERE page_content LIKE '%$keyword%'
              GROUP BY page_id, page_title
              ORDER BY keyword_count DESC";

    
    $result = $db->query($query);

    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "Seite: " . $row['page_title'] . " (Keyword-Anzahl: " . $row['keyword_count'] . ")<br>";
        }
    } else {
        echo "Fehler bei der Abfrage: " . $db->error;
    }
}


$db->close();
?>
