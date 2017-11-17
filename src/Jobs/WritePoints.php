<?php
/**
 * src/Jobs/WritePoints.php.
 *
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.1.5
 */
declare(strict_types=1);

namespace AustinHeap\Database\InfluxDb\Jobs;

use AustinHeap\Database\InfluxDb\InfluxDbServiceProvider;

/**
 * Class WritePoints.
 */
class WritePoints extends Job
{
    /**
     * @var string PRECISION_NANOSECONDS
     */
    const PRECISION_NANOSECONDS = 'n';

    /**
     * @var string PRECISION_MICROSECONDS
     */
    const PRECISION_MICROSECONDS = 'u';

    /**
     * @var string PRECISION_MILLISECONDS
     */
    const PRECISION_MILLISECONDS = 'ms';

    /**
     * @var string PRECISION_SECONDS
     */
    const PRECISION_SECONDS = 's';

    /**
     * @var string PRECISION_MINUTES
     */
    const PRECISION_MINUTES = 'm';

    /**
     * @var string PRECISION_HOURS
     */
    const PRECISION_HOURS = 'h';

    /**
     * @var array
     */
    public $points = null;

    /**
     * @var string
     */
    public $precision = null;

    /**
     * @var string|null
     */
    public $retentionPolicy = null;

    /**
     * WritePoints constructor.
     *
     * @param  \InfluxDB\Point[] $points
     * @param  string            $precision
     * @param  string|null       $retentionPolicy
     */
    public function __construct(array $points, $precision = self::PRECISION_NANOSECONDS, $retentionPolicy = null)
    {
        $this->points = $points;
        $this->precision = $precision;
        $this->retentionPolicy = $retentionPolicy;

        parent::__construct(
            [
                'points'          => $this->points,
                'precision'       => $this->precision,
                'retentionPolicy' => $this->retentionPolicy,
            ]
        );
    }

    /**
     * @return void
     */
    public function handle()
    {
        InfluxDbServiceProvider::getInstance()
                               ->writePoints(
                                   $this->points,
                                   $this->precision,
                                   $this->retentionPolicy
                               );
    }
}
