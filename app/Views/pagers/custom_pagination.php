<?php $pager->setSurroundCount(2); ?>

<div class="paging_simple_numbers" id="users_pagination">
  <ul class="pagination d-inline-flex m-0">
    <?php if ($pager->hasPreviousPage()) : ?>
      <li class="paginate_button page-item">
        <a href="<?= $pager->getFirst() ?>" aria-controls="users" data-dt-idx="2" tabindex="0" class="page-link">First</a>
      </li>
      <li class="paginate_button page-item">
        <a href="<?= $pager->getPreviousPage() ?>" aria-controls="users" data-dt-idx="2" tabindex="0" class="page-link">previous</a>
      </li>
    <?php else : ?>
      <li class="paginate_button page-item disabled">
        <a href="<?= $pager->getPreviousPage() ?>" aria-controls="users" data-dt-idx="2" tabindex="0" class="page-link">previous</a>
      </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
      <li class="paginate_button page-item <?= $link['active'] ? 'active' : '' ?>">
        <a href="<?= $link['uri'] ?>" aria-controls="users" data-dt-idx="1" tabindex="0" class="page-link"><?= $link['title'] ?></a>   
      </li>
    <?php endforeach ?>

    <?php if ($pager->hasNextPage()) : ?>
      <li class="paginate_button page-item">
        <a href="<?= $pager->getNextPage() ?>" aria-controls="users" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
      </li>
      <li class="paginate_button page-item">
        <a href="<?= $pager->getLast() ?>" aria-controls="users" data-dt-idx="2" tabindex="0" class="page-link">Last</a>
      </li>
    <?php else : ?>
      <li class="paginate_button page-item disabled">
        <a href="<?= $pager->getNextPage() ?>" aria-controls="users" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
      </li>
    <?php endif ?>
  </ul>
</div>