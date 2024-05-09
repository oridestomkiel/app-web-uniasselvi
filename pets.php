<?php include 'includes/head.php'; ?>
<?php include 'controller/pets.php'; ?>
<main>
    <div class="container py-3">
        <?php include 'includes/header.php'; ?>
        <div class="table-responsive">
            <?php
            if ($numTutores == 0) {
            ?>
                <div class="card bg-warning mb-3">
                    <div class="card-header">
                        É necessário criar um novo Tutor antes de cadastrar um Pet, <a class="card-header-link" href="tutores.php">clique aqui para cadastrar um Tutor</a>.
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="add-btn d-flex justify-content-between">
                    <div class="d-grid gap-2">
                        <?php if ($limparFiltro) { ?>
                            <a href="pets.php" class="btn btn-dark" title="Limpar Filtro">Limpar Filtro</a>
                        <?php } else { ?>
                            <form class="row g-3 form-search" id="searchPetForm" action="pets.php" method="POST">
                                <div class="input-group">
                                    <input class="form-control" type="search" placeholder="Pesquisar" aria-label="Pesquisar" name="searchText" id="searchText">
                                    <input type="hidden" name="search" value="search">
                                    <button class="btn btn-dark bt-search" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-secondary btn-add" data-type="pets" type="button" data-bs-toggle="modal" data-bs-target="#AddPet">
                            <?php include 'includes/pet-icon.php' ?>
                            Adicionar Pet
                        </button>
                    </div>
                </div>
            <?php } ?>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="col-4">Nome Tutor</th>
                        <th scope="col" class="col-4">Nome Pet</th>
                        <th scope="col" class="col-2">Espécie</th>
                        <th scope="col" class="col-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $dataString = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                    ?>
                            <tr id="Pet-<?php echo $row["id"]; ?>" data-info='<?php echo $dataString; ?>'>
                                <td><?php echo $row["NomeTutor"]; ?></td>
                                <td><?php echo $row["Nome"]; ?></td>
                                <td><?php echo $row["Especie"]; ?></td>
                                <td>
                                    <div class="d-flex">
                                        <div>
                                            <button type="button" class="btn btn-view" id="Id-<?php echo $row["id"]; ?>" data-type="Pet" data-bs-toggle="modal" data-bs-target="#ViewPet">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-edt" id="Id-<?php echo $row["id"]; ?>" data-type="Pet" data-bs-toggle="modal" data-bs-target="#EdtPet">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-del" id="Id-<?php echo $row["id"]; ?>" data-type="Pet" data-bs-toggle="modal" data-bs-target="#DelPet">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">Nenhum registo encontrado</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <?php include 'includes/modal-pets.php'; ?>
</main>
<?php include 'includes/footer.php'; ?>