<tbody class="employees-grid-error">
    <?php foreach ($mProducts as $k => $mProduct) { ?>
    <tr role="row" class="<?php echo $k % 2 == 0 ? 'odd' : 'even' ?>">
        <td><?= $mProduct->koudo ?></td>
        <td><?= $mProduct->mei ?></td>
        <td><?= $mProduct->mei_sakuin ?></td>
        <td><?= $mProduct->tani ?></td>
        <td><?= $mProduct->setto_hinkubun ?></td>
        <td><?= $mProduct->setto_hinkubun_mei ?></td>
        <td><?= $mProduct->hyoujun_uriage_tanka ?></td>
        <td><?= $mProduct->bunrui_koudo ?></td>
        <td><?= $mProduct->m_system_shouhin_kategori_id ?></td>
        <td><?= $mProduct->hikazei_kubun ?></td>
    </tr>
    <?php } ?>
</tbody>
