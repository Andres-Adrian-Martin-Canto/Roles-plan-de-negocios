<?php

use App\Models\ingreso_v2;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FodaController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Models\gasto_de_articulo_de_venta;
use App\Http\Controllers\AdviserController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConceptoController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\cincoAniosOptimista;
use App\Http\Controllers\cincoAniosPesimista;
use App\Http\Controllers\CostoFijoController;
use App\Http\Controllers\ConclusionController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\ingresosV2Controller;
use App\Http\Controllers\PublicidadController;
use App\Http\Controllers\cincoAniosConservador;
use App\Http\Controllers\ConservadorController;
use App\Http\Controllers\estadisticasController;
use App\Http\Controllers\ModeloCanvasController;
use App\Http\Controllers\GeneralidadesController;
use App\Http\Controllers\PlanDeNegocioController;
use App\Http\Controllers\UsuarioAGrupoController;
use App\Http\Controllers\CostosVariableController;
use App\Http\Controllers\OptimistaAnualController;
use App\Http\Controllers\PesimistaAnualController;
use App\Http\Controllers\EstructuraLegalController;
use App\Http\Controllers\gastosMensualesController;
use App\Http\Controllers\GruposDeTrabajoController;
use App\Http\Controllers\CapturarResultadoController;
use App\Http\Controllers\ImagenCorporativaController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\balanceGeneralAnualController;
use App\Http\Controllers\balaneGeneralCincoAnios;
use App\Http\Controllers\gastosPreoperativosController;
use App\Http\Controllers\flujoEfectivoMensualController;
use App\Http\Controllers\CulturaOrganizacionalController;
use App\Http\Controllers\flujoEfectivoCincoAniosController;
use App\Http\Controllers\gastos_articulos_ventasController;
use App\Http\Controllers\inversionInicialController;
use App\Http\Controllers\totalInversionInicial;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PlanDeNegocioController::class, 'index'])->middleware(['auth', 'verified', 'disciple'])->name('dashboard');
Route::get('/asesor.dashboard', [AdviserController::class, 'index'])->middleware(['auth', 'verified', 'adviser'])->name('asesor.dashboard');
Route::get('/admin.dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/plan_de_negocio/{plan_de_negocio}/estudio/{estudio}/pdf', [EstudioController::class, 'pdf'])->name('pdf');

    Route::group(['middleware' => 'disciple'], function() {
        Route::resources([
            'plan_de_negocio' => PlanDeNegocioController::class,
            'plan_de_negocio.generalidades' => GeneralidadesController::class,
            'plan_de_negocio.foda' => FodaController::class,
            'plan_de_negocio.modelo_canvas' => ModeloCanvasController::class,
            'plan_de_negocio.producto' => ProductoController::class,
            'plan_de_negocio.imagen_corporativa' => ImagenCorporativaController::class,
            'plan_de_negocio.cultura_organizacional' => CulturaOrganizacionalController::class,
            'plan_de_negocio.estructura_legal' => EstructuraLegalController::class,
            'plan_de_negocio.publicidad' => PublicidadController::class,
            'plan_de_negocio.estudio' => EstudioController::class,
            'plan_de_negocio.estudio.concepto' => ConceptoController::class,
            'plan_de_negocio.estudio.conclusion' => ConclusionController::class,
            'plan_de_negocio.estudio.encuesta' => PollController::class,
            'plan_de_negocio.estudio.encuesta.pregunta' => PreguntaController::class,
            'plan_de_negocio.estudio.encuesta.formulario' => FormularioController::class,
            'plan_de_negocio.estudio.capturar_resultado' => CapturarResultadoController::class,
            'plan_de_negocio.costo_fijo' => CostoFijoController::class,
            'plan_de_negocio.costo_variable' => CostosVariableController::class,
            'plan_de_negocio.ingresos' => IngresoController::class,
            'plan_de_negocio.estadisticas' => estadisticasController::class,
            'plan_de_negocio.proyeccionConservador' => ConservadorController::class,
            'plan_de_negocio.proyeccionPesimista' => PesimistaAnualController::class,
            'plan_de_negocio.proyeccionOptimista' => OptimistaAnualController::class,
            'plan_de_negocio.proyeccionPesimistaCincoAnios' => cincoAniosPesimista::class,
            'plan_de_negocio.proyeccionConservadorCincoAnios' => cincoAniosConservador::class,
            'plan_de_negocio.proyeccionOptimistaCincoAnios' => cincoAniosOptimista::class,
            // TODO: ENDPOIND de la nueva version V2
            'plan_de_negocio.gastoPreoperativo' => gastosPreoperativosController::class,
            'plan_de_negocio.gastosMensuales' =>  gastosMensualesController::class,
            'plan_de_negocio.gastos-articulo-venta' => gastos_articulos_ventasController::class,
            'plan_de_negocio.ingresosV2' => ingresosV2Controller::class,
            'plan_de_negocio.balanceGeneralAnual' => balanceGeneralAnualController::class,
            'plan_de_negocio.balanceGeneralCincoAnios' => balaneGeneralCincoAnios::class,
            'plan_de_negocio.inversionInicial' => inversionInicialController::class,
            'plan_de_negocio.totalInversion' => totalInversionInicial::class,
        ]);
    });

    Route::group(['middleware' => 'admin'], function() {
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);
        Route::get('/admin_grupos_de_trabajo/todos', [GruposDeTrabajoController::class, 'index'])->name('grupos_admin');
        Route::get('/admin_grupos_de_trabajo/{grupo}', [GruposDeTrabajoController::class, 'show'])->name('grupo_show_admin');
        Route::get('/admin_grupos_de_trabajo/busqueda/{grupo}/{usuario?}/{agregados?}', [GruposDeTrabajoController::class, 'busqueda'])->name('grupo_busqueda_admin.index');
        Route::patch('/admin_grupos_de_trabajo/{grupo}/{usuario}', [GruposDeTrabajoController::class, 'update'])->name('grupo_admin.update');
        Route::patch('/admin_grupos_de_trabajo/destroy/{grupo}/{usuario}', [GruposDeTrabajoController::class, 'destroy'])->name('grupo_admin.destroy'); //eliminar usuarios del grupo
        Route::delete('/admin_grupos_de_trabajo/destroy/{grupo}', [GruposDeTrabajoController::class, 'complete_destroy'])->name('grupo_complete_destroy'); //eliminar el grupo
        Route::get('/admin_grupos_de_trabajo/edit/{grupo}', [GruposDeTrabajoController::class, 'edit'])->name('grupo_admin.edit');
        Route::patch('/admin_grupos_de_trabajo_update/{grupo}', [GruposDeTrabajoController::class, 'details_update'])->name('grupo_detalles_admin');
        Route::get('/admin_planes_de_negocio/{usuario}/todos', [PlanDeNegocioController::class, 'admin_planes_x_usuario'])->name('planes_admin.index');

        Route::resource('usuarios', UserController::class);
        Route::resource('admin_plan_de_negocio', PlanDeNegocioController::class)->except(['update']);
        Route::patch('/admin_plan_de_negocio_update/{plan_de_negocio}', [PlanDeNegocioController::class, 'update'])->name('admin_plan_de_negocio.update');

        Route::resource('admin_plan_de_negocio.generalidades', GeneralidadesController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.foda', FodaController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.modelo_canvas', ModeloCanvasController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.producto', ProductoController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.imagen_corporativa', ImagenCorporativaController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.cultura_organizacional', CulturaOrganizacionalController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.estructura_legal', EstructuraLegalController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.publicidad', PublicidadController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.estudio', EstudioController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.estudio.concepto', ConceptoController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.estudio.conclusion', ConclusionController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.estudio.encuesta', PollController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.estudio.encuesta.pregunta', PreguntaController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.estudio.encuesta.formulario', FormularioController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('admin_plan_de_negocio.estudio.capturar_resultado', CapturarResultadoController::class)->parameters(['admin_plan_de_negocio' => 'plan_de_negocio']);
    });

    Route::group(['middleware' => 'adviser'], function() {
        Route::resource('grupos_de_trabajo', GruposDeTrabajoController::class)->except(['update', 'destroy', 'show', 'edit']);
        Route::get('/grupos_de_trabajo/show/{grupo}/{usuario?}', [GruposDeTrabajoController::class, 'show'])->name('grupo.show');
        Route::patch('/grupos_de_trabajo/{grupo}/{usuario}', [GruposDeTrabajoController::class, 'update'])->name('grupo.update');
        Route::patch('/grupos_de_trabajo/destroy/{grupo}/{usuario}', [GruposDeTrabajoController::class, 'destroy'])->name('grupo.destroy');
        Route::delete('/asesor_grupos_de_trabajo/destroy/{grupo}', [GruposDeTrabajoController::class, 'complete_destroy'])->name('grupo_destroy'); //eliminar el grupo
        Route::get('/grupos_de_trabajo/busqueda/{grupo}/{usuario?}/{agregados?}', [GruposDeTrabajoController::class, 'index'])->name('grupo.index');
        Route::get('/grupos_de_trabajo/edit/{grupo}', [GruposDeTrabajoController::class, 'edit'])->name('grupo.edit');
        Route::patch('/grupos_de_trabajo_update/{grupo}', [GruposDeTrabajoController::class, 'details_update'])->name('grupo_detalles');

        Route::get('/asesor_planes_de_negocio/{usuario}/todos', [PlanDeNegocioController::class, 'index'])->name('planes.index');

        Route::resource('asesor_plan_de_negocio', PlanDeNegocioController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.generalidades', GeneralidadesController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.foda', FodaController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.modelo_canvas', ModeloCanvasController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.producto', ProductoController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.imagen_corporativa', ImagenCorporativaController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.cultura_organizacional', CulturaOrganizacionalController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.estructura_legal', EstructuraLegalController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.publicidad', PublicidadController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.estudio', EstudioController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.estudio.concepto', ConceptoController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.estudio.conclusion', ConclusionController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.estudio.encuesta', PollController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.estudio.encuesta.pregunta', PreguntaController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.estudio.encuesta.formulario', FormularioController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
        Route::resource('asesor_plan_de_negocio.estudio.capturar_resultado', CapturarResultadoController::class)->parameters(['asesor_plan_de_negocio' => 'plan_de_negocio']);
    });
});

require __DIR__.'/auth.php';
