<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php if (empty($list)): ?>
                <p>Список пуст</p>
            <?php else: ?>
                <?php foreach ($list as $val): ?>
                    <div class="post-preview">
                        <ul>
                            <li>
                                <?php echo htmlspecialchars($val['name'], ENT_QUOTES); ?>
                                <?php echo htmlspecialchars($val['surname'], ENT_QUOTES); ?>
                                <?php echo htmlspecialchars($val['age'], ENT_QUOTES); ?>
                            </li>
                        </ul>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <div class="clearfix">
                    <?php echo $pagination; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
