<?php

namespace App\Commands;

use App\Http\HttpServer;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Forward extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'forward
        {host : Full URL of the destination server.}
        {--headers= : JSON encoded headers to send to the destination server.}
        {--port= : Port to listen on. Default=1337}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Starts an HTTP server to forward requests to the destination server.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $host = $this->argument('host');
        $headers = $this->option('headers');
        $headers = $headers ? json_decode($headers, true) : [];
        $port = $this->option('port') ?? 1337;

        $server = new HttpServer();
        $server->startServer($host, $headers, $port);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
