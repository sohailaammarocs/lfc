@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('ocs/standardforms::contactusforms/common.title') }}
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
								<a class="tip" href="{{ route('admin.ocs.standardforms.contactusforms.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
									<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
								</a>
							</li>
						</ul>

						<span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $contactusform->exists ? $contactusform->id : null }}}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($contactusform->exists)
							<li>
								<a href="{{ route('admin.ocs.standardforms.contactusforms.delete', $contactusform->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
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
					<li class="active" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">{{{ trans('ocs/standardforms::contactusforms/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('ocs/standardforms::contactusforms/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Form: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general">

						<fieldset>

							<div class="row">

								<div class="form-group{{ Alert::onForm('first_name', ' has-error') }}">

									<label for="first_name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::contactusforms/model.general.first_name_help') }}}"></i>
										{{{ trans('ocs/standardforms::contactusforms/model.general.first_name') }}}
									</label>

									<input type="text" class="form-control" name="first_name" id="first_name" placeholder="{{{ trans('ocs/standardforms::contactusforms/model.general.first_name') }}}" value="{{{ input()->old('first_name', $contactusform->first_name) }}}">

									<span class="help-block">{{{ Alert::onForm('first_name') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('last_name', ' has-error') }}">

									<label for="last_name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::contactusforms/model.general.last_name_help') }}}"></i>
										{{{ trans('ocs/standardforms::contactusforms/model.general.last_name') }}}
									</label>

									<input type="text" class="form-control" name="last_name" id="last_name" placeholder="{{{ trans('ocs/standardforms::contactusforms/model.general.last_name') }}}" value="{{{ input()->old('last_name', $contactusform->last_name) }}}">

									<span class="help-block">{{{ Alert::onForm('last_name') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('gender', ' has-error') }}">

									<label for="gender" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::contactusforms/model.general.gender_help') }}}"></i>
										{{{ trans('ocs/standardforms::contactusforms/model.general.gender') }}}
									</label>

									{{--<div class="checkbox">--}}
										{{--<label>--}}
											<select name="gender" id="gender" class="form-control">
												<option value="0">Male</option>
												<option value="1">Female</option>
											</select>
											{{--<input type="hidden" name="gender" id="gender" value="0" checked>--}}
											{{--<input type="checkbox" name="gender" id="gender" @if($contactusform->gender) }}}) checked @endif value="1"> {{ ucfirst('gender') }}--}}
										{{--</label>--}}
									{{--</div>--}}

									<span class="help-block">{{{ Alert::onForm('gender') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('work_phone', ' has-error') }}">

									<label for="work_phone" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::contactusforms/model.general.work_phone_help') }}}"></i>
										{{{ trans('ocs/standardforms::contactusforms/model.general.work_phone') }}}
									</label>

									<input type="date" dataformatas="DD-MM-YYYY" class="form-control" name="work_phone" id="work_phone" placeholder="{{{ trans('ocs/standardforms::contactusforms/model.general.work_phone') }}}" value="{{{ input()->old('work_phone', $contactusform->work_phone) }}}">

									<span class="help-block">{{{ Alert::onForm('work_phone') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('mobile', ' has-error') }}">

									<label for="mobile" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::contactusforms/model.general.mobile_help') }}}"></i>
										{{{ trans('ocs/standardforms::contactusforms/model.general.mobile') }}}
									</label>

									<input type="text" class="form-control" name="mobile" id="mobile" placeholder="{{{ trans('ocs/standardforms::contactusforms/model.general.mobile') }}}" value="{{{ input()->old('mobile', $contactusform->mobile) }}}">

									<span class="help-block">{{{ Alert::onForm('mobile') }}}</span>

								</div>


							</div>

						</fieldset>

					</div>

					{{-- Form: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($contactusform)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop
