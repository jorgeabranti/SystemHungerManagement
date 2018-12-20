<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('pages/welcome');
});

Route::get('/policies', function () {
    return view('pages/policies');
});

Auth::routes();

Route::get('pdfview',array('as'=>'pdfview','uses'=>'ItemController@pdfview'));

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registerrequests', 'RequestController@index')->name('registerrequests');

Route::get('/registerproducts', 'ProductsController@index')->name('registerproducts');

Route::get('/administration', 'AdministrationController@index')->name('administration');

Route::get('/systemparameters','ParameterController@index')->name('systemparameters');

Route::get('/registerclient', 'ClientsController@index')->name('registerclient');

Route::get('/registerdeliveryman', 'DeliveryManController@index')->name('registerdeliveryman');

Route::get('/salesreport', 'SalesReportController@index')->name('salesreport');

Route::get('/registeruser', 'Auth\RegisterController@index')->name('registeruser');

Route::get('updateAbility', array('as'=> 'updateAbility', 'uses'=>'RequestController@updateRequestQueue'));

Route::post('updatestatus/{id_pedido}','RequestController@updateRequestStatus');

Route::post('updatedeliveryman/{id_pedido}','RequestController@updateRequestDeliveryman');

Route::get('getflavors', array('as'=> 'getflavors', 'uses'=>'RequestFlavorsProductsController@getFlavorsRequest'));

Route::get('getproducts', array('as'=> 'getproducts', 'uses'=>'ProductsController@produtosEmpresaAtivos'));

Route::post('saverequest','RequestController@saveRequest');

Route::post('saveclient','ClientsController@saveClient');

Route::get('getclient', array('as'=> 'getclient', 'uses'=>'ClientsController@getCliente'));

Route::get('getproduct', array('as'=> 'getproduct', 'uses'=>'ProductsController@getProduct'));

Route::get('gettypeproduct', array('as'=> 'gettypeproduct', 'uses'=>'ProductsTypesController@getTypeProduct'));

Route::get('getflavor', array('as'=> 'getflavor', 'uses'=>'FlavorsProductsController@getFlavor'));

Route::get('getuser', array('as'=> 'getuser', 'uses'=>'Auth\RegisterController@getUser'));

Route::post('saveproduct','ProductsController@saveProduct');

Route::post('savetypeproduct','ProductsTypesController@savetypeproduct');

Route::post('saveflavor','FlavorsProductsController@saveflavor');

Route::post('savedeliveryman','DeliveryManController@savedeliveryman');

Route::post('saveformpayment','CompanyController@saveformpayment');

Route::get('getdeliveryman', array('as'=> 'getdeliveryman', 'uses'=>'DeliveryManController@geteditdeliveryman'));

Route::get('setnewproduct', array('as'=> 'setnewproduct', 'uses'=>'ProductsTypesController@setnewproduct'));

Route::get('setnewflavor', array('as'=> 'setnewflavor', 'uses'=>'ProductsTypesController@setnewflavor'));

Route::get('getdataclient', array('as'=> 'getdataclient', 'uses'=>'ClientsController@getdataclient'));

Route::get('editflavorsitemrequest', array('as'=> 'editflavorsitemrequest', 'uses'=>'RequestController@getflavorsitem'));

Route::post('savehourcompany','CompanyController@savehourcompany');

Route::post('updatevaluekm','CompanyController@updatevaluekm');

Route::post('uploadlogo', 'CompanyController@uploadlogo');

Route::post('alertpostdelivery', 'CompanyController@alertPostDelivery');

Route::get('getsalesmonth', 'SalesReportController@SalesMonth');

Route::get('getvaluesalesmonth', 'SalesReportController@valuesalesmonth');

Route::get('getsalesservicechannel', 'SalesReportController@salesservicechannel');

Route::get('gettopsalesproduct', 'SalesReportController@topsalesproduct');

Route::get('alertpostdelivery', 'CompanyController@alertpostdelivery');

Route::get('/validation', 'ValidationSystemController@index')->name('validation');

Route::post('savevalidation','ValidationSystemController@create');

