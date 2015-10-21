<?php

require_once('Vertex.php');
require_once('word_ladder.php');

/**
 * Breadth First Search
 */
function bfs($start_vertex)
{
    $start_vertex->setDistance(0);
    $start_vertex->setPredecessor(false);

    $queue = array();
    array_push($queue, $start_vertex);

    while (count($queue) > 0) {
        $current_vertext = array_shift($queue);
        $neighbor = $current_vertext->getConnections();

        foreach ($neighbor as $nbr_vertext) {
            if ($nbr_vertext['neighbor']->getColor() == 'white') {
                $nbr_vertext['neighbor']->setColor('gray');
                $nbr_vertext['neighbor']->setDistance($current_vertext->getDistance() + 1);
                $nbr_vertext['neighbor']->setPredecessor($current_vertext);
                array_push($queue, $nbr_vertext['neighbor']);
            }
        }
        $current_vertext->setColor('black');
    }
}

/**
 * 목표 단어부터 전임자를 탐색하여 시작 단어까지
 */
function traverse($end_vertex)
{
    $vertex = $end_vertex;
    while ($vertex->getPredecessor()) {
        echo $vertex->getId() . ' <- ';
        $vertex = $vertex->getPredecessor();
    }
    echo $vertex->getId();
}


$word_radder = buildWordLadderGraph('word_source.txt');
bfs($word_radder->getVertex('fool'));
traverse($word_radder->getVertex('sale'));
