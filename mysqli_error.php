<?php
/**
 * User: lisa
 * Date: 12/16/17
 * Time: 9:41 PM
 */
/* echo "TEST"; */
try {
    require_once 'includes/mysqli_connect.php';
    $sql = 'SELECT name, meaning, gender FROM names
            ORDER by gender';
    $result = $db->query($sql);
    if ($db->error) {
        $error = $db->error;
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}

if (isset($error)) {
    echo "<p>$error</p>";
} else {
    /* echo "<p>Connection successful.</p>"; */
    echo '<pre>';
    $all = $result->fetch_all(MYSQLI_ASSOC);
    print_r($all);
    echo '</pre>';
}
$db->close();
