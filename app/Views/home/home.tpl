{extends file="layout/layout.tpl"}
{*On modifie le contenu*}
{block name="content"}
{if isset($registered)}
    <div class="alert alert-success">
        {$registered}
    </div>
{/if}
    <div class="justify-content-evenly row d-flex flex-wrap">
        {foreach from=$allCocktail key=cle item=item}
            <div class="col-4 d-flex justify-content-center mb-5">
                <div class="card text-center p-2" style="width: 350px">
                    {*L'Image du cocktail*}
                    <img src="{$item->cocktail_img}" class="object-fit-fill"  alt="the picture name">
                    {*Les informations du cocktail*}
                    <div class="card-body">
                        {*Le nom du cocktail*}
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
                        {*On permet d'aller sur la fiche du cocktail*}
                        <a href="{base_url("cocktail/view")}/{$item->cocktail_id}" class="btn btn-purple">Open cocktail</a>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
{/block}
