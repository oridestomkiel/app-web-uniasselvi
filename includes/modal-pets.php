<!-- Modal Add -->
<div class="modal fade" id="AddPet" aria-labelledby="AddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddModalLabel">Adicionar Pet</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 form-add" id="addPetForm" action="pets.php" method="POST">
                    <div class="col-md-12">
                        <label for="recipient-Tutor" class="col-form-label">Tutor: *</label>
                        <select class="form-select" id="recipient-Tutor" aria-label="Select Tutor" name="Tutor">
                            <option value="">Selecione</option>
                            <?php
                            if ($tutores->num_rows > 0) {
                                while ($row = $tutores->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row["Nome"], ENT_QUOTES, 'UTF-8') . '</option>';
                                }
                            } else {
                                echo '<option value="">Nenhum tutor encontrado</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="recipient-Nome" class="col-form-label">Nome Pet: *</label>
                        <input type="text" class="form-control" id="recipient-Nome" name="Nome">
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-Especie" class="col-form-label">Espécie: *</label>
                        <select class="form-select" id="recipient-Especie" aria-label="Select Especie" name="Especie">
                            <option value="">Selecione</option>
                            <option value="Cão">Cão</option>
                            <option value="Gato">Gato</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-Sexo" class="col-form-label">Sexo: *</label>
                        <select class="form-select" id="recipient-Sexo" aria-label="Select Sexo" name="Sexo">
                            <option value="">Selecione</option>
                            <option value="Macho">Macho</option>
                            <option value="Fêmea">Fêmea</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="recipient-Observacoes" class="col-form-label">Observaçoẽs:</label>
                        <textarea name="Observacoes" class="form-control" id="recipient-Observacoes"></textarea>
                    </div>
                    <div class="col-md-12">
                        * Campos Obrigatórios
                    </div>
                    <input type="hidden" name="action" value="add">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success btn-add-form" data-add="pets" data-action="add" data-form="addPetForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edt -->
<div class="modal fade" id="EdtPet" aria-labelledby="EdtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EdtModalLabel">Editar Pet</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 form-edt" id="edtPetForm" action="pets.php" method="POST">
                    <div class="col-md-12">
                        <label for="recipient-Tutor" class="col-form-label">Tutor: *</label>
                        <select class="form-select" id="recipient-Tutor" aria-label="Select Tutor" name="Tutor">
                            <option value="">Selecione</option>
                            <?php
                            if ($tutoresS->num_rows > 0) {
                                while ($row = $tutoresS->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row["Nome"], ENT_QUOTES, 'UTF-8') . '</option>';
                                }
                            } else {
                                echo '<option value="">Nenhum tutor encontrado</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="recipient-Nome" class="col-form-label">Nome Pet: *</label>
                        <input type="text" class="form-control" id="recipient-Nome" name="Nome">
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-Especie" class="col-form-label">Espécie: *</label>
                        <select class="form-select" id="recipient-Especie" aria-label="Select Especie" name="Especie">
                            <option value="">Selecione</option>
                            <option value="Cão">Cão</option>
                            <option value="Gato">Gato</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-Sexo" class="col-form-label">Sexo: *</label>
                        <select class="form-select" id="recipient-Sexo" aria-label="Select Sexo" name="Sexo">
                            <option value="">Selecione</option>
                            <option value="Macho">Macho</option>
                            <option value="Fêmea">Fêmea</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="recipient-Observacoes" class="col-form-label">Observaçoẽs:</label>
                        <textarea name="Observacoes" class="form-control" id="recipient-Observacoes"></textarea>
                    </div>
                    <div class="col-md-12">
                        * Campos Obrigatórios
                    </div>
                    <input type="hidden" name="idEdt" id="recipient-Id" value="">
                    <input type="hidden" name="action" value="edt">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary btn-edt-form" data-add="pets" data-action="edt" data-form="edtPetForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View -->
<div class="modal fade" id="ViewPet" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ViewModalLabel">Visualizar Pet</h1>
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
<div class="modal fade" id="DelPet" tabindex="-1" aria-labelledby="DelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DelModalLabel">Apagar Pet</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-container-del"></div>
            </div>
            <form class="row g-3 form-del" id="delPetForm" action="pets.php" method="POST">
                <input type="hidden" name="idDel" id="idDel" value="edt">
                <input type="hidden" name="action" value="del">
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger btn-del-form" data-del="pets">Apagar</button>
            </div>
        </div>
    </div>
</div>