<?php
session_start();
function isLoging()
{
    if (!isset($_SESSION['id'])) {
        return false;
    }
    return true;
}
