<?php

     /*
     * SCRAPE realestate.com
     */

    require_once ('bootstrap/bootstrap.php');

    $scrape = new REALESTATECOM('rent');
    $t =  $scrape->scrapeNow('6060');

    echo "<pre>"; print_r($t) ; echo "</pre>";
?>