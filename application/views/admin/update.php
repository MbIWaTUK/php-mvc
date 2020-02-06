<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/update/<?php echo $data['id']; ?>" method="post" >
                            <div class="form-group">
                                <label>Имя</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['name'], ENT_QUOTES); ?>" name="name">
                            </div>
                            <div class="form-group">
                                <label>Фамилия</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['surname'], ENT_QUOTES); ?>" name="surname">
                            </div>
                            <div class="form-group">
                                <label>возраст</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['age'], ENT_QUOTES); ?>" name="age">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>