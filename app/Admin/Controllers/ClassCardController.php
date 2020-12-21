<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ClassCard;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use App\Admin\Forms\Activa;
use Dcat\Admin\Widgets\Modal;

class ClassCardController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ClassCard(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user_name');
            $grid->column('type')->display(function ($value){
                if ($value == 1){
                    return '年卡';
                }
            });
            $grid->status->using([0 => '未激活', 1 => '已激活'])->badge([
                0 => 'danger',
                1 => 'success',
            ]);
            $grid->column('user_tel');
            $grid->column('created_at','购买时间')->sortable();
            $grid->column('审核操作')->display(function (){
                $modal = Modal::make()
                    ->lg()
                    ->title('修改密码')
                    ->body(ResetPassword::make())
                    ->button('修改密码');
            });
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new ClassCard(), function (Show $show) {
            $show->field('id');
            $show->field('user_name');
            $show->field('type');
            $show->field('status');

            $show->field('user_tel');
            $show->field('created_at','购买时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new ClassCard(), function (Form $form) {
            $form->display('id');
            $form->text('user_name');
            $form->select('type')->options(['1'=>'年卡']);
//            $form->text('status');
            $form->radio('status')->options([0 => '未激活', 1=> '已激活'])->default(0);
            $form->text('user_tel');
            $form->datetime('created_at','购买时间');
        });
    }
}
