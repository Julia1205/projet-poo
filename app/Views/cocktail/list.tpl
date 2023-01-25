{extends file="layout/layout.tpl"}
{*On modifie le contenu*}
{block name="content"}
    <div class="justify-content-evenly row d-flex flex-wrap">
        {foreach from=$allCocktail key=cle item=item}
            <div class="col-4 d-flex justify-content-center mb-5">
                <div class="card text-center p-2" style="width: 350px">
                    L'Image du cocktail
                    <img src="{$item->cocktail_img}" class="object-fit-fill"  alt="the picture name">
                    Les informations du cocktail
                    <div class="card-body">
                        Le nom du cocktail
                        <h5 class="card-title">{$item->cocktail_name}</h5>
                        <p class="card-text">
                            {if $item->cocktail_is_alcoholic == 1}
                                Avec alcool
                            {elseif $item->cocktail_is_alcoholic == 0}
                                Sans alcool
                            {else}
                                Erreur
                            {/if}
                        </p>
                        On permet d'aller sur la fiche du cocktail
                        <a href="{base_url("cocktail/view")}/{$item->cocktail_id}" class="btn btn-purple">Open cocktail</a>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
    {*Les btn de changement de page*}
    <div class="row text-center align-middle align-items-center justify-content-center">
        {*On définit le numéro de la page précédente*}
        {if $actualPage > 1}
            {$previousPage = $actualPage - 1}
        {else}
            {$previousPage = 1}
        {/if}
        {*Page précédente*}
        <a href="{base_url('/cocktails/')}/{$previousPage}" class="btn btn-purple col-1"><</a>
        {*Le numéro de page actuel sur le nbr de pages total*}
        <div class="mx-2 col-2">Page {$actualPage} / {$maxPage}</div>
        {*On définit le numéro de la page suivante*}
        {if $actualPage < $maxPage}
            {$nextPage = $actualPage + 1}
        {else}
            {$nextPage = $actualPage}
        {/if}
        {*Page suivante*}
        <a href="{base_url('/cocktails/')}/{$nextPage}" class="btn btn-purple col-1">></a>
    </div>
{/block}