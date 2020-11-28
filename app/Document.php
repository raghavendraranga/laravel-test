<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function user(){
        return $this->hasOne('App\User');
    }

    public function getDocumentUrlAttribute(){
        return env('APP_URL')."/".$this->document;
    }
}
