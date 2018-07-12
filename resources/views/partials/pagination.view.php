<nav aria-label="...">
  <ul class="pagination pagination-show"  style="margin-top: -8px">
    <?php for ($i = 1; $i <= $numPages; $i++) : ?>
    <?php if ($i == 1 || $i == $numPages || ($i > $curPage - 3 && $i < $curPage +3) || $numPages < 8 ||
             ($curPage < 5 && $i < 7 && $numPages > 7) || ($numPages > 6 && $i > $numPages - 6 && $curPage > $numPages - 4)) : ?>
        <li class="page-item">
          <a class="page-link <?php if($i == $curPage): ?>--active <?php endif; ?>" href="/admin/news/all/page=<?= $i ?>">
            <?= $i ?>
            <?php if ($i == $curPage): ?>
            <span class="sr-only">(current)</span>
          <?php endif; ?>
          </a>
        </li>
      <?php elseif ($i === $curPage - 3 || $i === $curPage + 3 || ($curPage < 4 && $i < 8) ||  ($curPage > $numPages - 4 && $i > $numPages - 7) ) : ?>
        <li class="page-item">
          <a class="page-link page-active"  href="#">...</a>
        </li>
      <?php endif; ?>
    <?php endfor; ?>
  </ul>
</nav>
