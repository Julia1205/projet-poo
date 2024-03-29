<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{block name="title"}{$title}Cocktail Point{/block}</title>
    {block name="css"}
    {/block}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="{base_url()}/assets/css/style.css">
    {block name="js_top"}
    {/block}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
</head>
<body class="bg-dark text-white mx-3" data-bs-theme="dark">
{*La navbar*}
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="{base_url('/')}">Cocktail point</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{base_url('/cocktails/1')}">Cocktail list</a>
                </li>
                {if !isset($smarty.session.loggedUser)}
                {*On affiche si on est pas connecté*}
                <li class="nav-item">
                    <a class="nav-link" href="{base_url('/login')}">Log In / Register</a>
                </li>
                {/if}
                {*Fin de l'affichage hors connexion*}
                {*On affiche si on est connecté*}
                <li class="nav-item">
                    <a class="nav-link" href="{base_url('/cocktail/add')}">New cocktail</a>
                </li>
                {if isset($smarty.session.loggedUser)}
                <li class="nav-item">
                    <a class="nav-link" href="{base_url('/logout')}">Log Out</a>
                </li>
                {/if}
                {*Fin de l'affichage en connexion*}
                {if isset($smarty.session.loggedUser)}
                    <a class="nav-link" href="{base_url('/account')}">Account</a>
                {/if}
            </ul>
            <form class="d-flex" role="search" method='post' action="{base_url('/cocktail/search/')}">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search"/>
                <input type='submit' class="btn btn-purple"/>
            </form>
        </div>
    </div>
</nav>
<div class="container-fluid">
