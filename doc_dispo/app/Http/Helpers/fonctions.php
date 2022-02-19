<?php

use App\Models\Entite;

function getEntites($partie)
{
    return Entite::where('id_partie', $partie)->get();
}

?>
