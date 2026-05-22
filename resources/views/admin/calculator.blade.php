@extends('admin.layouts.app')

@section('title', 'Calculator')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-800">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Calculator</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Quick arithmetic operations</p>
        </div>

        <div class="p-6">
            <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-4 mb-4">
                <div id="calcDisplay" class="text-right text-4xl font-bold text-gray-900 dark:text-white truncate font-mono">0</div>
                <div id="calcHistory" class="text-right text-sm text-gray-400 dark:text-gray-500 font-mono h-5">&nbsp;</div>
            </div>

            <div class="grid grid-cols-4 gap-2">
                <button onclick="calcInput('clear')" class="col-span-2 px-4 py-3 rounded-xl text-sm font-semibold bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900/50 transition">Clear</button>
                <button onclick="calcInput('backspace')" class="px-4 py-3 rounded-xl text-sm font-semibold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9.75L14.25 12m0 0l2.25 2.25M14.25 12l2.25-2.25M14.25 12L12 14.25m-2.58 4.92l-6.375-6.375a1.125 1.125 0 010-1.59L9.42 4.83c.211-.211.498-.33.796-.33H19.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25h-9.284c-.298 0-.585-.119-.796-.33z"/></svg>
                </button>
                <button onclick="calcInput('%')" class="px-4 py-3 rounded-xl text-sm font-semibold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 transition">%</button>

                <button onclick="calcInput('7')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">7</button>
                <button onclick="calcInput('8')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">8</button>
                <button onclick="calcInput('9')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">9</button>
                <button onclick="calcInput('/')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition">÷</button>

                <button onclick="calcInput('4')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">4</button>
                <button onclick="calcInput('5')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">5</button>
                <button onclick="calcInput('6')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">6</button>
                <button onclick="calcInput('*')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition">×</button>

                <button onclick="calcInput('1')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">1</button>
                <button onclick="calcInput('2')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">2</button>
                <button onclick="calcInput('3')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">3</button>
                <button onclick="calcInput('-')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition">−</button>

                <button onclick="calcInput('0')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">0</button>
                <button onclick="calcInput('.')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition">.</button>
                <button onclick="calcInput('=')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-gradient-to-r from-blue-500 to-purple-600 text-white hover:from-blue-600 hover:to-purple-700 transition shadow-lg shadow-blue-500/25">=</button>
                <button onclick="calcInput('+')" class="px-4 py-3 rounded-xl text-lg font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition">+</button>
            </div>
        </div>
    </div>
</div>

<script>
let display = document.getElementById('calcDisplay');
let history = document.getElementById('calcHistory');
let currentInput = '0';
let previousInput = '';
let operator = null;
let shouldReset = false;

function calcInput(value) {
    if (value === 'clear') {
        currentInput = '0';
        previousInput = '';
        operator = null;
        shouldReset = false;
        history.innerHTML = '&nbsp;';
    } else if (value === 'backspace') {
        if (currentInput.length > 1) {
            currentInput = currentInput.slice(0, -1);
        } else {
            currentInput = '0';
        }
    } else if (value === '%') {
        currentInput = String(parseFloat(currentInput) / 100);
    } else if (value === '=') {
        if (operator && previousInput) {
            let result = calculate(parseFloat(previousInput), operator, parseFloat(currentInput));
            history.innerHTML = formatNumber(previousInput) + ' ' + getOpSymbol(operator) + ' ' + formatNumber(currentInput) + ' =';
            currentInput = String(result);
            operator = null;
            previousInput = '';
            shouldReset = true;
        }
    } else if (['+', '-', '*', '/'].includes(value)) {
        if (operator && !shouldReset) {
            currentInput = String(calculate(parseFloat(previousInput), operator, parseFloat(currentInput)));
        }
        previousInput = currentInput;
        operator = value;
        history.innerHTML = formatNumber(currentInput) + ' ' + getOpSymbol(value);
        shouldReset = true;
    } else {
        if (shouldReset) {
            currentInput = '';
            shouldReset = false;
        }
        if (value === '.' && currentInput.includes('.')) return;
        if (currentInput === '0' && value !== '.') {
            currentInput = value;
        } else {
            currentInput += value;
        }
        history.innerHTML = previousInput && operator
            ? formatNumber(previousInput) + ' ' + getOpSymbol(operator)
            : '&nbsp;';
    }

    display.textContent = formatNumber(currentInput);
}

function calculate(a, op, b) {
    let result;
    switch (op) {
        case '+': result = a + b; break;
        case '-': result = a - b; break;
        case '*': result = a * b; break;
        case '/': result = b !== 0 ? a / b : 'Error'; break;
    }
    return result;
}

function getOpSymbol(op) {
    return { '+': '+', '-': '−', '*': '×', '/': '÷' }[op] || op;
}

function formatNumber(num) {
    if (num === 'Error') return 'Error';
    let n = parseFloat(num);
    if (isNaN(n)) return '0';
    if (Number.isInteger(n)) return n.toLocaleString();
    return n.toLocaleString(undefined, { maximumFractionDigits: 10 });
}
</script>
@endsection
