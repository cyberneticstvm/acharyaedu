<?php

use App\Models\CourseOffer;

function courseOffers(){
   return CourseOffer::all();
}

function albhabets(){
    return array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E');
}
?>