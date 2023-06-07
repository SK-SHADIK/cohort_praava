<?php

namespace App\Admin\Controllers;

use App\Models\CampaignPatientDetails;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


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

        $grid->column('id', __('Id'))->sortable();
        $grid->capmaign()->campaign_id('One Time Campaign Id')->sortable();
        $grid->capmaign()->campaign_name('One Time Campaign Name');
        $grid->column('email', __('Email'));
        $grid->column('mobileno', __('Mobileno'));
        $grid->column('patientname', __('Patientname'));
        $grid->column('is_send', __('Is Send'))->display(function ($value) {
            return $value ? '<span style=" color: green; font-weight:900;">Sended</span>' :
            '<span style="color: red; font-weight:900;">Not Send</span>';
        });
        $grid->column('cd', __('Cd'))->sortable();

        $grid->model()->orderBy('id', 'desc');

        $grid->quickSearch(function ($model, $query) {
            $model->orWhereHas('capmaign', function (Builder $queryr) use ($query) {
                $queryr->where('campaign_id', 'like', "%{$query}%");
            });
            $model->orWhereHas('capmaign', function (Builder $queryr) use ($query) {
                $queryr->where('campaign_name', 'like', "%{$query}%");
            });
        })->placeholder('Search Here Campaign id Or Name...');

        $grid->disableFilter();

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

        return $form;
    }
}
