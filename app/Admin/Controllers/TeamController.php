<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Team;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Illuminate\Support\Facades\DB;

class TeamController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Team(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('team_name');
            $grid->column('member')->display(function ($value){
                $new_value = json_decode($value);
                $data = [];
                foreach ($new_value as $k=>$v){
                   $data[] = User::getNameById($v);
                }
                return implode(',',$data);
            });
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
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
        return Show::make($id, new Team(), function (Show $show) {
            $show->field('id');
            $show->field('team_name');
            $show->field('member');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Team(), function (Form $form) {
            $form->display('id');
            $form->text('team_name');
                $form->multipleSelect('member','学员')
                    ->options('/user/ownerDate')->saving(function ($value) {
                        return json_encode($value);
                    });
            $form->display('created_at');
            $form->display('updated_at');
            $form->saved(function (Form $form) {
                return $form->redirect('Team', '保存成功');
            });
        });
    }

    public function teamData(){
        $teamDate = \App\Models\Team::all(['id','team_name as text'])->toArray();
        return $teamDate;
    }
}
