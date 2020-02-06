<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Посты</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?php if (empty($list)): ?>
                            <p>Нет запросов</p>
                        <?php else: ?>
                            <table class="table">
                                <tr>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Возраст</th>
                                    <th>добавить</th>
                                    <th>отклонить</th>
                                </tr>
                                <?php foreach ($list as $val): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($val['name'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($val['surname'], ENT_QUOTES); ?></td>
                                        <td><?php echo htmlspecialchars($val['age'], ENT_QUOTES); ?></td>
                                        <td><a href="/admin/addrequest/<?php echo $val['id']; ?>" class="btn btn-primary">Добавить</a></td>
                                        <td><a href="/admin/reject/<?php echo $val['id']; ?>" class="btn btn-danger">Отклонить</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php echo $pagination; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
