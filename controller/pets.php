<?php
$limparFiltro = false;

if (isset($_POST) && isset($_POST["action"])) {
    if ($_POST["action"] == "add") {
        $tutor = filter_input(INPUT_POST, 'Tutor', FILTER_VALIDATE_INT);
        $nome = filter_input(INPUT_POST, 'Nome', FILTER_SANITIZE_STRING);
        $especie = filter_input(INPUT_POST, 'Especie', FILTER_SANITIZE_STRING);
        $sexo = filter_input(INPUT_POST, 'Sexo', FILTER_SANITIZE_STRING);
        $observacoes = filter_input(INPUT_POST, 'Observacoes', FILTER_SANITIZE_STRING);
        $stmt = $conn->prepare("
            INSERT INTO Pet (Tutor_Id, Nome, Especie, Sexo, Observacoes) VALUES (?, ?, ?, ?, ?)
        ");
        if ($stmt === false) {
            die('Erro ao preparar a declaração: ' . $conn->error);
        }
        $stmt->bind_param('issss', $tutor, $nome, $especie, $sexo, $observacoes);
        if (!$stmt->execute()) {
            die('Erro ao executar a declaração: ' . $stmt->error);
        }
        $stmt->close();
        $conn->close();
        header("Location: pets.php?add=true");
    } else if ($_POST["action"] == "edt") {
        $petId = filter_input(INPUT_POST, 'idEdt', FILTER_VALIDATE_INT);
        $tutor = filter_input(INPUT_POST, 'Tutor', FILTER_VALIDATE_INT);
        $nome = filter_input(INPUT_POST, 'Nome', FILTER_SANITIZE_STRING);
        $especie = filter_input(INPUT_POST, 'Especie', FILTER_SANITIZE_STRING);
        $sexo = filter_input(INPUT_POST, 'Sexo', FILTER_SANITIZE_STRING);
        $observacoes = filter_input(INPUT_POST, 'Observacoes', FILTER_SANITIZE_STRING);
        $stmt = $conn->prepare("
            UPDATE Pet 
            SET Tutor_Id = ?, Nome = ?, Especie = ?, Sexo = ?, Observacoes = ? 
            WHERE id = ?
        ");
        $stmt->bind_param('issssi', $tutor, $nome, $especie, $sexo, $observacoes, $petId);
        if (!$stmt->execute()) {
            die('Erro ao executar a atualização: ' . $stmt->error);
        }
        $stmt->close();
        $conn->close();
        header("Location: pets.php?edt=true");
    } else if ($_POST["action"] == "del") {
        $id = filter_input(INPUT_POST, 'idDel', FILTER_VALIDATE_INT);
        $stmt = $conn->prepare("
            DELETE FROM Pet WHERE id = ?
        ");
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            echo 'Erro ao deletar o registro: ' . $stmt->error;
            die();
        }
        $stmt->close();
        $conn->close();
        header("Location: pets.php?del=true");
    } else {

        header("Location: pets.php?error=true");
    }
} else if (isset($_POST) && isset($_POST["search"])) {
    $searchText = '%' . $conn->real_escape_string($_POST['searchText']) . '%';
    $sql = "
        SELECT P.*, Tu.Nome AS NomeTutor
        FROM Pet P
        INNER JOIN Tutor Tu ON P.Tutor_Id = Tu.id
        WHERE Tu.Nome LIKE ?
          OR P.Nome LIKE ?
          OR P.Especie LIKE ?
          OR P.Observacoes LIKE ?
        ORDER BY P.id DESC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $searchText, $searchText, $searchText, $searchText);
    $stmt->execute();
    $result = $stmt->get_result();
    $limparFiltro = true;
} else {
    $sql = "        
        SELECT Tu.Nome AS NomeTutor, P.* 
        FROM Pet P
        INNER JOIN Tutor Tu ON P.Tutor_Id = Tu.id
        order by P.id desc";
    $result = $conn->query($sql);
}
$sqlTutor = "
SELECT * FROM Tutor order by id desc
";
$tutores = $conn->query($sqlTutor);
$tutoresS = $conn->query($sqlTutor);

$numTutores = $tutores->num_rows;
