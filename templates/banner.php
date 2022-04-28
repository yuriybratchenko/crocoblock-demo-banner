<?php
/**
 * Banner html markup.
 */

$settings = $this->get_settings();

$price    = $settings['price'];
$price_sale = $settings['price-sale'];

$banner_title = $settings['banner-title'];
$banner_subtitle = $settings['banner-subtitle'];

$banner_upgrade_label = $settings['banner-upgrade-label'];
$banner_upgrade_link = $settings['banner-upgrade-link'];

$banner_price_label = $settings['banner-price-label'];
$banner_price_link = $settings['banner-price-link'];

$url = 'https://crocoblock.com/wp-content/uploads/';
?>

<div class="croco-upgrade-container">
    <div class="cs-upgrade-banner">
        <div class="cs-upgrade-banner-box">
            <img src="<?php echo $url;?>2022/04/lock.png" srcset="<?php echo $url;?>2022/04/lock-retina.png 2x" alt="lock">
            <div class="content-box">
                <p class="title"><?php echo $banner_title;?></p>
                <p class="subtitle"><?php echo $banner_subtitle;?></p>
            </div>
        </div>
        <div class="cs-upgrade-banner-btns">
            <a href="<?php echo $banner_price_link;?>" class="cs-btn get-link" role="button" target="_blank"><?php echo $banner_price_label;?>
                <?php if ( $price_sale ) {
                    echo sprintf('&nbsp;<del>$%1$s</del>&nbsp;$%2$s', $price, $price_sale );
                } else {
                    echo sprintf('$%s', $price );
                }?>
            </a>
            <a href="<?php echo $banner_upgrade_link;?>" class="cs-btn upgrade" role="button" target="_blank"><?php echo $banner_upgrade_label;?></a>
        </div>
    </div>
</div>