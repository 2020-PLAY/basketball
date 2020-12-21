<?php
/**
 * Created by PhpStorm.
 * User: 86159
 * Date: 2020/12/10
 * Time: 22:53
 */

namespace  App\Admin\Extensions;
use Dcat\Admin\Form\Field;
class Ueditor extends Field
{
    protected static $css = [
    ];
    public static $isJs=false;
    protected static $js = [
        /*ueditor1433文件夹为第二步中自定义的文件夹*/
        'vendor/ueditor1433/ueditor.config.js',
        'vendor/ueditor1433/ueditor.all.js',
    ];
    protected $view = 'admin.Ueditor';
    public function render()
    {
        $this->script = <<<EOT
        UE.delEditor('{$this->id}');
             var  ue = UE.getEditor('{$this->id}');
              
EOT;
        return parent::render();
    }

}