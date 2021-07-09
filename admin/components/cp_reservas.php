<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestão de reservas</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Utilizadores registados
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Data Criação</th>
                                <th>Perfil</th>
                                <th>Operações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{id_users}</td>
                                <td><i class="fa fa-ban fa-fw"></i>{username}</td>
                                <td>{email}</td>
                                <td>{date_creation}</td>
                                <td>{roles_descricao}</td>
                                <td><a href='users_edit.php?id={id_users}'><i class=\"fa fa-edit
                                                                              fa-fw\"></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

    </div>


</div>
