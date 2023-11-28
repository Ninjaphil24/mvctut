<?php
namespace RouterSpace;

interface RoutesInterface
{
    public function dispatch():array;
}