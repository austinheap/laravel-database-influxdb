<?php
/**
 * src/helpers.php.
 *
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.1.5
 */
declare(strict_types=1);

if (! function_exists('influxdb')) {
    /**
     * @return \InfluxDB\Client|\InfluxDB\Database
     */
    function influxdb()
    {
        return \AustinHeap\Database\InfluxDb\InfluxDbServiceProvider::getInstance();
    }
}
