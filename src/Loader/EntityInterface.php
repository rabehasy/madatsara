<?php

namespace App\Loader;

interface EntityInterface
{
    /**
     * Load translated string.
     */
    public function getTranslation(): ?string;

    /**
     * Load data to entity.
     * For example: imagine that entity has `domain`, `locale`, `key` and `translation` params
     * This method may be called as
     * ```
     * $entity->load([
     *    'domain' => $domain,
     *    'locale' => $locale,
     *    'key' => $key,
     *    'translation' => $translation,
     * ]);
     * ```
     * and return valid entity for store in database.
     *
     * @return EntityInterface
     */
    public function load(array $params): self;
}
