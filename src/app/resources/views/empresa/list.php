<?php include __DIR__ . '/../includes/pageHeader.php' ?>

<div class="container">
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Nome Fantasia</th>
                        <th scope="col">CEP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empresas as $empresa) { ?>
                        <tr>
                            <td scope="row"><?= $empresa->cnpj ?></td>
                            <td scope="row"><?= $empresa->nome_fantasia ?></td>
                            <td scope="row"><?= $empresa->cep ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/pageFooter.php' ?>