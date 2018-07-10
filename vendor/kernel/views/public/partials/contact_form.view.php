<section id="contact-form-section" class="contact-form-section padding-xl no-padding-top">
  <div class="contact-form-main wide-rule">
    <p style='line-height: 1.7;'>We will never distribute or solicit your contact information.</p>
    <div class="contact-form-container box-shadow-light collapse-568">
      <form action="/<?= $cur_page ?>/email" id="contact-form" method="post">
        <div class="row form-dual-col">
          <div class="no-padding col-sm-6 col-xs-6 form-solo-name">
            <div class="form-input-area">
              <label class="form-input-label">First Name:<span class="form-asterix">*</span></label>
              <?php if(isset($_SESSION['errors']['name-first'])): ?>
              <div class="input-err" id="err-first">
              <?php else: ?>
              <div class="input-err hidden" id="err-first">
              <?php endif; ?>
               <p>Please enter your first name</p>
             </div>
              <input class="form-input clear-errors" type="text" name="name-first" value="<?php if(isset($_SESSION['input_data'])) echo $_SESSION['input_data']['name-first'] ?>"></input>
            </div>
          </div>
          <div class="no-padding col-sm-6 col-xs-6 form-solo-name">
            <div class="form-input-area">
              <label class="form-input-label">Last Name:<span class="form-asterix">*</span></label>
              <?php if(isset($_SESSION['errors']['name-last'])): ?>
              <div class="input-err" id="err-last">
              <?php else: ?>
              <div class="input-err hidden" id="err-last">
              <?php endif; ?>
               <p>Please enter your last name</p>
             </div>
              <input class="form-input clear-errors" type="text" name="name-last" value="<?php if(isset($_SESSION['input_data'])) echo $_SESSION['input_data']['name-last'] ?>"></input>
            </div>
          </div>
        </div>
        <div class="row form-solo-md">
          <div class="form-input-area">
            <label class="form-input-label">Country:</label>
            <div class="form-select-icon"><i id="i-country" class="material-icons navfull-dropdown">arrow_drop_down</i></div>
            <select id="country" onmouseover="expSelect('i-country', 1)" onmouseout="expSelect('i-country', 0)" class="form-input form-select" name="country"></select>
          </div>
        </div>
        <div class="row form-solo-md">
          <div class="form-input-area">
            <label class="form-input-label">Email:<span class="form-asterix">*</span></label>
            <?php if(isset($_SESSION['errors']['email'])): ?>
            <div class="input-err" id="err-email">
            <?php else: ?>
            <div class="input-err hidden" id="err-email">
            <?php endif; ?>
               <p>Please enter a valid email address</p>
             </div>
            <input class="form-input clear-errors" type="text" name="email" value="<?php if(isset($_SESSION['input_data'])) echo $_SESSION['input_data']['email'] ?>"></input>
          </div>
        </div>
        <div class="row form-empty"></div>
        <div class="row form-solo-lg">
          <div class="form-input-area">
            <label class="form-input-label">Organization:</label>
            <input class="form-input" type="text" name="organization" value="<?php if(isset($_SESSION['input_data'])) echo $_SESSION['input_data']['organization'] ?>"></input>
          </div>
        </div>
        <div class="row form-dual-col">
          <div class="no-padding col-sm-5 col-lg-6 col-xs-5 form-solo-ph">
            <div class="form-input-area">
              <label class="form-input-label">Phone:</label>
              <input class="form-input" type="tel" name="phone" value="<?php if(isset($_SESSION['input_data'])) echo $_SESSION['input_data']['phone'] ?>"></input>
            </div>
          </div>
          <div class="no-padding col-sm-5 col-lg-6 col-xs-5 form-solo-ph">
            <div class="form-input-area">
              <label class="form-input-label">Fax:</label>
              <input class="form-input" type="tel" name="fax" value="<?php if(isset($_SESSION['input_data'])) echo $_SESSION['input_data']['fax'] ?>"></input>
            </div>
          </div>
        </div>
        <div class="row form-tri-col">
          <div class="form-solo-lg form-solo-org no-padding col-md-12 col-sm-7 col-lg-12 col-xs-12">
            <div class="form-input-area">
              <label class="form-input-label">Address:</label>
              <input class="form-input" type="text" name="address" value="<?php if(isset($_SESSION['input_data'])) echo $_SESSION['input_data']['address'] ?>"></input>
            </div>
          </div>
          <div class="no-padding col-md-4 col-sm-4 col-md-4 col-lg-4 col-xs-10 form-solo-st">
            <div class="form-input-area">
              <label class="form-input-label">State/Province:</label>
              <div class="form-select-icon"><i id="i-state" class="material-icons navfull-dropdown">arrow_drop_down</i></div>
              <select id="state" onmouseover="expSelect('i-state', 1)" onmouseout="expSelect('i-state', 0)" class="form-input form-select" name="state"></select>
            </div>
          </div>
          <div class="no-padding col-md-4 col-sm-5 col-md-3 col-lg-4 col-xs-6 form-solo-ci">
            <div class="form-input-area">
              <label class="form-input-label">City:</label>
              <input class="form-input" type="text" name="city" value="<?php if(isset($_SESSION['input_data'])) echo $_SESSION['input_data']['city'] ?>"></input>
            </div>
          </div>
          <div class="no-padding col-md-4 col-sm-5 col-md-3 col-lg-4 col-xs-6 form-solo-zi">
            <div class="form-input-area">
              <label class="form-input-label">ZIP/Postcode:</label>
              <input class="form-input" type="number" name="zip" value="<?php if(isset($_SESSION['input_data'])) echo $_SESSION['input_data']['zip'] ?>"></input>
            </div>
          </div>
        </div>
        <div class="row form-empty"></div>
        <div class="row form-solo-full">
          <div class="form-input-area">
            <label class="form-input-label">Message:<span class="form-asterix">*</span></label>
            <?php if(isset($_SESSION['errors']['message'])): ?>
            <div class="input-err" id="err-msg">
            <?php else: ?>
            <div class="input-err hidden" id="err-msg">
            <?php endif; ?>
               <p>Please enter your message</p>
             </div>
            <textarea class="form-input form-message clear-errors" type="textarea" name="message"><?php if(isset($_SESSION['input_data'])) echo $_SESSION['input_data']['message'] ?></textarea>
          </div>
        </div>
        <script language="javascript">
           populateCountries("country", "state");
           populateCountries("country2");
        </script>
      </form>
    </div>
    <p style='line-height: 1.7;'>We will never distribute or solicit your contact information.<br/> *Required field <br/></p>
    <div class="captcha-widget">
      <form action="?" method="POST">
        <div class="g-recaptcha" data-sitekey="6LfGMSkUAAAAABYtLrdRoadXKRSs0eDKJynOmRBr" data-callback="recaptcha_callback"></div>
      </form>
      <div class="input-err hidden" id="err-captcha">
       <p>Please verify</p>
     </div>
    </div>
    <a class="standard-button" style="cursor: pointer" onclick="sendMessage()">SEND MESSAGE</a>
  </div>
</section>
<?php if (isset($_SESSION['success'])): ?>
<div id="contact-modal" class="contact-modal cover-all" style="opacity: 1">
<?php else: ?>
<div id="contact-modal" class="contact-modal cover-all hidden">
<?php endif; ?>
  <?php if (isset($_SESSION['success']) && $_SESSION['success'] == '1'): ?>
  <div class="contact-modal-container box-shadow-light">
    <a href="javascript:;" onclick="closeContactModal(1)" class="close-modal">X</a>
    <h2 class="subheader-main">Thank you for contacting Neuraptive!</h2>
    <p>We'll respond as quickly as possible. <a class="floating-link" href="http://www.neuraptive.com">Click here</a> to return home or close this box to return to the current page</p>
  <?php elseif (isset($_SESSION['success']) && $_SESSION['success'] == '0'):  ?>
    <div class="contact-modal-container box-shadow-light">
      <a href="javascript:;" onclick="closeContactModal(0)" class="close-modal">X</a>
    <h2 class="subheader-main">It looks like we experienced an error</h2>
    <p>We were unable to send your message. You can email us directly at info@neuraptive.com or call us at (303) 736-9657. <a class="floating-link" href="http://www.neuraptive.com">Click here</a> to return home or close this box to try again. </p>
  <?php endif; ?>
  </div>
</div>
<?php $_SESSION['errors'] = [] ?>
<!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
