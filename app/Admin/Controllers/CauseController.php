<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Cause;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Controllers\AdminController;

class CauseController extends AdminController
{

    public function index(Content $content)
    {
        return $content->title('请假')
            ->description('列表')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Cause(), function (Grid $grid) {


            $grid->column('id')->sortable();
            $grid->column('user_name');
            $grid->column('causation')->limit(2)->responsive();
            $grid->column('type','请假类型')->display(function ($value){
                if ($value == 1){
                    return '个人请假';
                }elseif ($value == 2){
                    return '重大事假';
                }else{
                    return '球队请假';
                }
            });

            $grid->column('created_at')->sortable();;
            $grid->responsive();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
            $grid->selector(function (Grid\Tools\Selector $selector) {
                $selector->select('type', '请假类型', [1=>'个人请假', 2=>'重大事假',3=>'球队请假']);
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
        return Show::make($id, new Cause(), function (Show $show) {
            $show->field('id');
            $show->field('user_name');
            $show->field('causation');
            $show->field('type');
            $show->field('created_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Cause(), function (Form $form) {
            $form->display('id');
            $form->text('user_name');
            $form->text('causation');
            $form->select('type','请假类型')->options([1 => '个人请假', 2 => '重大事假', 3 => '球队请假']);;
            $form->datetime('created_at');
        });
    }
}
