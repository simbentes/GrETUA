<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Novo Evento <small>(ou Memória)</small></h1>
        <p class="mb-4">Publicar um novo Evento no plataforma. Se selecionar datas anteriores à atual, lembre-se que
            está a criar uma memórias.</p>

        <!-- DataTales Example -->
        <div class="row justify-content-center">
            <div class="col col-lg-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informações</h6>
                    </div>
                    <div class="card-body">
                        <div class="bg">
                            <form>
                                <div class="form-group">
                                    <label for="inputAddress">Nome</label>
                                    <input type="text" class="form-control" id="nome">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Descrição Curta</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Descrição</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-lg-6 col-xl-3">
                                        <label for="editora">Categoria</label>
                                        <select id="editora" name="editora" class="form-control">
                                            <option selected="">Selecionar</option>
                                            <option value="5">Abbey Records</option>
                                            <option value="6">Apple Records</option>
                                            <option value="12">Atlantic Records</option>
                                            <option value="15">Def Jam Recordings</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-xl-3">
                                        <label for="outraeditora">Outra Categoria</label>
                                        <input type="text" name="outraeditora" class="form-control" id="outraeditora">
                                    </div>
                                    <div class="form-group col-md-12 col-lg-4 col-xl-2">
                                        <label for="lotacao">Lotação</label>
                                        <input type="number" name="lotacao" class="form-control" id="lotacao" min="0">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-4 col-xl-2">
                                        <label for="precoreserva">Preço com Reserva</label>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-11 col-md-10">
                                                <input type="number" name="precoreserva" class="form-control"
                                                       id="precoreserva" min="0" step=".01">
                                            </div>
                                            <div class="col-auto pl-2">
                                                €
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-4 col-xl-2">
                                        <label for="precoporta">Preço à Porta</label>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-11 col-md-10">
                                                <input type="number" name="precoporta" class="form-control"
                                                       id="precoporta" min="0" step=".01">
                                            </div>
                                            <div class="col-auto pl-2">
                                                €
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>