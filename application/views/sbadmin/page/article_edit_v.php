<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<style>
    span.form-title{
        font-size: 16px;
        display: block;
    }
    
    input[name="title"]{
        width: 90%;
    }
    textarea[name="text"]{
        width: 90%;
        min-height: 600px;
    }
    span.out-link{
        font-weight: bold;
        color: #c00;
    }
    
    #aceCode{
        height: 600px; width: 90%; 
        margin: 10px; 
        border: 1px solid #000080;
    }
    
    
    ul{
        list-style: none;
        padding: 0;
    }
    .link-li{
        border-top: 1px #999 solid;
        border-left: 3px #fff solid;
        padding: 7px 5px;
        opacity: 0.6;
    }
    .link-li input{
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px #ccc solid;
        padding-left: 5px;
    }
    li[partner="Amazon"]{
        border-left: 3px #f8981d solid;
        background-color: rgba(248, 152, 29, 0.05);
        opacity: 1;
    }
    li[partner="Walmart"]{
        border-left: 3px #007dc3 solid;
        background-color: rgba(0, 125, 195, 0.05);
        opacity: 1;
    }
    .input-cls{ width: 150px;}
    .input-src{ width: 400px; }
    .input-txt{ width: 300px; }
</style>





<form action="/<?=LANG_CODE?>/sbadmin/amazon/edit_art_action/" method="post">
    
    <?php if(is_array($artData['links'])&&count($artData['links'])>0): ?>
    <ul>
    <?php foreach($artData['links'] as $key=>$linkData): ?>
        <li class="link-li" partner="<?=$linkData['partner']?>">
            <b>Cls:</b>
            <input class="input-cls" type="text" value="<?=$linkData['class']?>"  name="class[<?=$key?>]" />
            &nbsp;
            <b>Src:</b>
            <input class="input-src" type="text" value="<?=$linkData['src']?>"    name="src[<?=$key?>]" />
            &nbsp;
            <b>Txt:</b>
            <input class="input-txt" type="text" value="<?=htmlspecialchars($linkData['anchor'])?>" name="anchor[<?=$key?>]" />
            <a href="<?=$linkData['src']?>" target="_blank" >>>></a>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    
    <span class="form-title">Title:</span> <br />
    <input type="text" value="<?=$artData['title']?>" name="title" />
    <input type="hidden" value="<?=$artData['id']?>" name="id" />
    <br /><br />
    
    <span class="form-title">Text: <i>class="<b>partner-link</b>"</i> </span> <br />
    <span class="form-title">Search: <i>RegExp &nbsp;&nbsp; <b>//(www\.|)(amzn\.to|amazon\.com) &nbsp;&nbsp; //(www\.|)(goto\.walmart\.com|walmart.com)</b></i> </span> <br />
    
    <textarea name="text" ><?=$artData['text']?></textarea>
    <div id="aceCode" ></div>
    
    <br /><br />
    <input type="submit" value="Save changes" />    
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.6/ace.js" ></script>

<script>
var html_editor = ace.edit("aceCode");
var textarea = $('textarea[name="text"]').hide();
    html_editor.setTheme("ace/theme/monokai");
    html_editor.getSession().setMode("ace/mode/html");
    html_editor.setShowPrintMargin(false);
    html_editor.getSession().setValue(textarea.val());
    html_editor.getSession().on('change', function(){
      textarea.val(html_editor.getSession().getValue());
    });
</script>


