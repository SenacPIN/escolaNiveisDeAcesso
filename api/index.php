<?php

header("Content-Type: application/json");

echo json_encode([
    "api"=>"Escola",
    "versao"=>"1.0",
    "status"=>"Online"
]);