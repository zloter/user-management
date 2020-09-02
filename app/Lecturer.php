<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Lecturer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'education' => 'integer',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
