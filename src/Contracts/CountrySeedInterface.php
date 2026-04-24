<?php

namespace Aaix\LaravelCountries\Contracts;

interface CountrySeedInterface
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run();

    public function geographical();

}
