<style>
.CodeMirror {background: #f8f8f8;border:1px solid #cccccc;height: 1000px;}
.CodeMirror-scroll {height: 1000px;} pre{font-family: Courier !important;}
</style>
<div id="ccm-dashboard-content-inner">
    <? if($saved) : ?>
    <div class="message success">
        CSS updated Successfully
    </div>
    <? endif; ?>
    <h1><span>Slate Styles</span></h1>
    <div id="creative" class="ccm-dashboard-inner">
        <p>Edit the CSS in the textarea below and click save to upload your changes</p>
        <form id="creative-form" action="<?=$this->action('save');?>" method="post" accept-charset="utf-8">
            <div id="editable">
                <textarea id="css" name="css" cols="150" rows="50"><?=isset($css) ? $css : '';?></textarea>
            </div>
            <p><input type="submit" value="Save CSS" /></p>
        </form>
    </div>
</div>
