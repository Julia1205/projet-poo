{extends file="layout/layout.tpl"}
{*On modifie le contenu*}
{block name="content"}
    <section class="card border-purple mt-4 container text-center">
        <div class="row">
            <h1>Le nom du cocktail</h1>
        </div>
        {*Les infos du cocktail (image, ingrédients)*}
        <div class="row">
            {*L'image du cocktail*}
            <div class="col-5">
                <img src="{base_url()}/assets/pictures/cocktail.jpg" alt="cocktail" class="img-fluid">
            </div>
            {*La boucle de l'ensemble des ingrédients du cocktail*}
            <div class="d-flex col-7 text-center d-flex flex-wrap justify-content-evenly">
                {*Une carte ingrédient*}
                <div class="card my-2 border-purple" style="width: 135px; max-height: 230px">
                    <img src="{base_url()}/assets/pictures/cocktail.jpg" alt="" class="img-fluid">
                    <h5>Ingredient name</h5>
                    <h5>Quantity</h5>
                </div>
            </div>
        </div>
        {*La recette*}
        <div class="row text-center my-3">
            <h3>The recipe</h3>
            {*A enlever lors du remplissage avec les données*}
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ullamcorper varius lectus, ac vulputate ante bibendum eu. Praesent vel condimentum dui, ac dapibus erat. Integer porttitor, erat vitae eleifend feugiat, lectus velit sagittis tellus, eu mattis nunc tortor vel lectus. Curabitur eu leo ornare, finibus mauris maximus, dapibus magna. Quisque sed tellus imperdiet, varius nulla sed, semper mauris. Phasellus arcu lectus, sollicitudin eu lacinia in, efficitur in ante. Mauris viverra, lorem finibus eleifend ornare, erat augue ultricies leo, ut volutpat est turpis in leo. Curabitur efficitur nunc luctus diam suscipit, sit amet ultrices erat commodo. Praesent aliquam metus id lobortis lacinia. Quisque suscipit diam massa, vitae fringilla orci porttitor sit amet. Aliquam a pulvinar enim.
                </p>
                <p>
                    Integer a elementum ex. Fusce ante neque, luctus at dictum rutrum, viverra ut sapien. In dignissim viverra luctus. Donec quis nisl ac est viverra egestas. Maecenas sit amet odio egestas, tempor nisi sed, rhoncus massa. Fusce faucibus est in augue lacinia venenatis. Ut non venenatis ante. Aenean nec dolor ac ligula porttitor malesuada. Nunc risus enim, malesuada sit amet auctor quis, sagittis in lorem.
                </p>
                <p>
                    Nam venenatis sit amet quam ut pellentesque. Pellentesque sed urna finibus ex commodo posuere vitae auctor diam. Proin quis suscipit diam. Phasellus justo tellus, laoreet ut nibh ut, mollis pharetra lorem. Pellentesque luctus nunc sit amet enim faucibus, quis luctus orci tincidunt. Vivamus nec magna luctus, condimentum massa vel, luctus turpis. In at tempor felis. Donec efficitur dolor nec sapien pharetra elementum. Nulla vulputate vitae neque et varius.
                </p>
            {*jusqu'ici*}
        </div>
        {*Le btn pour modifier le cocktail si on en est l'auteur*}
        <div class="d-flex justify-content-center mb-3">
            <a href="{base_url('cocktail/update/cocktailId')}" class="btn btn-purple btn-block btn-lg text-body">Update cocktail</a>
        </div>
    </section>
{/block}