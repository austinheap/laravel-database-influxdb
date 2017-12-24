<?php
/**
 * src/Jobs/WritePayload.php.
 *
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.1.7
 */
declare(strict_types=1);

namespace AustinHeap\Database\InfluxDb\Jobs;

use AustinHeap\Database\InfluxDb\InfluxDbServiceProvider;

/**
 * Class WritePayload.
 */
class WritePayload extends Job
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
     * @var string|array
     */
    public $payload = null;

    /**
     * @var string
     */
    public $precision = null;

    /**
     * @var string|null
     */
    public $retentionPolicy = null;

    /**
     * WritePayload constructor.
     *
     * @param  string|array $payload
     * @param  string       $precision
     * @param  string|null  $retentionPolicy
     */
    public function __construct($payload, $precision = self::PRECISION_SECONDS, $retentionPolicy = null)
    {
        $this->payload = $payload;
        $this->precision = $precision;
        $this->retentionPolicy = $retentionPolicy;

        parent::__construct(
            [
                'payload'         => $this->payload,
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
                               ->writePayload(
                                   $this->payload,
                                   $this->precision,
                                   $this->retentionPolicy
                               );
    }

    /**
     * @return array
     */
    public function tags(): array
    {
        return array_merge(parent::tags(), [static::class . ':' . (is_string($this->payload) ? 1 : count($this->payload))]);
    }
}
