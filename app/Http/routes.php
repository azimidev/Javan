<?php

Route::get('uber', function() { return redirect('//eats.uber.com/stores/5e3716e3-8232-479e-a043-0fd7c10c6113
//eats.uber.com/stores/5e3716e3-8232-479e-a043-0fd7c10c6113'); })->name('uber');

# Pages
Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('Persian-Food-Delivery-London', 'PagesController@menu')->name('menu');
Route::get('menu', function() { return redirect()->route('menu'); });
Route::get('Persian-Live-Music', 'PagesController@liveMusic')->name('music');
Route::get('music', function() { return redirect()->route('music'); });
Route::post('deliverable', 'PagesController@deliverable');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');
Route::get('information', 'PagesController@information');
Route::get('feed', 'PagesController@feed');
Route::get('blog/{slug?}', 'PagesController@blog')->name('blog');
Route::get('guest/reservation', 'PagesController@createReservation')->name('create.reservation');
Route::post('guest/reservation', 'PagesController@storeReservation')->name('store.reservation');

# Authentications
Route::auth();

# Member Profile
Route::group(['prefix' => 'member', 'as' => 'member.'], function() {
	Route::get('profile', 'SessionsController@show')->name('show');
	Route::get('{user}/edit', 'SessionsController@edit')->name('edit');
	Route::patch('{user}', 'SessionsController@update')->name('update');
	Route::get('reservations', 'SessionsController@reservations')->name('reservations');
	Route::get('orders', 'SessionsController@orders')->name('orders');
	Route::get('bookings', 'SessionsController@bookings')->name('bookings');
});

# Admin & Manager Profile
Route::get('admin', 'UsersController@adminIndex')->name('admin.index');
Route::get('manager', 'UsersController@managerIndex')->name('manager.index');

# Resources
Route::resource('user', 'UsersController');
Route::resource('post', 'PostsController');
Route::resource('products', 'ProductsController');
Route::resource('cart', 'ShoppingCartsController', ['except' => ['show', 'edit']]);
Route::resource('reservations', 'ReservationsController', ['except' => ['show']]);
Route::resource('bookings', 'BookingsController', ['except' => ['show', 'edit']]);
Route::resource('events', 'EventsController');

# Products Photo
Route::post('/products/{product}/photo', 'ProductsController@addPhoto')->name('add.product.photo');
Route::delete('/products/{product}/photo', 'ProductsController@deletePhoto')->name('delete.product.photo');
# Events Photo
Route::post('/events/{event}/photo', 'EventsController@addPhoto')->name('add.event.photo');
Route::delete('/events/{event}/photo', 'EventsController@deletePhoto')->name('delete.event.photo');
# Posts Photo
Route::post('/post/{slug}/photos', 'PhotosController@store')->name('add.photo');
Route::delete('/photo/{photo}', 'PhotosController@destroy')->name('delete.photo');
# Product Cart
Route::get('menu/add/{product}', 'PagesController@addToCart')->name('add.to.cart');
Route::get('menu/remove/{productId}/{qty}', 'PagesController@removeFromCart')->name('remove.from.cart');
Route::get('menu/destroy/all', 'PagesController@destroyCart')->name('destroy.cart');

Route::get('event/add/{event}', 'PagesController@addEventToCart')->name('add.event.to.cart');
Route::get('event/remove/{eventId}/{qty}', 'PagesController@removeEventFromCart')->name('remove.event.from.cart');
Route::get('event/destroy/all', 'PagesController@destroyEventCart')->name('destroy.event.cart');
