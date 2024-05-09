<!-- Modal Add -->
<div class="modal fade" id="AddAgenda" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddModalLabel">Adicionar Agenda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 form-add" id="addAgendaForm" action="" method="POST">
                    <div class="col-md-6">
                        <label for="recipient-Tutor" class="col-form-label">Tutor: *</label>
                        <select class="form-select" id="recipient-Tutor" data-act="add" aria-label="Select Tutor" name="Tutor">
                            <option value="">Selecione</option>
                            <?php
                            if ($tutoresResult->num_rows > 0) {
                                while ($row = $tutoresResult->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row["Nome"], ENT_QUOTES, 'UTF-8') . '</option>';
                                }
                            } else {
                                echo '<option value="">Nenhum tutor encontrado</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="recipient-Pet" class="col-form-label">Pet: *</label>
                        <select class="form-select" id="recipient-Pet" aria-label="Select Pet" name="Pet">
                            <option value="">Selecione um Tutor</option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label for="recipient-Data" class="col-form-label">Data:</label>
                        <input type="text" class="form-control" id="recipient-dataAgenda" name="dataAgenda">
                    </div>
                    <div class="col-md-3">
                        <label for="recipient-Hora" class="col-form-label">Hora:</label>
                        <select class="form-select" id="recipient-Hora" aria-label="Select Hora" name="Hora">
                            <option value="">Selecione</option>
                            <?php echo $horasVagas; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="recipient-Servico" class="col-form-label">Serviço:</label>
                        <select class="form-select" id="recipient-Servico" aria-label="Select Servico" name="Servico">
                            <option value="">Selecione</option>
                            <option value="Banho">Banho</option>
                            <option value="Tosa">Tosa</option>
                        </select>
                    </div>
                    <input type="hidden" name="action" value="add">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success btn-add-form" data-add="Agenda" data-action="add" data-form="addAgendaForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edt -->
<div class="modal fade" id="EdtAgenda" tabindex="-1" aria-labelledby="EdtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EdtModalLabel">Editar Agenda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 form-edt" id="edtAgendaForm" action="" method="POST">
                    <div class="col-md-6">
                        <label for="recipient-Tutor" class="col-form-label">Tutor: *</label>
                        <select class="form-select" id="recipient-Tutor" data-act="edt" aria-label="Select Tutor" name="Tutor">
                            <option value="">Selecione</option>
                            <?php
                            if ($tutoresResultEdt->num_rows > 0) {
                                while ($row = $tutoresResultEdt->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row["Nome"], ENT_QUOTES, 'UTF-8') . '</option>';
                                }
                            } else {
                                echo '<option value="">Nenhum tutor encontrado</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="recipient-Pet" class="col-form-label">Pet: *</label>
                        <select class="form-select recipient-Pet" id="recipient-Pet" aria-label="Select Pet" name="Pet">
                            <option value="">Selecione um Tutor</option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label for="recipient-dataAgendaEdt" class="col-form-label">Data:</label>
                        <input type="text" class="form-control" id="recipient-dataAgendaEdt" name="dataAgenda">
                    </div>
                    <div class="col-md-3">
                        <label for="recipient-Hora" class="col-form-label">Hora:</label>
                        <select class="form-select" id="recipient-Hora" aria-label="Select Hora" name="Hora">
                            <option value="">Selecione</option>
                        </select>
                        <div class="d-none optHorasVagas">
                            <?php echo $horasVagas; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="recipient-Servico" class="col-form-label">Serviço:</label>
                        <select class="form-select" id="recipient-Servico" aria-label="Select Servico" name="Servico">
                            <option value="">Selecione</option>
                            <option value="Banho">Banho</option>
                            <option value="Tosa">Tosa</option>
                        </select>
                    </div>
                    <input type="hidden" name="idEdt" id="recipient-Id" value="">
                    <input type="hidden" name="action" value="edt">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success btn-edt-form" data-add="Agenda" data-action="edt" data-form="edtAgendaForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View -->
<div class="modal fade" id="ViewAgenda" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ViewModalLabel">Visualizar Agenda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="table-container-info"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Del -->
<div class="modal fade" id="DelAgenda" tabindex="-1" aria-labelledby="DelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DelModalLabel">Apagar Agenda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-container-del"></div>
            </div>
            <form class="row g-3 form-del" id="delAgendaForm" action="agenda.php" method="POST">
                <input type="hidden" name="idDel" id="idDel" value="edt">
                <input type="hidden" name="selectData" id="selectData" value="<?php echo $selectData; ?>">
                <input type="hidden" name="action" value="del">
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger btn-del-form" data-del="agendas">Apagar</button>
            </div>
        </div>
    </div>
</div>