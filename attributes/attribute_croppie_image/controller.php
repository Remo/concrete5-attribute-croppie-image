<?php

namespace Concrete\Package\AttributeCroppieImage\Attribute\AttributeCroppieImage;

use Database;
use Concrete\Core\Attribute\Controller as AttributeTypeController;

class Controller extends AttributeTypeController
{
    public $helpers = ['form'];

    protected $searchIndexFieldDefinition = [
        'type' => 'text',
        'options' => array('default' => null, 'notnull' => false),
    ];

    public function deleteKey()
    {
        $db = Database::connection();
    }

    public function deleteValue()
    {
        $db = Database::connection();
        $db->executeQuery('DELETE FROM atCroppieImage where avID = ?', [$this->getAttributeValueID()]);
    }

    /**
     * Returns the value entered in the HTML editor
     * @return string
     */
    public function getValue()
    {
        $values = $this->getValues();

        if ($values) {
            return DIR_REL . '/application/files/avatar/' . $values['fileName'];
        }
    }

    protected function getValues()
    {
        $db = Database::connection();
        $avID = $this->getAttributeValueID();

        if ($avID) {
            $row = $db->fetchAssoc('SELECT * FROM atCroppieImage WHERE avID = ?', [$avID]);

            return $row;
        }

        return false;
    }

    /**
     * Shows the attribute configuration form
     */
    public function type_form()
    {
    }

    /**
     * Saves the attribute configuration
     * @param $data
     */
    public function saveKey($data)
    {
    }

    /**
     * Shows the form to enter the value
     */
    public function form()
    {
        $this->requireAsset('croppie');
        $values = $this->getValues();
        $this->set('values', $values);

        if ($values['fileName'] && $values['settings']) {
            $bindOptions = json_decode($values['settings'], true);
            $bindOptions['url'] = BASE_URL . '/application/files/avatars/' . $values['fileName'];
            $this->set('bindOptions', $bindOptions);
        }
    }

    /**
     * Called when we're searching using an attribute.
     * @param $list
     */
    public function searchForm($list)
    {

    }

    /**
     * Called when we're saving the attribute from the frontend.
     * @param $data
     */
    public function saveForm($data)
    {
        $args = [
            'avID' => $this->getAttributeValueID(),
            'settings' => $data['settings'],
        ];

        // save thumbnail if there's one
        if (isset($data['fileNameThumbnail']) && !empty($data['fileNameThumbnail'])) {
            $fileName = uniqid('avatar_thumbnail');
            $thumbnailFileName = DIR_BASE . '/application/files/avatars/' . $fileName . '.png';

            $fileData = explode(',', $data['fileNameThumbnail']);

            $ifp = fopen($thumbnailFileName, 'wb');
            fwrite($ifp, base64_decode($fileData[1]));
            fclose($ifp);

            $args['fileNameThumbnail'] = $fileName . '.png';
        }

        // save original file
        if (isset($data['fileName']) && !empty($data['fileName'])) {
            $fileName = uniqid('avatar');
            $thumbnailFileName = DIR_BASE . '/application/files/avatars/' . $fileName . '.png';

            $fileData = explode(',', $data['fileName']);

            $ifp = fopen($thumbnailFileName, 'wb');
            fwrite($ifp, base64_decode($fileData[1]));
            fclose($ifp);

            $args['fileName'] = $fileName . '.png';
        }


        $db = Database::connection();
        $db->Replace('atCroppieImage', $args, 'avID', true);
    }

    /**
     * Called when the attribute is edited in the composer.
     */
    public function composer()
    {
        $this->form();
    }

}
