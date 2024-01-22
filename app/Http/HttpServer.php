<?php

namespace App\Http;

use Amp\ByteStream;
use Amp\Http\HttpStatus;
use Amp\Http\Server\DefaultErrorHandler;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Server\SocketHttpServer;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Illuminate\Support\Facades\Http;
use Monolog\Logger;

class HttpServer {
    public function startServer($host, $headers, $port = 1337) {
        $logHandler = new StreamHandler(ByteStream\getStdout());
        $logHandler->setFormatter(new ConsoleFormatter());
        $logger = new Logger('server');
        $logger->pushHandler($logHandler);

        $requestHandler = new class($host, $headers) implements RequestHandler {

            public function __construct(
                private string $host,
                private array $headers,
            ) {
                //
            }

            public function handleRequest(Request $request) : Response
            {
                $headers = [];
                $method = mb_strtolower($request->getMethod());

                foreach ($request->getHeaders() as $name => $values) {
                    foreach ($values as $value) {
                        $headers[$name] = $value;
                    }
                }

                $headers = [...$headers, ...$this->headers];
                $body = $request->getBody()->buffer();
                $response = Http::withHeaders($headers);
                if ($body) {
                    $response = $response->withBody($body);
                }

                $endpoint = str($this->host);
                if ($request->getUri()->getPath() !== '/') {
                    $endpoint = $endpoint->finish($request->getUri()->getPath());
                }

                if ($request->getUri()->getQuery()) {
                    $endpoint = $endpoint->append('?' . $request->getUri()->getQuery());
                }

                $response = $response->$method((string) $endpoint);
                return new Response(
                    status: $response->status(),
                    headers: $response->headers(),
                    body: $response->body(),
                );
            }
        };

        $errorHandler = new DefaultErrorHandler();

        $server = SocketHttpServer::createForDirectAccess($logger);
        $server->expose('127.0.0.1:'.$port);
        $server->start($requestHandler, $errorHandler);

        // Serve requests until SIGINT or SIGTERM is received by the process.
        \Amp\trapSignal([SIGINT, SIGTERM]);

        $server->stop();
    }

}
