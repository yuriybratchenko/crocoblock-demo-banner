<?php
/**
 * Banner html markup.
 */

$settings = $this->get_settings();
$dynamic_models = $settings['dynamic-models'];
$widgets_count = $settings['widgets-count'];
$purchase_utm = $settings['purchase-utm'];
$navigation_utm = $settings['navigation-utm'];
?>

<div class="croco-upgrade-container">
    Find more solutions to cover your development needs using&nbsp;
    <a href="https://crocoblock.com/plugins/<?php echo $navigation_utm;?>" class="btn-link" role="button" target="_blank">JetPlugins</a>
    &nbsp;and&nbsp;
    <a href="https://crocoblock.com/widgets/<?php echo $navigation_utm;?>" class="btn-link" role="button" target="_blank"><?php echo $widgets_count;?> widgets</a>
</div>

<div class="croco-upgrade-popup">
    <div>Get all <a href="https://crocoblock.com/dynamic-templates/<?php echo $purchase_utm;?>" class="btn-link" role="button" target="_blank"><?php echo $dynamic_models;?></a><br> with All-Inclusive subscription</div>
    <a href="https://crocoblock.com/pricing/<?php echo $purchase_utm;?>" class="btn" role="button" target="_blank">Choose subscription</a>
</div>