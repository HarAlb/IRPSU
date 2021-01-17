<?php 

namespace App\Helper;

class Helper{
    public static function getCount($table_name , $column = 'id'){
        //  Laravel Use select * , this way have more perfrmance
        $table = '\App\Models\\' . ucfirst($table_name);
        return $table::select(\DB::raw('count(`' . $column . '`) as count'))->pluck('count')->first();
    }
}