<?php

namespace Crypto\Analysis\indicators\rsi;

class RelativeStrengthIndex {

    /**
     * @param array $candlebars
     */
    public function __construct(private array $candlebars) {

    }

    public function calculate(int $period): array {
        $delta = $this->calculateClosingDiffs($this->candlebars);
        return $this->calculateRSI($delta, $period);
    }

    private function calculateClosingDiffs(array $candlebars): array {
        $diffs = array();
        $prevKline = null;
        foreach($candlebars as $bar) {
            if (isset($prevKline)) {
                $diff = $bar[2] - $prevKline[2];
                array_push($diffs, array($bar[0], $diff));
            }
            $prevKline = $bar;
        }
        return $diffs;
    }

    private function calculateRSI(array $diffs, int $period): array {
        $start = 0;
        $end  = $period - 1;
        $rsi = array();
        while ($end < count($diffs)) {
            if ($start < $period) {
                $start += 1;
                $end += 1;
                continue;
            } else {
                $rs = $this->performRsiCalculation(array_slice($diffs, $start, $period));
                array_push($rsi, array($diffs[$end][0], $rs));
                $start += 1;
                $end += 1;
            }

        }
        return $rsi;
    }

    private function performRsiCalculation(array $slice): float {
        $positive = array_filter($slice, function($v) {
            return $v[1] > 0;
        });
        $negative = array_filter($slice, function($v) {
            return $v[1] < 0;
        });
        $positiveSum = array_sum(array_map(function($v) {
            return $v[1];
        }, $positive));
        $avgGain = $positiveSum / count($positive);
        $negativeSum = array_sum(array_map(function($v) {
            return $v[1];
        }, $negative));
        $avgLoss = abs($negativeSum / count($negative));
        $rs = $avgGain / $avgLoss;
        return (100.0 - 100.0 / (1.0 + $rs));
    }
}