<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

chdir('../../../');
require 'includes/application_top.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Map Example</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
              integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
              crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>


        <script src="http://phoenix/ext/modules/shipping/leaflet-providers.js"></script>

    </head>
    <body>
        <div id="map"></div>
        <?php
        $hereApiKey = 'QAVNMJygMt2HpJUCDpnz';

        echo new \Ease\Html\ScriptTag(
                "
                    " .
//                $leaflet->build($map) .

                "
const here = {
  apiKey:'$hereApiKey'
}
const style = 'reduced.night';
"
                . 'const hereTileUrl = `https://2.base.maps.ls.hereapi.com/maptile/2.1/maptile/newest/${style}/{z}/{x}/{y}/512/png8?apiKey=${here.apiKey}&ppi=320`;' .
                "
const map = L.map('map', {
   center: [37.773972, -122.431297],
   zoom: 11,
   layers: [L.tileLayer(hereTileUrl)]
});
map.attributionControl.addAttribution('&copy; HERE 2019');


//L.tileLayer.provider('HEREv3.terrainDay', { apiKey: 'QAVNMJygMt2HpJUCDpnz' }).addTo(map);
"
        );
        ?>

    </body>
</html>
