<?php if(isset($_SESSION['messages'])): ?>
<div class="--feedback">
    <?php foreach ($_SESSION['messages'] as $message): ?>
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= $message ?>
        <a type="button" class="close passive close-me" href="javascript:;">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
