<?php

namespace Tax\Services;

interface ServiceInterface
{

    public function validate(): bool;

    public function getBody(): array;

    public function getServiceId(): string;
}
