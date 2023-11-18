<?php

namespace App\Core\Http;

class HttpStatus
{
    const OK = 200;
    const NOT_FOUND = 404;
    const CREATED = 201;
    const BAD_REQUEST = 400;
    const INTERNAL_SERVER_ERROR = 500;
    const METHOD_NOT_ALLOWED = 405;
}