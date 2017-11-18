<?php
/**
 * src/InfluxDbFacade.php.
 *
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.1.6
 */
declare(strict_types=1);

namespace AustinHeap\Database\InfluxDb;

use Illuminate\Support\Facades\Facade;
use Illuminate\Queue\InteractsWithQueue;
use AustinHeap\Database\InfluxDb\Jobs\Write;
use AustinHeap\Database\InfluxDb\Jobs\WritePoints;
use AustinHeap\Database\InfluxDb\Jobs\WritePayload;

/**
 * Class InfluxDbFacade.
 */
class InfluxDbFacade extends Facade
{
    use InteractsWithQueue;

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'InfluxDb';
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        switch ($method) {
            case 'write':
            case 'writePoints':
            case 'writePayload':
                return static::$method(...$arguments);
            default:
                return static::getFacadeRoot()
                             ->$method(...$arguments);
        }
    }

    /**
     * @param array $parameters
     * @param string|array $payload
     *
     * @return bool
     */
    public static function write(array $parameters, $payload): bool
    {
        if (config('influxdb.queue.enable', false) === true) {
            Write::dispatch($parameters, $payload);
        } else {
            return static::getFacadeRoot()
                         ->write($parameters, $payload);
        }

        return true;
    }

    /**
     * @param  string|array $payload
     * @param  string       $precision
     * @param  string|null  $retentionPolicy
     *
     * @return bool
     */
    public static function writePayload(
        $payload,
        $precision = WritePayload::PRECISION_NANOSECONDS,
        $retentionPolicy = null
    ): bool {
        if (config('influxdb.queue.enable', false) === true) {
            WritePayload::dispatch($payload, $precision, $retentionPolicy);
        } else {
            return static::getFacadeRoot()
                         ->writePayload($payload, $precision, $retentionPolicy);
        }

        return true;
    }

    /**
     * @param  \InfluxDB\Point[] $points
     * @param  string            $precision
     * @param  string|null       $retentionPolicy
     *
     * @return bool
     */
    public static function writePoints(
        array $points,
        $precision = WritePoints::PRECISION_NANOSECONDS,
        $retentionPolicy = null
    ): bool {
        if (config('influxdb.queue.enable', false) === true) {
            WritePoints::dispatch($points, $precision, $retentionPolicy);
        } else {
            return static::getFacadeRoot()
                         ->writePoints($points, $precision, $retentionPolicy);
        }

        return true;
    }
}
