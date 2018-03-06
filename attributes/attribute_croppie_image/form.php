<div class="attribute-croppie-image-wrap"
     data-viewport-width="<?= $viewportWidth ?>"
     data-viewport-height="<?= $viewportHeight ?>"
     data-boundary-width="<?= $boundaryWidth ?>"
     data-boundary-height="<?= $boundaryHeight ?>">
    <?php if (isset($values['fileNameThumbnail'])) { ?>
        <div class="changeAvatarWrapper">
            <img src="<?= BASE_URL ?>/application/files/avatars/<?= $values['fileNameThumbnail'] ?>">
        </div>
    <?php } ?>

    <div class="uploadAvatar <?= isset($values['fileNameThumbnail']) ? 'hidden' : '' ?>">
        <div id="attribute-croppie-image" class="hidden attribute-croppie-image"></div>
    </div>

    <div class="actions">
        <a class="btn btn-primary file-btn">
            <span><?= t('Upload Avatar') ?></span>
            <input type="file" id="upload" class="uploadAvatarButton" value="Choose a file" accept="image/*"/>
        </a>
    </div>

    <input type="hidden" name="<?= $this->field('fileName') ?>" class="originalFileName">
    <input type="hidden" name="<?= $this->field('fileNameThumbnail') ?>" class="fileNameThumbnail">
    <input type="hidden" name="<?= $this->field('fileSettings') ?>" class="fileSettings">
</div>