<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home / Produk
Breadcrumbs::for('produk', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Produk', route('produk.index'));
});

// Home / Produk / [Judul Produk]
Breadcrumbs::for('produk.show', function (BreadcrumbTrail $trail, $products) {
    $trail->parent('home');
    $trail->push($products->nama_produk, route('produk.index', $products->id));
});

// Home / Foto
Breadcrumbs::for('foto', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Foto', route('foto'));
});

// Home / Vidio
Breadcrumbs::for('vidio', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Vidio', route('vidio'));
});

// Home / About Us
Breadcrumbs::for('aboutus', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('About Us', route('aboutus'));
});
