<?php
    // strtolower
    if(!function_exists('getStrtolower')){
        function getStrtolower($texte){
            return strtolower($texte);
        }
    }

    // 
    if(!(function_exists('formatMontant'))){
        function formatMontant($amount){
            return $amount ? preg_replace('/\B(?=(\d{3})+(?!\d))/', ' ', $amount):null;
        }
    }

    // 
    if(!(function_exists('compareToDate'))){
        function compareToDate($actuel, $debut, $fin){
            $status = ['0', '1', '2'];
            return match(true) {
                ((strtotime($debut) > strtotime($actuel)) && (strtotime($fin) > strtotime($actuel))) => $status[0],
                ((strtotime($debut) <= strtotime($actuel)) && (strtotime($fin) >= strtotime($actuel))) => $status[1],
                ((strtotime($debut) < strtotime($actuel)) && (strtotime($fin) < strtotime($actuel))) => $status[2]
            };
        }
    }


    if(!(function_exists('getEtatServie'))){
        function getEtatServie($value){
            switch($value){
                case 1:
                    return 'Plein';
                    break;
                case 2:
                    return 'Partiel';
                    break;
                case 3:
                    return 'Trimestre';
                    break;
                default :
                    return 'Autre';
            }
        }
    }


    if(!(function_exists('getStatus'))){
        function getStatus($value){
            switch($value){
                case 0:
                    return ['warning', 'En attente'];
                    break;
                case 1:
                    return ['success', 'En cours'];
                    break;
                default :
                    return ['danger', 'Ternimer'];
            }
        }
    }
