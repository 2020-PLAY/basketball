<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ClassCard;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use App\Admin\Forms\Activa;
use Dcat\Admin\Widgets\Modal;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $grid->column('check','审核操作')->display(function ($value){
                if ($value == 0){
                    return "
                    <button class='btn btn-sm btn-custom'  id='data-" . $this->id . "'>激活年卡</button>
                           <script>
                                   $('#data-" . $this->id . "').unbind('click').click(function() {
                      Dcat.confirm('确认激活', null, function () {
                          $.post({
                                    method: 'get',
                                    url: '/admin/ClassCard/" . $this->id . "/change',
                                    success: function (data) {
                                        if (typeof data === 'object') {
                                            if (data.status) {
                                                Dcat.swal.success('激活成功');
                                                window.location.reload();
                                            } else {
                                                Dcat.swal.error('激活失败');
                                            }
                                        }
                                    }
                                });
                              });
                             })
                           </script>
                    ";
                }else{
                    return "
                    <button class='btn btn-sm btn-danger' id='data-" . $this->id . "'>取消激活</button>
                           <script>
                                   $('#data-" . $this->id . "').unbind('click').click(function() {
                      Dcat.confirm('取消激活', null, function () {
                          $.post({
                                    method: 'get',
                                    url: '/admin/ClassCard/" . $this->id . "/change1',
                                    success: function (data) {
                                        if (typeof data === 'object') {
                                            if (data.status) {
                                                Dcat.swal.success('取消成功');
                                                window.location.reload();
                                            } else {
                                                Dcat.swal.error('取消失败');
                                            }
                                        }
                                    }
                                });
                              });
                             })
                           </script>


                    ";
                }

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
            $form->radio('status')->options([0 => '未激活', 1=> '已激活'])->default(0);
            $form->text('user_tel');
            $form->datetime('created_at','购买时间');
        });
    }

    //审核操作
    public function change(Request $request){
        $id = $request->id;
        $res = DB::table('class_card')->where('id',$id)->update(['status'=>1,'check'=>1]);
        if ($res){
            return response()->json([
                'status'  => true,
                'message' => '激活成功',
            ]);
        }else{
            return response()->json([
                'status'  => true,
                'message' => '激活失败',
            ]);
        }
    }
    //取消操作
    public function change1(Request $request){
        $id = $request->id;
        $res = DB::table('class_card')->where('id',$id)->update(['status'=>0,'check'=>0]);
        if ($res){
            return response()->json([
                'status'  => true,
                'message' => '取消成功',
            ]);
        }else{
            return response()->json([
                'status'  => true,
                'message' => '取消失败',
            ]);
        }
    }

}
