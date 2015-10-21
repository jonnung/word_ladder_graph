<?php
require_once('Vertex.php');


class Graph
{
    public function __construct()
    {
        $this->vertex_list = array();
        $this->num_vertices = 0;
    }

    public function addVertex($key)
    {
        $this->num_vertices = $this->num_vertices + 1;
        $new_vertex = new Vertex($key);
        $this->vertex_list[$key] = $new_vertex;
        return $new_vertex;
    }

    public function getVertex($key)
    {
        if (array_key_exists($key, $this->vertex_list)) {
            return $this->vertex_list[$key];
        } else {
            return false;
        }
    }

    public function addEdge($from, $to, $cost = 0)
    {
        $vertex_keys = $this->getVertices();
        if (in_array($from, $vertex_keys) === false) {
            $this->addVertex($from);
        }
        if (in_array($to, $vertex_keys) === false) {
            $this->addVertex($to);
        }

        $this->vertex_list[$from]->addNeighbor($this->vertex_list[$to], $cost);
    }

    public function getVertices()
    {
        return array_keys($this->vertex_list);
    }

}
