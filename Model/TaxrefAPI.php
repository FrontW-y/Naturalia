<?php

namespace traitement;

class TaxrefAPI
{
    private $baseUrl = "https://taxref.mnhn.fr/api/taxa/";

    public static function getBaseUrl()
    {
        return self::$baseUrl;
    }
    
    public function fetchData($endpoint): ?array
    {
        $url = $this->baseUrl . $endpoint;
    
        $headers = @get_headers($url);
        if ($headers === false) {
            throw new \Exception("Inpossible d'obtenir l'en-tête: " . $url);
        }
    
        $status = $headers[0];
        if (strpos($status, "404") !== false) {
            return null;
        }
       try {
            $json = file_get_contents($url);
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new \Exception("JSON decoding error: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception("Error fetching data: " . $e->getMessage());
        }
    }
    
}
