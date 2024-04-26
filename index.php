<?php
$time = time();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css?v=<?php echo $time; ?>" rel="stylesheet">
    <link rel="icon" href="imagens/favicon.ico" sizes="any">
    <title>Minha Agenda Pet</title>
</head>

<body>
    <main>
        <div class="container my-5">
            <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                    <div class="logo">
                        <img src="imagens/logo.svg" alt="logo">
                    </div>
                    <h1 class="display-4 fw-bold lh-1">Minha Agenda Pet</h1>
                    <p class="lead">
                        Com o aplicativo Minha Agenda Pet, você irá gerenciar agendamentos de banhos e tosas para pets de maneira eficiente e organizada.
                        Visualize todos os compromissos em um calendário intuitivo e mantenha o controle dos horários de seus atendimentos.
                    </p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                        <a href="/app-web-uniasselvi/" class="btn btn-secondary btn-lg px-4 me-md-2 fw-bold">Acessar</a>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                    <img class="rounded-lg-3" src="imagens/minha-agenda-pet-banner.jpg?v=3" alt="" width="720">
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>