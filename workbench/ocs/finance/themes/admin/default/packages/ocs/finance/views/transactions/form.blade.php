@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('ocs/finance::transactions/common.title') }}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page --}}
@section('page')

<section class="panel panel-default panel-tabs">

	{{-- Form --}}
	<form id="content-form" action="{{ request()->fullUrl() }}" role="form" method="post" data-parsley-validate>

		{{-- Form: CSRF Token --}}
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<header class="panel-heading">

			<nav class="navbar navbar-default navbar-actions">

				<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#actions">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<ul class="nav navbar-nav navbar-cancel">
							<li>
								<a class="tip" href="{{ route('admin.ocs.finance.transactions.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
									<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
								</a>
							</li>
						</ul>

						<span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $transaction->exists ? $transaction->id : null }}}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($transaction->exists)
							<li>
								<a href="{{ route('admin.ocs.finance.transactions.delete', $transaction->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
									<i class="fa fa-trash-o"></i> <span class="visible-xs-inline">{{{ trans('action.delete') }}}</span>
								</a>
							</li>
							@endif

							<li>
								<button class="btn btn-primary navbar-btn" data-toggle="tooltip" data-original-title="{{{ trans('action.save') }}}">
									<i class="fa fa-save"></i> <span class="visible-xs-inline">{{{ trans('action.save') }}}</span>
								</button>
							</li>

						</ul>

					</div>

				</div>

			</nav>

		</header>

		<div class="panel-body">

			<div role="tabpanel">

				{{-- Form: Tabs --}}
				<ul class="nav nav-tabs" role="tablist">
					<li class="active" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">{{{ trans('ocs/finance::transactions/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('ocs/finance::transactions/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Form: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general">

						<fieldset>

							<div class="row">

								<div class="form-group{{ Alert::onForm('Company', ' has-error') }}">

									<label for="Company" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/finance::transactions/model.general.Company_help') }}}"></i>
										{{{ trans('ocs/finance::transactions/model.general.Company') }}}
									</label>

									<input type="text" class="form-control" name="Company" id="Company" placeholder="{{{ trans('ocs/finance::transactions/model.general.Company') }}}" value="{{{ input()->old('Company', $transaction->Company) }}}">

									<span class="help-block">{{{ Alert::onForm('Company') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('Calendar', ' has-error') }}">

									<label for="Calendar" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/finance::transactions/model.general.Calendar_help') }}}"></i>
										{{{ trans('ocs/finance::transactions/model.general.Calendar') }}}
									</label>

									<input type="text" class="form-control" name="Calendar" id="Calendar" placeholder="{{{ trans('ocs/finance::transactions/model.general.Calendar') }}}" value="{{{ input()->old('Calendar', $transaction->Calendar) }}}">

									<span class="help-block">{{{ Alert::onForm('Calendar') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('Amount', ' has-error') }}">

									<label for="Amount" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/finance::transactions/model.general.Amount_help') }}}"></i>
										{{{ trans('ocs/finance::transactions/model.general.Amount') }}}
									</label>

									<textarea class="form-control" name="Amount" id="Amount" placeholder="{{{ trans('ocs/finance::transactions/model.general.Amount') }}}">{{{ input()->old('Amount', $transaction->Amount) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('Amount') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('Type', ' has-error') }}">

									<label for="Type" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/finance::transactions/model.general.Type_help') }}}"></i>
										{{{ trans('ocs/finance::transactions/model.general.Type') }}}
									</label>

									<textarea class="form-control" name="Type" id="Type" placeholder="{{{ trans('ocs/finance::transactions/model.general.Type') }}}">{{{ input()->old('Type', $transaction->Type) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('Type') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('Paid_By', ' has-error') }}">

									<label for="Paid_By" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/finance::transactions/model.general.Paid_By_help') }}}"></i>
										{{{ trans('ocs/finance::transactions/model.general.Paid_By') }}}
									</label>

									<textarea class="form-control" name="Paid_By" id="Paid_By" placeholder="{{{ trans('ocs/finance::transactions/model.general.Paid_By') }}}">{{{ input()->old('Paid_By', $transaction->Paid_By) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('Paid_By') }}}</span>

								</div>


							</div>

						</fieldset>

					</div>

					{{-- Form: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($transaction)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop
