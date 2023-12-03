<?php

use CleaniqueCoders\LaravelDbDoc\LaravelDbDoc;

if (app()->environment() != 'production') {
    LaravelDbDoc::routes();
}
