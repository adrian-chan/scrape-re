<?php
    use Goutte\Client;

    class REALESTATECOM {

        private $url = 'http://www.realestate.com.au/';
        private $propertyType;


        public function __construct($type='rent')
        {
            if ($this->checkType($type))
            {
                $this->propertyType = $type;
            }
            else {
                throw new Exception ("Invalid Property Type");
            }
        }

        public function scrapeNow($postcode)
        {
            $client     = new Client();
            $url        = $this->buildURL($postcode);

            $crawler    = $client->request('GET', $url);

            $listings = $crawler->filter('.listingInfo')->each(function($node) {

               //CHECK TO ENSURE NODE EXISTS
               $nodeValue = function ($xPath) use ($node) {
                   return $node->filter($xPath)->count() ? $node->filter($xPath)->text() : '';
               };

               $propertyDetails['name']     = (string) $nodeValue('.name');
               $propertyDetails['price']    = (double) preg_replace("/[^0-9.]+/", "", $nodeValue('.priceText')); //extract price
               $propertyDetails['bedrooms'] = (int) $nodeValue('.rui-icon-bed + dd');    //extract bed
               $propertyDetails['bathroom'] = (int) $nodeValue('.rui-icon-bath + dd');   //extract bath
               $propertyDetails['carports'] = (int) $nodeValue('.rui-icon-car + dd');    //extract car
               return $propertyDetails;

            });

            return $listings;
        }

       /*
        * build url for for scraping
        */
        private function buildUrl($postcode)
        {
            return $this->url . $this->propertyType.'/in-'. $postcode . '/list-1';
        }

        private function checkType($type)
        {
            $types = array('sale', 'rent');

            return in_array($type , $types);
        }
    }
?>