<?php

function tampil_aman($str){
    echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}