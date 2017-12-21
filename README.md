# practice_php_mysqli
Misc PHP and MySQLi practice

## Scratch Notes

### References:

    https://programmerblog.net/php-mysqli-tutorial-for-beginners/
    https://www.sanwebe.com/2013/03/basic-php-mysqli-usage
    https://www.formget.com/php-mysqli-insert/

### Initial Run

#### db connection file:
    $db = new mysqli( host, username, pw, db );
    if $db->connect_error method gets a value, set $error to hold it
    else show success msg
    test ok

#### read:
    try:
        require_once - connection file
        set $sql query (fetch_assoc
        $result = $db->query($sql);
    catch:
        catch (Exception $e) {
            $error = $e->getMessage();
        }
    HTML
        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="make" id="make">
            <input type="submit" name="search" value="Search">
    if $error isset, echo error
    // elseif issset $result && $result->num_rows
    //    while ($row = $result->fetch_assoc()) {  // or fetch_array, etc.)
    //        echo $row['key']
    else
        echo '<pre>';
        $all = $result->fetch_all(MYSQLI_ASSOC);
        print_r($all);
        echo '</pre>';
    $db->close();

#### insert/update/delete:
    try:
        check $db->affected_rows (or $db->insert_id)
        // $result = 0 or 1
        // use same routine/page, with radio buttons to select CRUD?

### Prepared statements:
    set $sql query, e.g.:
        "INSERT INTO products (pcode, pname, price) VALUES (?, ?, ?)";
        "UPDATE tbl_products SET product_name = ?, price = ?, category = ? WHERE id = ?"
        "DELETE FROM tbl_products WHERE id = ?";
    $stmt = $db->stmt_init();
    if (!stmt->prepare($sql)) {
        $error = $stmt->error;
    } else {
        $stmt->bind_param('sid', $make, $_GET['yearmade'], $_GET['price']);
        $make = '%' . $_GET['make'] . '%';  // wildcards for 'like'
        if ($stmt->execute()) {
            print success msg
        else print/die $db->error
        $result = $stmt->get_result();  // OR
        $stmt->bind_result($id, $foo, $bar);
            then, while($stmt->fetch()) {
                print '<p>'.$id.'</p>';  // etc.
        $stmt->close();
