<?php

namespace App\Contracts\Interfaces;

interface ContactRepositoryInterface
{
    public function getContact();
    public function updateContact(array $data);
}
