<?php

require '../Model/TaxrefAPI.php';
require '../Controleur/TaxrefController.php';

use traitement\TaxrefAPI;
use traitement\TaxrefController;

$api = new TaxrefAPI();
$controller = new TaxrefController($api);

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'autoComplete':
        $term = $_GET['term'] ?? '';
        $size = $_GET['size'] ?? 5;
        $results = $controller->autoComplete($term, $size);
        header('Content-Type: application/json; charset=utf-8');
        if (!empty($results)) {
            echo json_encode($results);
        }
        break;
    case 'search':
        $term = $_GET['term'] ?? '';
        $size = $_GET['size'] ?? 5;
        $resultat = $controller->search($term, $size);
        header('Content-Type: application/json; charset=utf-8');

        $filtre = [];
        foreach ($resultat as $taxon) {
            if ($taxon['parentId'] != null) {
                $mediaUrl = $taxon['_links']['media']['href'];
                $mediaContent = file_get_contents($mediaUrl);
                $mediaData = json_decode($mediaContent, true);

                if (!empty($mediaData['_embedded']['media'][0]['_links']['file']['href'])) {
                    $taxonThumbnailUrl = $mediaData['_embedded']['media'][0]['_links']['file']['href'];
                    $taxon['taxonMedia'] = $taxonThumbnailUrl;
                }

                $filtre[] = $taxon;
            }
        }
        echo json_encode($filtre);
        break;


    case 'afficher':
        $term = $_GET['id'] ?? '';
        $resultat = $controller->afficher($term);
        header('Content-Type: application/json; charset=utf-8');
        $mediaUrl = $resultat['_links']['media']['href'];
        $mediaContent = file_get_contents($mediaUrl);
        $mediaData = json_decode($mediaContent, true);
        
        
        try {
            $resultat["factSheet"] = $controller->factsheet($term);

        } catch (Exception $e) {
            $resultat["factSheet"] = "Aucune donnée complementaire disponible disponible";
        }


        if (!empty($mediaData['_embedded']['media'][0]['_links']['file']['href'])) {
            $taxonThumbnailUrl = $mediaData['_embedded']['media'][0]['_links']['file']['href'];
            $resultat['taxonMedia'] = $taxonThumbnailUrl;
        }
        echo json_encode($resultat);
        break;

    default:
        echo json_encode(['error' => 'ERREUR ACTION NON RECONNUE']);
        break;
}