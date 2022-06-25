
<div class="d-flex">
    <?php  foreach($model->images as $image) : ?>
        <a href="<?= $image ?>" data-lightbox="gallery"><img src="<?= $image ?>" class="img-fluid w-50 mx-2"></a>
    <?php endforeach; ?>
</div>

<script>
    lightbox.option({
        'resizeDuration': 100,
        'imageFadeDuration': 100,
        'wrapAround': true
    })
</script>
