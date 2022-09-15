<!DOCTYPE html>
<html>
    <head>
        <title>Lista de empleados</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Image and text -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="https://www.pngmart.com/files/3/Software-PNG-Photos.png" width="30" height="30" class="d-inline-block align-top" alt="" />
                IGF-115
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{$saludo}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @switch($info)
            @case(1)
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Hay info en el sistema: {{$promedio['contador4']}} registros</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @break
            @case(2)
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>No hay info en el sistema</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @break
        @endswitch
        <center>
            <img width="10%" height="20%" src="http://cdn.onlinewebfonts.com/svg/img_382244.png" />
            <h1>Lista de empleados</h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarModal">
                Agregar empleado
            </button>
            <p></p>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Promedio</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                    <tr>
                        <th scope="row">{{$empleado -> id}}</th>
                        <td>{{$empleado -> nombre}}</td>
                        <td>{{$empleado -> apellido}}</td>
                        <td>{{$empleado -> edad}}</td>
                        <td>
                            <!--Estructura condicional-->
                            @if($empleado -> edad < $promedio['promedio'])
                            <p>Menor que el promedio</p>
                            @else @if($empleado -> edad == $promedio['promedio'])
                            <p>Igual al promedio</p>
                            @else
                            <p>Mayor al promedio</p>
                            <p>
                                @endif @endif
                            </p>
                        </td>

                        <td>
                            <button
                                type="button"
                                class="btn btn-success editar"
                                data-id="{{$empleado -> id}}"
                                data-nombre="{{$empleado -> nombre}}"
                                data-apellido="{{$empleado -> apellido}}"
                                data-edad="{{$empleado -> edad}}"
                                data-toggle="modal"
                                data-target="#editarModal"
                            >
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger eliminar" data-id="{{$empleado -> id}}" data-toggle="modal" data-target="#eliminarModal">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <center>
                <p><strong>Promedio de edades: </strong> {{$promedio['promedio']}} años</p>
            </center>
        </center>
        <!-- Modal -->
        <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar empleado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('create')}}" method="POST" id="CrearForm">
                            <p>Nombre:</p>
                            <input type="text" name="nombre" required pattern="[a-zA-Z ]{2,50}" />
                            <p>Apellido:</p>
                            <input type="text" name="apellido" required pattern="[a-zA-Z ]{2,50}" />
                            <p>Edad:</p>
                            <input type="number" size="4" min="18" name="edad" required max="120" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" form="CrearForm">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Editar -->
        <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar empleado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('edit')}}" method="POST" id="EditarForm">
                            <input name="id" type="hidden" id="idE" />
                            <p>Nombre:</p>
                            <input type="text" name="nombre" id="nombreE" required pattern="[a-zA-Z ]{2,50}" />
                            <p>Apellido:</p>
                            <input type="text" name="apellido" id="apellidoE" required pattern="[a-zA-Z ]{2,50}" />
                            <p>Edad:</p>
                            <input type="number" size="4" min="18" max="120" name="edad" id="edadE" required />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" form="EditarForm">Editar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Editar -->
        <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar empleado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que quieres realizar esta acción?
                        <form action="{{ url('destroy')}}" id="EliminarForm" method="POST">
                            <input name="idD" type="hidden" id="idD" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" form="EliminarForm">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Mejoras-->
        <script>
            $(document).ready(function () {
                $(document).on("click", ".editar", function () {
                    var variable = $(this).attr("data-nombre");
                    var variable2 = $(this).attr("data-apellido");
                    var variable3 = $(this).attr("data-edad");
                    var variable4 = $(this).attr("data-id");
                    $("#nombreE").attr("value", variable);
                    $("#apellidoE").attr("value", variable2);
                    $("#edadE").attr("value", variable3);
                    $("#idE").attr("value", variable4);
                });
                $(document).on("click", ".eliminar", function () {
                    var variable = $(this).attr("data-id");
                    $("#idD").attr("value", variable);
                });
            });
        </script>
    </body>
</html>
