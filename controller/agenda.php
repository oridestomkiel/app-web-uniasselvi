<?php
$limparFiltro = false;
$calendarData = date("d/m/Y");
$selectData = date("Y-m-d");

if (isset($_POST) && isset($_POST["action"])) {

    if ($_POST["action"] == "add") {
        $tutor = filter_input(INPUT_POST, 'Tutor', FILTER_VALIDATE_INT);
        $pet = filter_input(INPUT_POST, 'Pet', FILTER_VALIDATE_INT);
        $dataAgenda = filter_input(INPUT_POST, 'dataAgenda', FILTER_SANITIZE_STRING);
        $Hora = filter_input(INPUT_POST, 'Hora', FILTER_VALIDATE_INT);
        $Servico = filter_input(INPUT_POST, 'Servico', FILTER_SANITIZE_STRING);
        $stmt = $conn->prepare("
            INSERT INTO Agenda (Tutor_Id, Pet_id, Data, Hora, Servico) VALUES (?, ?, ?, ?, ?)
        ");
        if ($stmt === false) {
            die('Erro ao preparar a declaração: ' . $conn->error);
        }
        $partes = explode("/", $dataAgenda);
        $data_convertida = $partes[2] . "-" . $partes[1] . "-" . $partes[0];
        $stmt->bind_param('iisis', $tutor, $pet, $data_convertida, $Hora, $Servico);
        if (!$stmt->execute()) {
            die('Erro ao executar a declaração: ' . $stmt->error);
        }
        $stmt->close();
        $conn->close();
        header("Location: agenda.php?add=true&data=" . $data_convertida);
    } else if ($_POST["action"] == "edt") {

        $agendaId = filter_input(INPUT_POST, 'idEdt', FILTER_VALIDATE_INT);
        $tutor = filter_input(INPUT_POST, 'Tutor', FILTER_VALIDATE_INT);
        $pet = filter_input(INPUT_POST, 'Pet', FILTER_VALIDATE_INT);
        $dataAgenda = filter_input(INPUT_POST, 'dataAgenda', FILTER_SANITIZE_STRING);
        $Hora = filter_input(INPUT_POST, 'Hora', FILTER_VALIDATE_INT);
        $Servico = filter_input(INPUT_POST, 'Servico', FILTER_SANITIZE_STRING);
        $stmt = $conn->prepare("
            UPDATE Agenda 
            SET Tutor_Id = ?, Pet_id = ?, Data = ?, Hora = ?, Servico = ? 
            WHERE id = ?
        ");
        $partes = explode("/", $dataAgenda);
        $data_convertida = $partes[2] . "-" . $partes[1] . "-" . $partes[0];
        $stmt->bind_param('issssi', $tutor, $pet, $data_convertida, $Hora, $Servico, $agendaId);
        if (!$stmt->execute()) {
            die('Erro ao executar a atualização: ' . $stmt->error);
        }
        $stmt->close();
        $conn->close();
        header("Location: agenda.php?edt=true&data=" . $data_convertida);
    } else if ($_POST["action"] == "del") {

        $id = filter_input(INPUT_POST, 'idDel', FILTER_VALIDATE_INT);
        $selectData = filter_input(INPUT_POST, 'selectData', FILTER_SANITIZE_STRING);
        $stmt = $conn->prepare("
            DELETE FROM Agenda WHERE id = ?
        ");
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            echo 'Erro ao deletar o registro: ' . $stmt->error;
            die();
        }
        $stmt->close();
        $conn->close();
        header("Location: agenda.php?del=true&data=" . $selectData);
    } else {

        header("Location: pets.php?error=true");
    }
} else {

    if (isset($_GET) && isset($_GET["data"]) && $_GET["data"] != "") {
        $timestamp = strtotime($_GET["data"]);
        if ($timestamp !== false) {
            $calendarData = date("d/m/Y", $timestamp);
            $selectData = date("Y-m-d", $timestamp);
        }
    }
    $sql = "
        SELECT T.id, T.Nome as NomeTutor,
        P.id, P.Nome as NomePet,
        A.*
        FROM Agenda A
        INNER JOIN Tutor T ON A.Tutor_Id = T.id
        INNER JOIN Pet P ON A.Pet_Id = P.id        
        WHERE Data = '$selectData'";

    $result = $conn->query($sql);
    $agendamentos = array();
    while ($row = $result->fetch_assoc()) {
        $dataString = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
        $row['dataString'] = $dataString;
        $hora = $row['Hora'];
        $agendamentos[$hora][] = $row;
    }
    $sqlTutor = "SELECT * FROM Tutor order by nome";
    $tutoresResult = $conn->query($sqlTutor);
    $tutoresResultEdt = $conn->query($sqlTutor);
    $numTutores = $tutoresResult->num_rows;

    $sqlPet = "SELECT * FROM Pet ORDER BY id DESC";
    $pets = $conn->query($sqlPet);
    $numPets = $pets->num_rows;

    $currentDate = new DateTime($selectData);
    $previousDate = clone $currentDate;
    $nextDate = clone $currentDate;
    $previousDate->modify('-1 day');
    $nextDate->modify('+1 day');
    $previousDateFormatted = $previousDate->format('Y-m-d');
    $nextDateFormatted = $nextDate->format('Y-m-d');
}
