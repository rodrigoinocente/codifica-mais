<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Document')</title>
</head>

<body>
    <div id="container">
        @yield('content')
    </div>
</body>

</html>
<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 4rem;
    }

    #container {
        display: flex;
        flex-direction: column;
        border: 1px solid #9e9e9e;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    .alert {
        padding: 0.75rem 1rem;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
    }

    .alert-success {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    }

    .alert-error {
        background: #fee2e2;
        border: 1px solid #fca5a5;
        color: #b91c1c;
    }
</style>
