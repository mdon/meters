<?php
class maxsMeterGenerator {
    public static function metergenerator($params) {
        # --------------------- Length
        if (!isset($params['max'])) {
            return 'Param "max" is missing';
        }

        if (isset($params['max']) && !$params['max'] > 0) {
            return 'Param "max" is wrong, it is: ' . $params['max'];
        }
        # --------------------- Current
        if (!isset($params['current'])) {
            return 'Param "current" is missing';
        }

        if (isset($params['current']) && !$params['current'] > -1) {
            return 'Param "current" is wrong, it is: ' . $params['current'];
        }
        # --------------------- Name
        if (!isset($params['name'])) {
            return 'Param "name" is missing';
        }
        # --------------------- Length
        if (!isset($params['length'])) {
            return 'Param "length" is missing';
        }
        if (isset($params['length']) && !$params['length'] > 0) {
            return 'Param "length" is wrong, it is: ' . $params['length'];
        }
        # --------------------- Generating the bar
        if ($params['max'] < $params['current']) {
            return 'More then a 100% is being used in ' . $params['name'] . '! Something is wrong!';
        } else {
            $present = round($params['current'] * 100 / $params['max']);
            $bar = "";
            $poeb = 100 / $params['length'];
            $a = round($params['current'], 1, PHP_ROUND_HALF_UP);
            $b = round($params['max'], 1, PHP_ROUND_HALF_UP);
            $c = " ";

            if(fmod($a, 1) !== 0.00){
            } elseif ($a > 99) {
            } else {
                $c = $c . " ";
            }
            if(fmod($b, 1) !== 0.00){
            } elseif ($b > 99) {
            } else {
                $c = $c . " ";
            }

            #echo 'Present: ' . $present . "\n";
            #echo 'length: ' . $params['length'] . "\n";
            #echo 'Present of each bar: ' . $poeb . "\n";
            #echo 'num of bars: ' . ($present / $poeb) . "\n";
            #echo '$present / $poeb = ' . $present / $poeb . "\n";
            #echo 'Maximum: ' . $params['max'] . "\n";
            #echo 'Number of bars: ';

            for ($x = 1; $x <= ceil($present / $poeb); $x++) {
                $bar = $bar . "=";
                #echo "=";
            }
            #echo "\n";
            #echo 'Number of spaces: ' . ($params['length'] - ($present / $poeb));
            for ($x = 1; $x <= floor(($params['length'] - ($present / $poeb))); $x++) {
                $bar = $bar . " ";
                #echo "-";
            }
            #echo "\n";
            return $params['name'] . "[" . $bar . "|" . $a . '/' . $b . $c . $params['units'] . ']';
        }
    }
}

if (php_sapi_name() == "cli") {
    echo maxsMeterGenerator::metergenerator([
        'name'    => 'Bar 1',
        'max'     => 100,
        'current' => 80,
        'length'  => 20,
        'units'   => 'KB'
    ]) . "\n";
    echo maxsMeterGenerator::metergenerator([
        'name'    => 'Bar 2',
        'max'     => 1350100 / (1024*1024),
        'current' => 365400 / (1024*1024),
        'length'  => 20,
        'units'   => 'GB'
    ]) . "\n";
    echo maxsMeterGenerator::metergenerator([
        'name'    => 'Bar 3',
        'max'     => 20,
        'current' => 19,
        'length'  => 20,
        'units' => 'MB'
    ]) . "\n";
}
