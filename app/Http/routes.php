<?php

# Pages
Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('/Persian-Food-Delivery-London', 'PagesController@menu');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');
Route::get('information', 'PagesController@information');
Route::get('feed', 'PagesController@feed');
Route::post('contact', 'PagesController@sendEmailEnquiry')->name('send.email');
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
	Route::get('bookings', 'SessionsController@bookings')->name('bookings');
	Route::get('orders', 'SessionsController@orders')->name('orders');
});

# Admin & Manager Profile
Route::get('admin', 'UsersController@adminIndex')->name('admin.index');
Route::get('manager', 'UsersController@managerIndex')->name('manager.index');

# Resources
Route::resource('user', 'UsersController');
Route::resource('reservations', 'ReservationsController');
Route::resource('post', 'PostsController');
Route::resource('products', 'ProductsController');
Route::resource('cart', 'ShoppingCartsController');

# Products Photo
Route::post('/products/{product}/photo', 'ProductsController@addPhoto')->name('add.product.photo');
Route::delete('/products/{product}/photo', 'ProductsController@deletePhoto')->name('delete.product.photo');
# Posts Photo
Route::post('/post/{slug}/photos', 'PhotosController@store')->name('add.photo');
Route::delete('/photo/{photo}', 'PhotosController@destroy')->name('delete.photo');
# Cart
Route::get('menu/add/{product}', 'PagesController@addToCart')->name('add.to.cart');
Route::get('menu/remove/{product}/{qty}', 'PagesController@removeFromCart')->name('remove.from.cart');
Route::get('menu/destroy/cart', 'PagesController@destroyCart')->name('destroy.cart');