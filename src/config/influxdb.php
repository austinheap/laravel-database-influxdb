<?php
/**
 * src/config/influxdb.php.
 *
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.1.5
 */

return [

    'protocol'   => env('INFLUXDB_PROTOCOL', 'http'),

    'user'       => env('INFLUXDB_USER', null),

    'pass'       => env('INFLUXDB_PASS', null),

    'host'       => env('INFLUXDB_HOST', 'localhost'),

    'port'       => env('INFLUXDB_PORT', 8086),

    'database'   => env('INFLUXDB_DATABASE', 'default'),

    'queue'      => [

        'enable' => env('INFLUXDB_QUEUE_ENABLE', false),

        'name'   => env('INFLUXDB_QUEUE_NAME', 'default'),

    ],

    'log'        => [

        'monolog' => env('INFLUXDB_LOG_MONOLOG', true),

        'level'   => env('INFLUXDB_LOG_LEVEL', 'DEBUG'),

        'limit'   => env('INFLUXDB_LOG_LIMIT', 5),

    ],

    'timeout'       => env('INFLUXDB_TIMEOUT', 5),

    'verify_ssl'       => env('INFLUXDB_VERIFY_SSL', true),

];
