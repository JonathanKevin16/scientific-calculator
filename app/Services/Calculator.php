<?php

namespace App\Services;

class Calculator
{
    public function add($a, $b) {
        return $a + $b;
    }

    public function subtract($a, $b) {
        return $a - $b;
    }

    public function multiply($a, $b) {
        return $a * $b;
    }

    public function divide($a, $b) {
        if ($b == 0) {
            throw new \Exception("Division by zero");
        }
        return $a / $b;
    }

    public function power($base, $exponent) {
        return pow($base, $exponent);
    }

    public function sqrt($number) {
        if ($number < 0) {
            throw new \Exception("Cannot calculate square root of a negative number");
        }
        return sqrt($number);
    }

    public function natural_log($number) {
        if ($number <= 0) {
            throw new \Exception("Natural log is undefined for non-positive numbers");
        }
        return log($number);
    }

    public function log10($number) {
        if ($number <= 0) {
            throw new \Exception("Log10 is undefined for non-positive numbers");
        }
        return log10($number);
    }

    public function pi() {
        return M_PI;
    }

    // Add more scientific functions as needed
}
