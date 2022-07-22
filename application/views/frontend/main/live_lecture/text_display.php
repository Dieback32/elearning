<?php
if ($speechtext != null){
    foreach ($speechtext as $text){
        foreach ($user as $instructor){
            if ($instructor->id == $text->user_id){
                echo $text->speech;
            }
        }

    }
}