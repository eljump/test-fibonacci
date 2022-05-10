<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Числа Фибоначчи</title>

    <link rel="stylesheet" href="{{ mix('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ mix('css/loader.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <meta name="csrf-token" content="{{{ csrf_token() }}}">
</head>
<body>
<div class="container">
    <header class="header">Числа Фибоначчи</header>
</div>
<section class="main">
    <form id="form">
        <div class="title">
            <h1>Введите диапазон:</h1>
        </div>
        <div class="inputs-grid">
            <div class="input-wrapper">
                <input name="X" class="input" type="number">
                <label for="X" class="label-error">
                    <span class="error-text"></span>
                </label>
            </div>
            <div class="input-wrapper">
                <input name="Y" class="input" type="number">
                <label for="Y" class="label-error">
                    <span class="error-text"></span>
                </label>
            </div>
        </div>
        <div class="btn-wrapper">
            <button type="submit" class="btn">Вывести срез</button>
        </div>
    </form>
    <div id="result" class="result">
        <div class="title">
            <h2>Результат:</h2>
        </div>
        <div class="loader-wrapper">
            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="results-show">
            <div></div>
        </div>
    </div>
</section>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
