<ul id="error-msg" class="alert alert-danger">
    <?php if (is_array($message)) : ?>
        <?php foreach ($message as $item) : ?>
            <?php if (is_array($item)) : ?>
                <?php foreach ($item as $item2) : ?>
                    <?php if (is_array($item2)) : ?>
                        <?php foreach ($item2 as $item3) : ?>
                            <li><?= h($item3) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><?= h($item2) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <li><?= h($item) ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <li><?= h($message) ?></li>
    <?php endif; ?>
</ul>