<?php include 'includes/head.php'; ?>
<?php include 'controller/agenda.php'; ?>
<main>
    <div class="container py-3">
        <?php include 'includes/header.php'; ?>
        <div class="table-responsive">
            <?php
            if ($numTutores == 0 && $numPets == 0) {
            ?>
                <div class="card bg-warning mb-3">
                    <div class="card-header">
                        É necessário criar um novo Tutor e Pet antes de cadastrar uma Agenda, <a class="card-header-link" href="tutores.php">clique aqui para cadastrar um Tutor</a>.
                    </div>
                </div>
            <?php
            } else if ($numPets == 0) {
            ?>
                <div class="card bg-warning mb-3">
                    <div class="card-header">
                        É necessário criar um novo Pet antes de cadastrar uma Agenda, <a class="card-header-link" href="pets.php">clique aqui para cadastrar um Pet</a>.
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="add-btn d-flex justify-content-between">
                    <div class="d-grid gap-2">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group datas" role="group" aria-label="First group">
                                <a href="agenda.php?data=<?php echo $previousDateFormatted; ?>" title="<?php echo $previousDateFormatted; ?>" type="button" class="btn btn-secondary"><i class="bi bi-arrow-left"></i></a>
                                <button type="button" class="btn btn-secondary databt" disabled><?php echo $calendarData; ?></button>
                                <a href="agenda.php" type="button" title="Mostrar agenda de hoje" class="btn btn-dark hojebt">hoje</a>
                                <a href="agenda.php?data=<?php echo $nextDateFormatted; ?>" title="<?php echo $nextDateFormatted; ?>" type="button" class="btn btn-secondary"><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <input id="dateSearch" name="dateSearch" />
                    </div>
                </div>
                <div id="agendaLotada">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-header" id="agendaAviso"></div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="col-1">Horário</th>
                            <th scope="col" class="col-4">Tutor</th>
                            <th scope="col" class="col-3">Pet</th>
                            <th scope="col" class="col-2">Serviço</th>
                            <th scope="col" class="col-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $horasVagas = "";
                        for ($hora = 8; $hora < 18; $hora++) {
                            $almoco = ($hora == 12);
                            $hora_formatada = str_pad($hora, 2, '0', STR_PAD_LEFT) . ':00';
                            $classes = [];
                            if ($almoco) {
                                $classes[] = 'table-secondary';
                            } else {
                                if (isset($agendamentos[$hora])) {
                                    $classes[] = 'table-danger';
                                } else {
                                    $classes[] = 'table-success';
                                }
                            }
                            $classString = implode(' ', $classes);
                        ?>

                            <?php if (isFeriado($selectData)) { ?>
                                <tr class="table-secondary agendaFechada">
                                    <td><?php echo $hora_formatada; ?></td>
                                    <td colspan="4">Feriado</td>
                                </tr>
                            <?php } else if (isFimDeSemana($selectData)) { ?>
                                <tr class="table-secondary agendaFechada">
                                    <td><?php echo $hora_formatada; ?></td>
                                    <td colspan="4">Fim de semana</td>
                                </tr>
                            <?php } else { ?>

                                <tr id="Agenda-<?php echo $agendamentos[$hora][0]['id']; ?>" class="<?php echo $classString; ?>" data-info="<?php echo $agendamentos[$hora][0]['dataString'] ?>">
                                    <td><?php echo $hora_formatada; ?></td>
                                    <?php
                                    if (isset($agendamentos[$hora])) {
                                        $agendamento = $agendamentos[$hora][0];
                                    ?>
                                        <td><a href="javascript:;" class="view-modal-dynamic" data-type="Tutor" data-id="<?php echo $agendamento["Tutor_id"]; ?>"><?php echo htmlspecialchars($agendamento["NomeTutor"]); ?> <i class="bi bi-box-arrow-up-right"></i></a></td>
                                        <td><a href="javascript:;" class="view-modal-dynamic" data-type="Pet" data-id="<?php echo $agendamento["Pet_id"]; ?>"><?php echo htmlspecialchars($agendamento["NomePet"]); ?> <i class="bi bi-box-arrow-up-right"></i></a></td>
                                        <td><?php echo htmlspecialchars($agendamento["Servico"]); ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-view" id="Id-<?php echo $agendamento["id"]; ?>" data-data="<?php echo $calendarData; ?>" data-type="Agenda" data-bs-toggle="modal" data-bs-target="#ViewAgenda">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-edt" id="Id-<?php echo $agendamento["id"]; ?>" data-data="<?php echo $calendarData; ?>" data-type="Agenda" data-bs-toggle="modal" data-bs-target="#EdtAgenda">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-del" id="Id-<?php echo $agendamento["id"]; ?>" data-data="<?php echo $calendarData; ?>" data-type="Agenda" data-bs-toggle="modal" data-bs-target="#DelAgenda">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </td>
                                    <?php
                                    } else {
                                        if (!$almoco) {
                                            $horasVagas .= '<option value="' . $hora . '">' . $hora_formatada . '</option>';
                                        }
                                    ?>
                                        <td colspan="3"><?php echo ($almoco ? 'Horário de almoço' : 'Horário livre'); ?></td>
                                        <td>
                                            <?php echo ($almoco ? '' : '
                                    <button type="button" class="btn btn-add" data-data="' . $calendarData . '" data-hora="' . $hora . '" data-type="Agenda" data-bs-toggle="modal" data-bs-target="#AddAgenda">
                                        <i class="bi bi-calendar-plus"></i>
                                    </button>'); ?>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
    <?php include 'includes/modal-agenda.php'; ?>
</main>
<?php include 'includes/footer.php'; ?>