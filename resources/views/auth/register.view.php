<?php
  if (isset($_SESSION['input_data'])) dd($_SESSION);
   App::view('layouts/auth_top', [
    'page_title' => 'Register User | MVC Lite'
   ]);
 ?>

  <section class="--auth-surround m-auto h-100 flex-center">
    <div class="--auth-container z-depth-1 rounded p-5">
      <div class="--auth-content">
        <div class="flex-align-row">
          <div class="--icon mr-2" style="width: 25px">
            <img src="<?= base_url(); ?>/assets/favicon/android-chrome-512x512.png" class="w-100"></img>
          </div>
          <h5 class="m-0" style="opacity: .8">MVC Lite</h5>
        </div>
        <h3 class="display-5">Create an account</h3>
        <p class="lead">To continue to your user profile</p>
        <form action="#" id="register-form">
          <div class="row">
            <div class="col-sm-6">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-group">
                <input class="mdl-textfield__input" type="text" name="first">
                <label class="mdl-textfield__label" for="sample4">First name</label>
                <span class="mdl-textfield__error error-messages"></span>
              </div>
            </div>
            <div class="col-sm-6 pl-0">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-group">
                <input class="mdl-textfield__input" type="text" name="last">
                <label class="mdl-textfield__label" for="sample4">Last name</label>
                <span class="mdl-textfield__error error-messages"></span>
              </div>
            </div>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-group">
            <input class="mdl-textfield__input" type="text" name="email">
            <label class="mdl-textfield__label" for="sample4">Email</label>
            <span class="mdl-textfield__error error-messages"></span>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-group">
            <div class="flex-align-row">
              <input class="mdl-textfield__input" type="password" name="password" id="register-pass">
              <a class="ml-2 passive-password" href="javascript:;">
                <i class="material-icons">visibility_off</i>
              </a>
            </div>
            <label class="mdl-textfield__label" for="sample4">Password</label>
            <span class="mdl-textfield__error error-messages"></span>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label form-group">
            <div class="flex-align-row">
              <input class="mdl-textfield__input" type="password" name="passwordconfirm">
              <a class="ml-2 passive-password" href="javascript:;">
                <i class="material-icons">visibility_off</i>
              </a>
            </div>
            <label class="mdl-textfield__label" for="sample4">Confirm Password</label>
            <span class="mdl-textfield__error error-messages"></span>
          </div>
          <div class="flex-align-row justify-content-between my-4">
            <a href="<?= base_url(); ?>/login" class="text-primary">Sign in instead</a>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored primary" type="submit">
              Submit
            </button>
          </div>
        </form>
        <small class="text-black-50">*All fields required to create an account</small>
      </div>
    </div>
  </section>
<?php App::view('layouts/auth_bottom'); ?>
