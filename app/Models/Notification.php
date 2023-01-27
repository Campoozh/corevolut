<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'sender_id',
        'body'
    ];

    public function user(){
        
        return $this->belongsTo('App\Models\User');

    }
    
}
