<?php
/**
 * src/InfluxDbServiceProvider.php.
 *
 * @author      Austin Heap <me@austinheap.com>
 * @version     v0.1.6
 */
declare(strict_types=1);

namespace AustinHeap\Database\InfluxDb;

use Monolog\Logger;
use Illuminate\Log\Writer;
use Illuminate\Support\Facades\Log;
use InfluxDB\Client as InfluxClient;
use Illuminate\Support\ServiceProvider;
use AustinHeap\Database\InfluxDb\Logs\Formatter;
use InfluxDB\Client\Exception as ClientException;
use AustinHeap\Database\InfluxDb\Logs\MonologHandler;

/**
 * Class InfluxDbServiceProvider.
 */
class InfluxDbServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
                             __DIR__.'/config/influxdb.php' => config_path('influxdb.php'),
                         ]);

        $this->mergeConfigFrom(__DIR__.'/config/influxdb.php', 'influxdb');

        if (config('influxdb.log.monolog', false) === true) {
            $handler = new MonologHandler($this->getLoggingLevel());
            $handler->setFormatter(new Formatter());

            $monolog = Log::getMonolog();
            $monolog->pushHandler($handler);

            $new_log = new Writer($monolog, Log::getEventDispatcher());
            Log::swap($new_log);
        }
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('InfluxDb', function ($app) {
            try {
                $timeout = is_int(config('influxdb.timeout', null)) ? config('influxdb.timeout') : 5;
                $verifySsl = is_bool(config('influxdb.verify_ssl', null)) ? config('influxdb.verify_ssl') : true;
                $protocol = 'influxdb';

                if (in_array(config('influxdb.protocol'), ['https', 'udp'])) {
                    $protocol = config('influxdb.protocol').'+'.$protocol;
                }

                $dsn = sprintf('%s://%s:%s@%s:%s/%s',
                               $protocol,
                               config('influxdb.user'),
                               config('influxdb.pass'),
                               config('influxdb.host'),
                               config('influxdb.port'),
                               config('influxdb.database')
                );

                return InfluxClient::fromDSN($dsn, $timeout, $verifySsl);
            } catch (ClientException $exception) {
                throw $exception;
            }
        });
    }

    /**
     * @return \Illuminate\Config\Repository|int|mixed|string
     */
    private function getLoggingLevel()
    {
        $level = config('influxdb.log.level', 'DEBUG');
        $level = empty($level) ? 'DEBUG' : $level;

        return in_array($level, [
            'DEBUG',
            'INFO',
            'NOTICE',
            'WARNING',
            'ERROR',
            'CRITICAL',
            'ALERT',
            'EMERGENCY',
        ]) ? $level : Logger::DEBUG;
    }

    /**
     * @return \InfluxDB\Client|\InfluxDB\Database
     */
    public static function getInstance()
    {
        return app('InfluxDb');
    }
}
