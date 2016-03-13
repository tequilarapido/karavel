<?php

use Kahlan\Box\Box;
use Kahlan\Filter\Filter;

$box = box('spec', new Box);

$box->service('testCase', function () {
    return new KahlanTestCase;
});

Filter::register('run.testCase', function ($chain) {
    box('spec')->get('testCase')->boot();
    return $chain->next();
});
Filter::apply($this, 'run', 'run.testCase');


Filter::register('stop.testCase', function ($chain) {
    box('spec')->get('testCase')->destroy();
    return $chain->next();
});
Filter::apply($this, 'stop', 'stop.testCase');