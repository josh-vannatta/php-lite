<?php
   App::view('layouts/master_top', [
    'page_title' => 'Home Page'
   ]);
 ?>
 <div class="container py-5">
   <div class="flex-center flex-column my-5">
     <img src="<?= base_url() ?>/assets/icons/error-404" alt="" width="150">
     <div class="ml-5 text-center">
       <h1 class="display-4">I think you might be lost.</h1>
       <h3 class="display-2 mt-0">Move along.</h3>
     </div>
   </div>
 </div>
<?php App::view('layouts/master_bottom'); ?>
