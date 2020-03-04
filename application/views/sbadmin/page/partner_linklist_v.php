<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<style>
    .link-tbl{
        border-collapse: collapse;
        margin: 20px 5px;
    }
    .link-tbl td{
        border: 1px solid #919191;
        padding: 2px 5px;
    }
    .link-tbl tr:nth-child(even){
        background: #efefef;
    }
    .link-tbl tr:hover{
        background: #ffe0e0;
    }
</style>

<table class="link-tbl">
    <tr>
        <th>Views</th>
        <th>Date</th>
        <th>Prtner</th>
        <th>Category</th>
        <th>ID</th>
        <th>Title</th>
    </tr>
    <?php foreach($links_list as $link): ?>
    <tr>
        <td><?=$link['views']?></td>
        <td><?=explode(' ',$link['date'])[0]?></td>
        <td><?=$link['partner_name']?></td>
        <td><?=$link['name']?></td>
        <td><?=$link['id']?></td>
        <td>
            <a href="/sbadmin/amazon/change_art/<?=$link['id']?>/" target="_blank">
            <?=mb_substr($link['title'],0,60)?>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

