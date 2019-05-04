<?php

$host = '0.0.0.0';
$port = 8202;

set_time_limit(0);

$sock = null;
$result = null;

$accept= null;
$msg = null;

$line = 0;
$reply = null;


$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die('Could not create socket ');

$result = socket_bind($sock, $host, $port) or die('Could not bind to socket ');
$result = socket_listen($sock, 3) or die('Could not listen socket ');

echo "Listening connctors\n\n";

class Chat {
    function readLine() {
        return rtrim(fgets(STDIN));
    }
}

do {
    $accept = socket_accept($sock) or die('Could not accept incomming connectors ');
    $msg = socket_read($accept, 1024) or die('Could not read input ');

    $msg = trim($msg);

    echo "Client say:\t" . $msg . "\n";

    $line = new Chat();

    echo "Enter reply:\t";
    $reply = $line->readLine();

    socket_write($accept, $reply, strlen($reply)) or die('Could not write output');
} while(true);

socket_close($accept, $sock);
