<?php

namespace App\SQL;

/**
 * Dans notre cas je pourrais utiliser les fonctions natives ou celles de symfony, et je ne l'ai connaît pas toutes
 * et je ne suis pas sûr de leur efficacité donc je les fais moi :p
*/
class SqlVerificator
{
    static public function verificatorSqlParameter(string $parameter): bool
    {
        if(str_contains(strtolower($parameter), 'insert') || str_contains(strtolower($parameter), 'select') || str_contains(strtolower($parameter), 'where')){
            return false;
        }
        return true;
    }
}
