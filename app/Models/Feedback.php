<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'feedback',
        'prop_id'
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'prop_id', 'id');
    }

}
