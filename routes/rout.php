<?php

class rout
{
    public function user() {
        $text=auth::user() ->created_at;
        $date = jDate::forge('$text') ->format('datetime');
        echo $date;
    }
}
