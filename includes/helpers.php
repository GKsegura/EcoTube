<?php

function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function requireAdmin() {
    if (!isset($_SESSION['isadm']) || $_SESSION['isadm'] !== 't') {
        header("Location: ../index.php");
        exit;
    }
}

function redirect($msg, $url) {
    echo "<script>alert(" . json_encode($msg) . "); window.location='" . $url . "';</script>";
    exit;
}
