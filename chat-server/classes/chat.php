<?php
class Chat{

    public function sendHeaders($headersText, $newSocket, $host, $port)
    {
        $headers = [];
        $explodedHeaders = preg_split("/\n\r/", $headersText);
        foreach($explodedHeaders as $headerPart){
            if(strpos($headerPart, ":")){
                $arHeaderKeys = explode(":", $headerPart);
                $headers[trim($arHeaderKeys[0])] = $arHeaderKeys[1];
            }
        }
        $sKey = base64_encode(pack('H*', sha1($headers["Sec-WebSocket-Key"] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        $sendHeader = "HTTP/1.1 101 Switching Protocols\r\n".
                        "Upgrade: websocket\r\n".
                        "Connection: Upgrade\r\n".
                        "WebSocket-Origin: $host\r\n".
                        "WebSocket-Location: ws://$host:$port/chat-server/chat-server.php\r\n".
                        "Sec-WebSocket-Accept: $sKey\r\n\r\n";
        socket_write($newSocket, $sendHeader, strlen($sendHeader));
    }
}
