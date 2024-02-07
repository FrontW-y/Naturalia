<?php

namespace traitement;

class TaxrefController
{
    private $api;
    private $linkBuilderArray = [
        "autocomplete" => "autocomplete?term=:terme&page=1&size=:nombre",
        "fuzzy" => "fuzzyMatch?term=:terme",
        "search" => "search?frenchVernacularNames=:terme&page=1&size=:nombre",
        "afficher" => ":id",
        "factsheet" => ":id/factsheet"
    ];

    public function __construct(TaxrefAPI $api)
    {
        $this->api = $api;
    }

    public function autoComplete($term, $size)
    {
        $endpoint = str_replace([':terme', ':nombre'], [$term, $size], $this->linkBuilderArray['autocomplete']);
        return $this->fetchAndProcess($endpoint, 'processAutoComplete');
    }

    public function fuzzyMatch($term)
    {
        $endpoint = str_replace(':terme', $term, $this->linkBuilderArray['fuzzy']);
        return $this->fetchAndProcess($endpoint, 'processFuzzyMatch');
    }
    
    public function search($term, $size){
        $endpoint =  str_replace([':terme', ':nombre'], [$term, $size], $this->linkBuilderArray['search']);
        return $this->fetchAndProcess($endpoint, "processSearch");
    }

    public function afficher($id) {
        $endpoint =  str_replace([':id'], [$id], $this->linkBuilderArray['afficher']);
        return $this->fetchAndProcess($endpoint, "processAfficher");
    }

    public function factsheet($id)
    {
        $endpoint = str_replace(':id', $id, $this->linkBuilderArray['factsheet']);
        return $this->fetchAndProcess($endpoint, 'processFactsheet');
    }

    private function fetchAndProcess($endpoint, $processMethod)
    {
        try {
            $data = $this->api->fetchData($endpoint);
            return $this->$processMethod($data);
        } catch (\Exception $e) {
            return ['message' => 'Une erreur est survenue'];
        }
    }

    private function processAutoComplete($data)
    {
        if (isset($data['_embedded']['taxa'])) {
            return $data['_embedded']['taxa'];
        }

        return ['message' => 'Aucune correspondance trouvée'];
    }

    private function processFuzzyMatch($data)
    {
        if (isset($data['_embedded']['taxa'])) {
            return $data['_embedded']['taxa'];
        }

        return ['message' => 'Aucune correspondance trouvée'];
    }

    private function processAfficher($data)
    {
        if (isset($data)) {
            return $data;
        }

        return ['message' => 'Aucune correspondance trouvée'];
    }
    
    
    private function processSearch($data)
    {
        if (isset($data['_embedded']['taxa'])) {
            return $data['_embedded']['taxa'];
        }

        return ['message' => 'Aucune correspondance trouvée'];
    }

    private function processFactsheet($data)
    {
        if (isset($data['text'])) {
            return $data['text'];
        }

        return 'Aucune données complémentaires trouvées';
    }
}

