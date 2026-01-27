<?php

namespace App\Contracts\Interfaces;

interface AboutPageRepositoryInterface
{
    /**
     * Get the about page content.
     *
     * @return object|null
     */
    public function getContent();

    /**
     * Update the about page content.
     *
     * @param array $data
     * @return object
     */
    public function updateContent(array $data);
}
