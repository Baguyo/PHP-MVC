<?php 
    // REDIRECT PAGE
    function redirect( string $location){
        header('location: ' . URLROOT . '/' . $location);
    }