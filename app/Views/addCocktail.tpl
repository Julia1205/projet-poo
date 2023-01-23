{extends file="layout/layout.tpl" }
{block name='js_top' append} 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{/block}
{block name='content'}
    {$form_open}<br>
    {$input_name}<br>
    {$label_name}<br>
    {$input_receipe}<br>
    {$label_receipe}<br>
    {$input_glass}<br>
    <div id='test'>
        {$input_ingredients}
        {$input_quantity}<br>
    </div>
{$form_close}
    <button id='addIngredientLine'>add</button>
{/block}
{block name='js_bot' append} 
    <script src="{base_url('assets/js/addCocktail.js')}"></script>
{/block}