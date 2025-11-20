<?php
require __DIR__ .  '/vendor/autoload.php';
use GeoIp2\Database\Reader;

$databaseCidadePais = __DIR__ . '/GeoLite2-City.mmdb';
$databaseFileASN = __DIR__ . '/GeoLite2-ASN.mmdb';

$enderecoIp = $_SERVER['HTTP_X_FORWARDED_FOR'];

// para debug
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";

$pegarCidadesPaises = new Reader($databaseCidadePais);
$local = $pegarCidadesPaises->city($enderecoIp);

$readerASN = new Reader($databaseFileASN);
$provedor = $readerASN->asn($enderecoIp);

echo "<h1>Geolocalização do Provedor</h1>";
echo "<p><strong>IP obtido na requisição: </strong> {$enderecoIp}</p>";
echo "<hr>";
echo "<h2>Detalhes da Localização:</h2>";
echo "<ul>";
echo "<li><strong>Continente:</strong> " . $local->continent->name . " - " . $local->continent->code . "</li>";
echo "<li><strong>País:</strong> " . $local->country->name . "</li>";
echo "<li><strong>Cidade:</strong> " . $local->city->name . "</li>";
echo "<li><strong>Estado:</strong> " . $local->mostSpecificSubdivision->name . "</li>";
echo "<li><strong>Latitude:</strong> " . $local->location->latitude . "</li>";
echo "<li><strong>Longitude:</strong> " . $local->location->longitude . "</li>";
echo "<li><strong>Provedor:</strong> " . $provedor->autonomousSystemOrganization . "</li>";
echo "<br><br>";

echo "<a href=\"https://www.google.com/maps/search/?api=1&query={$local->location->latitude},{$local->location->longitude}\" target=\"_blank\">Veja no Maps</a>";
echo "<br><br>";

echo "<iframe
    src=\"https://www.google.com/maps?q={$local->location->latitude},{$local->location->longitude}&hl=pt-BR&z=14&output=embed\"
    width=\"600\"
    height=\"400\"
    style=\"border:0;\"
    allowfullscreen=\"\"
    loading=\"lazy\"
    referrerpolicy=\"no-referrer-when-downgrade\">
</iframe>";
echo "</ul>";
echo "<br><br><br><br>";