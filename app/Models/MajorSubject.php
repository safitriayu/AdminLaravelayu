<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorSubject extends Model
{
    use HasFactory, Uuids;

    protected $table = 'major_subjects';
    protected $primaryKey = "id";
    protected $fillable = [
        'degree',
        'semester'
    ];
    public function major(){
        return $this->hasOne(Major::class,'id','major_id');
    }
    public function subject(){
        return $this->hasOne(Subject::class,'id','subject_id');
    }
}