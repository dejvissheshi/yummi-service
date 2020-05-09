<?php

interface iValidator{
    public static function generateJwt();
    public static function validateJwt(string $token);
}
