{*On extend le layout*}
{extends file="layout/layout.tpl" }
{*On modifie le title de la page*}
{*On ajoute du contenu à la page*}
{block name="content"}
    {if isset($array)}
        {var_dump($array)}
    {/if}
    {if !empty(session('success'))}
        <div class="alert alert-success">
            {session('success')}
        </div>
    {else if !empty(session('fail'))}
        <div class="alert alert-danger">
            {session('fail')}
        </div>
    {/if}
    <section class="mask d-flex align-items-center h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card border-purple" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>
                            <form method="POST" action="{base_url('/registerUser')}" >
                            {csrf_field()}
                                <div class="form-outline mb-4">
                                    <input type="text" id="form3Example1cg" name="name" value="{set_value('name')}" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1cg">Your Username</label>
                                    <br>
                                    <span class="text-danger text-sm">
                                        {if isset($validation)}
                                            {display_form_errors($validation, 'name')}
                                        {else}
                                        {/if}
                                    </span>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="email" id="form3Example3cg" name="email" value="{set_value('email')}" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example3cg">Your Email</label>
                                    <br>
                                    <span class="text-danger text-sm">
                                        {if isset($validation)}
                                            {display_form_errors($validation, 'email')}
                                        {else}
                                        {/if}
                                    </span>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="form3Example4cg" name="password" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cg">Your Password</label>
                                    <br>
                                    <span class="text-danger text-sm">
                                        {if isset($validation)}
                                            {display_form_errors($validation, 'password')}
                                        {else}
                                        {/if}
                                    </span>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="form3Example4cdg" name="password_conf" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                    <br>
                                    <span class="text-danger text-sm">
                                        {if isset($validation)}
                                            {display_form_errors($validation, 'password_conf')}
                                        {else}
                                        {/if}
                                    </span>
                                </div>
                                <div class="form-check d-flex justify-content-center mb-5">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                                    <label class="form-check-label" for="form2Example3g">
                                        I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-purple btn-block btn-lg text-body">Register</button>
                                </div>
                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{base_url('/login')}" class="fw-bold text-body"><u>Login here</u></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div>
    {form_open()}
    <p>Username : </p>
    <p>{form_input('username', set_value('username'))}</p>
    </div>
{/block}