<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Course;
use App\Models\Team;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class CourseController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Course(), function (Grid $grid) {
            $grid->model()->orderBy('class_time' ,'desc');
            $grid->column('id')->sortable();
            $grid->column('class_name');
            $grid->column('team_id')->display(function ($value){
                  return Team::getTeaMById($value);
            });
            $grid->column('class_time');
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
        return Show::make($id, new Course(), function (Show $show) {
            $show->field('id');
            $show->field('class_name');
            $show->field('team_id');
            $show->field('class_time');
            $show->field('class_status')->display(function ($value){
                return $value ? '已下课' : '等待上课中';
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Course(), function (Form $form) {
            $form->display('id');
            $form->text('class_name');
            $form->select('team_id','Team')
                ->options('team/teamData');
            $form->datetime('class_time');
//            $form->display('class_status','课程状态');
            $form->saved(function (Form $form) {
                return $form->redirect('Course', '保存成功');
            });
        });
    }
}
