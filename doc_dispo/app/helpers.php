<?php

use App\Models\Entite;

function getEntites($partie)
{
    return Entite::where('id_partie', $partie)->get();
}

function getEntite($id)
{
    return Entite::find($id);
}

function getEntitesInRange($start, $end)
{
    return Entite::whereBetween('id', [$start, $end])->get();
}

?>
