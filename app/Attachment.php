<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'foto_ktp', 'foto_kk', 'foto_surat_pengantar', 'submission_id', 'foto_kk_baru'
    ];

    public function submission(){
        return $this->belongsTo(Submission::class, 'submission_id');
    }
}
