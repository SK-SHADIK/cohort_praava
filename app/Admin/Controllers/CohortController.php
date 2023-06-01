<?php

namespace App\Admin\Controllers;

use App\Models\Cohort;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CohortController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cohort';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cohort());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('query', __('Query'));
        $grid->column('is_active', __('Is Active'))->display(function ($value) {
            return $value ? '<span style="color: green; font-weight:900; ">Active</span>' :
            '<span style="color: red; font-weight:900; ">Not Active</span>';
        });
        $grid->column('send_email', __('Send Email'))->display(function ($value) {
            return $value ? '<span style="color: green; font-weight:900;">Active</span>' :
            '<span style="color: red; font-weight:900;">Not Active</span>';
        });
        $grid->column('send_sms', __('Send SMS'))->display(function ($value) {
            return $value ? '<span style=" color: green; font-weight:900;">Active</span>' :
            '<span style="color: red; font-weight:900;">Not Active</span>';
        });
        $grid->database()->name('Database Name');
        $grid->column('cd', __('Cd'))->sortable();

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {
            $filter->like('name', __('Cohort_Name'));
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Cohort::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('query', __('Query'));
        $show->field('is_active', __('Is active'));
        $show->field('send_email', __('Send email'));
        $show->field('send_sms', __('Send SMS'));
        $show->field('database_id', __('Database id'));
        $show->field('cb', __('Cb'));
        $show->field('cd', __('Cd'));
        $show->field('ub', __('Ub'));
        $show->field('ud', __('Ud'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Cohort());

        $form->text('name', __('Name'))->rules('required');
        $form->textarea('description', __('Description'))->rules('required');
        $form->html('<h4 class="alert alert-danger">Must be use <br> * Mobile Number = mobileno <br> * Email = email <br> * Patient Name = patientname</h4>');
        $form->text('query', __('Query'))->rules('required');
        $form->switch('is_active', __('Is Active'))->default(1);
        $form->switch('send_email', __('Send Email'))->default(1);
        $form->switch('send_sms', __('Send SMS'))->default(1);
        $databases = \App\Models\Database::pluck('name', 'id')->toArray();
        $form->select('database_id', __('Database Name'))->options($databases)->rules('required');
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
