<?php
$limparFiltro = false;

if (isset($_POST) && isset($_POST["action"])) {
    if ($_POST["action"] == "add") {
        $nome = filter_input(INPUT_POST, 'Nome', FILTER_SANITIZE_STRING);
        $telefone = filter_input(INPUT_POST, 'Telefone', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $cep = filter_input(INPUT_POST, 'CEP', FILTER_SANITIZE_STRING);
        $endereco = filter_input(INPUT_POST, 'Endereco', FILTER_SANITIZE_STRING);
        $numero = filter_input(INPUT_POST, 'Numero', FILTER_SANITIZE_STRING);
        $complemento = filter_input(INPUT_POST, 'Complemento', FILTER_SANITIZE_STRING);
        $bairro = filter_input(INPUT_POST, 'Bairro', FILTER_SANITIZE_STRING);
        $cidade = filter_input(INPUT_POST, 'Cidade', FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST, 'Estado', FILTER_SANITIZE_STRING);
        $stmt = $conn->prepare("
        INSERT INTO Tutor (Nome, Telefone, Email, CEP, Endereco, Numero, Complemento, Bairro, Cidade, Estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            'ssssssssss',
            $nome,
            $telefone,
            $email,
            $cep,
            $endereco,
            $numero,
            $complemento,
            $bairro,
            $cidade,
            $estado
        );
        if (!$stmt->execute()) {
            echo 'Erro ao inserir o registro: ' . $stmt->error;
            die();
        }
        $stmt->close();
        $conn->close();
        header("Location: tutores.php?add=true");
    } else if ($_POST["action"] == "edt") {
        $id = filter_input(INPUT_POST, 'idEdt', FILTER_VALIDATE_INT);
        $nome = filter_input(INPUT_POST, 'Nome', FILTER_SANITIZE_STRING);
        $telefone = filter_input(INPUT_POST, 'Telefone', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $cep = filter_input(INPUT_POST, 'CEP', FILTER_SANITIZE_STRING);
        $endereco = filter_input(INPUT_POST, 'Endereco', FILTER_SANITIZE_STRING);
        $numero = filter_input(INPUT_POST, 'Numero', FILTER_SANITIZE_STRING);
        $complemento = filter_input(INPUT_POST, 'Complemento', FILTER_SANITIZE_STRING);
        $bairro = filter_input(INPUT_POST, 'Bairro', FILTER_SANITIZE_STRING);
        $cidade = filter_input(INPUT_POST, 'Cidade', FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST, 'Estado', FILTER_SANITIZE_STRING);
        $stmt = $conn->prepare(
            "
            UPDATE Tutor 
             SET Nome = ?, Telefone = ?, Email = ?, CEP = ?, Endereco = ?, Numero = ?, Complemento = ?, Bairro = ?, Cidade = ?, Estado = ? 
             WHERE id = ?"
        );
        $stmt->bind_param(
            'ssssssssssi',
            $nome,
            $telefone,
            $email,
            $cep,
            $endereco,
            $numero,
            $complemento,
            $bairro,
            $cidade,
            $estado,
            $id
        );
        if (!$stmt->execute()) {
            echo 'Erro ao atualizar o registro: ' . $stmt->error;
            die();
        }
        $stmt->close();
        $conn->close();
        header("Location: tutores.php?edt=true");
    } else if ($_POST["action"] == "del") {
        $id = filter_input(INPUT_POST, 'idDel', FILTER_VALIDATE_INT);
        $stmt = $conn->prepare("
            DELETE FROM Tutor WHERE id = ?
        ");
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            echo 'Erro ao deletar o registro: ' . $stmt->error;
            die();
        }
        $stmt->close();
        $conn->close();
        header("Location: tutores.php?del=true");
    } else {
        header("Location: tutores.php?error=true");
    }
} else if (isset($_POST) && isset($_POST["search"])) {
    $searchText = '%' . $conn->real_escape_string($_POST['searchText']) . '%';
    $sql = "
            SELECT * FROM Tutor 
            WHERE Nome LIKE ?
               OR Telefone LIKE ?
               OR Email LIKE ?
               OR CEP LIKE ?
               OR Endereco LIKE ?
               OR Numero LIKE ?
               OR Complemento LIKE ?
               OR Bairro LIKE ?
               OR Cidade LIKE ?
               OR Estado LIKE ?
               order by id desc";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'ssssssssss',
        $searchText,
        $searchText,
        $searchText,
        $searchText,
        $searchText,
        $searchText,
        $searchText,
        $searchText,
        $searchText,
        $searchText
    );
    $stmt->execute();
    $result = $stmt->get_result();
    $limparFiltro = true;
} else {
    $sql = "SELECT * FROM Tutor order by id desc";
    $result = $conn->query($sql);
}
