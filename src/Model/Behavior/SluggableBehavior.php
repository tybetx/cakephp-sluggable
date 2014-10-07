<?php

namespace App\Model\Behavior;

use App\Model\Behavior\Query;
use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\Utility\Inflector;

/**
 * Slug behavior
 */
class SluggableBehavior extends Behavior {

    /**
     *
     * @var type 
     */
    protected $_defaultConfig = [
        'field' => 'title',
        'slug' => 'slug',
        'replacement' => '-'
    ];

    /**
     * 
     * @param Entity $entity
     */
    public function slug(Entity $entity) {
        $config = $this->config();
        $entity->set($config['slug'], Inflector::slug($this->_unicode_convert($entity->get($config['field'])), $config['replacement']));
    }

    /**
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findSlug(Query $query, array $options) {
        return $query->where(['slug' => $options['slug']]);
    }

    /**
     * 
     * @param Event $event
     * @param Entity $entity
     */
    public function beforeSave(Event $event, Entity $entity) {
        $this->slug($entity);
    }

    /**
     * 
     * @param type $str
     * @return string
     */
    protected function _unicode_convert($str) {
        if (!$str)
            return '';
        $unicode = array(
            'a' => array('á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ặ', 'ằ', 'ẳ', 'ẵ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ'),
            'A' => array('Á', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ặ', 'Ằ', 'Ẳ', 'Ẵ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ'),
            'd' => array('đ'),
            'D' => array('Đ'),
            'e' => array('&eacute;', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ'),
            'E' => array('&Eacute;', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ'),
            'i' => array('í', 'ì', 'ỉ', 'ĩ', 'ị'),
            'I' => array('Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'),
            'o' => array('ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'õ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ'),
            '0' => array('Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Õ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ'),
            'u' => array('ú', 'ù', 'ủ', 'ũ', 'ụ', 'ý', 'ứ', 'ừ', 'ử', 'ữ', 'ự'),
            'U' => array('Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ý', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự'),
            'y' => array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'),
            'Y' => array('Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
        );
        foreach ($unicode as $nonUnicode => $uni) {
            foreach ($uni as $value)
                $str = str_replace($value, $nonUnicode, $str);
        }
        return $str;
    }

}
