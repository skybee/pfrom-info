$(document).ready(function(){gAdsInContentHtml = '<div class="content-gAd content-gAd-bottom content-gAd-in-text" >\n\
                            <div class="content-gAd-center">\n\
                                <span class="gAd" data="InArticles"></span>\n\
                            </div>\n\
                        </div>'; if ($('span.storyimage').length > 0){$('span.storyimage:first').after(gAdsInContentHtml); }
else if ($('ul.slideshow').length > 0){$('ul.slideshow:first li:first').after('<li id="adsInSliderList"></li>'); $(gAdsInContentHtml).appendTo('li#adsInSliderList'); }
if ($('h3.look_more_hdn').length >= 3){$('span.gads_in_more_hdn:eq(2)').after(gAdsInContentHtml); if ($('h3.look_more_hdn').length >= 5){$('span.gads_in_more_hdn:eq(4)').after(gAdsInContentHtml); }}
setTimeout(function(){paste_code('GAdsMainCode'); if (addGadPosition()){$('span.gAd').each(function(){blockName = $(this).attr('data'); toWrite = loadGAd(blockName); $(this).replaceWith(toWrite); }); }}, 2000); }); var cntAdsInArticleIncrement = 1; var cntAdsInArtGreyIncrement = 1; function loadGAd(blockName){width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth; if (width <= 980){return loadGAdMobile(blockName); }
else{return loadGAdDesctop(blockName); }}
function addGadPosition(){leftHeight = $("#left").outerHeight(true); rightHeight = $("#right").outerHeight(true); if (leftHeight - rightHeight > 700){$("#right").append('<h3 class="widget-title" style="margin-bottom: -10px; margin-top: 30px;"><span class="title">&nbsp;</span></h3><div class="right_gad_block" style="margin-top: 30px;"><span class="gAd" data="right top"></span></div>'); }
return true; }
function loadGAdMobile(blockName){toWrite = '<!-- No Ads -->'; if (blockName == 'content noImg' || blockName == 'content bottom Netboard'){toWrite = "<!-- mobile -->\
                    <ins class=\"adsbygoogle mobile-noimg\"\
                         style=\"display:block\"\
                         data-ad-client=\"ca-pub-6096727633142370\"\
                         data-ad-slot=\"8859464449\"\
                         data-ad-format=\"rectangle\"></ins>\
                    <script>\
                    (adsbygoogle = window.adsbygoogle || []).push({});\
                    </script>"; }
if (blockName == 'mobile greyInTxt'){toWrite = " <div class=\"mobile-in-txt\"> \n\
                        <!-- Mobile In Text -->\
                        <ins class=\"adsbygoogle mobile-intxt-grey\"\
                             style=\"display:block\"\
                             data-ad-client=\"ca-pub-6096727633142370\"\
                             data-ad-slot=\"8410309242\"\
                             data-ad-format=\"horizontal\"></ins>\
                        <script>\
                        (adsbygoogle = window.adsbygoogle || []).push({});\
                        </script> \n\
                    </div> "; }
if (blockName == 'InArticles'){rndInt = $('#jsrnd').attr('rnd'); toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"2670565727\" \
                            data-ad-format=\"auto\" \
                            data-full-width-responsive=\"true\"> \
                        </ins> \
                        <script> \
                             (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>"; if (cntAdsInArticleIncrement == 2){toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-format=\"fluid\" \
                            data-ad-layout-key=\"-am+4z+b-2a+gu\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"3397609443\"> \
                        </ins> \
                        <script> \
                             (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>"; }
window.cntAdsInArticleIncrement++; }
if (blockName == 'InCategoryList'){toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block\" \
                        data-ad-format=\"fluid\" \
                        data-ad-layout-key=\"-6f+cl+4s-a-43\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"5504059340\"> \
                    </ins> \
                    <script> \
                         (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>"; }
if (blockName == 'LoockMoreInTxt'){toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"7018265929\" \
                        data-ad-format=\"auto\" \
                        data-full-width-responsive=\"true\"></ins> \
                   <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                   </script>"; if (window.cntAdsInArtGreyIncrement == 3 || window.cntAdsInArtGreyIncrement == 5){toWrite = '<!-- No Ads second block -->'; }
window.cntAdsInArtGreyIncrement++; }
return toWrite; }
function loadGAdDesctop(blockName){toWrite = '<!-- No Ads -->'; if (blockName == 'right top'){toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:inline-block;width:300px;height:600px\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"8418393106\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>"; }
if (blockName == 'InCategoryList'){toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block\" \
                        data-ad-format=\"fluid\" \
                        data-ad-layout-key=\"-dy+4w-5g-di+1j2\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"8136724446\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>"; }
if (blockName == 'InArticles'){toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-format=\"fluid\" \
                            data-ad-layout-key=\"-d2+6f-3y-ip+1my\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"8912358297\"> \
                        </ins> \
                        <script> \
                            (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>"; window.cntAdsInArticleIncrement++; }
if (blockName == 'content bottom Netboard'){toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:inline-block;width:580px;height:400px\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"2826759265\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>"; }
if (blockName == 'InSlider'){toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block;height:125px\" \
                        data-ad-format=\"fluid\" \
                        data-ad-layout-key=\"-gg+3r+8c-bc-1v\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"9221992516\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>"; }
if (blockName == 'LoockMoreInTxt'){toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block; max-height:90px;\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"8066584408\" \
                        data-ad-format=\"horizontal\" \
                        data-full-width-responsive=\"true\"></ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>"; if (window.cntAdsInArtGreyIncrement == 3 || window.cntAdsInArtGreyIncrement == 5){toWrite = '<!-- No Ads second block -->'; }
window.cntAdsInArtGreyIncrement++; }
return toWrite; }