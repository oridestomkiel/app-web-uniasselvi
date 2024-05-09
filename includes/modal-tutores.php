<!-- Modal Add -->
<div class="modal fade" id="AddTutor" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddModalLabel">Adicionar Tutor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 form-add" id="addTutorForm" action="tutores.php" method="POST">
                    <div class="col-md-12">
                        <label for="recipient-Nome" class="col-form-label">Nome: *</label>
                        <input type="text" class="form-control" id="recipient-Nome" name="Nome">
                    </div>
                    <div class="col-md-12">
                        <label for="recipient-Email" class="col-form-label">E-mail: *</label>
                        <input type="email" class="form-control" id="recipient-Email" name="Email">
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-Telefone" class="col-form-label">Telefone: *</label>
                        <input type="text" class="form-control" id="recipient-Telefone" name="Telefone">
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-CEP" class="col-form-label">CEP: *</label>
                        <input type="text" class="form-control recipient-CEP" id="recipient-CEP" name="CEP">
                    </div>
                    <div class="col-md-9">
                        <label for="recipient-Endereco" class="col-form-label">Endereço: *</label>
                        <input type="text" class="form-control recipient-Endereco" id="recipient-Endereco" name="Endereco">
                    </div>
                    <div class="col-md-3">
                        <label for="recipient-Numero" class="col-form-label">Número: *</label>
                        <input type="text" class="form-control recipient-Numero" id="recipient-Numero" name="Numero">
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-Bairro" class="col-form-label">Bairro: *</label>
                        <input type="text" class="form-control recipient-Bairro" id="recipient-Bairro" name="Bairro">
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-Complemento" class="col-form-label">Complemento:</label>
                        <input type="text" class="form-control recipient-Complemento" id="recipient-Complemento" name="Complemento">
                    </div>
                    <div class="col-md-5">
                        <label for="recipient-Estado" class="col-form-label">Estado: *</label>
                        <select class="form-select" id="recipient-Estado" aria-label="Select Estado" name="Estado">
                            <option value="">Selecione</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                    <div class="col-md-7">
                        <label for="recipient-Cidade" class="col-form-label">Cidade: *</label>
                        <input type="text" class="form-control recipient-Cidade" id="recipient-Cidade" name="Cidade">
                    </div>
                    <div class="col-md-12">
                        * Campos Obrigatórios
                    </div>
                    <input type="hidden" name="action" value="add">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success btn-add-form" data-add="tutores" data-action="add" data-form="addTutorForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edt -->
<div class="modal fade" id="EdtTutor" tabindex="-1" aria-labelledby="EdtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EdtModalLabel">Editar Tutor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 form-edt" id="edtTutorForm" action="tutores.php" method="POST">
                    <div class="col-md-12">
                        <label for="recipient-Nome" class="col-form-label">Nome: *</label>
                        <input type="text" class="form-control" id="recipient-Nome" name="Nome">
                    </div>
                    <div class="col-md-12">
                        <label for="recipient-Email" class="col-form-label">E-mail: *</label>
                        <input type="email" class="form-control" id="recipient-Email" name="Email">
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-Telefone" class="col-form-label">Telefone: *</label>
                        <input type="text" class="form-control" id="recipient-Telefone" name="Telefone">
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-CEP" class="col-form-label">CEP: *</label>
                        <input type="text" class="form-control recipient-CEP" id="recipient-CEP" name="CEP">
                    </div>
                    <div class="col-md-9">
                        <label for="recipient-Endereco" class="col-form-label">Endereço: *</label>
                        <input type="text" class="form-control recipient-Endereco" id="recipient-Endereco" name="Endereco">
                    </div>
                    <div class="col-md-3">
                        <label for="recipient-Numero" class="col-form-label">Número: *</label>
                        <input type="text" class="form-control recipient-Numero" id="recipient-Numero" name="Numero">
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-Bairro" class="col-form-label">Bairro: *</label>
                        <input type="text" class="form-control recipient-Bairro" id="recipient-Bairro" name="Bairro">
                    </div>
                    <div class="col-md-6">
                        <label for="recipient-Complemento" class="col-form-label">Complemento:</label>
                        <input type="text" class="form-control recipient-Complemento" id="recipient-Complemento" name="Complemento">
                    </div>
                    <div class="col-md-5">
                        <label for="recipient-Estado" class="col-form-label">Estado: *</label>
                        <select class="form-select" id="recipient-Estado" aria-label="Select Estado" name="Estado">
                            <option value="">Selecione</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                    <div class="col-md-7">
                        <label for="recipient-Cidade" class="col-form-label">Cidade: *</label>
                        <input type="text" class="form-control recipient-Cidade" id="recipient-Cidade" name="Cidade">
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
                <button type="button" class="btn btn-primary btn-edt-form" data-add="tutores" data-action="edt" data-form="edtTutorForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View -->
<div class="modal fade" id="ViewTutor" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ViewModalLabel">Visualizar Tutor</h1>
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
<div class="modal fade" id="DelTutor" tabindex="-1" aria-labelledby="DelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DelModalLabel">Apagar Tutor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-container-del"></div>
            </div>
            <form class="row g-3 form-del" id="delTutorForm" action="tutores.php" method="POST">
                <input type="hidden" name="idDel" id="idDel" value="edt">
                <input type="hidden" name="action" value="del">
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger btn-del-form" data-del="tutores">Apagar</button>
            </div>
        </div>
    </div>
</div>