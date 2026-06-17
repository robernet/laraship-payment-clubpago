<?php

//ClubPago References
Breadcrumbs::register('clubpago_references', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('ClubPago::module.clubpago_reference.title'), url(config('clubpago.models.clubpago_reference.resource_url')));
});

Breadcrumbs::register('clubpago_reference_create_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('clubpago_references');
    $breadcrumbs->push(view()->shared('title_singular'));
});

Breadcrumbs::register('clubpago_reference_show', function ($breadcrumbs) {
    $breadcrumbs->parent('clubpago_references');
    $breadcrumbs->push(view()->shared('title_singular'));
});