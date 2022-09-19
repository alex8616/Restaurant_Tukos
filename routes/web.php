<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PlatoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComandaController;
use App\Http\Controllers\ComandaMesaController;
use App\Http\Livewire\ReportesController;
use App\Http\Livewire\ReporteMesaController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportMesaController;
use App\Http\Controllers\TipoClienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\DetalleClientesController;
use App\Http\Livewire\Articulos;


Route::get('/', function () {
    return view('auth.login');
});

Route::resource('users', UserController::class)->names('admin.users');
Route::resource('roles', RoleController::class)->names('admin.roles');

Route::get('/home', [HomeController::class, 'index']);
Route::get('/home-dashboard', [HomeController::class, 'index'])->middleware('auth')->name('home-dashboard');


Route::get('report/pdf/{user}/{type}/{f1}/{f2}', [ReportController::class, 'reportePDF'])->name('reporte.pdf');
Route::get('report/pdf/{user}/{type}', [ReportController::class, 'reportePDF'])->name('reporte.pdf');

Route::get('report/pdfmesa/{user}/{type}/{f1}/{f2}', [ReportMesaController::class, 'reportePDF'])->name('reporte.pdfmesa');
Route::get('report/pdfmesa/{user}/{type}', [ReportMesaController::class, 'reportePDF'])->name('reporte.pdfmesa');

Route::resource('menu', MenuController::class)->names('admin.menu')->middleware('auth');
Route::post('/menu/guardar',[MenuController::class,'guardar']);
Route::post('/menu/creater',[MenuController::class,'creater']);
Route::get('/menu/listar',[MenuController::class,'show']);
Route::get('menu/pdf/{menu}', [MenuController::class, 'pdf'])->name('admin.menu.pdf');


Route::get('calendar', [EventController::class, 'index'])->name('calendar.index');
Route::post('calendar/create-event', [EventController::class, 'create'])->name('calendar.create');
Route::patch('calendar/edit-event', [EventController::class, 'edit'])->name('calendar.edit');
Route::delete('calendar/remove-event', [EventController::class, 'destroy'])->name('calendar.destroy');


//Route::resource('evento', EventController::class)->names('admin.evento')->middleware('auth');
Route::resource('mesa', MesaController::class)->names('admin.mesa')->middleware('auth');
Route::resource('plato', PlatoController::class)->names('admin.plato')->middleware('auth');
Route::resource('cliente', ClienteController::class)->names('admin.cliente')->middleware('auth');
Route::resource('categoria', CategoriaController::class)->except('show')->names('admin.categoria');
Route::resource('comanda', ComandaController::class)->names('admin.comanda')->middleware('auth');
Route::resource('tipopensionado', DetalleClientesController::class)->names('admin.tipopensionado')->middleware('auth');
//Route::resource('articulo', Articulos::class)->middleware('auth');
Route::get('articulos', Articulos::class)->middleware('auth')->name('admin.articulos');

Route::get('/livewire-pdf', [Articulos::class, 'Articulospdf'])->name('articulos.articuloxportPDF');
Route::get('/livewire-excel', [Articulos::class, 'Articulosexcel'])->name('articulos.articuloxportEXCEL');



Route::get('mesa.register', [MesaController::class, 'register'])->name('admin.mesa.register');
Route::post('mesa.crear', [MesaController::class, 'crear'])->name('admin.mesa.crear');

Route::resource('comandamesa', ComandaMesaController::class)->names('admin.comandamesa')->middleware('auth');


Route::get('cambio_de_estado/comandas/{comanda}', [ComandaController::class, 'cambio_de_estado'])->name('cambio.estado.comanda');

Route::get('comandamesa/pdf/{comandaMesa}', [ComandaMesaController::class, 'pdf'])->name('admin.comandamesa.pdf');

Route::get('comanda/pdf/{comanda}', [ComandaController::class, 'pdf'])->name('admin.comanda.pdf');

Route::get('reports.component', ReportesController::class)->middleware('auth')->name('reports.reportes');
Route::get('reports.ComponetMesa', ReporteMesaController::class)->middleware('auth')->name('reports.reportemesa');

Route::get('plato.listar', [PlatoController::class, 'listar'])->name('admin.plato.listar');

Route::get('cliente.listvip', [ClienteController::class, 'listvip'])->name('admin.cliente.listvip');
Route::get('cliente.listcumple', [ClienteController::class, 'listcumple'])->name('admin.cliente.listcumple');
Route::get('pensionado.listpensionados', [TipoClienteController::class, 'listpensionados'])->name('admin.pensionado.listpensionados');
Route::get('pensionado.createtipo', [TipoClienteController::class, 'createtipo'])->name('admin.pensionado.createtipo');


Route::get('comanda.listapedidos', [ComandaController::class, 'listapedidos'])->name('admin.comanda.listapedidos');


Route::get('notifications/get',[ClienteController::class, 'getNotificationsData'])->name('notifications.get');

Route::resource('pensionado', TipoClienteController::class)->names('admin.pensionado')->middleware('auth');
Route::get('cambio_de_estado/pensionado/{tipocliente}', [TipoClienteController::class, 'cambio_de_estado'])->name('cambio.estado.tipocliente');


Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');

