@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('ocs/finance::statements/common.title') }}
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
								<a class="tip" href="{{ route('admin.ocs.finance.statements.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
									<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
								</a>
							</li>
						</ul>

						<span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $statement->exists ? $statement->id : null }}}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($statement->exists)
							<li>
								<a href="{{ route('admin.ocs.finance.statements.delete', $statement->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
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
					<li class="active" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">{{{ trans('ocs/finance::statements/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('ocs/finance::statements/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Form: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general">

						<fieldset>

							<div class="row">

								<div class="form-group{{ Alert::onForm('Date', ' has-error') }}">

									<label for="Date" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/finance::statements/model.general.Date_help') }}}"></i>
										{{{ trans('ocs/finance::statements/model.general.Date') }}}
									</label>

									<input type="text" class="form-control" name="Date" id="Date" placeholder="{{{ trans('ocs/finance::statements/model.general.Date') }}}" value="{{{ input()->old('Date', $statement->Date) }}}">

									<span class="help-block">{{{ Alert::onForm('Date') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('Description', ' has-error') }}">

									<label for="Description" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/finance::statements/model.general.Description_help') }}}"></i>
										{{{ trans('ocs/finance::statements/model.general.Description') }}}
									</label>

									<textarea class="form-control" name="Description" id="Description" placeholder="{{{ trans('ocs/finance::statements/model.general.Description') }}}">{{{ input()->old('Description', $statement->Description) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('Description') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('Money_in', ' has-error') }}">

									<label for="Money_in" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/finance::statements/model.general.Money_in_help') }}}"></i>
										{{{ trans('ocs/finance::statements/model.general.Money_in') }}}
									</label>

									<textarea class="form-control" name="Money_in" id="Money_in" placeholder="{{{ trans('ocs/finance::statements/model.general.Money_in') }}}">{{{ input()->old('Money_in', $statement->Money_in) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('Money_in') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('Money_out', ' has-error') }}">

									<label for="Money_out" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/finance::statements/model.general.Money_out_help') }}}"></i>
										{{{ trans('ocs/finance::statements/model.general.Money_out') }}}
									</label>

									<textarea class="form-control" name="Money_out" id="Money_out" placeholder="{{{ trans('ocs/finance::statements/model.general.Money_out') }}}">{{{ input()->old('Money_out', $statement->Money_out) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('Money_out') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('Balance', ' has-error') }}">

									<label for="Balance" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/finance::statements/model.general.Balance_help') }}}"></i>
										{{{ trans('ocs/finance::statements/model.general.Balance') }}}
									</label>

									<textarea class="form-control" name="Balance" id="Balance" placeholder="{{{ trans('ocs/finance::statements/model.general.Balance') }}}">{{{ input()->old('Balance', $statement->Balance) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('Balance') }}}</span>

								</div>


							</div>

						</fieldset>

					</div>

					{{-- Form: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($statement)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop
