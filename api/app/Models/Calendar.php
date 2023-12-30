<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Calendar extends Model
{
    protected $table = "calendar";
    protected $fillable = ['code', 'holiday_date', 'holiday_name', 'detail'];
    protected $hidden = ["id"];

    public function add($data)
    {
        DB::beginTransaction();
        try {
            DB::table($this->table)
                ->insert($data);

        }catch (\Exception $e){
            DB::rollBack();
            return $e;
        }

        DB::commit();

        return true;
    }
}
