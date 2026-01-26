<?php
namespace App\Interfaces;

interface BankParser
{
    public function parse(string $payload): array;
}
