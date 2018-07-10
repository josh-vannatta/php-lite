<?php
   $page_title = 'Admin | All Accounts';
   App::view('partials/header', compact('page_title'));
   $actc =(in_array('acct_ctrl', App::admin('permissions')));
 ?>

 <section class="row">
   <div class="col-lg-12 --inline-header">
     <h3 class="--section-header">Administrators</h3>
     <?php if ($actc) : ?>
     <a href="/admin/system/create" class="--link-block">CREATE NEW</a>
     <?php endif; ?>
   </div>
   <div class="<?php if ($actc) : ?> col-lg-10 col-md-11 <?php else: ?>col-lg-9 <?php endif; ?>">
     <ul class="--news-feed">
       <?php foreach($accounts as $admin) : ?>
         <li class="--module">
           <div class="--news-item" href="/admin/system/profile=<?= $admin->email ?>">
             <div class="--header">
               <h4 class="--title"><?= $admin->name ?></h4>
               <p class="--subtitle"><?= $admin->role ?></p>
             </div>
             <div class="--body row">
               <div class="<?php if ($actc) : ?>col-sm-10<?php else: ?>col-sm-12<?php endif; ?> --no-padding">
                 <div class="col-sm-12 --no-padding">
                   <?php App::view('system/permissions', compact('admin')) ?>
                 </div>
               </div>
               <?php if ($actc) : ?>
               <div class="col-sm-2 --controls" style="padding-right: 0">
                 <a <?php if ($admin->email != App::admin('email') && $admin->role != 'Website Administrator'): ?>
                   href="/admin/system/profile=<?= $admin->email ?>"
                   class="--link-block --basic"
                   <?php else: ?>
                   disabled="disabled" class="--link-block --basic --disabled"
                 <?php endif; ?> >Edit</a>
                 <button type="button"
                  <?php if ($admin->email != App::admin('email') && $admin->role != 'Website Administrator'): ?>
                    onclick="deleteAdmin('<?= $admin->email ?>', '<?= $admin->name ?>')"
                    class="--link-block --cancel"
                  <?php else: ?>
                    disabled="disabled" class="--link-block --cancel --disabled"
                  <?php endif; ?> >Remove</a>
               </div>
               <?php endif; ?>
             </div>
           </div>
         </li>
       <?php endforeach; ?>
     </ul>
   </div>
</section>
<?php if ($actc) : ?>
<section class="--modal --transition --hidden">
  <div id="delete-popup" class="--popup --transition --hidden">
    <div class="--close">
      <button class="--transition close-popup" type="button" name="cancel">X</button>
    </div>
    <form class="" action="/admin/system/delete" method="post">
      <div class="--content">
        <input id="delete-id" type="hidden" name="email" value="">
        <p class="--message">Permanently delete administrator account?</p>
        <h4 id="delete-title"></h4>
      </div>
      <div class="--action">
        <button type="submit" name="submit" class="--button-gen --cancel --transition">Delete</button>
        <button type="button" name="cancel" class="close-popup --button-gen --basic --transition">Cancel</button>
        <small class="--disclosure">*Cannot be undone once confirmed</small>
      </div>
    </form>
  </div>
</section>
<?php endif; ?>

 <?php App::view('partials/footer') ?>
