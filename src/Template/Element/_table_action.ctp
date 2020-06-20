<?php
use Cake\Routing\Router;
use App\Libs\Crypt;
?>
<a href="<?= Router::url("$urlEdit/".Crypt::encrypAES($recordId)) ?>">
    <i class="fa fa-edit fa-lg"></i>
</a>
<i onclick="tableDelete('<?= Router::url("$urlDelete/".Crypt::encrypAES($recordId)) ?>');" class="fa fa-trash fa-lg text-danger"></i>