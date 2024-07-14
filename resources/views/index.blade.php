<x-layout>
    <div class="container">
        <h1 class="text-center">CRUD Usuarios</h1>
        <!-- Botón crear usuario -->
        <div class="text-right">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#createModal">Crear Usuario</a>
        </div>
        <br>

        <!-- Tabla registros -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Apodo</th>
                    <th>Contraseña</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->apodo}}</td>
                    <td>{{$usuario->contrasenha}}</td>
                    <td>
                        <button class="btn btn-primary btn-sm editButton" data-toggle="modal" data-target="#editModal">Editar</button>
                        <a href="#" class="btn btn-danger btn-sm deleteButton" data-id="{{ $usuario->id }}">Borrar</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Crear -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="createModalLabel">Crear Usuario</h4>
                </div>
                <div class="modal-body">
                    <form id="createForm" action="{{ route('usuario.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="apodo">Apodo</label>
                            <input type="text" class="form-control" id="apodo" name="apodo" required>
                        </div>
                        <div class="form-group">
                            <label for="contrasenha">Contraseña</label>
                            <input type="password" class="form-control" id="contrasenha" name="contrasenha" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Editar -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editModalLabel">Editar Usuario</h4>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group">
                        <label for="editApodo">Apodo</label>
                        <input type="text" class="form-control" id="editApodo" name="apodo" required>
                    </div>
                    <div class="form-group">
                        <label for="editContrasenha">Contraseña</label>
                        <input type="password" class="form-control" id="editContrasenha" name="contrasenha" >
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- JavaScript -->
    <script>
    $(document).ready(function() {
    $('#createForm').submit(function(event) {
        event.preventDefault();

        var formData = {
            apodo: $('#apodo').val(),
            contrasenha: $('#contrasenha').val()
        };

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //agregando token csrf...
            },
            success: function(response) {
                alert('Usuario creado exitosamente!');
                //recargar pagina
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert('Hubo un error al crear el usuario: ' + error);
            }
        });
    });
});


        // click editar
        $('.editButton').click(function() {
            var row = $(this).closest('tr');
            var id = row.find('td:eq(0)').text();
            var apodo = row.find('td:eq(1)').text();
            var contrasenha = row.find('td:eq(2)').text();
            // llenar campos a editar
            $('#editId').val(id);
            $('#editApodo').val(apodo);


        // enviar formulario editar
        $('#editForm').submit(function(event) {
                event.preventDefault();

                var formData = {
                    id: $('#editId').val(),
                    apodo: $('#editApodo').val(),
                    contrasenha: $('#editContrasenha').val()
                };

                var actionUrl = "{{ url('usuarios') }}/" + id;

                $(this).attr('action', actionUrl);

                // enviar peticion ajax
                $.ajax({
                    url: actionUrl,
                    method: 'PATCH',
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Usuario actualizado exitosamente!');
                        $('#editModal').modal('hide');
                        //recargar pagina
                         window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Hubo un error al actualizar el usuario: ' + error);
                    }
                });
            });

        });


        $('.deleteButton').click(function(event) {
        event.preventDefault();

        var button = $(this);
        var userId = button.data('id');

        if (confirm('¿Seguro que deseas eliminar este registro?')) {
            // enviar peticion ajax para borrar usuario
            $.ajax({
                url: '/usuarios/' + userId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    button.closest('tr').remove();
                    alert('¡Registro eliminado exitosamente!');
                },
                error: function(xhr, status, error) {
                    alert('Hubo un error al eliminar el registro: ' + error);
                }
            });
        }
    });

    </script>

</x-layout>
