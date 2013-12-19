<?php
// Load dictionnary if we want to use __()
// Nos\I18n::current_dictionary('dailymotion::common');
?>
<div class="dailymotion_video noviusos_enhancer">

    <iframe frameborder="0" id="consultation" width="920" height="480" src="http://www.dailymotion.com/embed/video/<?php echo $video['vide_id_dailymotion'];?>?logo=0&startscreen=html&html"></iframe>


    <h2><?=$video->vide_name ?></h2>


    <?= $video->wysiwygs->description ?>
    <?= \Nos\Nos::main_controller()->getPage()->htmlAnchor(array('text' => __('Back'))); ?>
</div>