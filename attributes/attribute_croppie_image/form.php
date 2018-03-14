<div class="attribute-croppie-image-wrap"
     data-viewport-width="<?= $viewportWidth ?>"
     data-viewport-height="<?= $viewportHeight ?>"
     data-boundary-width="<?= $boundaryWidth ?>"
     data-boundary-height="<?= $boundaryHeight ?>">
    <div class="changeAvatarWrapper">
        <?php if (isset($values['fileNameThumbnail'])) { ?>
            <img src="<?= BASE_URL ?>/application/files/avatars/<?= $values['fileNameThumbnail'] ?>">
        <?php } else { ?>
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
        <?php } ?>
    </div>

    <div class="uploadAvatar <?= isset($values['fileNameThumbnail']) ? 'hidden' : '' ?>">
        <div id="attribute-croppie-image" class="hidden attribute-croppie-image"></div>
    </div>

    <div class="actions">
        <a class="btn btn-primary file-btn uploadAvatarButtonWrapper">
            <span><?= t('Upload Avatar') ?></span>
            <input type="file" id="upload" class="uploadAvatarButton" value="Choose a file" accept="image/*"/>
        </a>
        <?php if ($showDeleteButton) { ?>
            <a class="btn btn-primary deleteAvatar <?php if (!isset($values['fileNameThumbnail'])) { ?>hidden<?php } ?>">
                <span><?= t('Delete Avatar') ?></span>
            </a>
        <?php } ?>
        <a class="btn btn-primary applyAvatar hidden">
            <span><?= t('Apply Avatar') ?></span>
        </a>
    </div>

    <input type="hidden" name="<?= $this->field('fileNameThumbnail') ?>" class="fileNameThumbnail">
    <input type="hidden" name="<?= $this->field('fileSettings') ?>" class="fileSettings">
</div>