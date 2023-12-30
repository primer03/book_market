<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

    require dirname(__DIR__) . '/vendor/autoload.php';
    $port = $_ENV['PORT'] ?? 8080;
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        $port
    );

    $server->run();
?>