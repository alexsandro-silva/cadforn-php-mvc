<?php include __DIR__ . '/../includes/pageHeader.php' ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <h3>Cadastro de empresa</h3>
            <hr>

            <form method="post" action="/empresa/register">
                <div class="mb-3">
                    <label for="cnpjInput" class="form-label">CNPJ</label>
                    <input type="text" class="form-control" id="cnpjInput">
                </div>
                <div class="mb-3">
                    <label for="nomeInput" class="form-label">Nome Fantasia</label>
                    <input type="text" class="form-control" id="nomeInput">
                </div>
                <div class="mb-3">
                    <label for="cepInput" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cepInput">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/pageFooter.php' ?>