<?php

namespace App\Admin\Controllers;

use App\Models\CampaignPatientDetails;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CampaignPatientDetailsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Campaign Patient Details';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CampaignPatientDetails());

        $grid->column('id', __('Id'));
        $grid->column('one_time_campaign_id', __('One time campaign id'));
        $grid->column('email', __('Email'));
        $grid->column('mobileno', __('Mobileno'));
        $grid->column('patientname', __('Patientname'));
        $grid->column('cb', __('Cb'));
        $grid->column('cd', __('Cd'));
        $grid->column('ub', __('Ub'));
        $grid->column('ud', __('Ud'));

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
        $show = new Show(CampaignPatientDetails::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('one_time_campaign_id', __('One time campaign id'));
        $show->field('email', __('Email'));
        $show->field('mobileno', __('Mobileno'));
        $show->field('patientname', __('Patientname'));
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
        $form = new Form(new CampaignPatientDetails());

        $form->number('one_time_campaign_id', __('One time campaign id'));
        $form->email('email', __('Email'));
        $form->text('mobileno', __('Mobileno'));
        $form->text('patientname', __('Patientname'));
        $form->text('cb', __('Cb'));
        $form->text('ub', __('Ub'));

        return $form;
    }
}
