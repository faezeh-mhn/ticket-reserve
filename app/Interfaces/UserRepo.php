<?php

namespace App\Interfaces;

interface UserRepo
{
    public function makeTotal($id);
    public function getUser($id);

}
