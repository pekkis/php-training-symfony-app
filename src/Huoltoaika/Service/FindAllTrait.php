<?php

namespace Huoltoaika\Service;

trait FindAllTrait
{
    public function findAll()
    {
        return $this->repository->findAll();
    }
}