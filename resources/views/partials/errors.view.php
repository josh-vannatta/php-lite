<?php if(isset($_SESSION['errors'])): ?>
<div class="--feedback">
    <?php foreach ($_SESSION['errors'] as $error): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> <?= $error ?>
        <a type="button" class="close passive close-me" href="javascript:;">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
