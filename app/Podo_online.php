<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Podo_online extends Model
{
    protected $table = 'podo_onlines';
    protected $primaryKey = 'id';
    protected $fillable = ['ekatjual_id', 'po', 'tglpo', 'do', 'tgldo', 'file', 'keterangan'];

    public function Ekatjual()
    {
        return $this->BelongsTo('App\Ekatjual', 'ekatjual_id');
    }
}
