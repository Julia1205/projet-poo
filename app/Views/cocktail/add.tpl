{extends file="layout/layout.tpl"}
{*On modifie le contenu*}
{block name="content"}
    <section class="mask d-flex align-items-center h-100 mb-5">
        <div class="container h-100 mb-5">
            <div class="row d-flex justify-content-center align-items-center h-100 mb-5">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card border-purple" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Add new cocktail</h2>
                            {*Le nom du nouveau cocktail*}
                            <div class="form-outline mb-4">
                                <input type="text" id="form3Example1cg" class="form-control form-control-lg" />
                                <label class="form-label" for="form3Example1cg">Cocktail name</label>
                            </div>
                            {*L'image du nouveau cocktail*}
                            <div class="form-outline mb-4">
                                <input class="form-control" type="file" id="formFile">
                                <label for="formFile" class="form-label">Cocktail Picture</label>
                            </div>
                            {*Le type de verre du nouveau cocktail*}
                            <div class="form-outline mb-4">
                                <select name="cocktailGlass" id="cocktailGlass" class="form-select">
                                    <option value="">--Select a glass--</option>
                                    {*On liste l'ensemble des verres en bdd*}
                                </select>
                                <label class="form-label" for="cocktailGlass">Cocktail name</label>
                            </div>
                            {*Si le nouveau cocktail est avec ou sans alcool*}
                            <div class="form-outline mb-4">
                                <input type="radio" name="cocktailAlcool" id="cocktailAlcoolWithout" class="form-check-input">
                                <label for="cocktailAlcoolWithout">Cocktail without alcool</label>
                                <br>
                                <input type="radio" name="cocktailAlcool" id="cocktailAlcoolWith" class="form-check-input">
                                <label for="cocktailAlcoolWith">Cocktail with alcool</label>
                            </div>
                            {*On fait une boucle pour les ingrédients*}
                            {for $ingredient = 1 to 15 }
                                {$nextIngredient = $ingredient + 1}
                                {if $ingredient > 1}
                                    {$hidden = 'd-none'}
                                {else}
                                    {$hidden = false}
                                {/if}
                                <div class="form-outline mb-4 {$hidden}" id="cocktailIngredient{$ingredient}">
                                    <select name="cocktailIngredient{$ingredient}" id="cocktailIngredientForm{$ingredient}" class="form-select">
                                        <option value="">--Select an ingredient--</option>
                                        {*On liste l'ensemble des verres en bdd*}
                                    </select>
                                    <label class="form-label" for="cocktailIngredientForm{$ingredient}">Cocktail ingredient {$ingredient}</label>
                                    {*On demande la qtt de l'ingrédient*}
                                    <input type="number" name="cocktailIngredientQuantity{$ingredient}" id="cocktailIngredientQuantity{$ingredient}" class="form-control">
                                    <label for="cocktailIngredientQuantity{$ingredient}">Quantity</label>
                                    {if $ingredient < 15}
                                        <br>
                                        <div class="btn btn-purple" id="showIngredient{$nextIngredient}" onclick="showHiddenById('cocktailIngredient{$nextIngredient}', 'showIngredient{$nextIngredient}')">Add 1 more ingredient</div>
                                    {/if}
                                </div>
                            {/for}
                            {*La recette du nouveau cocktail*}
                            <div class="form-outline mb-4">
                                <textarea name="cocktailRecipe" id="cocktailRecipe" cols="30" rows="10" class="form-control"></textarea>
                                <label for="cocktailRecipe">Cocktail recipe</label>
                            </div>
                            {*Le btn pour créer le nouveau cocktail*}
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-purple btn-block btn-lg text-body">Create new cocktail</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{/block}