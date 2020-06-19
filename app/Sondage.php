<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sondage extends Model
{
    public function count()
    {
        return $count = $this->all()->count();
    }

//    recupere dans la BDD les resultats (sond) du sondages et retourne un json de valeur de % arrondit par reponse proposé
    public function index()
    {
        $tabValue = [];
        $sondageCount = $this->all()->count();

        for ($i = 0; $i <= 6; $i++) {
            $result = $this->where('sond', 'LIKE', '%' . $i . '%')->count();
            if ($result == 0){
                $pourcent = 0;
            }else{
                $pourcent = ($result / $sondageCount) * 100;
            }
            $tabValue[$i] = round($pourcent,0);
        }


        return json_encode($tabValue);
    }

}
