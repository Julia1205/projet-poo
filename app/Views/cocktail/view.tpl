{extends file="layout/layout.tpl"}
{*On modifie le contenu*}
{block name="content"}

            {*
            cocktail_is_alcoholic
            cocktail_receipe
            cocktail_glass_id
            *}

            {*var_dump($allCocktail)*}


{foreach from=$allCocktail key=cle item=item}
    <section class="card border-purple mt-4 container text-center">
        <div class="row">
            <h1>{$item->cocktail_name}</h1>
        </div>
        {*Les infos du cocktail (image, ingrédients)*}
        <div class="row">
            {*L'image du cocktail*}
            <div class="col-5">
                <img src="{$item->cocktail_img}" alt="cocktail" class="img-fluid">
            </div>
            {*La boucle de l'ensemble des ingrédients du cocktail*}
            <div class="d-flex col-7 text-center d-flex flex-wrap justify-content-evenly">
                {*Une carte ingrédient*}
                <div class="card my-2 border-purple" style="width: 135px; max-height: 230px">
                    <img src="{$item->cocktail_img}" alt="" class="img-fluid">
                    {foreach from=$Cocktail_ingredient_model key=de item=ieuutem}
                        {foreach from=$ieuutem key=keykey item=iitem}
                         {$keykey}
                         {$iitem}
                        {/foreach}
                    {/foreach}

                </div>
            </div>
        </div>
        {*La recette*}
        <div class="row text-center my-3">
            <h3>The recipe</h3>
            <p>
                {if $item->cocktail_receipe != null}
                    {$item->cocktail_receipe}
                {else}
                    Any receip
                {/if}
            </p>
        </div>
        {*Le btn pour modifier le cocktail si on en est l'auteur*}
        <div class="d-flex justify-content-center mb-3">
            <a href="{base_url('cocktail/update/cocktailId')}" class="btn btn-purple btn-block btn-lg text-body">Update cocktail</a>
        </div>
    </section>
{/foreach}
{/block}