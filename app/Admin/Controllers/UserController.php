<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use App\Models\Team;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user_name');
            $grid->column('wx_nickname');
            $grid->column('wx_sex','性别');
            $grid->column('wx_headimgurl','微信图像');
            $grid->column('user_phone');
            $grid->column('user_email');
            $grid->column('user_status','是否会员')->display(function ($value){
               return  $value ? '会员' : '非会员';
            });
            $grid->column('user_team','是否成对')->display(function ($value){
               if ($value){
                 return Team::getTeamById($this->id);
               }
            });;
            $grid->column('create_time');

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
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id');
            $show->field('wx_nickname');
            $show->field('wx_sex');
            $show->field('wx_province');
            $show->field('wx_city');
            $show->field('wx_country');
            $show->field('wx_headimgurl');
            $show->field('user_phone');
            $show->field('user_email');
            $show->field('user_name');
            $show->field('create_time');
            $show->field('user_status');
            $show->field('user_team');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('wx_nickname');
            $form->text('wx_sex');
            $form->text('wx_province');
            $form->text('wx_city');
            $form->text('wx_country');
            $form->text('wx_headimgurl');
            $form->text('user_phone');
            $form->text('user_email');
            $form->text('user_name');
            $form->text('create_time');
            $form->text('user_status');
            $form->text('user_team');
        });
    }
    public function ownerDate(){
        $OwnerData = \App\Models\User::where(['user_status'=>1,'user_team'=>0])->get(['id','user_name as text'])->toArray();
        return $OwnerData;
    }
}
