{*On étend le layout*}
{extends file="layout/layout.tpl"}
{*On modifie le titre de l'onglet*}
{block name="title"}My account{/block}
{*On affiche le contenu de la page*}
{block name="content"}
    <h1 class="text-uppercase text-underline text-center my-5">Manage my account</h1>
    {*La partie pour modifier les informations du compte*}
    <section class="mask d-flex align-items-center h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card border-purple" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Update informations</h2>
                            <form>
                                <div class="form-outline mb-4">
                                    <input type="text" id="form3Example1cg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1cg">My Username</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="email" id="form3Example3cg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example3cg">My Email</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="form3Example4cg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cg">My Actual Password</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="form3Example4cdg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cdg">My New Password</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="form3Example4cdg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cdg">Repeat My New Password</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-purple btn-block btn-lg text-body">Update my informations</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="card border-purple mt-4">
        <h2 class="text-uppercase text-center my-5">My cocktails</h2>
        {*La partie pour lister les cocktails créés par l'utilisateur*}
        <div class="justify-content-evenly row">
            {*la carte cocktail*}
            <div class="col-4 d-flex justify-content-center mb-5">
                <div class="card text-center p-2" style="width: 350px">
                    <img src="{base_url()}/assets/pictures/cocktail.jpg" class="object-fit-fill"  alt="the picture name">
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
    </section>
{/block}