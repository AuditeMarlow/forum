<?php

/**
 * Make a model.
 *
 * @return \Illuminate\Database\Eloquent\Model
 */
function make($class, $attributes = []) {
    return factory($class)->make($attributes);
}

/**
 * Create a model.
 *
 * @return \Illuminate\Database\Eloquent\Model
 */
function create($class, $attributes = []) {
    return factory($class)->create($attributes);
}
