<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Добавить юзера</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form  method="post" action="/admin/add" class="form-horizontal">
                            <div class="row">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 ">
                                            <input placeholder="имя" type="text" name="name" class="form-control"></br>
                                        </div>
                                        <div class="col-sm-12 ">
                                            <input placeholder="фамилия" type="text" name="surname" class="form-control"></br>
                                        </div>
                                        <div class="col-sm-12 ">
                                            <input  placeholder="возраст" type="number" name="age" class="form-control"></br>
                                        </div>
                                        <div class="col-sm-12 ">
                                            <button class="btn btn-secondary" type="submit">Сохранить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form  id="upload-form" method="POST" action="/admin/table" class="form-horizontal">
                            <div class="row">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="btn btn-secondary" type="submit">Выгрузить список</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
