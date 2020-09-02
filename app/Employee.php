<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_voivodeship',
        'address_city',
        'address_postal_code',
        'address_street',
        'address_number',
        'correspondence_voivodeship',
        'correspondence_city',
        'correspondence_postal_code',
        'correspondence_street',
        'correspondence_number'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
