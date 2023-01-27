<?php

namespace App\Models\Attendance;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['account_id','checkin','checkout','latitude','longitude'];    
    protected $guarded = ['id'];
    
    protected $casts = [
        'account_id' => 'int',
        'checkin' => 'string',
        'checkout' => 'string',
        'latitude' => 'string',
        'longitude' => 'string'
    ];

    /** Get attendant of a specific day */
    public static function attendantOfDay($date)
    {
        $date = \Carbon\Carbon::parse($date)->format('Y-m-d H:i:s');
        $attendants = static::where('checkin', $date)->get();
        return $attendants->count() ? $attendants : null;
    }
    /** Get attendent from to */
    public static function attendantFromTo($from, $to)
    {
        $from = \Carbon\Carbon::parse($from)->format('Y-m-d H:i:s');
        $to = \Carbon\Carbon::parse($to)->format('Y-m-d H:i:s');
        $attendants = static::whereBetween('checkin', [$from, $to])->get();
        return $attendants->count() ? $attendants : null;
    }

    public function account(){
        return $this->belongsTo('App\User','account_id','id');
    }
    public function setCheckinAttribute($val){
        $this->attributes['checkin'] = \Carbon\Carbon::parse( $val )->format('Y-m-d H-i:s');
    }
    public function setCheckoutAttribute($val)
    {
        $this->attributes['checkin'] = \Carbon\Carbon::parse($val)->format('Y-m-d H-i:s');
    }
}
