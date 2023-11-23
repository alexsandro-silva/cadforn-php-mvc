<?php include __DIR__ . '/../includes/pageHeader.php' ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a href="/empresa/register" class="btn btn-primary">Nova Empresa</a>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Nome Fantasia</th>
                        <th scope="col">CEP</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empresas as $empresa) { ?>
                        <tr>
                            <td scope="row"><?= $empresa->cnpj ?></td>
                            <td scope="row"><?= $empresa->nome_fantasia ?></td>
                            <td scope="row"><?= $empresa->cep ?></td>
                            <td>
                                <a href="/empresa/<?= $empresa->id ?>/edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href="/empresa/<?= $empresa->id ?>/delete"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/pageFooter.php' ?>