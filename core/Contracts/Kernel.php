<?php
namespace Chicane\Contracts;
interface Kernel
{
    public function handle($input, $output = null);
    public function call($command, array $parameters = [], $outputBuffer = null);
    public function queue($command, array $parameters = []);
    public function all();
    public function output();
}