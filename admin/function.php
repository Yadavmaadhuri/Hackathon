<?php
function load_settings($conn) {
    $settings = [];
    $result = $conn->query("SELECT `key`, `value` FROM settings");
    while ($row = $result->fetch_assoc()) {
        $settings[$row['key']] = $row['value'];
    }
    return $settings;
}
