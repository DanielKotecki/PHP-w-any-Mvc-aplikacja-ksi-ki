<div>
    <h4 class="display-4">Lista książek</h4>
</div>
<div>
    <table class=" table table-light">
        <thead class="bg-gradient-primary">
            <tr class="text-white">
                <th class="text-center">#</th>
                <th class="text-center">Tytuł</th>
                <th class="text-center">Kategoria</th>
                <th class="text-center">Status</th>
                <th class="text-center">Szczegóły</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($params['books'] ?? [] as $key => $book) : ?>
                <tr>
                    <td class="text-center"><?php echo $key + 1 ?></td>
                    <td class="text-center"><?php echo $book['title'] ?></td>
                    <td class="text-center"><?php echo $book['name_categories'] ?></td>
                    <?php if ($book['is_read'] == true) : ?>
                        <td class="text-center">Przeczytana</td>
                    <?php else : ?>
                        <td class="text-center">Nie przeczytana</td>
                    <?php endif; ?>
                    <td class="text-center">
                        <a href="/?action=show&id=<?php echo $book['id'] ?>"><button class="btn btn-info" type="button">Szczegóy</button></a>

                        <form style="display: inline" action="/?action=delete" method="post">
                            <input type="hidden" name="id_delete" value="<?php echo $book['id'] ?>">
                            <input type="submit" class="btn btn-danger" value="Usuń">
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>