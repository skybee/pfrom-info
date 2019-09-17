/*

 - http://express-info.lh/js/skin1/jquery.magnific-popup.min.js

 - http://express-info.lh/js/skin1/jquery.bxslider.min.js

 - http://express-info.lh/js/skin1/sb.js?v=20190305-1129

 - http://express-info.lh/js/skin1/gads.js?v=20181113-1246

*/

 /* FILE START: http://express-info.lh/js/skin1/jquery.magnific-popup.min.js */ 
/*! Magnific Popup - v0.9.9 - 2013-11-15
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2013 Dmitry Semenov; */
(function(e){var t,n,i,o,r,a,s,l="Close",c="BeforeClose",d="AfterClose",u="BeforeAppend",p="MarkupParse",f="Open",m="Change",g="mfp",v="."+g,h="mfp-ready",C="mfp-removing",y="mfp-prevent-close",w=function(){},b=!!window.jQuery,I=e(window),x=function(e,n){t.ev.on(g+e+v,n)},k=function(t,n,i,o){var r=document.createElement("div");return r.className="mfp-"+t,i&&(r.innerHTML=i),o?n&&n.appendChild(r):(r=e(r),n&&r.appendTo(n)),r},T=function(n,i){t.ev.triggerHandler(g+n,i),t.st.callbacks&&(n=n.charAt(0).toLowerCase()+n.slice(1),t.st.callbacks[n]&&t.st.callbacks[n].apply(t,e.isArray(i)?i:[i]))},E=function(n){return n===s&&t.currTemplate.closeBtn||(t.currTemplate.closeBtn=e(t.st.closeMarkup.replace("%title%",t.st.tClose)),s=n),t.currTemplate.closeBtn},_=function(){e.magnificPopup.instance||(t=new w,t.init(),e.magnificPopup.instance=t)},S=function(){var e=document.createElement("p").style,t=["ms","O","Moz","Webkit"];if(void 0!==e.transition)return!0;for(;t.length;)if(t.pop()+"Transition"in e)return!0;return!1};w.prototype={constructor:w,init:function(){var n=navigator.appVersion;t.isIE7=-1!==n.indexOf("MSIE 7."),t.isIE8=-1!==n.indexOf("MSIE 8."),t.isLowIE=t.isIE7||t.isIE8,t.isAndroid=/android/gi.test(n),t.isIOS=/iphone|ipad|ipod/gi.test(n),t.supportsTransition=S(),t.probablyMobile=t.isAndroid||t.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),i=e(document.body),o=e(document),t.popupsCache={}},open:function(n){var i;if(n.isObj===!1){t.items=n.items.toArray(),t.index=0;var r,s=n.items;for(i=0;s.length>i;i++)if(r=s[i],r.parsed&&(r=r.el[0]),r===n.el[0]){t.index=i;break}}else t.items=e.isArray(n.items)?n.items:[n.items],t.index=n.index||0;if(t.isOpen)return t.updateItemHTML(),void 0;t.types=[],a="",t.ev=n.mainEl&&n.mainEl.length?n.mainEl.eq(0):o,n.key?(t.popupsCache[n.key]||(t.popupsCache[n.key]={}),t.currTemplate=t.popupsCache[n.key]):t.currTemplate={},t.st=e.extend(!0,{},e.magnificPopup.defaults,n),t.fixedContentPos="auto"===t.st.fixedContentPos?!t.probablyMobile:t.st.fixedContentPos,t.st.modal&&(t.st.closeOnContentClick=!1,t.st.closeOnBgClick=!1,t.st.showCloseBtn=!1,t.st.enableEscapeKey=!1),t.bgOverlay||(t.bgOverlay=k("bg").on("click"+v,function(){t.close()}),t.wrap=k("wrap").attr("tabindex",-1).on("click"+v,function(e){t._checkIfClose(e.target)&&t.close()}),t.container=k("container",t.wrap)),t.contentContainer=k("content"),t.st.preloader&&(t.preloader=k("preloader",t.container,t.st.tLoading));var l=e.magnificPopup.modules;for(i=0;l.length>i;i++){var c=l[i];c=c.charAt(0).toUpperCase()+c.slice(1),t["init"+c].call(t)}T("BeforeOpen"),t.st.showCloseBtn&&(t.st.closeBtnInside?(x(p,function(e,t,n,i){n.close_replaceWith=E(i.type)}),a+=" mfp-close-btn-in"):t.wrap.append(E())),t.st.alignTop&&(a+=" mfp-align-top"),t.fixedContentPos?t.wrap.css({overflow:t.st.overflowY,overflowX:"hidden",overflowY:t.st.overflowY}):t.wrap.css({top:I.scrollTop(),position:"absolute"}),(t.st.fixedBgPos===!1||"auto"===t.st.fixedBgPos&&!t.fixedContentPos)&&t.bgOverlay.css({height:o.height(),position:"absolute"}),t.st.enableEscapeKey&&o.on("keyup"+v,function(e){27===e.keyCode&&t.close()}),I.on("resize"+v,function(){t.updateSize()}),t.st.closeOnContentClick||(a+=" mfp-auto-cursor"),a&&t.wrap.addClass(a);var d=t.wH=I.height(),u={};if(t.fixedContentPos&&t._hasScrollBar(d)){var m=t._getScrollbarSize();m&&(u.marginRight=m)}t.fixedContentPos&&(t.isIE7?e("body, html").css("overflow","hidden"):u.overflow="hidden");var g=t.st.mainClass;return t.isIE7&&(g+=" mfp-ie7"),g&&t._addClassToMFP(g),t.updateItemHTML(),T("BuildControls"),e("html").css(u),t.bgOverlay.add(t.wrap).prependTo(document.body),t._lastFocusedEl=document.activeElement,setTimeout(function(){t.content?(t._addClassToMFP(h),t._setFocus()):t.bgOverlay.addClass(h),o.on("focusin"+v,t._onFocusIn)},16),t.isOpen=!0,t.updateSize(d),T(f),n},close:function(){t.isOpen&&(T(c),t.isOpen=!1,t.st.removalDelay&&!t.isLowIE&&t.supportsTransition?(t._addClassToMFP(C),setTimeout(function(){t._close()},t.st.removalDelay)):t._close())},_close:function(){T(l);var n=C+" "+h+" ";if(t.bgOverlay.detach(),t.wrap.detach(),t.container.empty(),t.st.mainClass&&(n+=t.st.mainClass+" "),t._removeClassFromMFP(n),t.fixedContentPos){var i={marginRight:""};t.isIE7?e("body, html").css("overflow",""):i.overflow="",e("html").css(i)}o.off("keyup"+v+" focusin"+v),t.ev.off(v),t.wrap.attr("class","mfp-wrap").removeAttr("style"),t.bgOverlay.attr("class","mfp-bg"),t.container.attr("class","mfp-container"),!t.st.showCloseBtn||t.st.closeBtnInside&&t.currTemplate[t.currItem.type]!==!0||t.currTemplate.closeBtn&&t.currTemplate.closeBtn.detach(),t._lastFocusedEl&&e(t._lastFocusedEl).focus(),t.currItem=null,t.content=null,t.currTemplate=null,t.prevHeight=0,T(d)},updateSize:function(e){if(t.isIOS){var n=document.documentElement.clientWidth/window.innerWidth,i=window.innerHeight*n;t.wrap.css("height",i),t.wH=i}else t.wH=e||I.height();t.fixedContentPos||t.wrap.css("height",t.wH),T("Resize")},updateItemHTML:function(){var n=t.items[t.index];t.contentContainer.detach(),t.content&&t.content.detach(),n.parsed||(n=t.parseEl(t.index));var i=n.type;if(T("BeforeChange",[t.currItem?t.currItem.type:"",i]),t.currItem=n,!t.currTemplate[i]){var o=t.st[i]?t.st[i].markup:!1;T("FirstMarkupParse",o),t.currTemplate[i]=o?e(o):!0}r&&r!==n.type&&t.container.removeClass("mfp-"+r+"-holder");var a=t["get"+i.charAt(0).toUpperCase()+i.slice(1)](n,t.currTemplate[i]);t.appendContent(a,i),n.preloaded=!0,T(m,n),r=n.type,t.container.prepend(t.contentContainer),T("AfterChange")},appendContent:function(e,n){t.content=e,e?t.st.showCloseBtn&&t.st.closeBtnInside&&t.currTemplate[n]===!0?t.content.find(".mfp-close").length||t.content.append(E()):t.content=e:t.content="",T(u),t.container.addClass("mfp-"+n+"-holder"),t.contentContainer.append(t.content)},parseEl:function(n){var i=t.items[n],o=i.type;if(i=i.tagName?{el:e(i)}:{data:i,src:i.src},i.el){for(var r=t.types,a=0;r.length>a;a++)if(i.el.hasClass("mfp-"+r[a])){o=r[a];break}i.src=i.el.attr("data-mfp-src"),i.src||(i.src=i.el.attr("href"))}return i.type=o||t.st.type||"inline",i.index=n,i.parsed=!0,t.items[n]=i,T("ElementParse",i),t.items[n]},addGroup:function(e,n){var i=function(i){i.mfpEl=this,t._openClick(i,e,n)};n||(n={});var o="click.magnificPopup";n.mainEl=e,n.items?(n.isObj=!0,e.off(o).on(o,i)):(n.isObj=!1,n.delegate?e.off(o).on(o,n.delegate,i):(n.items=e,e.off(o).on(o,i)))},_openClick:function(n,i,o){var r=void 0!==o.midClick?o.midClick:e.magnificPopup.defaults.midClick;if(r||2!==n.which&&!n.ctrlKey&&!n.metaKey){var a=void 0!==o.disableOn?o.disableOn:e.magnificPopup.defaults.disableOn;if(a)if(e.isFunction(a)){if(!a.call(t))return!0}else if(a>I.width())return!0;n.type&&(n.preventDefault(),t.isOpen&&n.stopPropagation()),o.el=e(n.mfpEl),o.delegate&&(o.items=i.find(o.delegate)),t.open(o)}},updateStatus:function(e,i){if(t.preloader){n!==e&&t.container.removeClass("mfp-s-"+n),i||"loading"!==e||(i=t.st.tLoading);var o={status:e,text:i};T("UpdateStatus",o),e=o.status,i=o.text,t.preloader.html(i),t.preloader.find("a").on("click",function(e){e.stopImmediatePropagation()}),t.container.addClass("mfp-s-"+e),n=e}},_checkIfClose:function(n){if(!e(n).hasClass(y)){var i=t.st.closeOnContentClick,o=t.st.closeOnBgClick;if(i&&o)return!0;if(!t.content||e(n).hasClass("mfp-close")||t.preloader&&n===t.preloader[0])return!0;if(n===t.content[0]||e.contains(t.content[0],n)){if(i)return!0}else if(o&&e.contains(document,n))return!0;return!1}},_addClassToMFP:function(e){t.bgOverlay.addClass(e),t.wrap.addClass(e)},_removeClassFromMFP:function(e){this.bgOverlay.removeClass(e),t.wrap.removeClass(e)},_hasScrollBar:function(e){return(t.isIE7?o.height():document.body.scrollHeight)>(e||I.height())},_setFocus:function(){(t.st.focus?t.content.find(t.st.focus).eq(0):t.wrap).focus()},_onFocusIn:function(n){return n.target===t.wrap[0]||e.contains(t.wrap[0],n.target)?void 0:(t._setFocus(),!1)},_parseMarkup:function(t,n,i){var o;i.data&&(n=e.extend(i.data,n)),T(p,[t,n,i]),e.each(n,function(e,n){if(void 0===n||n===!1)return!0;if(o=e.split("_"),o.length>1){var i=t.find(v+"-"+o[0]);if(i.length>0){var r=o[1];"replaceWith"===r?i[0]!==n[0]&&i.replaceWith(n):"img"===r?i.is("img")?i.attr("src",n):i.replaceWith('<img src="'+n+'" class="'+i.attr("class")+'" />'):i.attr(o[1],n)}}else t.find(v+"-"+e).html(n)})},_getScrollbarSize:function(){if(void 0===t.scrollbarSize){var e=document.createElement("div");e.id="mfp-sbm",e.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(e),t.scrollbarSize=e.offsetWidth-e.clientWidth,document.body.removeChild(e)}return t.scrollbarSize}},e.magnificPopup={instance:null,proto:w.prototype,modules:[],open:function(t,n){return _(),t=t?e.extend(!0,{},t):{},t.isObj=!0,t.index=n||0,this.instance.open(t)},close:function(){return e.magnificPopup.instance&&e.magnificPopup.instance.close()},registerModule:function(t,n){n.options&&(e.magnificPopup.defaults[t]=n.options),e.extend(this.proto,n.proto),this.modules.push(t)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:"Close (Esc)",tLoading:"Loading..."}},e.fn.magnificPopup=function(n){_();var i=e(this);if("string"==typeof n)if("open"===n){var o,r=b?i.data("magnificPopup"):i[0].magnificPopup,a=parseInt(arguments[1],10)||0;r.items?o=r.items[a]:(o=i,r.delegate&&(o=o.find(r.delegate)),o=o.eq(a)),t._openClick({mfpEl:o},i,r)}else t.isOpen&&t[n].apply(t,Array.prototype.slice.call(arguments,1));else n=e.extend(!0,{},n),b?i.data("magnificPopup",n):i[0].magnificPopup=n,t.addGroup(i,n);return i};var P,O,z,M="inline",B=function(){z&&(O.after(z.addClass(P)).detach(),z=null)};e.magnificPopup.registerModule(M,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){t.types.push(M),x(l+"."+M,function(){B()})},getInline:function(n,i){if(B(),n.src){var o=t.st.inline,r=e(n.src);if(r.length){var a=r[0].parentNode;a&&a.tagName&&(O||(P=o.hiddenClass,O=k(P),P="mfp-"+P),z=r.after(O).detach().removeClass(P)),t.updateStatus("ready")}else t.updateStatus("error",o.tNotFound),r=e("<div>");return n.inlineElement=r,r}return t.updateStatus("ready"),t._parseMarkup(i,{},n),i}}});var F,H="ajax",L=function(){F&&i.removeClass(F)},A=function(){L(),t.req&&t.req.abort()};e.magnificPopup.registerModule(H,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){t.types.push(H),F=t.st.ajax.cursor,x(l+"."+H,A),x("BeforeChange."+H,A)},getAjax:function(n){F&&i.addClass(F),t.updateStatus("loading");var o=e.extend({url:n.src,success:function(i,o,r){var a={data:i,xhr:r};T("ParseAjax",a),t.appendContent(e(a.data),H),n.finished=!0,L(),t._setFocus(),setTimeout(function(){t.wrap.addClass(h)},16),t.updateStatus("ready"),T("AjaxContentAdded")},error:function(){L(),n.finished=n.loadError=!0,t.updateStatus("error",t.st.ajax.tError.replace("%url%",n.src))}},t.st.ajax.settings);return t.req=e.ajax(o),""}}});var j,N=function(n){if(n.data&&void 0!==n.data.title)return n.data.title;var i=t.st.image.titleSrc;if(i){if(e.isFunction(i))return i.call(t,n);if(n.el)return n.el.attr(i)||""}return""};e.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var e=t.st.image,n=".image";t.types.push("image"),x(f+n,function(){"image"===t.currItem.type&&e.cursor&&i.addClass(e.cursor)}),x(l+n,function(){e.cursor&&i.removeClass(e.cursor),I.off("resize"+v)}),x("Resize"+n,t.resizeImage),t.isLowIE&&x("AfterChange",t.resizeImage)},resizeImage:function(){var e=t.currItem;if(e&&e.img&&t.st.image.verticalFit){var n=0;t.isLowIE&&(n=parseInt(e.img.css("padding-top"),10)+parseInt(e.img.css("padding-bottom"),10)),e.img.css("max-height",t.wH-n)}},_onImageHasSize:function(e){e.img&&(e.hasSize=!0,j&&clearInterval(j),e.isCheckingImgSize=!1,T("ImageHasSize",e),e.imgHidden&&(t.content&&t.content.removeClass("mfp-loading"),e.imgHidden=!1))},findImageSize:function(e){var n=0,i=e.img[0],o=function(r){j&&clearInterval(j),j=setInterval(function(){return i.naturalWidth>0?(t._onImageHasSize(e),void 0):(n>200&&clearInterval(j),n++,3===n?o(10):40===n?o(50):100===n&&o(500),void 0)},r)};o(1)},getImage:function(n,i){var o=0,r=function(){n&&(n.img[0].complete?(n.img.off(".mfploader"),n===t.currItem&&(t._onImageHasSize(n),t.updateStatus("ready")),n.hasSize=!0,n.loaded=!0,T("ImageLoadComplete")):(o++,200>o?setTimeout(r,100):a()))},a=function(){n&&(n.img.off(".mfploader"),n===t.currItem&&(t._onImageHasSize(n),t.updateStatus("error",s.tError.replace("%url%",n.src))),n.hasSize=!0,n.loaded=!0,n.loadError=!0)},s=t.st.image,l=i.find(".mfp-img");if(l.length){var c=document.createElement("img");c.className="mfp-img",n.img=e(c).on("load.mfploader",r).on("error.mfploader",a),c.src=n.src,l.is("img")&&(n.img=n.img.clone()),n.img[0].naturalWidth>0&&(n.hasSize=!0)}return t._parseMarkup(i,{title:N(n),img_replaceWith:n.img},n),t.resizeImage(),n.hasSize?(j&&clearInterval(j),n.loadError?(i.addClass("mfp-loading"),t.updateStatus("error",s.tError.replace("%url%",n.src))):(i.removeClass("mfp-loading"),t.updateStatus("ready")),i):(t.updateStatus("loading"),n.loading=!0,n.hasSize||(n.imgHidden=!0,i.addClass("mfp-loading"),t.findImageSize(n)),i)}}});var W,R=function(){return void 0===W&&(W=void 0!==document.createElement("p").style.MozTransform),W};e.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(e){return e.is("img")?e:e.find("img")}},proto:{initZoom:function(){var e,n=t.st.zoom,i=".zoom";if(n.enabled&&t.supportsTransition){var o,r,a=n.duration,s=function(e){var t=e.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),i="all "+n.duration/1e3+"s "+n.easing,o={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},r="transition";return o["-webkit-"+r]=o["-moz-"+r]=o["-o-"+r]=o[r]=i,t.css(o),t},d=function(){t.content.css("visibility","visible")};x("BuildControls"+i,function(){if(t._allowZoom()){if(clearTimeout(o),t.content.css("visibility","hidden"),e=t._getItemToZoom(),!e)return d(),void 0;r=s(e),r.css(t._getOffset()),t.wrap.append(r),o=setTimeout(function(){r.css(t._getOffset(!0)),o=setTimeout(function(){d(),setTimeout(function(){r.remove(),e=r=null,T("ZoomAnimationEnded")},16)},a)},16)}}),x(c+i,function(){if(t._allowZoom()){if(clearTimeout(o),t.st.removalDelay=a,!e){if(e=t._getItemToZoom(),!e)return;r=s(e)}r.css(t._getOffset(!0)),t.wrap.append(r),t.content.css("visibility","hidden"),setTimeout(function(){r.css(t._getOffset())},16)}}),x(l+i,function(){t._allowZoom()&&(d(),r&&r.remove(),e=null)})}},_allowZoom:function(){return"image"===t.currItem.type},_getItemToZoom:function(){return t.currItem.hasSize?t.currItem.img:!1},_getOffset:function(n){var i;i=n?t.currItem.img:t.st.zoom.opener(t.currItem.el||t.currItem);var o=i.offset(),r=parseInt(i.css("padding-top"),10),a=parseInt(i.css("padding-bottom"),10);o.top-=e(window).scrollTop()-r;var s={width:i.width(),height:(b?i.innerHeight():i[0].offsetHeight)-a-r};return R()?s["-moz-transform"]=s.transform="translate("+o.left+"px,"+o.top+"px)":(s.left=o.left,s.top=o.top),s}}});var Z="iframe",q="//about:blank",D=function(e){if(t.currTemplate[Z]){var n=t.currTemplate[Z].find("iframe");n.length&&(e||(n[0].src=q),t.isIE8&&n.css("display",e?"block":"none"))}};e.magnificPopup.registerModule(Z,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){t.types.push(Z),x("BeforeChange",function(e,t,n){t!==n&&(t===Z?D():n===Z&&D(!0))}),x(l+"."+Z,function(){D()})},getIframe:function(n,i){var o=n.src,r=t.st.iframe;e.each(r.patterns,function(){return o.indexOf(this.index)>-1?(this.id&&(o="string"==typeof this.id?o.substr(o.lastIndexOf(this.id)+this.id.length,o.length):this.id.call(this,o)),o=this.src.replace("%id%",o),!1):void 0});var a={};return r.srcAction&&(a[r.srcAction]=o),t._parseMarkup(i,a,n),t.updateStatus("ready"),i}}});var K=function(e){var n=t.items.length;return e>n-1?e-n:0>e?n+e:e},Y=function(e,t,n){return e.replace(/%curr%/gi,t+1).replace(/%total%/gi,n)};e.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var n=t.st.gallery,i=".mfp-gallery",r=Boolean(e.fn.mfpFastClick);return t.direction=!0,n&&n.enabled?(a+=" mfp-gallery",x(f+i,function(){n.navigateByImgClick&&t.wrap.on("click"+i,".mfp-img",function(){return t.items.length>1?(t.next(),!1):void 0}),o.on("keydown"+i,function(e){37===e.keyCode?t.prev():39===e.keyCode&&t.next()})}),x("UpdateStatus"+i,function(e,n){n.text&&(n.text=Y(n.text,t.currItem.index,t.items.length))}),x(p+i,function(e,i,o,r){var a=t.items.length;o.counter=a>1?Y(n.tCounter,r.index,a):""}),x("BuildControls"+i,function(){if(t.items.length>1&&n.arrows&&!t.arrowLeft){var i=n.arrowMarkup,o=t.arrowLeft=e(i.replace(/%title%/gi,n.tPrev).replace(/%dir%/gi,"left")).addClass(y),a=t.arrowRight=e(i.replace(/%title%/gi,n.tNext).replace(/%dir%/gi,"right")).addClass(y),s=r?"mfpFastClick":"click";o[s](function(){t.prev()}),a[s](function(){t.next()}),t.isIE7&&(k("b",o[0],!1,!0),k("a",o[0],!1,!0),k("b",a[0],!1,!0),k("a",a[0],!1,!0)),t.container.append(o.add(a))}}),x(m+i,function(){t._preloadTimeout&&clearTimeout(t._preloadTimeout),t._preloadTimeout=setTimeout(function(){t.preloadNearbyImages(),t._preloadTimeout=null},16)}),x(l+i,function(){o.off(i),t.wrap.off("click"+i),t.arrowLeft&&r&&t.arrowLeft.add(t.arrowRight).destroyMfpFastClick(),t.arrowRight=t.arrowLeft=null}),void 0):!1},next:function(){t.direction=!0,t.index=K(t.index+1),t.updateItemHTML()},prev:function(){t.direction=!1,t.index=K(t.index-1),t.updateItemHTML()},goTo:function(e){t.direction=e>=t.index,t.index=e,t.updateItemHTML()},preloadNearbyImages:function(){var e,n=t.st.gallery.preload,i=Math.min(n[0],t.items.length),o=Math.min(n[1],t.items.length);for(e=1;(t.direction?o:i)>=e;e++)t._preloadItem(t.index+e);for(e=1;(t.direction?i:o)>=e;e++)t._preloadItem(t.index-e)},_preloadItem:function(n){if(n=K(n),!t.items[n].preloaded){var i=t.items[n];i.parsed||(i=t.parseEl(n)),T("LazyLoad",i),"image"===i.type&&(i.img=e('<img class="mfp-img" />').on("load.mfploader",function(){i.hasSize=!0}).on("error.mfploader",function(){i.hasSize=!0,i.loadError=!0,T("LazyLoadError",i)}).attr("src",i.src)),i.preloaded=!0}}}});var U="retina";e.magnificPopup.registerModule(U,{options:{replaceSrc:function(e){return e.src.replace(/\.\w+$/,function(e){return"@2x"+e})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var e=t.st.retina,n=e.ratio;n=isNaN(n)?n():n,n>1&&(x("ImageHasSize."+U,function(e,t){t.img.css({"max-width":t.img[0].naturalWidth/n,width:"100%"})}),x("ElementParse."+U,function(t,i){i.src=e.replaceSrc(i,n)}))}}}}),function(){var t=1e3,n="ontouchstart"in window,i=function(){I.off("touchmove"+r+" touchend"+r)},o="mfpFastClick",r="."+o;e.fn.mfpFastClick=function(o){return e(this).each(function(){var a,s=e(this);if(n){var l,c,d,u,p,f;s.on("touchstart"+r,function(e){u=!1,f=1,p=e.originalEvent?e.originalEvent.touches[0]:e.touches[0],c=p.clientX,d=p.clientY,I.on("touchmove"+r,function(e){p=e.originalEvent?e.originalEvent.touches:e.touches,f=p.length,p=p[0],(Math.abs(p.clientX-c)>10||Math.abs(p.clientY-d)>10)&&(u=!0,i())}).on("touchend"+r,function(e){i(),u||f>1||(a=!0,e.preventDefault(),clearTimeout(l),l=setTimeout(function(){a=!1},t),o())})})}s.on("click"+r,function(){a||o()})})},e.fn.destroyMfpFastClick=function(){e(this).off("touchstart"+r+" click"+r),n&&I.off("touchmove"+r+" touchend"+r)}}(),_()})(window.jQuery||window.Zepto);
 /* FILE END: http://express-info.lh/js/skin1/jquery.magnific-popup.min.js */ 



 /* FILE START: http://express-info.lh/js/skin1/jquery.bxslider.min.js */ 
/**
 * BxSlider v4.1.2 - Fully loaded, responsive content slider
 * http://bxslider.com
 *
 * Copyright 2014, Steven Wanderski - http://stevenwanderski.com - http://bxcreative.com
 * Written while drinking Belgian ales and listening to jazz
 *
 * Released under the MIT license - http://opensource.org/licenses/MIT
 */
!function(t){var e={},s={mode:"horizontal",slideSelector:"",infiniteLoop:!0,hideControlOnEnd:!1,speed:500,easing:null,slideMargin:0,startSlide:0,randomStart:!1,captions:!1,ticker:!1,tickerHover:!1,adaptiveHeight:!1,adaptiveHeightSpeed:500,video:!1,useCSS:!0,preloadImages:"visible",responsive:!0,slideZIndex:50,touchEnabled:!0,swipeThreshold:50,oneToOneTouch:!0,preventDefaultSwipeX:!0,preventDefaultSwipeY:!1,pager:!0,pagerType:"full",pagerShortSeparator:" / ",pagerSelector:null,buildPager:null,pagerCustom:null,controls:!0,nextText:"Next",prevText:"Prev",nextSelector:null,prevSelector:null,autoControls:!1,startText:"Start",stopText:"Stop",autoControlsCombine:!1,autoControlsSelector:null,auto:!1,pause:4e3,autoStart:!0,autoDirection:"next",autoHover:!1,autoDelay:0,minSlides:1,maxSlides:1,moveSlides:0,slideWidth:0,onSliderLoad:function(){},onSlideBefore:function(){},onSlideAfter:function(){},onSlideNext:function(){},onSlidePrev:function(){},onSliderResize:function(){}};t.fn.bxSlider=function(n){if(0==this.length)return this;if(this.length>1)return this.each(function(){t(this).bxSlider(n)}),this;var o={},r=this;e.el=this;var a=t(window).width(),l=t(window).height(),d=function(){o.settings=t.extend({},s,n),o.settings.slideWidth=parseInt(o.settings.slideWidth),o.children=r.children(o.settings.slideSelector),o.children.length<o.settings.minSlides&&(o.settings.minSlides=o.children.length),o.children.length<o.settings.maxSlides&&(o.settings.maxSlides=o.children.length),o.settings.randomStart&&(o.settings.startSlide=Math.floor(Math.random()*o.children.length)),o.active={index:o.settings.startSlide},o.carousel=o.settings.minSlides>1||o.settings.maxSlides>1,o.carousel&&(o.settings.preloadImages="all"),o.minThreshold=o.settings.minSlides*o.settings.slideWidth+(o.settings.minSlides-1)*o.settings.slideMargin,o.maxThreshold=o.settings.maxSlides*o.settings.slideWidth+(o.settings.maxSlides-1)*o.settings.slideMargin,o.working=!1,o.controls={},o.interval=null,o.animProp="vertical"==o.settings.mode?"top":"left",o.usingCSS=o.settings.useCSS&&"fade"!=o.settings.mode&&function(){var t=document.createElement("div"),e=["WebkitPerspective","MozPerspective","OPerspective","msPerspective"];for(var i in e)if(void 0!==t.style[e[i]])return o.cssPrefix=e[i].replace("Perspective","").toLowerCase(),o.animProp="-"+o.cssPrefix+"-transform",!0;return!1}(),"vertical"==o.settings.mode&&(o.settings.maxSlides=o.settings.minSlides),r.data("origStyle",r.attr("style")),r.children(o.settings.slideSelector).each(function(){t(this).data("origStyle",t(this).attr("style"))}),c()},c=function(){r.wrap('<div class="bx-wrapper"><div class="bx-viewport"></div></div>'),o.viewport=r.parent(),o.loader=t('<div class="bx-loading" />'),o.viewport.prepend(o.loader),r.css({width:"horizontal"==o.settings.mode?100*o.children.length+215+"%":"auto",position:"relative"}),o.usingCSS&&o.settings.easing?r.css("-"+o.cssPrefix+"-transition-timing-function",o.settings.easing):o.settings.easing||(o.settings.easing="swing"),f(),o.viewport.css({width:"100%",overflow:"hidden",position:"relative"}),o.viewport.parent().css({maxWidth:p()}),o.settings.pager||o.viewport.parent().css({margin:"0 auto 0px"}),o.children.css({"float":"horizontal"==o.settings.mode?"left":"none",listStyle:"none",position:"relative"}),o.children.css("width",u()),"horizontal"==o.settings.mode&&o.settings.slideMargin>0&&o.children.css("marginRight",o.settings.slideMargin),"vertical"==o.settings.mode&&o.settings.slideMargin>0&&o.children.css("marginBottom",o.settings.slideMargin),"fade"==o.settings.mode&&(o.children.css({position:"absolute",zIndex:0,display:"none"}),o.children.eq(o.settings.startSlide).css({zIndex:o.settings.slideZIndex,display:"block"})),o.controls.el=t('<div class="bx-controls" />'),o.settings.captions&&P(),o.active.last=o.settings.startSlide==x()-1,o.settings.video&&r.fitVids();var e=o.children.eq(o.settings.startSlide);"all"==o.settings.preloadImages&&(e=o.children),o.settings.ticker?o.settings.pager=!1:(o.settings.pager&&T(),o.settings.controls&&C(),o.settings.auto&&o.settings.autoControls&&E(),(o.settings.controls||o.settings.autoControls||o.settings.pager)&&o.viewport.after(o.controls.el)),g(e,h)},g=function(e,i){var s=e.find("img, iframe").length;if(0==s)return i(),void 0;var n=0;e.find("img, iframe").each(function(){t(this).one("load",function(){++n==s&&i()}).each(function(){this.complete&&t(this).load()})})},h=function(){if(o.settings.infiniteLoop&&"fade"!=o.settings.mode&&!o.settings.ticker){var e="vertical"==o.settings.mode?o.settings.minSlides:o.settings.maxSlides,i=o.children.slice(0,e).clone().addClass("bx-clone"),s=o.children.slice(-e).clone().addClass("bx-clone");r.append(i).prepend(s)}o.loader.remove(),S(),"vertical"==o.settings.mode&&(o.settings.adaptiveHeight=!0),o.viewport.height(v()),r.redrawSlider(),o.settings.onSliderLoad(o.active.index),o.initialized=!0,o.settings.responsive&&t(window).bind("resize",Z),o.settings.auto&&o.settings.autoStart&&H(),o.settings.ticker&&L(),o.settings.pager&&q(o.settings.startSlide),o.settings.controls&&W(),o.settings.touchEnabled&&!o.settings.ticker&&O()},v=function(){var e=0,s=t();if("vertical"==o.settings.mode||o.settings.adaptiveHeight)if(o.carousel){var n=1==o.settings.moveSlides?o.active.index:o.active.index*m();for(s=o.children.eq(n),i=1;i<=o.settings.maxSlides-1;i++)s=n+i>=o.children.length?s.add(o.children.eq(i-1)):s.add(o.children.eq(n+i))}else s=o.children.eq(o.active.index);else s=o.children;return"vertical"==o.settings.mode?(s.each(function(){e+=t(this).outerHeight()}),o.settings.slideMargin>0&&(e+=o.settings.slideMargin*(o.settings.minSlides-1))):e=Math.max.apply(Math,s.map(function(){return t(this).outerHeight(!1)}).get()),e},p=function(){var t="100%";return o.settings.slideWidth>0&&(t="horizontal"==o.settings.mode?o.settings.maxSlides*o.settings.slideWidth+(o.settings.maxSlides-1)*o.settings.slideMargin:o.settings.slideWidth),t},u=function(){var t=o.settings.slideWidth,e=o.viewport.width();return 0==o.settings.slideWidth||o.settings.slideWidth>e&&!o.carousel||"vertical"==o.settings.mode?t=e:o.settings.maxSlides>1&&"horizontal"==o.settings.mode&&(e>o.maxThreshold||e<o.minThreshold&&(t=(e-o.settings.slideMargin*(o.settings.minSlides-1))/o.settings.minSlides)),t},f=function(){var t=1;if("horizontal"==o.settings.mode&&o.settings.slideWidth>0)if(o.viewport.width()<o.minThreshold)t=o.settings.minSlides;else if(o.viewport.width()>o.maxThreshold)t=o.settings.maxSlides;else{var e=o.children.first().width();t=Math.floor(o.viewport.width()/e)}else"vertical"==o.settings.mode&&(t=o.settings.minSlides);return t},x=function(){var t=0;if(o.settings.moveSlides>0)if(o.settings.infiniteLoop)t=o.children.length/m();else for(var e=0,i=0;e<o.children.length;)++t,e=i+f(),i+=o.settings.moveSlides<=f()?o.settings.moveSlides:f();else t=Math.ceil(o.children.length/f());return t},m=function(){return o.settings.moveSlides>0&&o.settings.moveSlides<=f()?o.settings.moveSlides:f()},S=function(){if(o.children.length>o.settings.maxSlides&&o.active.last&&!o.settings.infiniteLoop){if("horizontal"==o.settings.mode){var t=o.children.last(),e=t.position();b(-(e.left-(o.viewport.width()-t.width())),"reset",0)}else if("vertical"==o.settings.mode){var i=o.children.length-o.settings.minSlides,e=o.children.eq(i).position();b(-e.top,"reset",0)}}else{var e=o.children.eq(o.active.index*m()).position();o.active.index==x()-1&&(o.active.last=!0),void 0!=e&&("horizontal"==o.settings.mode?b(-e.left,"reset",0):"vertical"==o.settings.mode&&b(-e.top,"reset",0))}},b=function(t,e,i,s){if(o.usingCSS){var n="vertical"==o.settings.mode?"translate3d(0, "+t+"px, 0)":"translate3d("+t+"px, 0, 0)";r.css("-"+o.cssPrefix+"-transition-duration",i/1e3+"s"),"slide"==e?(r.css(o.animProp,n),r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(){r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"),D()})):"reset"==e?r.css(o.animProp,n):"ticker"==e&&(r.css("-"+o.cssPrefix+"-transition-timing-function","linear"),r.css(o.animProp,n),r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(){r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"),b(s.resetValue,"reset",0),N()}))}else{var a={};a[o.animProp]=t,"slide"==e?r.animate(a,i,o.settings.easing,function(){D()}):"reset"==e?r.css(o.animProp,t):"ticker"==e&&r.animate(a,speed,"linear",function(){b(s.resetValue,"reset",0),N()})}},w=function(){for(var e="",i=x(),s=0;i>s;s++){var n="";o.settings.buildPager&&t.isFunction(o.settings.buildPager)?(n=o.settings.buildPager(s),o.pagerEl.addClass("bx-custom-pager")):(n=s+1,o.pagerEl.addClass("bx-default-pager")),e+='<div class="bx-pager-item"><a href="" data-slide-index="'+s+'" class="bx-pager-link">'+n+"</a></div>"}o.pagerEl.html(e)},T=function(){o.settings.pagerCustom?o.pagerEl=t(o.settings.pagerCustom):(o.pagerEl=t('<div class="bx-pager" />'),o.settings.pagerSelector?t(o.settings.pagerSelector).html(o.pagerEl):o.controls.el.addClass("bx-has-pager").append(o.pagerEl),w()),o.pagerEl.on("click","a",I)},C=function(){o.controls.next=t('<a class="bx-next" href="">'+o.settings.nextText+"</a>"),o.controls.prev=t('<a class="bx-prev" href="">'+o.settings.prevText+"</a>"),o.controls.next.bind("click",y),o.controls.prev.bind("click",z),o.settings.nextSelector&&t(o.settings.nextSelector).append(o.controls.next),o.settings.prevSelector&&t(o.settings.prevSelector).append(o.controls.prev),o.settings.nextSelector||o.settings.prevSelector||(o.controls.directionEl=t('<div class="bx-controls-direction" />'),o.controls.directionEl.append(o.controls.prev).append(o.controls.next),o.controls.el.addClass("bx-has-controls-direction").append(o.controls.directionEl))},E=function(){o.controls.start=t('<div class="bx-controls-auto-item"><a class="bx-start" href="">'+o.settings.startText+"</a></div>"),o.controls.stop=t('<div class="bx-controls-auto-item"><a class="bx-stop" href="">'+o.settings.stopText+"</a></div>"),o.controls.autoEl=t('<div class="bx-controls-auto" />'),o.controls.autoEl.on("click",".bx-start",k),o.controls.autoEl.on("click",".bx-stop",M),o.settings.autoControlsCombine?o.controls.autoEl.append(o.controls.start):o.controls.autoEl.append(o.controls.start).append(o.controls.stop),o.settings.autoControlsSelector?t(o.settings.autoControlsSelector).html(o.controls.autoEl):o.controls.el.addClass("bx-has-controls-auto").append(o.controls.autoEl),A(o.settings.autoStart?"stop":"start")},P=function(){o.children.each(function(){var e=t(this).find("img:first").attr("title");void 0!=e&&(""+e).length&&t(this).append('<div class="bx-caption"><span>'+e+"</span></div>")})},y=function(t){o.settings.auto&&r.stopAuto(),r.goToNextSlide(),t.preventDefault()},z=function(t){o.settings.auto&&r.stopAuto(),r.goToPrevSlide(),t.preventDefault()},k=function(t){r.startAuto(),t.preventDefault()},M=function(t){r.stopAuto(),t.preventDefault()},I=function(e){o.settings.auto&&r.stopAuto();var i=t(e.currentTarget),s=parseInt(i.attr("data-slide-index"));s!=o.active.index&&r.goToSlide(s),e.preventDefault()},q=function(e){var i=o.children.length;return"short"==o.settings.pagerType?(o.settings.maxSlides>1&&(i=Math.ceil(o.children.length/o.settings.maxSlides)),o.pagerEl.html(e+1+o.settings.pagerShortSeparator+i),void 0):(o.pagerEl.find("a").removeClass("active"),o.pagerEl.each(function(i,s){t(s).find("a").eq(e).addClass("active")}),void 0)},D=function(){if(o.settings.infiniteLoop){var t="";0==o.active.index?t=o.children.eq(0).position():o.active.index==x()-1&&o.carousel?t=o.children.eq((x()-1)*m()).position():o.active.index==o.children.length-1&&(t=o.children.eq(o.children.length-1).position()),t&&("horizontal"==o.settings.mode?b(-t.left,"reset",0):"vertical"==o.settings.mode&&b(-t.top,"reset",0))}o.working=!1,o.settings.onSlideAfter(o.children.eq(o.active.index),o.oldIndex,o.active.index)},A=function(t){o.settings.autoControlsCombine?o.controls.autoEl.html(o.controls[t]):(o.controls.autoEl.find("a").removeClass("active"),o.controls.autoEl.find("a:not(.bx-"+t+")").addClass("active"))},W=function(){1==x()?(o.controls.prev.addClass("disabled"),o.controls.next.addClass("disabled")):!o.settings.infiniteLoop&&o.settings.hideControlOnEnd&&(0==o.active.index?(o.controls.prev.addClass("disabled"),o.controls.next.removeClass("disabled")):o.active.index==x()-1?(o.controls.next.addClass("disabled"),o.controls.prev.removeClass("disabled")):(o.controls.prev.removeClass("disabled"),o.controls.next.removeClass("disabled")))},H=function(){o.settings.autoDelay>0?setTimeout(r.startAuto,o.settings.autoDelay):r.startAuto(),o.settings.autoHover&&r.hover(function(){o.interval&&(r.stopAuto(!0),o.autoPaused=!0)},function(){o.autoPaused&&(r.startAuto(!0),o.autoPaused=null)})},L=function(){var e=0;if("next"==o.settings.autoDirection)r.append(o.children.clone().addClass("bx-clone"));else{r.prepend(o.children.clone().addClass("bx-clone"));var i=o.children.first().position();e="horizontal"==o.settings.mode?-i.left:-i.top}b(e,"reset",0),o.settings.pager=!1,o.settings.controls=!1,o.settings.autoControls=!1,o.settings.tickerHover&&!o.usingCSS&&o.viewport.hover(function(){r.stop()},function(){var e=0;o.children.each(function(){e+="horizontal"==o.settings.mode?t(this).outerWidth(!0):t(this).outerHeight(!0)});var i=o.settings.speed/e,s="horizontal"==o.settings.mode?"left":"top",n=i*(e-Math.abs(parseInt(r.css(s))));N(n)}),N()},N=function(t){speed=t?t:o.settings.speed;var e={left:0,top:0},i={left:0,top:0};"next"==o.settings.autoDirection?e=r.find(".bx-clone").first().position():i=o.children.first().position();var s="horizontal"==o.settings.mode?-e.left:-e.top,n="horizontal"==o.settings.mode?-i.left:-i.top,a={resetValue:n};b(s,"ticker",speed,a)},O=function(){o.touch={start:{x:0,y:0},end:{x:0,y:0}},o.viewport.bind("touchstart",X)},X=function(t){if(o.working)t.preventDefault();else{o.touch.originalPos=r.position();var e=t.originalEvent;o.touch.start.x=e.changedTouches[0].pageX,o.touch.start.y=e.changedTouches[0].pageY,o.viewport.bind("touchmove",Y),o.viewport.bind("touchend",V)}},Y=function(t){var e=t.originalEvent,i=Math.abs(e.changedTouches[0].pageX-o.touch.start.x),s=Math.abs(e.changedTouches[0].pageY-o.touch.start.y);if(3*i>s&&o.settings.preventDefaultSwipeX?t.preventDefault():3*s>i&&o.settings.preventDefaultSwipeY&&t.preventDefault(),"fade"!=o.settings.mode&&o.settings.oneToOneTouch){var n=0;if("horizontal"==o.settings.mode){var r=e.changedTouches[0].pageX-o.touch.start.x;n=o.touch.originalPos.left+r}else{var r=e.changedTouches[0].pageY-o.touch.start.y;n=o.touch.originalPos.top+r}b(n,"reset",0)}},V=function(t){o.viewport.unbind("touchmove",Y);var e=t.originalEvent,i=0;if(o.touch.end.x=e.changedTouches[0].pageX,o.touch.end.y=e.changedTouches[0].pageY,"fade"==o.settings.mode){var s=Math.abs(o.touch.start.x-o.touch.end.x);s>=o.settings.swipeThreshold&&(o.touch.start.x>o.touch.end.x?r.goToNextSlide():r.goToPrevSlide(),r.stopAuto())}else{var s=0;"horizontal"==o.settings.mode?(s=o.touch.end.x-o.touch.start.x,i=o.touch.originalPos.left):(s=o.touch.end.y-o.touch.start.y,i=o.touch.originalPos.top),!o.settings.infiniteLoop&&(0==o.active.index&&s>0||o.active.last&&0>s)?b(i,"reset",200):Math.abs(s)>=o.settings.swipeThreshold?(0>s?r.goToNextSlide():r.goToPrevSlide(),r.stopAuto()):b(i,"reset",200)}o.viewport.unbind("touchend",V)},Z=function(){var e=t(window).width(),i=t(window).height();(a!=e||l!=i)&&(a=e,l=i,r.redrawSlider(),o.settings.onSliderResize.call(r,o.active.index))};return r.goToSlide=function(e,i){if(!o.working&&o.active.index!=e)if(o.working=!0,o.oldIndex=o.active.index,o.active.index=0>e?x()-1:e>=x()?0:e,o.settings.onSlideBefore(o.children.eq(o.active.index),o.oldIndex,o.active.index),"next"==i?o.settings.onSlideNext(o.children.eq(o.active.index),o.oldIndex,o.active.index):"prev"==i&&o.settings.onSlidePrev(o.children.eq(o.active.index),o.oldIndex,o.active.index),o.active.last=o.active.index>=x()-1,o.settings.pager&&q(o.active.index),o.settings.controls&&W(),"fade"==o.settings.mode)o.settings.adaptiveHeight&&o.viewport.height()!=v()&&o.viewport.animate({height:v()},o.settings.adaptiveHeightSpeed),o.children.filter(":visible").fadeOut(o.settings.speed).css({zIndex:0}),o.children.eq(o.active.index).css("zIndex",o.settings.slideZIndex+1).fadeIn(o.settings.speed,function(){t(this).css("zIndex",o.settings.slideZIndex),D()});else{o.settings.adaptiveHeight&&o.viewport.height()!=v()&&o.viewport.animate({height:v()},o.settings.adaptiveHeightSpeed);var s=0,n={left:0,top:0};if(!o.settings.infiniteLoop&&o.carousel&&o.active.last)if("horizontal"==o.settings.mode){var a=o.children.eq(o.children.length-1);n=a.position(),s=o.viewport.width()-a.outerWidth()}else{var l=o.children.length-o.settings.minSlides;n=o.children.eq(l).position()}else if(o.carousel&&o.active.last&&"prev"==i){var d=1==o.settings.moveSlides?o.settings.maxSlides-m():(x()-1)*m()-(o.children.length-o.settings.maxSlides),a=r.children(".bx-clone").eq(d);n=a.position()}else if("next"==i&&0==o.active.index)n=r.find("> .bx-clone").eq(o.settings.maxSlides).position(),o.active.last=!1;else if(e>=0){var c=e*m();n=o.children.eq(c).position()}if("undefined"!=typeof n){var g="horizontal"==o.settings.mode?-(n.left-s):-n.top;b(g,"slide",o.settings.speed)}}},r.goToNextSlide=function(){if(o.settings.infiniteLoop||!o.active.last){var t=parseInt(o.active.index)+1;r.goToSlide(t,"next")}},r.goToPrevSlide=function(){if(o.settings.infiniteLoop||0!=o.active.index){var t=parseInt(o.active.index)-1;r.goToSlide(t,"prev")}},r.startAuto=function(t){o.interval||(o.interval=setInterval(function(){"next"==o.settings.autoDirection?r.goToNextSlide():r.goToPrevSlide()},o.settings.pause),o.settings.autoControls&&1!=t&&A("stop"))},r.stopAuto=function(t){o.interval&&(clearInterval(o.interval),o.interval=null,o.settings.autoControls&&1!=t&&A("start"))},r.getCurrentSlide=function(){return o.active.index},r.getCurrentSlideElement=function(){return o.children.eq(o.active.index)},r.getSlideCount=function(){return o.children.length},r.redrawSlider=function(){o.children.add(r.find(".bx-clone")).outerWidth(u()),o.viewport.css("height",v()),o.settings.ticker||S(),o.active.last&&(o.active.index=x()-1),o.active.index>=x()&&(o.active.last=!0),o.settings.pager&&!o.settings.pagerCustom&&(w(),q(o.active.index))},r.destroySlider=function(){o.initialized&&(o.initialized=!1,t(".bx-clone",this).remove(),o.children.each(function(){void 0!=t(this).data("origStyle")?t(this).attr("style",t(this).data("origStyle")):t(this).removeAttr("style")}),void 0!=t(this).data("origStyle")?this.attr("style",t(this).data("origStyle")):t(this).removeAttr("style"),t(this).unwrap().unwrap(),o.controls.el&&o.controls.el.remove(),o.controls.next&&o.controls.next.remove(),o.controls.prev&&o.controls.prev.remove(),o.pagerEl&&o.settings.controls&&o.pagerEl.remove(),t(".bx-caption",this).remove(),o.controls.autoEl&&o.controls.autoEl.remove(),clearInterval(o.interval),o.settings.responsive&&t(window).unbind("resize",Z))},r.reloadSlider=function(t){void 0!=t&&(n=t),r.destroySlider(),d()},d(),this}}(jQuery);
 /* FILE END: http://express-info.lh/js/skin1/jquery.bxslider.min.js */ 



 /* FILE START: http://express-info.lh/js/skin1/sb.js?v=20190305-1129 */ 
function imgError(image){
    image.onerror = "";
//    image.src = "/img/default_news_error.jpg";
//    return true;
    
    
    
    imgNameAr = [
        'no_img_340x220-1.jpg',
        'no_img_340x220-2.jpg',
        'no_img_340x220-3.jpg',
        'no_img_340x220-4.jpg',
        'no_img_340x220-5.jpg',
        'no_img_340x220-6.jpg',
        'no_img_340x220-7.jpg',
        'no_img_340x220-8.jpg',
        'no_img_340x220-9.jpg'
    ];
    
    // использование Math.round() даст неравномерное распределение!
    function getRandomInt(min, max)
    {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
   
    rndImgName = imgNameAr[getRandomInt(0,imgNameAr.length-1)];
    
    image.src   = "/img/no_img/"+rndImgName;
    image.style.transform = "none";  
    return true;
}

$( document ).ready(function(){
    
    //MAIL Show in footer
    $('a#foot_mail').attr('href','mailto:mail'+'@'+'pressfrom'+'.info').text('mail'+'@'+'pressfrom'+'.info');
    
    $('#left .copy-url img, .like-article-list img, #out_window img').error( //удаление изображений 404
                function(){
                    $(this).remove();
                }
            );
    
    
    // <add url link to copy post>
    var source_link = '<p>Source: <a href="' + location.href + '">' + location.href + '</a></p>';
    $(
        function($)
        {
            if (window.getSelection) $('.copy-url').bind(
                'copy',
                function()
                {
                    var selection = window.getSelection();
                    var range = selection.getRangeAt(0);

                    var magic_div = $('<div>').css({ overflow : 'hidden', width: '1px', height : '1px', position : 'absolute', top: '-10000px', left : '-10000px' });
                    magic_div.append(range.cloneContents(), source_link);
                    $('body').append(magic_div);

                    var cloned_range = range.cloneRange();
                    selection.removeAllRanges();

                    var new_range = document.createRange();
                    new_range.selectNode(magic_div.get(0));
                    selection.addRange(new_range);

                    window.setTimeout(
                        function()
                        {
                            selection.removeAllRanges();
                            selection.addRange(cloned_range);
                            magic_div.remove();
                        }, 0
                    );
                }
            );
        }
    );
    // </add url link to copy post>
    
    
    setTimeout('setTop()', 15000);
    
    
    

    
    if(!$('#right').is(':visible')){
        ifMobile();
    }
    else{
        ifDesktop();
    }
    
    
    // <Content Link>
    if($('span.out-link').length > 0)
    {
        $('span.out-link').each(function(){
            url     = $(this).attr('src');
            inner   = $(this).html();
            cls     = $(this).attr('class');
            stl     = $(this).attr('style');
            aHtml = '<a target="_blank" href="'+url+'" class="'+cls+'" style="'+stl+'" rel="nofollow" >'+inner+'</a>';
            $(this).replaceWith(aHtml);
        });
    }
    // <Content Link>
    
    
    // <Like Link in Text>
    if($('h2.look_more_hdn').length > 0)
    {
        $('h2.look_more_hdn').each(function(){
            likeInTxtLink = $(this).attr('rel');
            $(this).wrapInner('<a href="'+likeInTxtLink+'"></a>');
        });
    }
    // <Like Link in Text>
    
    
    // <show out window> //
    setTimeout('setOutWindow()', 5000);
    var cntShowOutWindow = 0;
    $('#top_hide_line').mouseover(function(){
        if(outWindow==1 && cntShowOutWindow < 2 && $("#out_window").length > 0){
            $('#ow_bg').css({'display':'block'}).animate({opacity:'0.7'},400,function(){
                $('#out_window').css({'display':'block'}).animate({top:'50px'},400);
            });
            cntShowOutWindow++;
            outWindow = 0;
            //setTimeout('setOutWindow()', 10000);
        }
    });
    $('#ow_close').click(function(){
        $('#out_window').animate({top:'-800px'},400,function(){
            $('#out_window').css({'display':'none'});
            $('#ow_bg').animate({opacity:'0'},400,function(){
                $('#ow_bg').css({'display':'none'});
            })
        });
        setTimeout('setOutWindow()', 5000);
    });
    // </show out window> //
    
    setRightBlockTopSpace(); // Set RightTop Space size
    
    setTimeout('pagePreloadClose()', 1500); //Close Page Preload
    
});

var outWindow = 0;
function setOutWindow(){outWindow=1;}


function setTop(){
    var docId = $('#docId').attr('docId');
    if( !docId ){ return; }
    
    langCode = $('#langCode').attr('data');
    
    $.post( '/'+langCode+'/ajax/background/set_top/', {docId: docId, ref: document.referrer} );
}



// < Preload Page Close >
function pagePreloadClose(){
    $('.page-preload-bg').fadeOut(500);
}
// </ Preload Page Close >


//===================== <if Mobile> =====================//
function ifMobile(){
    
    // <show this cat>
    if( $('span').is('#opt-tag-main-cat') ){ 
        $mainCatName = $('#opt-tag-main-cat').text();
        mobMenuTabIndex = $('#mobile_menu_tabs #nav-tabs li[catname='+$mainCatName+']').index();
    }
     if( $('span').is('#opt-tag-sub-cat') ){ 
        $subCatName = $('#opt-tag-sub-cat').text();
        $('.mobile_sub_menu li[catname='+$subCatName+']').addClass('mobile_sub_menu_active');
    }
    // </show this cat>
    
//    alert('123-'+mobMenuTabIndex);
    $('#mobile_menu_tabs').tabs({active: mobMenuTabIndex});
    
    $('#mobile_nav_btn').click(function(){
            $('#mobile_menu').slideToggle();
        }
    );
    
    //change mobile menu link
    $('#mobile_menu li span').each(function(){
        spanUrl     = $(this).attr('data-url');
        spanAnchor  = $(this).attr('data-anchor');
        $(this).replaceWith('<a href="'+spanUrl+'">'+spanAnchor+'</a>');
    });
    
    
    // top slider mobile
    //initialize swiper when document ready
    var mySwiper = new Swiper ('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
      
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });
    
}
//===================== </if Mobile> =====================//


//===================== <if Desktop> =====================//
function ifDesktop(){
    
    //========== <Sliders> ==========//
    window.setTimeout("showTopSliderTimeOut()",2000);   
    //========== </Sliders> ==========//


    // <zoom img>
    $('.image-popup-no-margins').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image: {
                        verticalFit: true
                },
                zoom: {
                        enabled: true,
                        duration: 300 // don't foget to change the duration also in CSS
                }
        });
    // </zoom img>

    // <show this cat>
    if( $('span').is('#opt-tag-main-cat') ){ 
        $mainCatName = $('#opt-tag-main-cat').text();
        $('.firstnav-menu li[catname='+$mainCatName+']').addClass('main-nav-cat-active');
        window.mobMenuTabIndex = $('#mobile_menu_tabs #nav-tabs li[catname='+$mainCatName+']').index();
    }
     if( $('span').is('#opt-tag-sub-cat') ){ 
        $subCatName = $('#opt-tag-sub-cat').text();
        $('.secondnav-menu li[catname='+$subCatName+']').addClass('sub-nav-cat-active');
    }
    // </show this cat>

//    $('#right-ajax-block').load('/ajax/background/get_right_hc/');

    // <serp result add link>
    if($('.serp_block').length > 0){
        var serp_h4 = $('.serp_block h4');
        var serp_length = serp_h4.length;

        for(i=0; i<serp_length; i++)
        {
            $('.serp_block h4').eq(i).wrap('<a href="'+$('.serp_block h4').eq(i).attr('rel')+'" target="_blank"></a>')
        }
    }
    // <serp result add link>
    
    //Load Games
//    setTimeout('$("#bottom-games").load("/html/bottom-games.html");', 10000);
}
//===================== <if Desktop> =====================//


//===================== <TopSliderLoad> =====================//
function showTopSliderTimeOut(){
        $('#featured .featured-hide-preload').css({'display':'block'});
        $('#featured .featured-hide-preload').animate({opacity:1}, 600,function(){
            $('.bxslider').bxSlider({
                mode: 'fade',
                pagerCustom: '#bx-pager',
                controls: false,
                auto: true,
                speed: 400,
                pause: 3000,
                onSlideBefore: lazySliderBefore
            });
        });
//        alert("slider");
};

function lazySliderBefore(thisBlock){
    thisImg = $('img', thisBlock);
    newSrc = thisImg.attr('data-src');
    if(newSrc !== undefined){
        thisImg.attr('src',newSrc);
        thisImg.removeAttr('data-src');
    }
}
//===================== </TopSliderLoad> =====================//



// ===== <YouTube Video Load> ===== //
$( document ).ready(function(){
    setTimeout("replace_yt_video('.yt_video_top')", 7000);
    setTimeout("replace_yt_video('.yt_video')", 15000);
});

function replace_yt_video(selector){
    $(selector).replaceWith(function(){
        return '<iframe width="'+$(this).attr('width')+'" height="'+$(this).attr('height')+'"  src="'+$(this).attr('src')+'" frameborder="0" allowfullscreen></iframe>';
    });
}
// ===== </YouTube Video Load> ===== //


function setRightBlockTopSpace(){ //установка верхнего отступа правой колонки, в зависимости от высоты заголовка 
    startSpaceSize = 45;
    titleHeight = $('.single h1').outerHeight(true);
    rightSpaceSize = startSpaceSize + titleHeight;
    $('#fscreen-right-top-padding').css('height', rightSpaceSize+'px');
//    alert(titleHeight);
}
 /* FILE END: http://express-info.lh/js/skin1/sb.js?v=20190305-1129 */ 



 /* FILE START: http://express-info.lh/js/skin1/gads.js?v=20181113-1246 */ 


$( document ).ready(function(){

    // <top adsense after image> //
    gAdsInContentHtml = '<div class="content-gAd content-gAd-bottom content-gAd-in-text" >\n\
                            <div class="content-gAd-center">\n\
                                <span class="gAd" data="InArticles"></span>\n\
                            </div>\n\
                        </div>';
    
    if( $('span.storyimage').length > 0 ){ //add after first(main) img
        $('span.storyimage:first').after(gAdsInContentHtml);
    }
    else if( $('ul.slideshow').length > 0){ //add in slider
        $('ul.slideshow:first li:first').after( '<li id="adsInSliderList"></li>');
        $(gAdsInContentHtml).appendTo('li#adsInSliderList');
    }
    
    if($('h2.look_more_hdn').length >= 3){ //add after like news block
//        $('p.look_more_hdn:eq(2)').after(gAdsInContentHtml);
        $('span.gads_in_more_hdn:eq(2)').after(gAdsInContentHtml);
        if($('h2.look_more_hdn').length >= 5){ //add after like news block
            $('span.gads_in_more_hdn:eq(4)').after(gAdsInContentHtml);
        }
    }
    
    // </top adsense after image> //

    if(addGadPosition()){ // добовляет дополнительные места(теги) для рекламы
        $('span.gAd').each(function(){ // простановка блоков рекламы
            blockName = $(this).attr('data');
            toWrite = loadGAd(blockName);
            $(this).replaceWith(toWrite);
        });
    }

});


var cntAdsInArticleIncrement = 1; // счетчик колличества проставленных блоков в статье
var cntAdsInArtGreyIncrement = 1; //// счетчик колличества проставленных блоков в статье(в see more серых)


function loadGAd( blockName ){

    width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    if( width <= 980 ){
        return loadGAdMobile(blockName);
    }
    else{
        return loadGAdDesctop(blockName);
    }  
}


function addGadPosition(){ // добовляет дополнительные места(теги) для рекламы 

    // 2й блок справа
    leftHeight     = $("#left").outerHeight(true); 
    rightHeight    = $("#right").outerHeight(true);
    if(leftHeight-rightHeight > 700){
        $("#right").append('<h3 class="widget-title" style="margin-bottom: -10px; margin-top: 30px;"><span class="title">&nbsp;</span></h3><div class="right_gad_block" style="margin-top: 30px;"><span class="gAd" data="right top"></span></div>');   
    }
    
    return true;
}


function loadGAdMobile(blockName){

    toWrite = '<!-- No Ads -->';
    
    if( blockName == 'content noImg' || blockName == 'content bottom Netboard' ){
        /* Grey in Text */
        toWrite = "<!-- mobile -->\
                    <ins class=\"adsbygoogle mobile-noimg\"\
                         style=\"display:block\"\
                         data-ad-client=\"ca-pub-6096727633142370\"\
                         data-ad-slot=\"8859464449\"\
                         data-ad-format=\"rectangle\"></ins>\
                    <script>\
                    (adsbygoogle = window.adsbygoogle || []).push({});\
                    </script>";
    }
    
    if(blockName == 'mobile greyInTxt'){
        /* Grey in Text */
        toWrite = " <div class=\"mobile-in-txt\"> \n\
                        <!-- Mobile In Text -->\
                        <ins class=\"adsbygoogle mobile-intxt-grey\"\
                             style=\"display:block\"\
                             data-ad-client=\"ca-pub-6096727633142370\"\
                             data-ad-slot=\"8410309242\"\
                             data-ad-format=\"horizontal\"></ins>\
                        <script>\
                        (adsbygoogle = window.adsbygoogle || []).push({});\
                        </script> \n\
                    </div> ";
    }
    
    if(blockName == 'InArticles'){ //TMP Test from big size site
        rndInt = $('#jsrnd').attr('rnd');
        
        //PFinfo Mobi inArt Adaptive
        toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"2670565727\" \
                            data-ad-format=\"auto\" \
                            data-full-width-responsive=\"true\"> \
                        </ins> \
                        <script> \
                             (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>";
        
        if(cntAdsInArticleIncrement == 2){
            //  PFinfo Mobi inArt Feed TitleTop 
            toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-format=\"fluid\" \
                            data-ad-layout-key=\"-am+4z+b-2a+gu\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"3397609443\"> \
                        </ins> \
                        <script> \
                             (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>";
        }
        
        window.cntAdsInArticleIncrement ++;
        
//        if(rndInt == 1){
//         // PFinfo Mobi inArt In-Article
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block; text-align:center;\" \
//                            data-ad-layout=\"in-article\" \
//                            data-ad-format=\"fluid\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"8326627839\"> \
//                        </ins> \
//                        <script> \
//                             (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
//        
//        if(rndInt == 2){
//        //  PFinfo Mobi inArt Feed TitleTop 
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block\" \
//                            data-ad-format=\"fluid\" \
//                            data-ad-layout-key=\"-am+4z+b-2a+gu\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"3397609443\"> \
//                        </ins> \
//                        <script> \
//                             (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
//        
//        if(rndInt == 3){
//        // PFinfo Mobi inArt Feed TitleBottom
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block\" \
//                            data-ad-format=\"fluid\" \
//                            data-ad-layout-key=\"-5c+c9+8-38+ij\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"6042834529\"> \
//                        </ins> \
//                        <script> \
//                             (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
//        
//        if(rndInt == 4){
//        //PFinfo Mobi inArt Adaptive
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"2670565727\" \
//                            data-ad-format=\"auto\" \
//                            data-full-width-responsive=\"true\"> \
//                        </ins> \
//                        <script> \
//                             (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
    }
    
    if(blockName == 'InCategoryList'){
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block\" \
                        data-ad-format=\"fluid\" \
                        data-ad-layout-key=\"-6f+cl+4s-a-43\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"5504059340\"> \
                    </ins> \
                    <script> \
                         (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }
    
    if(blockName == 'LoockMoreInTxt'){
        // PFinfo Mobi in LikeNews
//        toWrite = " <ins class=\"adsbygoogle\" \
//                        <ins class=\"adsbygoogle\" \
//                            style=\"display:inline-block;width:auto;height:60px\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"7812756355\"> \
//                        </ins> \
//                    <script> \
//                        (adsbygoogle = window.adsbygoogle || []).push({}); \
//                    </script>";
        
        // PFinfo Mobi in LikeNews 320x100
        toWrite = " <ins class=\"adsbygoogle\" \
                        <ins class=\"adsbygoogle\" \
                            style=\"display:inline-block;width:320px;height:100px\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"4760051757\"> \
                        </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
        
        if( window.cntAdsInArtGreyIncrement == 3 || window.cntAdsInArtGreyIncrement == 5 ){
            toWrite = '<!-- No Ads second block -->';
        }
        window.cntAdsInArtGreyIncrement ++;
    }
    
    return toWrite;
}

function loadGAdDesctop(blockName){
    
    toWrite         = '<!-- No Ads -->';
    
    if( blockName == 'right top' ){ 
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:inline-block;width:300px;height:600px\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"8418393106\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }
    
    if(blockName == 'InCategoryList'){
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block\" \
                        data-ad-format=\"fluid\" \
                        data-ad-layout-key=\"-dy+4w-5g-di+1j2\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"8136724446\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }
    
    if(blockName == 'InArticles'){
//        rndInt = $('#jsrnd').attr('rnd');
            //PFinfo FullScr inArt Feed
            toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-format=\"fluid\" \
                            data-ad-layout-key=\"-d2+6f-3y-ip+1my\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"8912358297\"> \
                        </ins> \
                        <script> \
                            (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>";
        
//        if(window.cntAdsInArticleIncrement == 2 || window.cntAdsInArticleIncrement == 4){ //PFinfo FullScr inArt Adaptive
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block; min-height:100px;\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"9281283135\" \
//                            data-ad-format=\"auto\" \
//                            data-full-width-responsive=\"true\"> \
//                        </ins> \
//                        <script> \
//                            (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
//        else if(window.cntAdsInArticleIncrement == 5){ //PFinfo FullScr inArt In-Article
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block; text-align:center;\" \
//                            data-ad-layout=\"in-article\" \
//                            data-ad-format=\"fluid\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"1907966247\"> \
//                        </ins> \
//                        <script> \
//                            (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
//        else { //PFinfo FullScr inArt Feed
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block\" \
//                            data-ad-format=\"fluid\" \
//                            data-ad-layout-key=\"-d2+6f-3y-ip+1my\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"8912358297\"> \
//                        </ins> \
//                        <script> \
//                            (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
        
        window.cntAdsInArticleIncrement ++;
    }
    
    if( blockName == 'content bottom Netboard' ){
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:inline-block;width:580px;height:400px\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"2826759265\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }
    if(blockName == 'UnderSlider'){ //PR24 info LinkBlock under slider
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block;height:30px;\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"5033317876\" \
                        data-ad-format=\"link\" \
                        data-full-width-responsive=\"true\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }
    if(blockName == 'LoockMoreInTxt'){ 
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block; max-height:90px;\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"8066584408\" \
                        data-ad-format=\"horizontal\" \
                        data-full-width-responsive=\"true\"></ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
        if(window.cntAdsInArtGreyIncrement == 3 || window.cntAdsInArtGreyIncrement == 5 ){
            toWrite = '<!-- No Ads second block -->';
        }
        window.cntAdsInArtGreyIncrement ++;
    }

    return toWrite;
}
 /* FILE END: http://express-info.lh/js/skin1/gads.js?v=20181113-1246 */ 

