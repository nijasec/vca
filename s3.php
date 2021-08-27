<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use MyApp\Listener;
use React\Socket\Server;
//use React\Socket\TcpServer;
use React\Socket\SecureServer;
//use React\Scoket\SecureServer
use Amir\Comm;
require_once 'vendor/autoload.php';

$loop=Factory::create();
$server=new Server($loop);
//$server->listen(8081,'0.0.0.0');
//$server=new TcpServer(8081);
//$cp='ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-CHACHA20-POLY1305:ECDHE-RSA-CHACHA20-POLY1305:ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-SHA384:ECDHE-RSA-AES256-SHA384:ECDHE-ECDSA-AES128-SHA256:ECDHE-RSA-AES128-SHA256';
$cp='DHE-RSA-AES256-SHA:LONG-CIPHER';
/*$secureServer =new SecureServer($server,$loop,array(
		'local_cert' => '/home/micky/combined2.pem',
	//	'local_pk' => '/home/micky/example.key',
		// 'crypto_method' => STREAM_CRYPTO_METHOD_ANY_SERVER,
		'allow_self_signed' => true,
                'verify_peer' =>false,
'ciphers' => $cp));*/
//$secureServer=new React\Socket\SocketServer('tls://127.0.0.1:8081',array(
//'tls'=>array(
//	'local_cert' =>'stunnel.pem')));

$server->listen(8080,'0.0.0.0');

$httpserver =   new HttpServer(
        new WsServer(
            new Comm()
        )
    );

$server->on('error', function (Exception $e) {
    echo 'Error' . $e->getMessage() . PHP_EOL;
//  var_dump($e);
});
$ioServer =new IoServer($httpserver,$server,$loop);
//$socket->listen(8082, '0.0.0.0'); //Port 2
//$socket->on('connection', [$server, 'handleConnect']);
$ioServer->run();
