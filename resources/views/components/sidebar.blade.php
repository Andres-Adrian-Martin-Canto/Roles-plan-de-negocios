@props([
    'plan_de_negocio' => ''
])
<div class="">
    <!--Verificar si el usuario autenticado es admin-->
    @php ($user_route = '')
    @if ( auth()->user()->rol == 'admin')
        @php ($user_route = 'admin_')
    @elseif ( auth()->user()->rol == 'asesor')
        @php ($user_route = 'asesor_')
    @endif
    <div class="
        hidden
        w-50
        min-h-screen
        p-4
        md:flex
        bg-slate-700
        text-white
        border-none
        dark:bg-gray-800
        dark:text-gray-100"
        >

        <aside class="h-full space-y-2 text-base font-normal">
            <div class="flex flex-nowrap space-x-2">
                <a href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M7.28 7.72a.75.75 0 010 1.06l-2.47 2.47H21a.75.75 0 010 1.5H4.81l2.47 2.47a.75.75 0 11-1.06 1.06l-3.75-3.75a.75.75 0 010-1.06l3.75-3.75a.75.75 0 011.06 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                <span>
                    @if ($user_route == 'admin_')
                        <p class="bg-red-800 text-white rounded-xl p-2">ADMINISTRADOR</p>
                    @elseif ($user_route == 'asesor_')
                        <p class="bg-blue-800 p-1">ASESOR</p>
                    @else
                        CIIE
                    @endif
                </span>
            </div>

            <!--DROPDOWN-->
            <div class="flex flex-col divide-y divide-gray-600">
                <div
                    x-data="{
                        open: false,
                        toggle() {
                            if (this.open) { return this.close() }
                            this.$refs.button.focus()
                            this.open = true
                        },
                        close(focusAfter) {
                            if (! this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']"
                    class="relative"
                    >
                    <!-- Button -->
                    <button
                        x-ref="button"
                        x-on:click="toggle()"
                        :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')"
                        type="button"
                        class="flex w-full justify-between items-center gap-2 p-4 my-1 rounded-md
                        hover:bg-slate-800 hover:dark:bg-gray-700"
                        >
                        <div class="flex items-center">
                            <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#cfcfcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            <p class="text-left">Generalidades</p>
                        </div>

                        <!-- Heroicon: chevron-down -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#cfcfcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </button>

                    <!-- Panel -->
                    <div
                        x-ref="panel"
                        x-show="open"
                        x-transition.origin.top.left
                        x-on:click.outside="close($refs.button)"
                        :id="$id('dropdown-button')"
                        style="display: none;"
                        class="left-0 mt-2 rounded-md m-2"
                        >
                        <a href="{{ route($user_route.'plan_de_negocio.generalidades.index',[$plan_de_negocio]) }}" class="flex items-center gap-2 w-full rounded-md px-4 py-2.5 text-left text-sm hover:bg-slate-800 hover:dark:bg-gray-700 disabled:text-gray-500">
                            Información general de la empresa
                        </a>

                        <a href="{{ route($user_route.'plan_de_negocio.foda.index',[$plan_de_negocio]) }}" class="flex items-center gap-2 w-full rounded-md px-4 py-2.5 text-left text-sm hover:bg-slate-800 hover:dark:bg-gray-700 disabled:text-gray-500">
                            Análisis foda
                        </a>

                        <a href="{{ route($user_route.'plan_de_negocio.modelo_canvas.index',[$plan_de_negocio]) }}" class="flex items-center gap-2 w-full rounded-md px-4 py-2.5 text-left text-sm hover:bg-slate-800 hover:dark:bg-gray-700 disabled:text-gray-500">
                            Modelo canvas
                        </a>

                        <a href="{{ route($user_route.'plan_de_negocio.producto.index',[$plan_de_negocio]) }}" class="flex items-center gap-2 w-full rounded-md px-4 py-2.5 text-left text-sm hover:bg-slate-800 hover:dark:bg-gray-700 disabled:text-gray-500">
                            Producto y/o Servicio
                        </a>
                    </div>
                </div>
                <!--segundo dropdown-->
                <div
                    x-data="{
                        open: false,
                        toggle() {
                            if (this.open) { return this.close() }
                            this.$refs.button.focus()
                            this.open = true
                        },
                        close(focusAfter) {
                            if (! this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']"
                    class="relative"
                    >
                    <!-- Button -->
                    <button
                        x-ref="button"
                        x-on:click="toggle()"
                        :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')"
                        type="button"
                        class="flex w-full justify-between items-center gap-2 p-4 my-1 rounded-md
                        hover:bg-slate-800 hover:dark:bg-gray-700"
                        >
                        <div class="flex items-center">
                            <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#cfcfcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                            <p class="text-left">Administración de recursos</p>
                        </div>

                        <!-- Heroicon: chevron-down -->
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#cfcfcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                        </div>
                    </button>

                    <!-- Panel -->
                    <div
                        x-ref="panel"
                        x-show="open"
                        x-transition.origin.top.left
                        x-on:click.outside="close($refs.button)"
                        :id="$id('dropdown-button')"
                        style="display: none;"
                        class="left-0 mt-2 rounded-md m-2"
                        >
                        <a href="{{ route($user_route.'plan_de_negocio.cultura_organizacional.index',[$plan_de_negocio]) }}" class="flex items-center gap-2 w-full rounded-md px-4 py-2.5 text-left text-sm hover:bg-slate-800 hover:dark:bg-gray-700 disabled:text-gray-500">
                            Cultura organizacional
                        </a>

                        <a href="{{ route($user_route.'plan_de_negocio.estructura_legal.index',[$plan_de_negocio]) }}" class="flex items-center gap-2 w-full rounded-md px-4 py-2.5 text-left text-sm hover:bg-slate-800 hover:dark:bg-gray-700 disabled:text-gray-500">
                            Estructura legal
                        </a>
                    </div>
                </div>

                <!--tercer dropdown-->
                <div
                    x-data="{
                        open: false,
                        toggle() {
                            if (this.open) { return this.close() }
                            this.$refs.button.focus()
                            this.open = true
                        },
                        close(focusAfter) {
                            if (! this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']"
                    class="relative"
                    >
                    <!-- Button -->
                    <button
                        x-ref="button"
                        x-on:click="toggle()"
                        :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')"
                        type="button"
                        class="flex w-full justify-center items-center gap-2 p-4 my-1 rounded-md
                        hover:bg-slate-800 hover:dark:bg-gray-700"
                        >
                        <div class="flex items-center">
                            <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#cfcfcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                            <p class="text-left">Imagen corporativa y marketing</p>
                        </div>

                        <!-- Heroicon: chevron-down -->
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#cfcfcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                        </div>
                    </button>

                    <!-- Panel -->
                    <div
                        x-ref="panel"
                        x-show="open"
                        x-transition.origin.top.left
                        x-on:click.outside="close($refs.button)"
                        :id="$id('dropdown-button')"
                        style="display: none;"
                        class="left-0 mt-2 rounded-md m-2"
                        >
                        <a href="{{ route($user_route.'plan_de_negocio.imagen_corporativa.index',[$plan_de_negocio]) }}" class="flex items-center gap-2 w-full rounded-md px-4 py-2.5 text-left text-sm hover:bg-slate-800 hover:dark:bg-gray-700 disabled:text-gray-500">
                            Imagen de la empresa
                        </a>

                        <a href="{{ route($user_route.'plan_de_negocio.publicidad.index',[$plan_de_negocio]) }}" class="flex items-center gap-2 w-full rounded-md px-4 py-2.5 text-left text-sm hover:bg-slate-800 hover:dark:bg-gray-700 disabled:text-gray-500">
                            Publicidad, promoción y mercadotecnia
                        </a>
                    </div>
                </div>
            </div>
            <!---->
            <!--ESTUDIOS DE MERCADO-->
            <div
                class="flex justify-between"
                >
                <!-- Button -->
                <a href="{{ route($user_route.'plan_de_negocio.estudio.index', [$plan_de_negocio]) }}" class="flex items-center justify-between gap-2 w-full rounded-md px-4 py-2.5 text-left hover:bg-slate-800 hover:dark:bg-gray-600 dark:bg-gray-700 disabled:text-gray-500 flex mt-4">
                    <div class="flex">
                        <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#cfcfcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/><path d="M14 3v5h5M16 13H8M16 17H8M10 9H8"/></svg>
                        <p class="text-left">Estudios de mercado</p>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#b8b8b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                    </div>
                </a>
            </div>

            {{-- TODO: PLAN FINANCIERO --}}
            <div
                class="flex justify-between"
                >
                <!-- Button -->
                <a href="{{ route($user_route.'plan_de_negocio.gastoPreoperativo.index', [$plan_de_negocio]) }}" class="flex items-center justify-between gap-2 w-full rounded-md px-4 py-2.5 text-left hover:bg-slate-800 hover:dark:bg-gray-600 dark:bg-gray-700 disabled:text-gray-500 flex mt-4">
                    <div class="flex">
                        <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#cfcfcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/><path d="M14 3v5h5M16 13H8M16 17H8M10 9H8"/></svg>
                        <p class="text-left">Plan Financiero</p>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#b8b8b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                    </div>
                </a>
            </div>
        </aside>
    </div>
</div>
