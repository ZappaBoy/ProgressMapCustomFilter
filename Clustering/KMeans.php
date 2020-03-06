<?php

declare(strict_types=1);

namespace Clustering;

use Clustering\KMeans\Space;
use InvalidArgumentException;
require_once plugin_dir_path( __FILE__ ) . "KMeans/Space.php";
require_once plugin_dir_path( __FILE__ ) . "InvalidArgumentException.php";
require_once plugin_dir_path( __FILE__ ) . "Clusterer.php";

class KMeans implements Clusterer
{
    public const INIT_RANDOM = 1;

    public const INIT_KMEANS_PLUS_PLUS = 2;

    /**
     * @var int
     */
    private $clustersNumber;

    /**
     * @var int
     */
    private $initialization;

    public function __construct(int $clustersNumber, int $initialization = self::INIT_KMEANS_PLUS_PLUS)
    {
        if ($clustersNumber <= 0) {
            throw new InvalidArgumentException('Invalid clusters number');
        }

        $this->clustersNumber = $clustersNumber;
        $this->initialization = $initialization;
    }

    public function cluster(array $samples): array
    {
        $space = new Space(count(reset($samples)));
        foreach ($samples as $key => $sample) {
            $space->addPoint($sample, $key);
        }

        $clusters = [];
        foreach ($space->cluster($this->clustersNumber, $this->initialization) as $cluster) {
            $clusters[] = $cluster->getPoints();
        }

        return $clusters;
    }
}