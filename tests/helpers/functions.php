<?php

function create($class, $attributes = [])
{
    return $class::factory($attributes)->create();
}

function make($class, $attributes = [])
{
    return $class::factory($attributes)->make();
}