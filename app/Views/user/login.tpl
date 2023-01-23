{*On extend le layout*}
{extends file="layout/layout.tpl" }
{*On modifie le title de la page*}
{*On ajoute du contenu à la page*}
{block name="content"}
    <section class="mask d-flex align-items-center h-100 mb-5">
        <div class="container h-100 mb-5">
            <div class="row d-flex justify-content-center align-items-center h-100 mb-5">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card border-purple" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Log in</h2>
                            {$form_open}
                                <div class="form-outline mb-4">
                                    {$form_username}
                                    {$label_username}
                                </div>
                                <div class="form-outline mb-4">
                                    {$form_pwd}
                                    {$label_password}
                                </div>
                                <div class="d-flex justify-content-center">
                                    {$form_submit}
                                </div>
                                <p class="text-center text-muted mt-5 mb-0">Haven't any account ? <a href="{base_url('/register')}" class="fw-bold text-body"><u>Register here</u></a></p>
                            {$form_close}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{/block}