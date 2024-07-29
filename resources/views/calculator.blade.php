<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Scientific Calculator</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="text" id="display" class="form-control form-control-lg" readonly>
                </div>
                <div class="row g-2">
                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('7')">7</button></div>
                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('8')">8</button></div>
                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('9')">9</button></div>
                    <div class="col-3"><button class="btn btn-primary w-100" onclick="operate('divide')">/</button></div>

                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('4')">4</button></div>
                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('5')">5</button></div>
                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('6')">6</button></div>
                    <div class="col-3"><button class="btn btn-primary w-100" onclick="operate('multiply')">*</button></div>

                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('1')">1</button></div>
                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('2')">2</button></div>
                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('3')">3</button></div>
                    <div class="col-3"><button class="btn btn-primary w-100" onclick="operate('subtract')">-</button></div>

                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('0')">0</button></div>
                    <div class="col-3"><button class="btn btn-secondary w-100" onclick="appendToDisplay('.')">.</button></div>
                    <div class="col-3"><button class="btn btn-success w-100" onclick="calculate()">=</button></div>
                    <div class="col-3"><button class="btn btn-primary w-100" onclick="operate('add')">+</button></div>

                    <div class="col-3"><button class="btn btn-info w-100" onclick="operate('power')">x^y</button></div>
                    <div class="col-3"><button class="btn btn-info w-100" onclick="operate('sqrt')">√</button></div>
                    <div class="col-3"><button class="btn btn-info w-100" onclick="operate('natural_log')">ln</button></div>
                    <div class="col-3"><button class="btn btn-info w-100" onclick="operate('log10')">log</button></div>

                    <div class="col-3"><button class="btn btn-info w-100" onclick="operate('pi')">π</button></div>
                    <div class="col-9"><button class="btn btn-danger w-100" onclick="clearDisplay()">Clear</button></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let display = document.getElementById('display');
        let currentOperation = null;
        let firstOperand = null;

        function appendToDisplay(value) {
            display.value += value;
        }

        function clearDisplay() {
            display.value = '';
            currentOperation = null;
            firstOperand = null;
        }

        function operate(operation) {
            if (display.value !== '') {
                firstOperand = parseFloat(display.value);
                currentOperation = operation;
                display.value = '';
            }
        }

        function calculate() {
            if (currentOperation && display.value !== '') {
                let secondOperand = parseFloat(display.value);
                axios.post('/calculate', {
                    operation: currentOperation,
                    a: firstOperand,
                    b: secondOperand
                })
                .then(function (response) {
                    display.value = response.data.result;
                })
                .catch(function (error) {
                    display.value = 'Error';
                    console.error(error);
                });
                currentOperation = null;
                firstOperand = null;
            } else if (currentOperation === 'sqrt' || currentOperation === 'natural_log' || currentOperation === 'log10' || currentOperation === 'pi') {
                axios.post('/calculate', {
                    operation: currentOperation,
                    a: parseFloat(display.value)
                })
                .then(function (response) {
                    display.value = response.data.result;
                })
                .catch(function (error) {
                    display.value = 'Error';
                    console.error(error);
                });
                currentOperation = null;
            }
        }
    </script>
</body>
</html>
