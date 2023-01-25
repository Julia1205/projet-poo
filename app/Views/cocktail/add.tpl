{extends file="layout/layout.tpl"}
{*On modifie le contenu*}
{block name='js_top' append}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{/block}
{block name="content"}
    <div class='errors'>
        {*$arrErrors*}
    </div>
    {$form_open}
        <section class="mask d-flex align-items-center h-100 mb-5">
            <div class="container h-100 mb-5">
                <div class="row d-flex justify-content-center align-items-center h-100 mb-5">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card border-purple" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Add new cocktail</h2>
                                {*Le nom du nouveau cocktail*}
                                <div class="form-outline mb-4">
                                    {$input_name}
                                    {$label_name}
                                </div>
                                {*L'image du nouveau cocktail*}
                                <div class="form-outline mb-4">
                                    <input class="form-control" type="file" id="formFile">
                                    <label for="formFile" class="form-label">Cocktail Picture</label>
                                </div>
                                {*Le type de verre du nouveau cocktail*}
                                <div class="form-outline mb-4">
                                    {$input_glass}
                                    {$label_glass}                                
                                </div>
                                {*Si le nouveau cocktail est avec ou sans alcool*}
                                <div class="form-outline mb-4">
                                    {$input_nonalcohol}
                                    {$label_nonalcohol}
                                    <br>
                                    {$input_alcohol}
                                    {$label_alcohol}
                                </div>
                                {*On fait une boucle pour les ingrédients*}
                                    {for $foo = 1 to 15}
                                        <div class='card border-purple m-2 p-2' id='{$foo}'>
                                            {$input_ingredient.$foo}
                                            {$label_ingredient_name}<br>
                                            {$input_quantity.$foo}<br>
                                            {$label_quantity_name}
                                        <div>
                                        <span class='btn btn-purple add{$foo}' id='add{$foo}'> add more ingredient</span>
                                        </div>
                                        </div>
                                    {/for}
                                
                                {*La recette du nouveau cocktail*}
                                <div class="form-outline mb-4">
                                    <textarea name="cocktailRecipe" id="cocktailRecipe" cols="30" rows="10" class="form-control"></textarea>
                                    <label for="cocktailRecipe">Cocktail recipe</label>
                                </div>
                                {*Le btn pour créer le nouveau cocktail*}
                                <div class="d-flex justify-content-center">
                                    {$form_submit}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    {$form_close}
{/block}
{block name='js_bot' append}
        <script src="{base_url('assets/js/addCocktail.js')}"></script>
{/block}