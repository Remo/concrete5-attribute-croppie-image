<fieldset>
    <legend><?= t('Attribute Options') ?></legend>
    <div class="form-group">
        <label class="control-label" for="viewportWidth"><?= t('Viewport Width') ?></label>
        <?= $form->number('viewportWidth', $viewportWidth) ?>
    </div>
    <div class="form-group">
        <label class="control-label" for="viewportHeight"><?= t('Viewport Height') ?></label>
        <?= $form->number('viewportHeight', $viewportHeight) ?>
    </div>
    <div class="form-group">
        <label class="control-label" for="boundaryWidth"><?= t('Boundary Width') ?></label>
        <?= $form->number('boundaryWidth', $boundaryWidth) ?>
    </div>
    <div class="form-group">
        <label class="control-label" for="boundaryHeight"><?= t('Boundary Height') ?></label>
        <?= $form->number('boundaryHeight', $boundaryHeight) ?>
    </div>
    <div class="form-group">
        <label class="control-label" for="showDeleteButton"><?= t('Show Delete Button') ?></label>
        <div class="checkbox">
            <label class="checkbox">
                <?= $form->checkbox('showDeleteButton', 1, $showDeleteButton) ?>
            </label>
        </div>
    </div>
</fieldset>