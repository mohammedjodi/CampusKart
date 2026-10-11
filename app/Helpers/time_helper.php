<?php 

if(! function_exists('timeAgo')){
    function timeAgo(string $datetime): string 
    {
        $time = strtotime($datetime);
        $now = time();

        $difference = $now - $time;

        if($difference < 60){
            return 'Just now';
        }

        $minutes = floor($difference/60);

        if($minutes < 60){
            return $minutes . '' . ($minutes == 1 ? 'minute' : 'minutes') . ' ago';
        }

        $hours = floor($minutes/60);

        if($hours< 24){
            return $hours . '' . ($hours == 1 ? 'hour' : 'hours') . ' ago';
        }

        $days = floor($hours/24);
        if($days< 7){
            return $days . '' . ($days == 1 ? 'day' : 'days') . ' ago';
        }

        $weeks = floor($days/7);

        if($weeks< 4){
            return $weeks . '' . ($weeks == 1 ? 'week' : 'weeks') . ' ago';
        }

        $months = floor($days/30);

        if($months < 12){
            return $months . '' . ($months == 1 ? 'month' : 'months') . ' ago';
        }

        $years = floor($days/365);

        return $years. '' .($years == 1 ? 'year' : 'years' ) . ' ago';

    }
}