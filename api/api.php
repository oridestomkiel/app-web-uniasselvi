<?php
include '../conn/conect.php';
include '../functions/functions.php';

if (isset($_GET) && isset($_GET["pets"]) && $_GET["pets"] != "") {

    $pet_id = isset($_GET['pets']) ? (int) $_GET['pets'] : 0;
    $pets = array();
    $sql = "
    SELECT id, Nome
    FROM Pet
    WHERE Tutor_Id = ?
    ORDER BY nome
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }
    $stmt->bind_param('i', $pet_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pets[] = $row;
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($pets, JSON_UNESCAPED_UNICODE);
    } else {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array("message" => "Nenhum pet encontrado para o tutor especificado"), JSON_UNESCAPED_UNICODE);
    }
}

if (isset($_GET) && isset($_GET["dados"]) && $_GET["dados"] != "") {

    if ($_GET["dados"] == "Pet") {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $pets = array();
        $sql = "
        SELECT P.*        
        FROM Pet P
        WHERE P.id = ?
        ";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pets[] = $row;
            }
            echo dataToTable($pets);
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(array("message" => "Nenhum pet encontrado para este ID"), JSON_UNESCAPED_UNICODE);
        }
    }

    if ($_GET["dados"] == "Tutor") {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $tutores = array();
        $sql = "
        SELECT *        
        FROM Tutor
        WHERE id = ?
        ";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tutores[] = $row;
            }
            echo dataToTable($tutores);
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(array("message" => "Nenhum pet encontrado para este ID"), JSON_UNESCAPED_UNICODE);
        }
    }
}

$conn->close();
