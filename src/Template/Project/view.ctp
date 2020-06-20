<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project $project
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Project'), ['action' => 'edit', $project->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Project'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Project'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="project view large-9 medium-8 columns content">
    <h3><?= h($project->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Bangou') ?></th>
            <td><?= h($project->bangou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Denpyou Bangou') ?></th>
            <td><?= h($project->denpyou_bangou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tokuisaki Koudo') ?></th>
            <td><?= h($project->tokuisaki_koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sagyouchi') ?></th>
            <td><?= h($project->sagyouchi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teimei') ?></th>
            <td><?= h($project->teimei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shoukaisha Sonota Jouhou') ?></th>
            <td><?= h($project->shoukaisha_sonota_jouhou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shoukai Tesuuryou Bikou') ?></th>
            <td><?= h($project->shoukai_tesuuryou_bikou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sekisui Choumonsho Bikou') ?></th>
            <td><?= h($project->sekisui_choumonsho_bikou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sekisui Shiharaitsuuchisho Bikou') ?></th>
            <td><?= h($project->sekisui_shiharaitsuuchisho_bikou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('E Moushisha Yuubenbangou') ?></th>
            <td><?= h($project->e_moushisha_yuubenbangou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('E Moushisha Juushotodoufuken') ?></th>
            <td><?= h($project->e_moushisha_juushotodoufuken) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('E Moushisha Juushoshichou') ?></th>
            <td><?= h($project->e_moushisha_juushoshichou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('E Moushisha Juushomanshonmei') ?></th>
            <td><?= h($project->e_moushisha_juushomanshonmei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('E Sabisukibou Yuubenbangou') ?></th>
            <td><?= h($project->e_sabisukibou_yuubenbangou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('E Sabisukibou Juushotodoufuken') ?></th>
            <td><?= h($project->e_sabisukibou_juushotodoufuken) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('E Sabisukibou Juushoshichou') ?></th>
            <td><?= h($project->e_sabisukibou_juushoshichou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('E Sabisukibou Juushomanshonmei') ?></th>
            <td><?= h($project->e_sabisukibou_juushomanshonmei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($project->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M System Kaiinshurui Id') ?></th>
            <td><?= $this->Number->format($project->m_system_kaiinshurui_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M System Tantousha Id') ?></th>
            <td><?= $this->Number->format($project->m_system_tantousha_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M System Shiharaihouhou Id') ?></th>
            <td><?= $this->Number->format($project->m_system_shiharaihouhou_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M System Bumon Id') ?></th>
            <td><?= $this->Number->format($project->m_system_bumon_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M System Kamoku Id') ?></th>
            <td><?= $this->Number->format($project->m_system_kamoku_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Mediation Gensen Id') ?></th>
            <td><?= $this->Number->format($project->m_mediation_gensen_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Customer Id') ?></th>
            <td><?= $this->Number->format($project->m_customer_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shoukaisha Id') ?></th>
            <td><?= $this->Number->format($project->shoukaisha_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gyou Bangou') ?></th>
            <td><?= $this->Number->format($project->gyou_bangou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hatchuu Tanka Goukei') ?></th>
            <td><?= $this->Number->format($project->hatchuu_tanka_goukei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hatchuu Kingaku Goukei') ?></th>
            <td><?= $this->Number->format($project->hatchuu_kingaku_goukei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhizei') ?></th>
            <td><?= $this->Number->format($project->shouhizei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ararigaku Goukei') ?></th>
            <td><?= $this->Number->format($project->ararigaku_goukei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uriage Yotei Goukei') ?></th>
            <td><?= $this->Number->format($project->uriage_yotei_goukei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uriage Zumi Goukei') ?></th>
            <td><?= $this->Number->format($project->uriage_zumi_goukei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shoukai Tesuuryou Umu') ?></th>
            <td><?= $this->Number->format($project->shoukai_tesuuryou_umu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sekisui Chuumonsho Umu') ?></th>
            <td><?= $this->Number->format($project->sekisui_chuumonsho_umu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sekisui Shiharaitsuuchisho Umu') ?></th>
            <td><?= $this->Number->format($project->sekisui_shiharaitsuuchisho_umu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zeiritsu') ?></th>
            <td><?= $this->Number->format($project->zeiritsu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $this->Number->format($project->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kakute Type') ?></th>
            <td><?= $this->Number->format($order->kakute_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uriagebi') ?></th>
            <td><?= h($project->uriagebi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kaiin Kaiyakubi') ?></th>
            <td><?= h($project->kaiin_kaiyakubi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sekisui Choumonsho Hidzuke') ?></th>
            <td><?= h($project->sekisui_choumonsho_hidzuke) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sekisui Shiharaitsuuchisho Nyuukinbi') ?></th>
            <td><?= h($project->sekisui_shiharaitsuuchisho_nyuukinbi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($project->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($project->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($project->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Moushikomisha Douitsu') ?></th>
            <td><?= $project->moushikomisha_douitsu ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bikou') ?></th>
            <td><?= $project->bikou ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
