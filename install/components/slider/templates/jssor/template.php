<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div id="slider" style="position: relative; top: 0; left: 0; width: <?=$arParams['WIDTH']?>px; height: 334px;">
    <div u="slides" style="cursor: move; position: absolute; left: 0; top: 0; width: 998px; height: 334px;">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <div>
                <a u="image" <?if($arItem["PROPERTIES"]["URL"]["VALUE"]):?>href="<?=$arItem["PROPERTIES"]["URL"]["VALUE"]?>"<?endif;?>>
                    <img src="<?=$arItem["PREVIEW_PICTURE"]?>">
                </a>
                <a u="caption" <?if($arItem["PROPERTIES"]["URL"]["VALUE"]):?>href="<?=$arItem["PROPERTIES"]["URL"]["VALUE"]?>"<?endif;?>>
                    <div>
                        <?=$arItem["PREVIEW_TEXT"];?>
                    </div>
                </a>
            </div>
        <?endforeach;?>
    </div>

    <div u="navigator" class="jssorn02" style="position: absolute; bottom: 16px; left: 6px;">
        <!-- navigator item prototype -->
        <div u="prototype" style="POSITION: absolute; WIDTH: 21px; HEIGHT: 21px; text-align:center; line-height:21px; color:black; font-size:20px;"><NumberTemplate></NumberTemplate></div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var options = {
            $SlideDuration: 1000,
            $AutoPlay: true,
            $NavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                $Class: $JssorNavigator$,                       //[Required] Class to create navigator instance
                $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                $SpacingX: 10,                                  //[Optional] Horizontal space between each item in pixel, default value is 0
                $SpacingY: 10,                                  //[Optional] Vertical space between each item in pixel, default value is 0
                $Orientation: 1,                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                $Transitions: [
                    {
                        $Duration: 700,
                        $Opacity: 2,
                        $Brother: {
                            $Duration: 1000,
                            $Opacity: 2
                        }
                    }
                ]
            },
            $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: [
                    {
                        $Duration: 700,
                        $Opacity: 2,
                        $Brother: {
                            $Duration: 1000,
                            $Opacity: 2
                        }
                    }
                ]
            },
            $CaptionSliderOptions: {
                $Class: $JssorCaptionSlider$,
                $CaptionTransitions: [
                    {$Duration:900,$Opacity:2}
                ]
            }
        };
        var jssor_slider1 = new $JssorSlider$('slider', options);
    });

</script>