<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'reason', 'user_id', 'reject_reason', 'status', 'approved_at', 'rejected_at', 'processed_at'
    ];

    public const STATUS_PENDING = 'PENDING';
    public const STATUS_PROCESSING = 'DIPROSES';
    public const STATUS_COMPLETED = 'SELESAI';
    public const STATUS_REJECTED = 'DITOLAK';

//    protected $dates = ['approved_at', 'rejected_at'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attachment(){
        return $this->hasOne(Attachment::class, 'submission_id' );
    }

}
