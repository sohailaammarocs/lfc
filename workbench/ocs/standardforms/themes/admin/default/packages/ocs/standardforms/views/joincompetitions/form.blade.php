@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{ trans("action.{$mode}") }} {{ trans('ocs/standardforms::joincompetitions/common.title') }}
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
								<a class="tip" href="{{ route('admin.ocs.standardforms.joincompetitions.all') }}" data-toggle="tooltip" data-original-title="{{ trans('action.cancel') }}">
									<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{ trans('action.cancel') }}</span>
								</a>
							</li>
						</ul>

						<span class="navbar-brand">{{ trans("action.{$mode}") }} <small>{{ $joincompetition->exists ? $joincompetition->id : null }}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($joincompetition->exists)
							<li>
								<a href="{{ route('admin.ocs.standardforms.joincompetitions.delete', $joincompetition->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{ trans('action.delete') }}" type="delete">
									<i class="fa fa-trash-o"></i> <span class="visible-xs-inline">{{ trans('action.delete') }}</span>
								</a>
							</li>
							@endif

							<li>
								<button class="btn btn-primary navbar-btn" data-toggle="tooltip" data-original-title="{{ trans('action.save') }}">
									<i class="fa fa-save"></i> <span class="visible-xs-inline">{{ trans('action.save') }}</span>
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
					<li class="active" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">{{ trans('ocs/standardforms::joincompetitions/common.tabs.general') }}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{ trans('ocs/standardforms::joincompetitions/common.tabs.attributes') }}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Form: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general">

						<fieldset>

							<div class="row">

								<div class="form-group{{ Alert::onForm('team_name', ' has-error') }}">

									<label for="team_name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{ trans('ocs/standardforms::joincompetitions/model.general.team_name_help') }}"></i>
										{{ trans('ocs/standardforms::joincompetitions/model.general.team_name') }}
									</label>

									<input type="text" class="form-control" name="team_name" id="team_name" placeholder="{{ trans('ocs/standardforms::joincompetitions/model.general.team_name') }}" value="{{ input()->old('team_name', $joincompetition->team_name) }}">

									<span class="help-block">{{ Alert::onForm('team_name') }}</span>

								</div>

				<div class="form-group{{ Alert::onForm('team_type', ' has-error') }}">

									<label for="team_type" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{ trans('ocs/standardforms::joincompetitions/model.general.team_type_help') }}"></i>
										{{ trans('ocs/standardforms::joincompetitions/model.general.team_type') }}
									</label>
									<select name="team_type" id="team_type" class="form-control">
										<option value="cooperate_team">Cooperate Team</option>
										<option value="group_of_friends">Group of Friends</option>
										<option value="football_club">Football Club</option>
										<option value="local_team">Local Team</option>
									</select>

									{{--<input type="text" class="form-control" name="team_type" id="team_type" placeholder="{{ trans('ocs/standardforms::joincompetitions/model.general.team_type') }}" value="{{ input()->old('team_type', $joincompetition->team_type) }}">--}}

									<span class="help-block">{{ Alert::onForm('team_type') }}</span>

								</div>

				<div class="form-group{{ Alert::onForm('competition_type', ' has-error') }}">

									<label for="competition_type" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{ trans('ocs/standardforms::joincompetitions/model.general.competition_type_help') }}"></i>
										{{ trans('ocs/standardforms::joincompetitions/model.general.competition_type') }}
									</label>

									<div class="checkbox">
										<label>
											<input type="hidden" name="competition_type" id="competition_type" value="0" checked>
											<input type="checkbox" name="competition_type" id="competition_type" @if($contactusform->gender) }}}) checked @endif value="1"> {{ ucfirst('gender') }}
										</label>
									</div>
									<input type="text" class="form-control" name="competition_type" id="competition_type" placeholder="{{ trans('ocs/standardforms::joincompetitions/model.general.competition_type') }}" value="{{ input()->old('competition_type', $joincompetition->competition_type) }}">

									<span class="help-block">{{ Alert::onForm('competition_type') }}</span>

								</div>

				<div class="form-group{{ Alert::onForm('message_box', ' has-error') }}">

									<label for="message_box" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{ trans('ocs/standardforms::joincompetitions/model.general.message_box_help') }}"></i>
										{{ trans('ocs/standardforms::joincompetitions/model.general.message_box') }}
									</label>

									<textarea class="form-control" name="message_box" id="message_box" placeholder="{{ trans('ocs/standardforms::joincompetitions/model.general.message_box') }}">{{ input()->old('message_box', $joincompetition->message_box) }}</textarea>

									<span class="help-block">{{ Alert::onForm('message_box') }}</span>

								</div>


							</div>

						</fieldset>

					</div>

					{{-- Form: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($joincompetition)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop
