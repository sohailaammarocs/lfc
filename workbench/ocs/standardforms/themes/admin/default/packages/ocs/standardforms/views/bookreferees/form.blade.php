@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('ocs/standardforms::bookreferees/common.title') }}
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
								<a class="tip" href="{{ route('admin.ocs.standardforms.bookreferees.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
									<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
								</a>
							</li>
						</ul>

						<span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $bookreferees->exists ? $bookreferees->id : null }}}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($bookreferees->exists)
							<li>
								<a href="{{ route('admin.ocs.standardforms.bookreferees.delete', $bookreferees->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
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
					<li class="active" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">{{{ trans('ocs/standardforms::bookreferees/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('ocs/standardforms::bookreferees/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Form: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general">

						<fieldset>

							<div class="row">

								<div class="form-group{{ Alert::onForm('team_name', ' has-error') }}">

									<label for="team_name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.team_name_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.team_name') }}}
									</label>

									<input type="text" class="form-control" name="team_name" id="team_name" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.team_name') }}}" value="{{{ input()->old('team_name', $bookreferees->team_name) }}}">

									<span class="help-block">{{{ Alert::onForm('team_name') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('team_type', ' has-error') }}">

									<label for="team_type" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.team_type_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.team_type') }}}
									</label>

									<input type="text" class="form-control" name="team_type" id="team_type" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.team_type') }}}" value="{{{ input()->old('team_type', $bookreferees->team_type) }}}">

									<span class="help-block">{{{ Alert::onForm('team_type') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('opponent_first_name', ' has-error') }}">

									<label for="opponent_first_name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_first_name_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_first_name') }}}
									</label>

									<input type="text" class="form-control" name="opponent_first_name" id="opponent_first_name" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_first_name') }}}" value="{{{ input()->old('opponent_first_name', $bookreferees->opponent_first_name) }}}">

									<span class="help-block">{{{ Alert::onForm('opponent_first_name') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('opponent_last_name', ' has-error') }}">

									<label for="opponent_last_name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_last_name_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_last_name') }}}
									</label>

									<input type="text" class="form-control" name="opponent_last_name" id="opponent_last_name" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_last_name') }}}" value="{{{ input()->old('opponent_last_name', $bookreferees->opponent_last_name) }}}">

									<span class="help-block">{{{ Alert::onForm('opponent_last_name') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('opponent_work_phone', ' has-error') }}">

									<label for="opponent_work_phone" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_work_phone_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_work_phone') }}}
									</label>

									<input type="text" class="form-control" name="opponent_work_phone" id="opponent_work_phone" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_work_phone') }}}" value="{{{ input()->old('opponent_work_phone', $bookreferees->opponent_work_phone) }}}">

									<span class="help-block">{{{ Alert::onForm('opponent_work_phone') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('opponent_mobile', ' has-error') }}">

									<label for="opponent_mobile" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_mobile_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_mobile') }}}
									</label>

									<input type="text" class="form-control" name="opponent_mobile" id="opponent_mobile" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_mobile') }}}" value="{{{ input()->old('opponent_mobile', $bookreferees->opponent_mobile) }}}">

									<span class="help-block">{{{ Alert::onForm('opponent_mobile') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('opponent_email_address', ' has-error') }}">

									<label for="opponent_email_address" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_email_address_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_email_address') }}}
									</label>

									<input type="text" class="form-control" name="opponent_email_address" id="opponent_email_address" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_email_address') }}}" value="{{{ input()->old('opponent_email_address', $bookreferees->opponent_email_address) }}}">

									<span class="help-block">{{{ Alert::onForm('opponent_email_address') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('opponent_team_name', ' has-error') }}">

									<label for="opponent_team_name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_team_name_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_team_name') }}}
									</label>

									<input type="text" class="form-control" name="opponent_team_name" id="opponent_team_name" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.opponent_team_name') }}}" value="{{{ input()->old('opponent_team_name', $bookreferees->opponent_team_name) }}}">

									<span class="help-block">{{{ Alert::onForm('opponent_team_name') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('match_gender', ' has-error') }}">

									<label for="match_gender" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.match_gender_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.match_gender') }}}
									</label>

									<input type="text" class="form-control" name="match_gender" id="match_gender" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.match_gender') }}}" value="{{{ input()->old('match_gender', $bookreferees->match_gender) }}}">

									<span class="help-block">{{{ Alert::onForm('match_gender') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('referees', ' has-error') }}">

									<label for="referees" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.referees_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.referees') }}}
									</label>

									<input type="text" class="form-control" name="referees" id="referees" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.referees') }}}" value="{{{ input()->old('referees', $bookreferees->referees) }}}">

									<span class="help-block">{{{ Alert::onForm('referees') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('assistant_refrees', ' has-error') }}">

									<label for="assistant_refrees" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.assistant_refrees_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.assistant_refrees') }}}
									</label>

									<input type="text" class="form-control" name="assistant_refrees" id="assistant_refrees" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.assistant_refrees') }}}" value="{{{ input()->old('assistant_refrees', $bookreferees->assistant_refrees) }}}">

									<span class="help-block">{{{ Alert::onForm('assistant_refrees') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('fixture', ' has-error') }}">

									<label for="fixture" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.fixture_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.fixture') }}}
									</label>

									<input type="text" class="form-control" name="fixture" id="fixture" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.fixture') }}}" value="{{{ input()->old('fixture', $bookreferees->fixture) }}}">

									<span class="help-block">{{{ Alert::onForm('fixture') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('fixture_type', ' has-error') }}">

									<label for="fixture_type" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.fixture_type_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.fixture_type') }}}
									</label>

									<input type="text" class="form-control" name="fixture_type" id="fixture_type" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.fixture_type') }}}" value="{{{ input()->old('fixture_type', $bookreferees->fixture_type) }}}">

									<span class="help-block">{{{ Alert::onForm('fixture_type') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('competition_name', ' has-error') }}">

									<label for="competition_name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.competition_name_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.competition_name') }}}
									</label>

									<input type="text" class="form-control" name="competition_name" id="competition_name" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.competition_name') }}}" value="{{{ input()->old('competition_name', $bookreferees->competition_name) }}}">

									<span class="help-block">{{{ Alert::onForm('competition_name') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('match_duration', ' has-error') }}">

									<label for="match_duration" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.match_duration_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.match_duration') }}}
									</label>

									<input type="text" class="form-control" name="match_duration" id="match_duration" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.match_duration') }}}" value="{{{ input()->old('match_duration', $bookreferees->match_duration) }}}">

									<span class="help-block">{{{ Alert::onForm('match_duration') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('match_start', ' has-error') }}">

									<label for="match_start" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.match_start_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.match_start') }}}
									</label>

									<input type="text" class="form-control" name="match_start" id="match_start" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.match_start') }}}" value="{{{ input()->old('match_start', $bookreferees->match_start) }}}">

									<span class="help-block">{{{ Alert::onForm('match_start') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('match_end', ' has-error') }}">

									<label for="match_end" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.match_end_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.match_end') }}}
									</label>

									<input type="text" class="form-control" name="match_end" id="match_end" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.match_end') }}}" value="{{{ input()->old('match_end', $bookreferees->match_end) }}}">

									<span class="help-block">{{{ Alert::onForm('match_end') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('fixture_date', ' has-error') }}">

									<label for="fixture_date" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.fixture_date_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.fixture_date') }}}
									</label>

									<input type="text" class="form-control" name="fixture_date" id="fixture_date" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.fixture_date') }}}" value="{{{ input()->old('fixture_date', $bookreferees->fixture_date) }}}">

									<span class="help-block">{{{ Alert::onForm('fixture_date') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('pitch_surface', ' has-error') }}">

									<label for="pitch_surface" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.pitch_surface_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.pitch_surface') }}}
									</label>

									<input type="text" class="form-control" name="pitch_surface" id="pitch_surface" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.pitch_surface') }}}" value="{{{ input()->old('pitch_surface', $bookreferees->pitch_surface) }}}">

									<span class="help-block">{{{ Alert::onForm('pitch_surface') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('venue', ' has-error') }}">

									<label for="venue" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.venue_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.venue') }}}
									</label>

									<input type="text" class="form-control" name="venue" id="venue" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.venue') }}}" value="{{{ input()->old('venue', $bookreferees->venue) }}}">

									<span class="help-block">{{{ Alert::onForm('venue') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('message', ' has-error') }}">

									<label for="message" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/standardforms::bookreferees/model.general.message_help') }}}"></i>
										{{{ trans('ocs/standardforms::bookreferees/model.general.message') }}}
									</label>

									<textarea class="form-control" name="message" id="message" placeholder="{{{ trans('ocs/standardforms::bookreferees/model.general.message') }}}">{{{ input()->old('message', $bookreferees->message) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('message') }}}</span>

								</div>


							</div>

						</fieldset>

					</div>

					{{-- Form: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($bookreferees)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop
