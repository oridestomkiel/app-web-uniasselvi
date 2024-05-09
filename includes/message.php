<?php
if (isset($_GET) && isset($_GET["del"]) && $_GET["del"] == "true") {
    echo "<script>showAlert('Item apagado com sucesso sucesso!', 'success');</script>";
}
if (isset($_GET) && isset($_GET["edt"]) && $_GET["edt"] == "true") {
    echo "<script>showAlert('Item alterado com sucesso sucesso!', 'success');</script>";
}
if (isset($_GET) && isset($_GET["add"]) && $_GET["add"] == "true") {
    echo "<script>showAlert('Item adicionado com sucesso sucesso!', 'success');</script>";
}
