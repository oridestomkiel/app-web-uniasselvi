<?php
function isFimDeSemana($date)
{
    $dateTime = new DateTime($date);
    $dayOfWeek = $dateTime->format('N');
    return $dayOfWeek == 6 || $dayOfWeek == 7;
}

function isFeriado($date)
{
    $dateTime = new DateTime($date);
    $formattedDate = $dateTime->format('Y-m-d');

    $fixedHolidays = [
        '2024-01-01',
        '2024-03-09',
        '2024-04-21',
        '2024-05-01',
        '2024-09-07',
        '2024-10-12',
        '2024-11-02',
        '2024-11-15',
        '2024-12-25',
    ];

    $easter = (new DateTime())->setTimestamp(easter_date($dateTime->format('Y')));
    $formattedEaster = $easter->format('Y-m-d');

    return in_array($formattedDate, $fixedHolidays) || $formattedDate == $formattedEaster;
}

function dataPorExtenso($data)
{
    setlocale(LC_TIME, 'pt_BR.utf8');
    $dateTime = new DateTime($data);
    return strftime('%A, %d de %B de %Y', $dateTime->getTimestamp());
}

function dataToTable($data)
{
    unset($data[0]['Tutor_Id']);
    unset($data[0]['Pet_Id']);
    unset($data[0]['id']);
    $table = '<table class="vertical-table">';
    foreach ($data as $itens) {
        foreach ($itens as $key => $value) {
            $table .= '<tr>';
            $table .= '<th>' . getLabel($key) . '</th>';
            $table .= '<td>' . $value . '</td>';
            $table .= '</tr>';
        }
    }
    $table .= '</table>';
    return $table;
}

function getLabel($key)
{
    $mapeamento = [
        'Email' => 'E-mail',
        'Endereco' => 'Endereço',
        'Especie' => 'Espécie',
        'NomePet' => 'Nome Pet',
        'NomeTutor' => 'Nome Tutor',
        'Numero' => 'Número',
        'Observacoes' => 'Observações',
        'Servico' => 'Serviço',
    ];

    if (array_key_exists($key, $mapeamento)) {
        return $mapeamento[$key];
    }

    return $key;
}
