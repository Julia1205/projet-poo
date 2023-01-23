{extends file="layout/layout.tpl"}
{*On modifie le title*}
{*On modifie le contenu*}
{block name="content"}
    <div class="justify-content-evenly row d-flex flex-wrap">
        {*la carte pour chaque cocktail*}
        <div class="col-4 d-flex justify-content-center mb-5">
            <div class="card text-center p-2" style="width: 350px">
                {*L'Image du cocktail*}
                <img src="{base_url()}/assets/pictures/cocktail.jpg" class="object-fit-fill"  alt="the picture name">
                {*Les informations du cocktail*}
                <div class="card-body">
                    {*Le nom du cocktail*}
                    <h5 class="card-title">Nom du cocktail</h5>
                    {*On indique si il y a de l'alcool ou non*}
                    <p class="card-text">Avec alcool</p>
                    <p class="card-text">Sans alcool</p>
                    {*On permet d'aller sur la fiche du cocktail*}
                    <a href="#" class="btn btn-purple">Open cocktail</a>
                </div>
            </div>
        </div>
    </div>
{/block}
