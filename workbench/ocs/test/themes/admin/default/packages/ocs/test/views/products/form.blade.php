@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('ocs/test::products/common.title') }}
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
								<a class="tip" href="{{ route('admin.ocs.test.products.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
									<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
								</a>
							</li>
						</ul>

						<span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $products->exists ? $products->id : null }}}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($products->exists)
							<li>
								<a href="{{ route('admin.ocs.test.products.delete', $products->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
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
					<li class="active" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">{{{ trans('ocs/test::products/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('ocs/test::products/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Form: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general">

						<fieldset>

							<div class="row">

								<div class="form-group{{ Alert::onForm('name', ' has-error') }}">

									<label for="name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/test::products/model.general.name_help') }}}"></i>
										{{{ trans('ocs/test::products/model.general.name') }}}
									</label>

									<input type="text" class="form-control" name="name" id="name" placeholder="{{{ trans('ocs/test::products/model.general.name') }}}" value="{{{ input()->old('name', $products->name) }}}">

									<span class="help-block">{{{ Alert::onForm('name') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('image', ' has-error') }}">

									<label for="image" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/test::products/model.general.image_help') }}}"></i>
										{{{ trans('ocs/test::products/model.general.image') }}}
									</label>

									<input type="text" class="form-control" name="image" id="image" placeholder="{{{ trans('ocs/test::products/model.general.image') }}}" value="{{{ input()->old('image', $products->image) }}}">

									<span class="help-block">{{{ Alert::onForm('image') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('price', ' has-error') }}">

									<label for="price" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/test::products/model.general.price_help') }}}"></i>
										{{{ trans('ocs/test::products/model.general.price') }}}
									</label>

									<input type="text" class="form-control" name="price" id="price" placeholder="{{{ trans('ocs/test::products/model.general.price') }}}" value="{{{ input()->old('price', $products->price) }}}">

									<span class="help-block">{{{ Alert::onForm('price') }}}</span>

								</div>

				<div class="form-group{{ Alert::onForm('desc', ' has-error') }}">

									<label for="desc" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('ocs/test::products/model.general.desc_help') }}}"></i>
										{{{ trans('ocs/test::products/model.general.desc') }}}
									</label>

									<textarea class="form-control" name="desc" id="desc" placeholder="{{{ trans('ocs/test::products/model.general.desc') }}}">{{{ input()->old('desc', $products->desc) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('desc') }}}</span>

								</div>


							</div>

						</fieldset>

					</div>

					{{-- Form: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($products)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop
