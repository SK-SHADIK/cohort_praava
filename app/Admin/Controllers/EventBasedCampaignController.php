<?php

namespace App\Admin\Controllers;

use App\Models\EventBasedCampaign;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class EventBasedCampaignController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Event Based Campaign';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EventBasedCampaign());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('campaign_name', __('Campaign Name'));
        $grid->column('campaign_date', __('Campaign Date Time'))->sortable();
        $grid->cohort()->name('Cohort Name');
        $grid->column('email_body', __('Email Body'));
        $grid->column('sms_body', __('SMS Body'));
        $grid->column('cd', __('Cd'))->sortable();

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {
            $filter->like('campaign_name', __('Campaign Name'));
        });

        $grid->filter(function ($filter) {
            $filter->like('campaign_date', __('Campaign Date Time'));
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
        $show = new Show(EventBasedCampaign::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('campaign_id', __('Campaign id'));
        $show->field('campaign_name', __('Campaign name'));
        $show->field('campaign_date', __('Campaign date'));
        $show->field('cohort_id', __('Cohort id'));
        $show->field('email_body', __('Email body'));
        $show->field('sms_body', __('Sms body'));
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
        $form = new Form(new EventBasedCampaign());

        $campaignId = Str::uuid();
        $form->text('campaign_id', __('Campaign Id'))->readonly()->default($campaignId);
        $form->text('campaign_name', __('Campaign Name'))->rules('required');
        $form->datetime('campaign_date', __('Campaign Date Time'))->default(date('Y-m-d h:i A'))
     ->format('YYYY-MM-DD hh:mm A')
     ->rules('required');
        $cohorts = \App\Models\Cohort::where('is_active', true)->get();
        $options = [];
        $sendEmailflag = [];
        $sendSMSflag = [];
        foreach ($cohorts as $cohort) {
            $options[$cohort->id] = $cohort->name;
            if ($cohort->send_email) {
                $sendEmailflag[] = $cohort->id;
            }
            if ($cohort->send_sms) {
                $sendSMSflag[] = $cohort->id;
            }
        }
        $form->select('cohort_id', __('Cohort Name'))->options($options)
        ->when('in', $sendEmailflag, function (Form $form) {
        
                $form->textarea('email_body', __('Email Body'))->rules('required');
            
        })->when('in', $sendSMSflag, function (Form $form) {
    
            $form->textarea('sms_body', __('SMS Body'))->rules('required');
        
        })->rules('required');

        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
