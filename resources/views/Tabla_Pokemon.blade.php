<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabla Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/af4b05b6c6.js" crossorigin="anonymous"></script>
</head>
<body style="background-color: #111826">
    <h1 class="text-white text-center p-3">Tabla Pokémon</h1>

    @if (session("Correcto"))
        <div class="alert alert-success">{{session("Correcto")}}</div>
    @endif    

    @if (session("Incorrecto"))
        <div class="alert alert-danger">{{session("Incorrecto")}}</div>
    @endif    

    <script>
        var res=function(){
            var not=confirm("¿Estas seguro de eliminar este registro?");
            return not;
        }
    </script>

    <div class="modal fade" id="ModalAñadir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir datos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route("crud.create_pokemon")}}" method="POST">
                        @csrf
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="txtNombre">
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Especie:</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="txtEspecie">
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nivel:</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="txtNivel">
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Estado:</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="txtEstado">
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Entrenador:</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="txtEntrenador">
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Habilida:</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="txtHabilidad">
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Equipo Villano:</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="txtEquipoVillano">
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Huevo:</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="txtHuevo">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="p-5 table-responsive">
        <button data-bs-toggle="modal" data-bs-target="#ModalAñadir" class="btn btn-success">Añadir</button>
        <table class="table table-striped table-bordered table-hover ">
        <thead class="bg-primary">
          <tr>
            <th class="text-white" scope="col">#</th>
            <th class="text-white" scope="col">Nombre</th>
            <th class="text-white" scope="col">Especie</th>
            <th class="text-white" scope="col">Nivel</th>
            <th class="text-white" scope="col">Estado</th>
            <th class="text-white" scope="col">Entrenador</th>
            <th class="text-white" scope="col">Habilidad</th>
            <th class="text-white" scope="col">Equipo villano</th>
            <th class="text-white" scope="col">Huevo</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="table-grup-divide">
            @foreach ($datos as $item)
                <tr>
                    <th class="text-white">{{$item->ID_Pokémon}}</th>
                    <td class="text-white">{{$item->Nombre}}</td>
                    <td class="text-white">{{$item->Especie_ID}}</td>
                    <td class="text-white">{{$item->Nivel}}</td>
                    <td class="text-white">{{$item->Estado_ID}}</td>
                    <td class="text-white">{{$item->Entrenador_ID}}</td>
                    <td class="text-white">{{$item->Habilida_ID}}</td>
                    <td class="text-white">{{$item->EquipoVillano_ID}}</td>
                    <td class="text-white">{{$item->Huevo_ID}}</td>
                    <td>
                        <a href="" data-bs-toggle="modal" data-bs-target="#ModalModificar{{$item->ID_Pokémon}}" class="btn btn-warning btn-sm btn"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{route("crud.delete_pokemon", $item->ID_Pokémon)}}" onclick="return res()" class="btn btn-danger btn-sm btn"><i class="fa-regular fa-trash-can"></i></a>
                    </td>
                    
                    <!-- Modal de modificar-->
                    <div class="modal fade" id="ModalModificar{{$item->ID_Pokémon}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route("crud.update_pokemon")}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label"># ID:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        name="txtID" value="{{$item->ID_Pokémon}}" readonly>
                                        </div>
                                        <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        name="txtNombre" value="{{$item->Nombre}}">
                                        </div>
                                        <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label"> ## Especie:</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        name="txtEspecie" value="{{$item->Especie_ID}}">
                                        </div>
                                        <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nivel</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        name="txtNivel" value="{{$item->Nivel}}">
                                        </div>
                                        <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">## Estado:</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        name="txtEstado" value="{{$item->Estado_ID}}">
                                        </div>
                                        <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">## Entrenador:</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        name="txtEntrenador" value="{{$item->Entrenador_ID}}">
                                        </div>
                                        <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">## Habilida:</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        name="txtHabilidad" value="{{$item->Habilida_ID}}">
                                        </div>
                                        <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">## Equipo Villano:</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        name="txtEquipoVillano" value="{{$item->EquipoVillano_ID}}">
                                        </div>
                                        <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">## Huevo:</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        name="txtHuevo" value="{{$item->Huevo_ID}}">
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Modificar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>