<?php $basePath = $this->crudBase ?? 'sparc/premiumgrains/pages'; ?>
<?php Block::put('breadcrumb') ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Backend::url($basePath) ?>">Premium Grains</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= e(__($this->pageTitle)) ?></li>
    </ol>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>
    <div class="flex-grow-1">
        <?= $this->formRenderPreview() ?>
    </div>
    <p class="pt-4">
        <a href="<?= Backend::url($basePath) ?>" class="btn btn-default oc-icon-chevron-left">Return to Premium Grains</a>
    </p>
<?php else: ?>
    <p class="flash-message static error"><?= e(__($this->fatalError)) ?></p>
<?php endif ?>
