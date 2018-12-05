<html>
<body>
<?php 

$out = array();

$GID = $_GET["GroupID"];
echo exec("curl 'http://example.com/be/remote/toolkit/viewcontentresult?layoutOff=true' -H 'Cookie: PHPSESSID=cc520344f884ed3555d740ec5cdcfddd' -H 'Origin: http://example.com' -H 'Accept-Encoding: gzip, deflate' -H 'Accept-Language: es-ES,es;q=0.9,en;q=0.8' -H 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36' -H 'Content-Type: application/x-www-form-urlencoded' -H 'Pragma: akamai-x-get-client-ip, akamai-x-cache-on, akamai-x-cache-remote-on, akamai-x-check-cacheable, akamai-x-get-cache-key, akamai-x-get-extracted-values, akamai-x-get-nonces, akamai-x-get-ssl-client-session-id, akamai-x-get-true-cache-key, akamai-x-serial-no, akamai-x-feo-trace, akamai-x-get-request-id' -H 'Accept: text/html, */*; q=0.01' -H 'Referer: http://example.com/be/remote/toolkit/viewcontent' -H 'X-Requested-With: XMLHttpRequest' -H 'Connection: keep-alive' --data 'instalacion=8140&grupo=$GID&contenido=&version=&program=&housenumber=&title=&sololectura=' --compressed", $out); 


echo "Manifests con Last-Modified diferente:\n\n";
echo "GroupID: $GID\n\n";

$out_line = preg_grep("/plataforma/", $out);
$out_uniq = array_unique($out_line);

foreach($out_uniq as $line)
    if (preg_match("/SS.ism/", $line))
    {
        $outssLCDN = array();
        $outssOrigen = array();
        $td1 = preg_replace('/\s+<td align="center">/','',$line);
        $manifest = preg_replace('/<\/td>/','',$td1);
        $urlLCDN = "http://LCDN.com/multimediav81$manifest/Manifest\n";
        $urlOrigen = "http://originServer.com/multimediav81$manifest/Manifest\n";
        $dominio = "LCDN.com";
        exec("curl -I $urlLCDN", $outssLCDN);
        exec("curl -I --header Host:$dominio $urlOrigen", $outssOrigen);
            if ($outssLCDN[7] !== $outssOrigen[6])
		{
                echo "Formato Smooth Streaming\n";
                echo "Manifest:  $urlLCDN";
                echo "LCDN    : $outssLCDN[7]\n";
                echo "ORIGEN  : $outssOrigen[6]\n\n";
		}
    }

    elseif (preg_match("/HLS.m3u8/", $line))

    {
        $outhlsLCDN = array();
        $outhlsOrigen = array();
        $td1 = preg_replace('/\s+<td align="center">/','',$line);
        $manifest = preg_replace('/<\/td>/','',$td1);
        $urlLCDN = "http://LCDN.com/multimediav81$manifest\n";
        $urlOrigen = "http://originServer.com/multimediav81$manifest\n";
        $dominio = "LCDN.com";
        exec("curl -I $urlLCDN", $outhlsLCDN);
        exec("curl -I --header Host:$dominio $urlOrigen", $outhlsOrigen);
            if ($outhlsLCDN[7] !== $outhlsOrigen[6])
		{
                echo "Formato HLS\n";
                echo "Manifest:  $urlLCDN";
                echo "LCDN    : $outhlsLCDN[7]\n";
                echo "ORIGEN  : $outhlsOrigen[6]\n\n";
		}

    }

    elseif (preg_match("/HLSFPS.m3u8/", $line))
    {
        $outhlsfpsLCDN = array();
        $outhlsfpsOrigen = array();
        $td1 = preg_replace('/\s+<td align="center">/','',$line);
        $manifest = preg_replace('/<\/td>/','',$td1);
        $urlLCDN = "http://LCDN.com/multimediav81$manifest\n";
        $urlOrigen = "http://originServer.com/multimediav81$manifest\n";
        $dominio = "LCDN.com";
        exec("curl -I $urlLCDN", $outhlsfpsLCDN);
        exec("curl -I --header Host:$dominio $urlOrigen", $outhlsfpsOrigen);
            if ($outhlsfpsLCDN[7] !== $outhlsfpsOrigen[6])
		{
                echo "Formato HLSFPS\n";
                echo "Manifest:  $urlLCDN";
                echo "LCDN    : $outhlsfpsLCDN[7]\n";
                echo "ORIGEN  : $outhlsfpsOrigen[6]\n\n";
		}

    }

    elseif (preg_match("/DASH.ism/", $line))
    {
        $outdashLCDN = array();
        $outdashOrigen = array();
        $td1 = preg_replace('/\s+<td align="center">/','',$line);
        $manifest = preg_replace('/<\/td>/','',$td1);
        $urlLCDN = "https://LCDN.com/multimediav81$manifest/.mpd\n";
        $urlOrigen = "http://originServer.com/multimediav81$manifest/.mpd\n";
        $dominio = "LCDN.com";
        exec("curl -I $urlLCDN", $outdashLCDN);
        exec("curl -I --header Host:$dominio $urlOrigen", $outdashOrigen);
            if ($outdashLCDN[7] !== $outdashOrigen[6])
		{
                echo "Formato DASH\n";
                echo "Manifest:  $urlLCDN";
                echo "LCDN    : $outdashLCDN[7]\n";
                echo "ORIGEN  : $outdashOrigen[6]\n\n";
		}

    }

?>
<br>
</body>
</html>
