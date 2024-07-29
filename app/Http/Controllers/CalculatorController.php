<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Calculator;


class CalculatorController extends Controller
{
    private $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function calculate(Request $request)
    {
        $operation = $request->input('operation');
        $a = $request->input('a');
        $b = $request->input('b');

        try {
            switch ($operation) {
                case 'add':
                    $result = $this->calculator->add($a, $b);
                    break;
                case 'subtract':
                    $result = $this->calculator->subtract($a, $b);
                    break;
                case 'multiply':
                    $result = $this->calculator->multiply($a, $b);
                    break;
                case 'divide':
                    $result = $this->calculator->divide($a, $b);
                    break;
                case 'power':
                    $result = $this->calculator->power($a, $b);
                    break;
                case 'sqrt':
                    $result = $this->calculator->sqrt($a);
                    break;
                case 'natural_log':
                    $result = $this->calculator->natural_log($a);
                    break;
                case 'log10':
                    $result = $this->calculator->log10($a);
                    break;
                case 'pi':
                    $result = $this->calculator->pi();
                    break;
                default:
                    throw new \Exception("Unknown operation");
            }
            return response()->json(['result' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
