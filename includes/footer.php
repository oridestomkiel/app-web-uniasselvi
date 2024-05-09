<div id="loadingOverlay">
    <div class=" spinner-border text-light" role="status">
        <span class="visually-hidden">Carregando...</span>
    </div>
</div>

<!-- Modal Alunos -->
<div class="modal fade" id="ViewAlunos" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ViewModalLabel">Alunos Uniasselvi - Grupo 1</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">João Otavio Fontes Rodrigues</li>
                    <li class="list-group-item">Orides Tomkiel Zmovirzynski</li>
                    <li class="list-group-item">Rafael Mendes de Carvalho</li>
                    <li class="list-group-item">Wellington de Oliveira Zmovirzynski</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dinamica -->
<div class="modal fade" id="ViewModalDinamic" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ViewModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/messages/messages.pt-br.js" type="text/javascript"></script>
<script src="js/script.js?v=<?php echo $time; ?>"></script>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container" style="position:relative">
        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#ViewAlunos" class="linkAlunos">
            <span class="text-muted">&copy; <?php echo date("Y"); ?> - Alunos Uniasselvi - Grupo 1</span>
        </a>
        <?php
        if ($horasVagas != "" && $_SERVER['PHP_SELF'] = "/app-web-uniasselvi/agenda.php") { ?>
            <div class="fixedButton">
                <button type="button" class="btn btn-success btn-round btn-add" data-data="<?php echo $calendarData; ?>" data-hora="" data-type="Agenda" data-bs-toggle="modal" data-bs-target="#AddAgenda">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        <?php } ?>
    </div>
</footer>
</body>

</html>
<?php include 'includes/message.php'; ?>
<?php $conn->close(); ?>