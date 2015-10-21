<?php
require_once('Graph.php');

/**
 * 단어 목록으로 인접 리스트를 사용해서 그래프 생성
 *
 * @param string $word_file 단어파일
 * @return object Graph 그래프객체
 * @throws Exception
 */
function buildWordLadderGraph($word_file)
{
    $container = array();
    $graph = new Graph();

    $f = fopen($word_file, "r");
    if ($f) {
        while (($word = fgets($f)) !== false) {
            $container = setBucketContainer($container, trim($word));
        }
        fclose($f);
    } else {
        throw new Exception('파일을 읽을 수 없습니다.');
    }

    $bucket_keys = array_keys($container);
    foreach ($bucket_keys as $bucket) {
        foreach ($container[$bucket] as $word1) {
            foreach ($container[$bucket] as $word2) {
                if ($word1 != $word2) {
                    $graph->addEdge($word1, $word2);
                }
            }
        }
    }
    return $graph;
}

/**
 * 단어를 한글자씩 특수문자로 치환해서 버킷을 만듬
 *
 * @param array $container 단어버켓 컨테이너
 * @param string $word 단어
 * @return array
 */
function setBucketContainer($container, $word)
{
    $word_length = strlen($word);
    for ($i = 0; $i < $word_length; $i++) {
        $bucket = substr($word, 0, $i) . '_' . substr($word, $i + 1, ($word_length - 1) - $i);
        if (array_key_exists($bucket, $container)) {
            array_push($container[$bucket], $word);
        } else {
            $container[$bucket] = array($word);
        }
    }
    return $container;
}
