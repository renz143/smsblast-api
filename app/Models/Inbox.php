<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Inbox extends Model
{
    use HasFactory;

    protected $table = 'inbox';

    public $timestamps = false;

    protected $fillable = [
        'phone_number',
        'message',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
