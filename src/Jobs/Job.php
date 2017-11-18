<?php
/**
 * src/Jobs/Job.php.
 *
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.1.6
 */
declare(strict_types=1);

namespace AustinHeap\Database\InfluxDb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class Job.
 */
class Job implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue;

    /**
     * @var array
     */
    public $args;

    /**
     * Write constructor.
     *
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        $this->queue = config('influxdb.queue.name', 'default');

        if (count($args)) {
            $this->args = $args;
        }
    }
}
