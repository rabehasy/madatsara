<?php

namespace App\Loader;

use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ObjectRepository;

interface TranslationRepositoryInterface extends ObjectRepository
{
    /**
     * @return array|Collection|EntityInterface[]
     */
    public function findByDomainAndLocale(string $domain, string $locale);
}
