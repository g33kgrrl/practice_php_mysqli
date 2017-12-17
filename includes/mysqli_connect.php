<?php
/**
 * User: lisa
 * Date: 12/16/17
 * Time: 7:56 PM
 */
$db = new mysqli('localhost', 'oophp', 'lynda', 'oophp');

if ($db->connect_error) {
    $error = $db->connect_error;
}
$db->set_charset('utf8');
