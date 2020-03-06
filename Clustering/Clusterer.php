<?php

declare(strict_types=1);

namespace Clustering;

interface Clusterer
{
    public function cluster(array $samples): array;
}