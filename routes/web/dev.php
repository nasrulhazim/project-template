<?php

use Bekwoh\LaravelDbDoc\LaravelDbDoc;

if (app()->environment() != 'production') {
    LaravelDbDoc::routes();
}
