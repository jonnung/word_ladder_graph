<?php

class Vertex
{
    public $distance = 0;
    public $predecessor = '';
    public $color = 'white';

    public function __construct($key)
    {
        $this->id = $key;
        $this->connect_to = array();
    }

    public function addNeighbor($neighbor, $weight = 0)
    {
        $this->connect_to[$neighbor->getId()] = array(
            'neighbor' => $neighbor,
            'weight' => $weight
        );
    }

    public function getConnections()
    {
        return array_values($this->connect_to);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getWeight($neighbor)
    {
        return $this->connect_to[$neighbor->getId()]['weight'];
    }

    public function setDistance($distance = 0)
    {
        $this->distance = $distance;
    }

    public function setPredecessor($predecessor)
    {
        $this->predecessor = $predecessor;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getDistance()
    {
        return $this->distance;
    }

    public function getPredecessor()
    {
        return $this->predecessor;
    }

    public function getColor()
    {
        return $this->color;
    }
}
