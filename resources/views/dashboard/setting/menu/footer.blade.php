@extends('dashboard.master')
@section('title', 'Menú de Pie')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Menú de Pie</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item">Menús</li>
                        <li class="breadcrumb-item active">Menú de Pie</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Menú de Pie</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> ¡Error!</h5>
                                @foreach ($errors->all() as $error)
                                <p class="m-0">{{ $error }}</p>
                                @endforeach
                            </div>
                            @endif
                            @if (session("success"))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                <p class="m-0">{{ session("success") }}</p>
                            </div>
                            @endif
                            <form method="POST" id="menuform" action="{{ route("dashboard.settings.menus.footer.update") }}">
                                @csrf
                                <input type="hidden" id="menudata" name="menudata" value=""/>
                            </form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <div class="d-flex flex-row justify-content-between">
                                                <span>Menú de Pie</span>
                                                <button class="btn btn-sm btn-primary" id="storebutton">Guardar</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="element-id"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">Agregar o Editar</div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="txtText" class="form-label">Texto</label>
                                                <input type="text" class="form-control" id="txtText" placeholder="texto">
                                            </div>
                                            <div class="mb-3">
                                                <label for="txtHref" class="form-label">URL/Ruta</label>
                                                <input type="text" class="form-control" id="txtHref" placeholder="URL/Ruta">
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button id="btnUpdate" class="btn btn-secondary" disabled="">
                                                Actualizar
                                            </button>
                                            <button id="btnAdd" class="btn btn-primary">
                                                <i class="fa-solid fas fa-plus"></i> Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section("style")
<link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/menu-editor/css/styles.min.css") }}"/>
@endsection

@section("script")
<script src="{{ asset("assets/dashboard/plugins/menu-editor/js/menu-editor.min.js") }}"></script>
<script>
    var itemTextInput = document.getElementById("txtText"),
    itemHrefInput = document.getElementById("txtHref"),
    R = document.getElementById("btnUpdate"),
    menudata = document.getElementById("menudata"),
    storebutton = document.getElementById("storebutton");
    form = document.querySelector("#menuform");
	var menuEditor = new MenuEditor('element-id', { maxLevel: 0 });
    var nestedData = {!! $menu !!}
    menuEditor.onClickDelete((event) => {
        if (confirm('¿Desea eliminar el elemento ' + event.item.getDataset().text + '?')) {
            event.item.remove();
        }
    });
    menuEditor.onClickEdit((t) => {
        let e = t.item,
        n = e.getDataset();
        itemTextInput.value = n.text,
        itemHrefInput.value = n.href,
        menuEditor.edit(t.item),
        R == null || R.removeAttribute("disabled");
    });
    function ze() {
        itemHrefInput.value = "";
        itemTextInput.value = "";
    }
    var xe;
    (xe = document.getElementById("btnAdd")) == null || xe.addEventListener("click", ()=>{
        let t = {
            text: itemTextInput.value,
            href: itemHrefInput.value,
            icon: "",
            tooltip: ""
        };
        menuEditor.add(t),
        R == null || R.setAttribute("disabled", "true"),
        ze();
    });
    R == null || R.addEventListener("click", ()=>{
        let t = {
            text: itemTextInput.value,
            href: itemHrefInput.value,
            icon: "",
            tooltip: ""
        };
        menuEditor.update(t),
        R.setAttribute("disabled", "true"),
        ze();
    });
    menuEditor.setArray(nestedData);
    menuEditor.mount();
    storebutton.addEventListener("click", (e) => {
        e.preventDefault();
        menudata.value = menuEditor.getString();
        form.submit();
    });
</script>
@endsection
