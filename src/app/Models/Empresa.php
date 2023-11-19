<?php

namespace App\Models;

use App\Core\Database\Database;
use PDO;

class Empresa
{

    public string $cnpj;
    public string $nome_fantasia;
    public string $cep;

    public static function fetchAll(): array
    {
        $data = (new Database('empresa'))->select()->fetchAll(PDO::FETCH_CLASS, self::class);
        return $data;
    }
}