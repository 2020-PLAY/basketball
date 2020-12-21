<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Article;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Controllers\AdminController;
use App\Admin\Controllers\PreviewCode;
class ArticleController extends AdminController
{
    public function index(Content $content)
    {
        return $content->title('文章')
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
        return Grid::make(new Article(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('post_author');
            $grid->column('post_content')->sortable();
            $grid->column('post_title');
            $grid->column('created_at','创建时间');
            $grid->column('updated_at','更新时间');
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
        return Show::make($id, new Article(), function (Show $show) {
            $show->field('id');
            $show->field('post_author');
            $show->field('post_content');
            $show->field('post_title');
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
        return Form::make(new Article(), function (Form $form) {
            $form->display('id');
            $form->text('post_author');
            $form->text('post_title');
            $form->ueditor('post_content');

        });
    }
}
