<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{

    const COLLEGE_GRADUATE = 1;
    const ASSOCIATE_DEGREE = 2;
    const BACHELOR_DEGREE = 3;
    const MASTER_DEGREE = 4;
    const DOCTORATE_DEGREE = 5;
    const PROFESSOR_DEGREE = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone', 'education',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
