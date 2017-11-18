<?php
/**
 * src/Jobs/Write.php.
 *
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.1.6
 */
declare(strict_types=1);

namespace AustinHeap\Database\InfluxDb\Jobs;

use AustinHeap\Database\InfluxDb\InfluxDbServiceProvider;

/**
 * Class Write.
 */
class Write extends Job
{
    /**
     * @var string|array
     */
    public $payload = null;

    /**
     * @var array
     */
    public $parameters = null;

    /**
     * Write constructor.
     *
     * @param array        $parameters
     * @param string|array $payload
     */
    public function __construct(array $parameters, $payload)
    {
        $this->parameters = $parameters;
        $this->payload = $payload;

        parent::__construct(
            [
                'parameters' => $parameters,
                'payload'    => $payload,
            ]
        );
    }

    /**
     * @return void
     */
    public function handle()
    {
        InfluxDbServiceProvider::getInstance()
                               ->write(
                                   $this->parameters,
                                   $this->payload
                               );
    }
}
