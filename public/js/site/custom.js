// JavaScript Document
// // makes sure the whole site is loaded
// $(window).on('load', function(){
// // will first fade out the loading animation
// jQuery("#status").fadeOut();
// // will fade out the whole DIV that covers the website.
// jQuery("#preloader").delay(1000).fadeOut("slow");
// });

//** Smooth Navigational Menu- By Dynamic Drive DHTML code library: http://www.dynamicdrive.com
//** Script Download/ instructions page: http://www.dynamicdrive.com/dynamicindex1/ddlevelsmenu/
//** Menu created: Nov 12, 2008

//** Dec 12th, 08" (v1.01): Fixed Shadow issue when multiple LIs within the same UL (level) contain sub menus: http://www.dynamicdrive.com/forums/showthread.php?t=39177&highlight=smooth

//** Feb 11th, 09" (v1.02): The currently active main menu item (LI A) now gets a CSS class of ".selected", including sub menu items.

//** May 1st, 09" (v1.3):
//** 1) Now supports vertical (side bar) menu mode- set "orientation" to 'v'
//** 2) In IE6, shadows are now always disabled

//** July 27th, 09" (v1.31): Fixed bug so shadows can be disabled if desired.
//** Feb 2nd, 10" (v1.4): Adds ability to specify delay before sub menus appear and disappear, respectively. See showhidedelay variable below

//** Dec 17th, 10" (v1.5): Updated menu shadow to use CSS3 box shadows when the browser is FF3.5+, IE9+, Opera9.5+, or Safari3+/Chrome. Only .js file changed.

//** Jun 28th, 2012: Unofficial update adds optional hover images for down and right arrows in the format: filename_over.ext
//** These must be present for whichever or both of the arrow(s) are used and will preload.

//** Dec 23rd, 2012 Unofficial update to fixed configurable z-index, add method option to init "toggle" which activates on click or "hover" 
//** which activates on mouse over/out - defaults to "toggle" (click activation), with detection of touch devices to activate on click for them.
//** Add option for when there are two or more menus using "toggle" activation, whether or not all previously opened menus collapse
//** on new menu activation, or just those within that specific menu
//** See: http://www.dynamicdrive.com/forums/showthread.php?72449-PLEASE-HELP-with-Smooth-Navigational-Menu-(v1-51)&p=288466#post288466

//** Feb 7th, 2013 Unofficial update change fixed configurable z-index back to graduated for cases of main UL wrapping. Update off menu click detection in
//** ipad/iphone to touchstart because document click wasn't registering. see: http://www.dynamicdrive.com/forums/showthread.php?72825

//** Feb 14th, 2013 Add window.ontouchstart to means tests for detecting touch browsers - thanks DD!
//** Feb 15th, 2013 Add 'ontouchstart' in window and 'ontouchstart' in document.documentElement to means tests for detecting touch browsers - thanks DD!

//** Feb 20th, 2013 correct for IE 9+ sometimes adding a pixel to the offsetHeight of the top level trigger for horizontal menus
//** Feb 23rd, 2013 move CSS3 shadow adjustment for IE 9+ to the script, add resize event for all browsers to reposition open toggle 
//** menus and shadows in window if they would have gone to a different position at the new window dimensions
//** Feb 25th, 2013 (v2.0) All unofficial updates by John merged into official and now called v2.0. Changed "method" option's default value to "hover"
//** May 14th, 2013 (v2.1) Adds class 'repositioned' to menus moved due to being too close to the browser's right edge
//** May 30th, 2013 (v2.1) Change from version sniffing to means testing for jQuery versions which require added code for click toggle event handling
//** Sept 15th, 2013 add workaround for false positives for touch on Chrome
//** Sept 22nd, 2013 (v2.2) Add vertical repositioning if sub menu will not fit in the viewable vertical area. May be turned off by setting
//  repositionv: false,
//** in the init. Sub menus that are vertically repositioned will have the class 'repositionedv' added to them.
//** March 17th, 15' (v3.0): Adds fully mobile friendly, compact version of menu that's activated in mobile and small screen browsers.
//** Refines drop down menu behaviour when there's neither space to the right nor left to accommodate sub menu; in that case sub menu overlaps parent menu.
//** Nov 3rd, 15' (v3.01): Fixed long drop down menus causing a vertical document scrollbar when page loads
//** April 1st, 16' (v3.02): Fixed Chrome desktop falsely reporting as touch enabled, requiring clicking on menu items to drop down.
var ddsmoothmenu = {

///////////////////////// Global Configuration Options: /////////////////////////

mobilemediaquery: "screen and (max-width: 1199px)", // CSS media query string that when matched activates mobile menu (while hiding default)
//Specify full URL to down and right arrow images (23 is padding-right for top level LIs with drop downs, 6 is for vertical top level items with fly outs):
arrowimages: {down:['downarrowclass', jsWebsiteUrl + '/images/site/down.png'], right:['rightarrowclass', jsWebsiteUrl + '/images/site/right.png', 6], left:['leftarrowclass', jsWebsiteUrl + '/images/site/left.png']},
transition: {overtime:300, outtime:300}, //duration of slide in/ out animation, in milliseconds
mobiletransition: 200, // duration of slide animation in mobile menu, in milliseconds
shadow: false, //enable shadow? (offsets now set in ddsmoothmenu.css stylesheet)
showhidedelay: {showdelay: 100, hidedelay: 200}, //set delay in milliseconds before sub menus appear and disappear, respectively
zindexvalue: 1000, //set z-index value for menus
closeonnonmenuclick: true, //when clicking outside of any "toggle" method menu, should all "toggle" menus close? 
closeonmouseout: false, //when leaving a "toggle" menu, should all "toggle" menus close? Will not work on touchscreen

/////////////////////// End Global Configuration Options ////////////////////////

overarrowre: /(?=\.(gif|jpg|jpeg|png|bmp))/i,
overarrowaddtofilename: '_over',
detecttouch: !!('ontouchstart' in window) || !!('ontouchstart' in document.documentElement) || !!window.ontouchstart || (!!window.Touch && !!window.Touch.length) || !!window.onmsgesturechange || (window.DocumentTouch && window.document instanceof window.DocumentTouch),
detectwebkit: navigator.userAgent.toLowerCase().indexOf("applewebkit") > -1, //detect WebKit browsers (Safari, Chrome etc)
detectchrome: navigator.userAgent.toLowerCase().indexOf("chrome") > -1, //detect chrome
ismobile: navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i) != null, //boolean check for popular mobile browsers
idevice: /ipad|iphone/i.test(navigator.userAgent),
detectie6: (function(){var ie; return (ie = /MSIE (\d+)/.exec(navigator.userAgent)) && ie[1] < 7;})(),
detectie9: (function(){var ie; return (ie = /MSIE (\d+)/.exec(navigator.userAgent)) && ie[1] > 8;})(),
ie9shadow: function(){},
css3support: typeof document.documentElement.style.boxShadow === 'string' || (!document.all && document.querySelector), //detect browsers that support CSS3 box shadows (ie9+ or FF3.5+, Safari3+, Chrome etc)
prevobjs: [], menus: null,
mobilecontainer: {$main: null, $topulsdiv: null, $toggler: null, hidetimer: null},
mobilezindexvalue: 2000, // mobile menus starting zIndex

executelink: function($, prevobjs, e){
    var prevscount = prevobjs.length, link = e.target;
    while(--prevscount > -1){
        if(prevobjs[prevscount] === this){
            prevobjs.splice(prevscount, 1);
            if(link.href !== ddsmoothmenu.emptyhash && link.href && $(link).is('a') && !$(link).children('span.' + ddsmoothmenu.arrowimages.down[0] +', span.' + ddsmoothmenu.arrowimages.right[0]).length){
                if(link.target && link.target !== '_self'){
                    window.open(link.href, link.target);
                } else {
                    window.location.href = link.href;
                }
                e.stopPropagation();
            }
        }
    }
},

repositionv: function($subul, $link, newtop, winheight, doctop, method, menutop){
    menutop = menutop || 0;
    var topinc = 0, doclimit = winheight + doctop;
    $subul.css({top: newtop, display: 'block'});
    while($subul.offset().top < doctop) {
        $subul.css({top: ++newtop});
        ++topinc;
    }
    if(!topinc && $link.offset().top + $link.outerHeight() < doclimit && $subul.data('height') + $subul.offset().top > doclimit){
        $subul.css({top: doctop - $link.parents('ul').last().offset().top - $link.position().top});
    }
    method === 'toggle' && $subul.css({display: 'none'});
    if(newtop !== menutop){$subul.addClass('repositionedv');}
    return [topinc, newtop];
},

updateprev: function($, prevobjs, $curobj){
    var prevscount = prevobjs.length, prevobj, $indexobj = $curobj.parents().add(this);
    while(--prevscount > -1){
        if($indexobj.index((prevobj = prevobjs[prevscount])) < 0){
            $(prevobj).trigger('click', [1]);
            prevobjs.splice(prevscount, 1);
        }
    }
    prevobjs.push(this);
},

subulpreventemptyclose: function(e){
    var link = e.target;
    if(link.href === ddsmoothmenu.emptyhash && $(link).parent('li').find('ul').length < 1){
        e.preventDefault();
        e.stopPropagation();
    }
},

getajaxmenu: function($, setting, nobuild){ //function to fetch external page containing the panel DIVs
    var $menucontainer=$('#'+setting.contentsource[0]); //reference empty div on page that will hold menu
    $menucontainer.html("Loading Menu...");
    $.ajax({
        url: setting.contentsource[1], //path to external menu file
        async: true,
        dataType: 'html',
        error: function(ajaxrequest){
            setting.menustate = "error"
            $menucontainer.html('Error fetching content. Server Response: '+ajaxrequest.responseText);
        },
        success: function(content){
            setting.menustate = "fetched"
            $menucontainer.html(content).find('#' + setting.mainmenuid).css('display', 'block');
            !!!nobuild && ddsmoothmenu.buildmenu($, setting);
        }
    });
},

getajaxmenuMobile: function($, setting){ //function to fetch external page containing the primary menu UL
    setting.mobilemenustate = 'fetching'
    $.ajax({
        url: setting.contentsource[1], //path to external menu file
        async: true,
        dataType: 'html',
        error: function(ajaxrequest){
            setting.mobilemenustate = 'error'
            alert("Error fetching Ajax content " + ajaxrequest.responseText)
        },
        success: function(content){
            var $ul = $(content).find('>ul')
            setting.mobilemenustate = 'fetched'
            ddsmoothmenu.buildmobilemenu($, setting, $ul);
        }
    });
},

closeall: function(e){
    var smoothmenu = ddsmoothmenu, prevscount;
    if(!smoothmenu.globaltrackopen){return;}
    if(e.type === 'mouseleave' || ((e.type === 'click' || e.type === 'touchstart') && smoothmenu.menus.index(e.target) < 0)){
        prevscount = smoothmenu.prevobjs.length;
        while(--prevscount > -1){
            $(smoothmenu.prevobjs[prevscount]).trigger('click');
            smoothmenu.prevobjs.splice(prevscount, 1);
        }
    }
},

emptyhash: $('<a href="#"></a>').get(0).href,

togglemobile: function(action, duration){
    if (!this.mobilecontainer.$main)
        return
    clearTimeout(this.mobilecontainer.hidetimer)
    var $mobilemenu = this.mobilecontainer.$main
    var duration = duration || this.mobiletransition
    if ($mobilemenu.css('visibility') == 'hidden' && (!action || action == 'open')){
        $mobilemenu.css({left: '-100%', visibility: 'visible'}).animate({left: 0}, duration)
        this.mobilecontainer.$toggler.addClass('open')
    }
    else if ($mobilemenu.css('visibility') == 'visible' && (!action || action != 'open')){
        $mobilemenu.animate({left: '-100%'}, duration, function(){this.style.visibility = 'hidden'})
        this.mobilecontainer.$toggler.removeClass('open')
    }
    return false
    
},

buildmobilemenu: function($, setting, $ul){

    function flattenuls($mainul, cloneulBol, callback, finalcall){
        var callback = callback || function(){}
        var finalcall = finalcall || function(){}
        var $headers = $mainul.find('ul').parent()
        var $mainulcopy = cloneulBol? $mainul.clone() : $mainul
        var $flattened = jQuery(document.createDocumentFragment())
        var $headers = $mainulcopy.find('ul').parent()
        for (var i=$headers.length-1; i>=0; i--){ // loop through headers backwards, so we end up with topmost UL last
            var $header = $headers.eq(i)
            var $subul = $header.find('>ul').prependTo($flattened)
            callback(i, $header, $subul)
        }
        $mainulcopy.prependTo($flattened) // Add top most UL to collection
        finalcall($mainulcopy)
        return $flattened
    }

    var $mainmenu = $('#' + setting.mainmenuid)
    var $mainul = $ul
    var $topulref = null

    var flattened = flattenuls($mainul, false,
        function(i, $header, $subul){ // loop through header LIs and sub ULs
            $subul.addClass("submenu")
            var $breadcrumb = $('<li class="breadcrumb" />')
                .html('<img src="' + ddsmoothmenu.arrowimages.left[1] +'" class="' + ddsmoothmenu.arrowimages.left[0] +'" />' + $header.text())
                .prependTo($subul)
            $header.find('a:eq(0)').append('<img src="' + ddsmoothmenu.arrowimages.right[1] +'" class="' + ddsmoothmenu.arrowimages.right[0] +'" />')
            $header.on('click', function(e){
                var $headermenu = $(this).parent('ul')
                $headermenu = $headermenu.hasClass('submenu')? $headermenu : $headermenu.parent()
                $headermenu.css({zIndex: ddsmoothmenu.mobilezindexvalue++, left: 0}).animate({left: '-100%'}, ddsmoothmenu.mobiletransition)
                $subul.css({zIndex: ddsmoothmenu.mobilezindexvalue++, left: '100%'}).animate({left: 0}, ddsmoothmenu.mobiletransition)
                e.stopPropagation()
                e.preventDefault()
            })
            $breadcrumb.on('click', function(e){
                var $headermenu = $header.parent('ul')
                $headermenu = $headermenu.hasClass('submenu')? $headermenu : $headermenu.parent()
                $headermenu.css({zIndex: ddsmoothmenu.mobilezindexvalue++, left: '-100%'}).animate({left: 0}, ddsmoothmenu.mobiletransition)
                $subul.css({zIndex: ddsmoothmenu.mobilezindexvalue++, left: 0}).animate({left: '100%'}, ddsmoothmenu.mobiletransition)
                e.stopPropagation()
                e.preventDefault()
            })
        },
        function($topul){
            $topulref = $topul
        }
    )


    if (!this.mobilecontainer.$main){ // if primary mobile menu container not defined yet
        var $maincontainer = $('<div class="ddsmoothmobile"><div class="topulsdiv"></div></div>').appendTo(document.body)
        $maincontainer
            .css({zIndex: this.mobilezindexvalue++, left: '-100%', visibility: 'hidden'})
            .on('click', function(e){ // assign click behavior to mobile container
                ddsmoothmenu.mobilecontainer.hidetimer = setTimeout(function(){
                    ddsmoothmenu.togglemobile('close', 0)
                }, 50)
                e.stopPropagation()
            })
            .on('touchstart', function(e){
                e.stopPropagation()
            })
        var $topulsdiv = $maincontainer.find('div.topulsdiv')
        var $mobiletoggler = $('#ddsmoothmenu-mobiletoggle').css({display: 'block'})
        $mobiletoggler
            .on('click', function(e){ // assign click behavior to main mobile menu toggler
                ddsmoothmenu.togglemobile()
                e.stopPropagation()
            })
            .on('touchstart', function(e){
                e.stopPropagation()
            })      
        var hidemobilemenuevent = /(iPad|iPhone|iPod)/g.test( navigator.userAgent )? 'touchstart' : 'click' // ios doesnt seem to respond to clicks on BODY
        $(document.body).on(hidemobilemenuevent, function(e){
            if (!$maincontainer.is(':animated'))
                ddsmoothmenu.togglemobile('close', 0)
        })

        this.mobilecontainer.$main = $maincontainer
        this.mobilecontainer.$topulsdiv = $topulsdiv
        this.mobilecontainer.$toggler = $mobiletoggler
    }
    else{ // else, just reference mobile container on page
        var $maincontainer = this.mobilecontainer.$main
        var $topulsdiv = this.mobilecontainer.$topulsdiv
    }
    $topulsdiv.append($topulref).css({zIndex: this.mobilezindexvalue++})
    $maincontainer.append(flattened)

    setting.mobilemenustate = 'done'
    

},

buildmenu: function($, setting){
    // additional step to detect true touch support. Chrome desktop mistakenly returns true for this.detecttouch
    var detecttruetouch = (this.detecttouch && !this.detectchrome) || (this.detectchrome && this.ismobile)
    var smoothmenu = ddsmoothmenu;
    smoothmenu.globaltrackopen = smoothmenu.closeonnonmenuclick || smoothmenu.closeonmouseout;
    var zsub = 0; //subtractor to be incremented so that each top level menu can be covered by previous one's drop downs
    var prevobjs = smoothmenu.globaltrackopen? smoothmenu.prevobjs : [];
    var $mainparent = $("#"+setting.mainmenuid).removeClass("ddsmoothmenu ddsmoothmenu-v").addClass(setting.classname || "ddsmoothmenu");
    setting.repositionv = setting.repositionv !== false;
    var $mainmenu = $mainparent.find('>ul'); //reference main menu UL
    var method = (detecttruetouch)? 'toggle' : setting.method === 'toggle'? 'toggle' : 'hover';
    var $topheaders = $mainmenu.find('>li>ul').parent();//has('ul');
    var orient = setting.orientation!='v'? 'down' : 'right', $parentshadow = $(document.body);
    $mainmenu.click(function(e){e.target.href === smoothmenu.emptyhash && e.preventDefault();});
    if(method === 'toggle') {
        if(smoothmenu.globaltrackopen){
            smoothmenu.menus = smoothmenu.menus? smoothmenu.menus.add($mainmenu.add($mainmenu.find('*'))) : $mainmenu.add($mainmenu.find('*'));
        }
        if(smoothmenu.closeonnonmenuclick){
            if(orient === 'down'){$mainparent.click(function(e){e.stopPropagation();});}
            $(document).unbind('click.smoothmenu').bind('click.smoothmenu', smoothmenu.closeall);
            if(smoothmenu.idevice){
                document.removeEventListener('touchstart', smoothmenu.closeall, false);
                document.addEventListener('touchstart', smoothmenu.closeall, false);
            }
        } else if (setting.closeonnonmenuclick){
            if(orient === 'down'){$mainparent.click(function(e){e.stopPropagation();});}
            $(document).bind('click.' + setting.mainmenuid, function(e){$mainmenu.find('li>a.selected').parent().trigger('click');});
            if(smoothmenu.idevice){
                document.addEventListener('touchstart', function(e){$mainmenu.find('li>a.selected').parent().trigger('click');}, false);
            }
        }
        if(smoothmenu.closeonmouseout){
            var $leaveobj = orient === 'down'? $mainparent : $mainmenu;
            $leaveobj.bind('mouseleave.smoothmenu', smoothmenu.closeall);
        } else if (setting.closeonmouseout){
            var $leaveobj = orient === 'down'? $mainparent : $mainmenu;
            $leaveobj.bind('mouseleave.smoothmenu', function(){$mainmenu.find('li>a.selected').parent().trigger('click');});
        }
        if(!$('style[title="ddsmoothmenushadowsnone"]').length){
            $('head').append('<style title="ddsmoothmenushadowsnone" type="text/css">.ddsmoothmenushadowsnone{display:none!important;}</style>');
        }
        var shadowstimer;
        $(window).bind('resize scroll', function(){
            clearTimeout(shadowstimer);
            var $selected = $mainmenu.find('li>a.selected').parent(),
            $shadows = $('.ddshadow').addClass('ddsmoothmenushadowsnone');
            $selected.eq(0).trigger('click');
            $selected.trigger('click');
            if ( !window.matchMedia || (window.matchMedia && !setting.mobilemql.matches))
                shadowstimer = setTimeout(function(){$shadows.removeClass('ddsmoothmenushadowsnone');}, 100);
        });
    }

    $topheaders.each(function(){
        var $curobj=$(this).css({zIndex: (setting.zindexvalue || smoothmenu.zindexvalue) + zsub--}); //reference current LI header
        var $subul=$curobj.children('ul:eq(0)').css({display:'block'}).data('timers', {});
        var $link = $curobj.children("a:eq(0)").css({paddingRight: smoothmenu.arrowimages[orient][2]}).append( //add arrow images
            '<span style="display: block;" class="' + smoothmenu.arrowimages[orient][0] + '"></span>'
        );
        var dimensions = {
            w   : $link.outerWidth(),
            h   : $curobj.innerHeight(),
            subulw  : $subul.outerWidth(),
            subulh  : $subul.outerHeight()
        };
        var menutop = orient === 'down'? dimensions.h : 0;
        $subul.css({top: menutop});
        function restore(){$link.removeClass('selected');}
        method === 'toggle' && $subul.click(smoothmenu.subulpreventemptyclose);
        $curobj[method](
            function(e){
                if(!$curobj.data('headers')){
                    smoothmenu.buildsubheaders($, $subul, $subul.find('>li>ul').parent(), setting, method, prevobjs);
                    $curobj.data('headers', true).find('>ul').each(function(i, ul){
                        var $ul = $(ul);
                        $ul.data('height', $ul.outerHeight());
                    }).css({display:'none', visibility:'visible'});
                }
                method === 'toggle' && smoothmenu.updateprev.call(this, $, prevobjs, $curobj);
                clearTimeout($subul.data('timers').hidetimer);
                $link.addClass('selected');
                $subul.data('timers').showtimer=setTimeout(function(){
                    var menuleft = orient === 'down'? 0 : dimensions.w;
                    var menumoved = menuleft, newtop, doctop, winheight, topinc = 0;
                    var offsetLeft = $curobj.offset().left
                    menuleft=(offsetLeft+menuleft+dimensions.subulw>$(window).width())? (orient === 'down'? -dimensions.subulw+dimensions.w : -dimensions.w) : menuleft; 
//calculate this sub menu's offsets from its parent
                    if (orient === 'right' && menuleft < 0){ // for vertical menu, if top level sub menu drops left, test to see if it'll be obscured by left window edge
                        var scrollX = window.pageXOffset || (document.documentElement || document.body.parentNode || document.body).scrollLeft
                        if (offsetLeft - dimensions.subulw < 0) // if menu will be obscured by left window edge
                            menuleft = 0
                    }
                    menumoved = menumoved !== menuleft;
                    $subul.css({top: menutop}).removeClass('repositionedv');
                    if(setting.repositionv && $link.offset().top + menutop + $subul.data('height') > (winheight = $(window).height()) + (doctop = $(document).scrollTop())){
                        newtop = (orient === 'down'? 0 : $link.outerHeight()) - $subul.data('height');
                        topinc = smoothmenu.repositionv($subul, $link, newtop, winheight, doctop, method, menutop)[0];
                    }
                    $subul.css({left:menuleft, width:dimensions.subulw}).stop(true, true).animate({height:'show',opacity:'show'}, smoothmenu.transition.overtime, function(){this.style.removeAttribute && this.style.removeAttribute('filter');});
                    if(menumoved){$subul.addClass('repositioned');} else {$subul.removeClass('repositioned');}
                    if (setting.shadow){
                        if(!$curobj.data('$shadow')){
                            $curobj.data('$shadow', $('<div></div>').addClass('ddshadow toplevelshadow').prependTo($parentshadow).css({zIndex: $curobj.css('zIndex')}));  //insert shadow DIV and set it to parent node for the next shadow div
                        }
                        smoothmenu.ie9shadow($curobj.data('$shadow'));
                        var offsets = $subul.offset();
                        var shadowleft = offsets.left;
                        var shadowtop = offsets.top;
                        $curobj.data('$shadow').css({overflow: 'visible', width:dimensions.subulw, left:shadowleft, top:shadowtop}).stop(true, true).animate({height:dimensions.subulh}, smoothmenu.transition.overtime);
                    }
                }, smoothmenu.showhidedelay.showdelay);
            },
            function(e, speed){
                var $shadow = $curobj.data('$shadow');
                if(method === 'hover'){restore();}
                else{smoothmenu.executelink.call(this, $, prevobjs, e);}
                clearTimeout($subul.data('timers').showtimer);
                $subul.data('timers').hidetimer=setTimeout(function(){
                    $subul.stop(true, true).animate({height:'hide', opacity:'hide'}, speed || smoothmenu.transition.outtime, function(){method === 'toggle' && restore();});
                    if ($shadow){
                        if (!smoothmenu.css3support && smoothmenu.detectwebkit){ //in WebKit browsers, set first child shadow's opacity to 0, as "overflow:hidden" doesn't work in them
                            $shadow.children('div:eq(0)').css({opacity:0});
                        }
                        $shadow.stop(true, true).animate({height:0}, speed || smoothmenu.transition.outtime, function(){if(method === 'toggle'){this.style.overflow = 'hidden';}});
                    }
                }, smoothmenu.showhidedelay.hidedelay);
            }
        ); //end hover/toggle
        $subul.css({display: 'none'}); // collapse sub UL 
    }); //end $topheaders.each()
},

buildsubheaders: function($, $subul, $headers, setting, method, prevobjs){
    //setting.$mainparent.data('$headers').add($headers);
    $subul.css('display', 'block');
    $headers.each(function(){ //loop through each LI header
        var smoothmenu = ddsmoothmenu;
        var $curobj=$(this).css({zIndex: $(this).parent('ul').css('z-index')}); //reference current LI header
        var $subul=$curobj.children('ul:eq(0)').css({display:'block'}).data('timers', {}), $parentshadow;
        method === 'toggle' && $subul.click(smoothmenu.subulpreventemptyclose);
        var $link = $curobj.children("a:eq(0)").append( //add arrow images
            '<span style="display: block;" class="' + smoothmenu.arrowimages['right'][0] + '"></span>'
        );
        var dimensions = {
            w   : $link.outerWidth(),
            subulw  : $subul.outerWidth(),
            subulh  : $subul.outerHeight()
        };
        $subul.css({top: 0});
        function restore(){$link.removeClass('selected');}
        $curobj[method](
            function(e){
                if(!$curobj.data('headers')){
                    smoothmenu.buildsubheaders($, $subul, $subul.find('>li>ul').parent(), setting, method, prevobjs);
                    $curobj.data('headers', true).find('>ul').each(function(i, ul){
                        var $ul = $(ul);
                        $ul.data('height', $ul.height());
                    }).css({display:'none', visibility:'visible'});
                }
                method === 'toggle' && smoothmenu.updateprev.call(this, $, prevobjs, $curobj);
                clearTimeout($subul.data('timers').hidetimer);
                $link.addClass('selected');
                $subul.data('timers').showtimer=setTimeout(function(){
                    var menuleft= dimensions.w;
                    var menumoved = menuleft, newtop, doctop, winheight, topinc = 0;
                    var offsetLeft = $curobj.offset().left
                    menuleft=(offsetLeft+menuleft+dimensions.subulw>$(window).width())? -dimensions.w : menuleft; //calculate this sub menu's offsets from its parent
                    if (menuleft < 0){ // if drop left, test to see if it'll be obscured by left window edge
                        var scrollX = window.pageXOffset || (document.documentElement || document.body.parentNode || document.body).scrollLeft
                        if (offsetLeft - dimensions.subulw < scrollX) // if menu will be obscured by left window edge
                            menuleft = 0
                    }
                    menumoved = menumoved !== menuleft;

                    $subul.css({top: 0}).removeClass('repositionedv');
                    if(setting.repositionv && $link.offset().top + $subul.data('height') > (winheight = $(window).height()) + (doctop = $(document).scrollTop())){
                        newtop = $link.outerHeight() - $subul.data('height');
                        topinc = smoothmenu.repositionv($subul, $link, newtop, winheight, doctop, method);
                        newtop = topinc[1];
                        topinc = topinc[0];
                    }
                    $subul.css({left:menuleft, width:dimensions.subulw}).stop(true, true).animate({height:'show',opacity:'show'}, smoothmenu.transition.overtime, function(){this.style.removeAttribute && this.style.removeAttribute('filter');});
                    if(menumoved){$subul.addClass('repositioned');} else {$subul.removeClass('repositioned');}
                    if (setting.shadow){
                        if(!$curobj.data('$shadow')){
                            $parentshadow = $curobj.parents("li:eq(0)").data('$shadow');
                            $curobj.data('$shadow', $('<div></div>').addClass('ddshadow').prependTo($parentshadow).css({zIndex: $parentshadow.css('z-index')}));  //insert shadow DIV and set it to parent node for the next shadow div
                        }
                        var offsets = $subul.offset();
                        var shadowleft = menuleft;
                        var shadowtop = $curobj.position().top - (newtop? $subul.data('height') - $link.outerHeight() - topinc : 0);
                        if (smoothmenu.detectwebkit && !smoothmenu.css3support){ //in WebKit browsers, restore shadow's opacity to full
                            $curobj.data('$shadow').css({opacity:1});
                        }
                        $curobj.data('$shadow').css({overflow: 'visible', width:dimensions.subulw, left:shadowleft, top:shadowtop}).stop(true, true).animate({height:dimensions.subulh}, smoothmenu.transition.overtime);
                    }
                }, smoothmenu.showhidedelay.showdelay);
            },
            function(e, speed){
                var $shadow = $curobj.data('$shadow');
                if(method === 'hover'){restore();}
                else{smoothmenu.executelink.call(this, $, prevobjs, e);}
                clearTimeout($subul.data('timers').showtimer);
                $subul.data('timers').hidetimer=setTimeout(function(){
                    $subul.stop(true, true).animate({height:'hide', opacity:'hide'}, speed || smoothmenu.transition.outtime, function(){
                        method === 'toggle' && restore();
                    });
                    if ($shadow){
                        if (!smoothmenu.css3support && smoothmenu.detectwebkit){ //in WebKit browsers, set first child shadow's opacity to 0, as "overflow:hidden" doesn't work in them
                            $shadow.children('div:eq(0)').css({opacity:0});
                        }
                        $shadow.stop(true, true).animate({height:0}, speed || smoothmenu.transition.outtime, function(){if(method === 'toggle'){this.style.overflow = 'hidden';}});
                    }
                }, smoothmenu.showhidedelay.hidedelay);
            }
        ); //end hover/toggle for subheaders
    }); //end $headers.each() for subheaders
},


initmenu: function(setting){
    if (setting.mobilemql.matches){ // if mobile mode
        jQuery(function($){
            var $mainmenu = $('#' + setting.mainmenuid)
            $mainmenu.css({display: 'none'}) // hide regular menu
            //setTimeout(function(){$('.ddshadow').addClass('ddsmoothmenushadowsnone')}, 150)
            if (!setting.$mainulclone){ // store a copy of the main menu's UL menu before it gets manipulated
                setting.$mainulclone = $mainmenu.find('>ul').clone()
            }
            var mobilemenustate = setting.mobilemenustate
            if (setting.contentsource == "markup" && !mobilemenustate){ // if mobile menu not built yet
                ddsmoothmenu.buildmobilemenu($, setting, setting.$mainulclone)
            }
            else if (setting.contentsource != "markup" && (!mobilemenustate || mobilemenustate == "error")){ // if Ajax content and mobile menu not built yet
                ddsmoothmenu.getajaxmenuMobile($, setting)
            }
            else{ // if mobile menu built already, just show mobile togger
                $('#ddsmoothmenu-mobiletoggle').css({display: 'block'})             
            }
        })
        return
    }
    else{ // if desktop mode
        var menustate = setting.menustate
        if (menustate && menustate != "error"){ // if menustate is anything other than "error" (meaning error fetching ajax content), it means menu's built already, so exit init()
            var $mainmenu = $('#' + setting.mainmenuid)
            $mainmenu.css({display: 'block'}) // show regular menu
            if (this.mobilecontainer.$main){ // if mobile menu defined, hide it
                this.togglemobile('close', 0)
            }
            $('#ddsmoothmenu-mobiletoggle').css({display: 'none'}) // hide mobile menu toggler
            return
        }
    }

    if(this.detectie6 && parseFloat(jQuery.fn.jquery) > 1.3){
        this.initmenu = function(setting){
            if (typeof setting.contentsource=="object"){ //if external ajax menu
                jQuery(function($){ddsmoothmenu.getajaxmenu($, setting, 'nobuild');});
            }
            return false;
        };
        jQuery('link[href*="ddsmoothmenu"]').attr('disabled', true);
        jQuery(function($){
            alert('You Seriously Need to Update Your Browser!\n\nDynamic Drive Smooth Navigational Menu Showing Text Only Menu(s)\n\nDEVELOPER\'s NOTE: This script will run in IE 6 when using jQuery 1.3.2 or less,\nbut not real well.');
                $('link[href*="ddsmoothmenu"]').attr('disabled', true);
        });
        return this.initmenu(setting);
    }
    var mainmenuid = '#' + setting.mainmenuid, right, down, stylestring = ['</style>\n'], stylesleft = setting.arrowswap? 4 : 2;
    function addstyles(){
        if(stylesleft){return;}
        if (typeof setting.customtheme=="object" && setting.customtheme.length==2){ //override default menu colors (default/hover) with custom set?
            var mainselector=(setting.orientation=="v")? mainmenuid : mainmenuid+', '+mainmenuid;
            stylestring.push([mainselector,' ul li a {background:',setting.customtheme[0],';}\n',
                mainmenuid,' ul li a:hover {background:',setting.customtheme[1],';}'].join(''));
        }
        stylestring.push('\n<style type="text/css">');
        stylestring.reverse();
        jQuery('head').append(stylestring.join('\n'));
    }
    if(setting.arrowswap){
        right = ddsmoothmenu.arrowimages.right[1].replace(ddsmoothmenu.overarrowre, ddsmoothmenu.overarrowaddtofilename);
        down = ddsmoothmenu.arrowimages.down[1].replace(ddsmoothmenu.overarrowre, ddsmoothmenu.overarrowaddtofilename);
        jQuery(new Image()).bind('load error', function(e){
            setting.rightswap = e.type === 'load';
            if(setting.rightswap){
                stylestring.push([mainmenuid, ' ul li a:hover .', ddsmoothmenu.arrowimages.right[0], ', ',
                mainmenuid, ' ul li a.selected .', ddsmoothmenu.arrowimages.right[0],
                ' { background-image: url(', this.src, ');}'].join(''));
            }
            --stylesleft;
            addstyles();
        }).attr('src', right);
        jQuery(new Image()).bind('load error', function(e){
            setting.downswap = e.type === 'load';
            if(setting.downswap){
                stylestring.push([mainmenuid, ' ul li a:hover .', ddsmoothmenu.arrowimages.down[0], ', ',
                mainmenuid, ' ul li a.selected .', ddsmoothmenu.arrowimages.down[0],
                ' { background-image: url(', this.src, ');}'].join(''));
            }
            --stylesleft;
            addstyles();
        }).attr('src', down);
    }
    jQuery(new Image()).bind('load error', function(e){
        if(e.type === 'load'){
            stylestring.push([mainmenuid+' ul li a .', ddsmoothmenu.arrowimages.right[0],' { background: url(', this.src, ') no-repeat;width:', this.width,'px;height:', this.height, 'px;}'].join(''));
        }
        --stylesleft;
        addstyles();
    }).attr('src', ddsmoothmenu.arrowimages.right[1]);
    jQuery(new Image()).bind('load error', function(e){
        if(e.type === 'load'){
            stylestring.push([mainmenuid+' ul li a .', ddsmoothmenu.arrowimages.down[0],' { background: url(', this.src, ') no-repeat;width:', this.width,'px;height:', this.height, 'px;}'].join(''));
        }
        --stylesleft;
        addstyles();
    }).attr('src', ddsmoothmenu.arrowimages.down[1]);
    setting.shadow = this.detectie6 && (setting.method === 'hover' || setting.orientation === 'v')? false : setting.shadow || this.shadow; //in IE6, always disable shadow except for horizontal toggle menus
    jQuery(document).ready(function($){
        var $mainmenu = $('#' + setting.mainmenuid)
        $mainmenu.css({display: 'block'}) // show regular menu (in case previously hidden by mobile menu activation)
        if (ddsmoothmenu.mobilecontainer.$main){ // if mobile menu defined, hide it
                ddsmoothmenu.togglemobile('close', 0)
        }
        $('#ddsmoothmenu-mobiletoggle').css({display: 'none'}) // hide mobile menu toggler
        if (!setting.$mainulclone){ // store a copy of the main menu's UL menu before it gets manipulated
            setting.$mainulclone = $mainmenu.find('>ul').clone()
        }
        if (setting.shadow && ddsmoothmenu.css3support){$('body').addClass('ddcss3support');}
        if (typeof setting.contentsource=="object"){ //if external ajax menu
            ddsmoothmenu.getajaxmenu($, setting);
        }
        else{ //else if markup menu
            ddsmoothmenu.buildmenu($, setting);
        }

        setting.menustate = "initialized" // set menu state to initialized
    });
},

init: function(setting){
    setting.mobilemql = (window.matchMedia)? window.matchMedia(this.mobilemediaquery) : {matches: false, addListener: function(){}}
    this.initmenu(setting)
    setting.mobilemql.addListener(function(){
        ddsmoothmenu.initmenu(setting)
    })
}
}; //end ddsmoothmenu variable


equalheight = function(container){
    var currentTallest = 0, currentRowStart = 0, rowDivs = new Array(), $el, topPosition = 0;
    $(container).each(function() {
        $el = $(this);
        $($el).height('auto')
        topPostion = $el.position().top;
        if (currentRowStart != topPostion) {
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
            rowDivs.length = 0; // empty the array
            currentRowStart = topPostion;
            currentTallest = $el.height();
            rowDivs.push($el);
        } else {
            rowDivs.push($el);
            currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
        }
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
        }
    });
}
   
   
$(window).on('load', function() {
    equalheight('.equal-image-height');
});  
$(window).resize(function(){
    equalheight('.equal-image-height');
});

// Patch for jQuery 1.9+ which lack click toggle (deprecated in 1.8, removed in 1.9)
// Will not run if using another patch like jQuery Migrate, which also takes care of this
if(
    (function($){
        var clicktogglable = false;
        try {
            $('<a href="#"></a>').toggle(function(){}, function(){clicktogglable = true;}).trigger('click').trigger('click');
        } catch(e){}
        return !clicktogglable;
    })(jQuery)
){
    (function(){
        var toggleDisp = jQuery.fn.toggle; // There's an animation/css method named .toggle() that toggles display. Save a reference to it.
        jQuery.extend(jQuery.fn, {
            toggle: function( fn, fn2 ) {
                // The method fired depends on the arguments passed.
                if ( !jQuery.isFunction( fn ) || !jQuery.isFunction( fn2 ) ) {
                    return toggleDisp.apply(this, arguments);
                }
                // Save reference to arguments for access in closure
                var args = arguments, guid = fn.guid || jQuery.guid++,
                    i = 0,
                    toggler = function( event ) {
                        // Figure out which function to execute
                        var lastToggle = ( jQuery._data( this, "lastToggle" + fn.guid ) || 0 ) % i;
                        jQuery._data( this, "lastToggle" + fn.guid, lastToggle + 1 );
    
                        // Make sure that clicks stop
                        event.preventDefault();
    
                        // and execute the function
                        return args[ lastToggle ].apply( this, arguments ) || false;
                    };

                // link all the functions, so any of them can unbind this click handler
                toggler.guid = guid;
                while ( i < args.length ) {
                    args[ i++ ].guid = guid;
                }

                return this.click( toggler );
            }
        });
    })();
}

/* TECHNICAL NOTE: To overcome an intermittent layout bug in IE 9+, the script will change margin top and left for the shadows to 
   1px less than their computed values, and the first two values for the box-shadow property will be changed to 1px larger than 
   computed, ex: -1px top and left margins and 6px 6px 5px #aaa box-shadow results in what appears to be a 5px box-shadow. 
   Other browsers skip this step and it shouldn't affect you in most cases. In some rare cases it will result in 
   slightly narrower (by 1px) box shadows for IE 9+ on one or more of the drop downs. Without this, sometimes 
   the shadows could be 1px beyond their drop down resulting in a gap. This is the first of the two patches below. 
   and also relates to the MS CSSOM which uses decimal fractions of pixels for layout while only reporting rounded values. 
   There appears to be no computedStyle workaround for this one. */

//Scripted CSS Patch for IE 9+ intermittent mis-rendering of box-shadow elements (see above TECHNICAL NOTE for more info)
//And jQuery Patch for IE 9+ CSSOM re: offset Width and Height and re: getBoundingClientRect(). Both run only in IE 9 and later.
//IE 9 + uses decimal fractions of pixels internally for layout but only reports rounded values using the offset and getBounding methods.
//These are sometimes rounded inconsistently. This second patch gets the decimal values directly from computedStyle.
if(ddsmoothmenu.detectie9){
    (function($){ //begin Scripted CSS Patch
        function incdec(v, how){return parseInt(v) + how + 'px';}
        ddsmoothmenu.ie9shadow = function($elem){ //runs once
            var getter = document.defaultView.getComputedStyle($elem.get(0), null),
            curshadow = getter.getPropertyValue('box-shadow').split(' '),
            curmargin = {top: getter.getPropertyValue('margin-top'), left: getter.getPropertyValue('margin-left')};
            $('head').append(['\n<style title="ie9shadow" type="text/css">',
            '.ddcss3support .ddshadow {',
            '\tbox-shadow: ' + incdec(curshadow[0], 1) + ' ' + incdec(curshadow[1], 1) + ' ' + curshadow[2] + ' ' + curshadow[3] + ';',
            '}', '.ddcss3support .ddshadow.toplevelshadow {',
            '\topacity: ' + ($('.ddcss3support .ddshadow').css('opacity') - 0.1) + ';',
            '\tmargin-top: ' + incdec(curmargin.top, -1) + ';',
            '\tmargin-left: ' + incdec(curmargin.left, -1) + ';', '}',
            '</style>\n'].join('\n'));
            ddsmoothmenu.ie9shadow = function(){}; //becomes empty function after running once
        }; //end Scripted CSS Patch
        var jqheight = $.fn.height, jqwidth = $.fn.width; //begin jQuery Patch for IE 9+ .height() and .width()
        $.extend($.fn, {
            height: function(){
                var obj = this.get(0);
                if(this.length < 1 || arguments.length || obj === window || obj === document){
                    return jqheight.apply(this, arguments);
                }
                return parseFloat(document.defaultView.getComputedStyle(obj, null).getPropertyValue('height'));
            },
            innerHeight: function(){
                if(this.length < 1){return null;}
                var val = this.height(), obj = this.get(0), getter = document.defaultView.getComputedStyle(obj, null);
                val += parseInt(getter.getPropertyValue('padding-top'));
                val += parseInt(getter.getPropertyValue('padding-bottom'));
                return val;
            },
            outerHeight: function(bool){
                if(this.length < 1){return null;}
                var val = this.innerHeight(), obj = this.get(0), getter = document.defaultView.getComputedStyle(obj, null);
                val += parseInt(getter.getPropertyValue('border-top-width'));
                val += parseInt(getter.getPropertyValue('border-bottom-width'));
                if(bool){
                    val += parseInt(getter.getPropertyValue('margin-top'));
                    val += parseInt(getter.getPropertyValue('margin-bottom'));
                }
                return val;
            },
            width: function(){
                var obj = this.get(0);
                if(this.length < 1 || arguments.length || obj === window || obj === document){
                    return jqwidth.apply(this, arguments);
                }
                return parseFloat(document.defaultView.getComputedStyle(obj, null).getPropertyValue('width'));
            },
            innerWidth: function(){
                if(this.length < 1){return null;}
                var val = this.width(), obj = this.get(0), getter = document.defaultView.getComputedStyle(obj, null);
                val += parseInt(getter.getPropertyValue('padding-right'));
                val += parseInt(getter.getPropertyValue('padding-left'));
                return val;
            },
            outerWidth: function(bool){
                if(this.length < 1){return null;}
                var val = this.innerWidth(), obj = this.get(0), getter = document.defaultView.getComputedStyle(obj, null);
                val += parseInt(getter.getPropertyValue('border-right-width'));
                val += parseInt(getter.getPropertyValue('border-left-width'));
                if(bool){
                    val += parseInt(getter.getPropertyValue('margin-right'));
                    val += parseInt(getter.getPropertyValue('margin-left'));
                }
                return val;
            }
        }); //end jQuery Patch for IE 9+ .height() and .width()
    })(jQuery);
}



 ddsmoothmenu.init({
 mainmenuid: "smoothmenu1", //menu DIV id
 orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
 classname: 'ddsmoothmenu', //class added to menu's outer DIV
 //customtheme: ["#1c5a80", "#18374a"],
 contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})




 ddsmoothmenu.init({
 mainmenuid: "smoothmenu2", //menu DIV id
 orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
 classname: 'ddsmoothmenu', //class added to menu's outer DIV
 //customtheme: ["#1c5a80", "#18374a"],
 contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})





$('.bannerSlider').slick({
  slidesToShow: 1,
  arrows: false,
   autoplay: true,
  autoplaySpeed: 2000,
});

$(document).ready(function() {
    $('.selectCity').select2();
});

// $(window).scroll(function()
// {
//     if( $(window).scrollTop() > 100 )
// {
//         $('.header').addClass('fixed');
//         $('.header_take_place').addClass('take_height');
// } 
// else 
// {
//         $('.header').removeClass('fixed');
//         $('.header_take_place').removeClass('take_height');
// }
// });





;(function ( $, window, undefined ) {

    /** Default settings */
    var defaults = {
        active: null,
        event: 'click',
        disabled: [],
        collapsible: 'accordion',
        startCollapsed: false,
        rotate: false,
        setHash: false,
        animation: 'default',
        animationQueue: false,
        duration: 500,
        fluidHeight: true,
        scrollToAccordion: false,
        scrollToAccordionOnLoad: true,
        scrollToAccordionOffset: 0,
        accordionTabElement: '<div></div>',
        navigationContainer: '',
        click: function(){},
        activate: function(){},
        deactivate: function(){},
        load: function(){},
        activateState: function(){},
        classes: {
            stateDefault: 'r-tabs-state-default',
            stateActive: 'r-tabs-state-active',
            stateDisabled: 'r-tabs-state-disabled',
            stateExcluded: 'r-tabs-state-excluded',
            container: 'r-tabs',
            ul: 'r-tabs-nav',
            tab: 'r-tabs-tab',
            anchor: 'r-tabs-anchor',
            panel: 'r-tabs-panel',
            accordionTitle: 'r-tabs-accordion-title'
        }
    };

    /**
     * Responsive Tabs
     * @constructor
     * @param {object} element - The HTML element the validator should be bound to
     * @param {object} options - An option map
     */
    function ResponsiveTabs(element, options) {
        this.element = element; // Selected DOM element
        this.$element = $(element); // Selected jQuery element

        this.tabs = []; // Create tabs array
        this.state = ''; // Define the plugin state (tabs/accordion)
        this.rotateInterval = 0; // Define rotate interval
        this.$queue = $({});

        // Extend the defaults with the passed options
        this.options = $.extend( {}, defaults, options);

        this.init();
    }


    /**
     * This function initializes the tab plugin
     */
    ResponsiveTabs.prototype.init = function () {
        var _this = this;

        // Load all the elements
        this.tabs = this._loadElements();
        this._loadClasses();
        this._loadEvents();

        // Window resize bind to check state
        $(window).on('resize', function(e) {
            _this._setState(e);
            if(_this.options.fluidHeight !== true) {
                _this._equaliseHeights();
            }
        });

        // Hashchange event
        $(window).on('hashchange', function(e) {
            var tabRef = _this._getTabRefBySelector(window.location.hash);
            var oTab = _this._getTab(tabRef);

            // Check if a tab is found that matches the hash
            if(tabRef >= 0 && !oTab._ignoreHashChange && !oTab.disabled) {
                // If so, open the tab and auto close the current one
                _this._openTab(e, _this._getTab(tabRef), true);
            }
        });

        // Start rotate event if rotate option is defined
        if(this.options.rotate !== false) {
            this.startRotation();
        }

        // Set fluid height
        if(this.options.fluidHeight !== true) {
            _this._equaliseHeights();
        }

        // --------------------
        // Define plugin events
        //

        // Activate: this event is called when a tab is selected
        this.$element.bind('tabs-click', function(e, oTab) {
            _this.options.click.call(this, e, oTab);
        });

        // Activate: this event is called when a tab is selected
        this.$element.bind('tabs-activate', function(e, oTab) {
            _this.options.activate.call(this, e, oTab);
        });
        // Deactivate: this event is called when a tab is closed
        this.$element.bind('tabs-deactivate', function(e, oTab) {
            _this.options.deactivate.call(this, e, oTab);
        });
        // Activate State: this event is called when the plugin switches states
        this.$element.bind('tabs-activate-state', function(e, state) {
            _this.options.activateState.call(this, e, state);
        });

        // Load: this event is called when the plugin has been loaded
        this.$element.bind('tabs-load', function(e) {
            var startTab;

            _this._setState(e); // Set state

            // Check if the panel should be collaped on load
            if(_this.options.startCollapsed !== true && !(_this.options.startCollapsed === 'accordion' && _this.state === 'accordion')) {

                startTab = _this._getStartTab();

                // Open the initial tab
                _this._openTab(e, startTab); // Open first tab

                // Call the callback function
                _this.options.load.call(this, e, startTab); // Call the load callback
            }
        });
        // Trigger loaded event
        this.$element.trigger('tabs-load');
    };

    //
    // PRIVATE FUNCTIONS
    //

    /**
     * This function loads the tab elements and stores them in an array
     * @returns {Array} Array of tab elements
     */
    ResponsiveTabs.prototype._loadElements = function() {
        var _this = this;
        var $ul = (_this.options.navigationContainer === '') ? this.$element.children('ul:first') : this.$element.find(_this.options.navigationContainer).children('ul:first');
        var tabs = [];
        var id = 0;

        // Add the classes to the basic html elements
        this.$element.addClass(_this.options.classes.container); // Tab container
        $ul.addClass(_this.options.classes.ul); // List container

        // Get tab buttons and store their data in an array
        $('li', $ul).each(function() {
            var $tab = $(this);
            var isExcluded = $tab.hasClass(_this.options.classes.stateExcluded);
            var $anchor, $panel, $accordionTab, $accordionAnchor, panelSelector;

            // Check if the tab should be excluded
            if(!isExcluded) {

                $anchor = $('a', $tab);
                panelSelector = $anchor.attr('href');
                $panel = $(panelSelector);
                $accordionTab = $(_this.options.accordionTabElement).insertBefore($panel);
                $accordionAnchor = $('<a></a>').attr('href', panelSelector).html($anchor.html()).appendTo($accordionTab);

                var oTab = {
                    _ignoreHashChange: false,
                    id: id,
                    disabled: ($.inArray(id, _this.options.disabled) !== -1),
                    tab: $(this),
                    anchor: $('a', $tab),
                    panel: $panel,
                    selector: panelSelector,
                    accordionTab: $accordionTab,
                    accordionAnchor: $accordionAnchor,
                    active: false
                };

                // 1up the ID
                id++;
                // Add to tab array
                tabs.push(oTab);
            }
        });
        return tabs;
    };


    /**
     * This function adds classes to the tab elements based on the options
     */
    ResponsiveTabs.prototype._loadClasses = function() {
        for (var i=0; i<this.tabs.length; i++) {
            this.tabs[i].tab.addClass(this.options.classes.stateDefault).addClass(this.options.classes.tab);
            this.tabs[i].anchor.addClass(this.options.classes.anchor);
            this.tabs[i].panel.addClass(this.options.classes.stateDefault).addClass(this.options.classes.panel);
            this.tabs[i].accordionTab.addClass(this.options.classes.accordionTitle);
            this.tabs[i].accordionAnchor.addClass(this.options.classes.anchor);
            if(this.tabs[i].disabled) {
                this.tabs[i].tab.removeClass(this.options.classes.stateDefault).addClass(this.options.classes.stateDisabled);
                this.tabs[i].accordionTab.removeClass(this.options.classes.stateDefault).addClass(this.options.classes.stateDisabled);
           }
        }
    };

    /**
     * This function adds events to the tab elements
     */
    ResponsiveTabs.prototype._loadEvents = function() {
        var _this = this;

        // Define activate event on a tab element
        var fActivate = function(e) {
            var current = _this._getCurrentTab(); // Fetch current tab
            var activatedTab = e.data.tab;

            e.preventDefault();

            // Trigger click event for whenever a tab is clicked/touched even if the tab is disabled
            activatedTab.tab.trigger('tabs-click', activatedTab);

            // Make sure this tab isn't disabled
            if(!activatedTab.disabled) {

                // Check if hash has to be set in the URL location
                if(_this.options.setHash) {
                    // Set the hash using the history api if available to tackle Chromes repaint bug on hash change
                    if(history.pushState) {
                        // Fix for missing window.location.origin in IE
                        if (!window.location.origin) {
                            window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
                        }
                        
                        history.pushState(null, null, window.location.origin + window.location.pathname + window.location.search + activatedTab.selector);
                    } else {
                        // Otherwise fallback to the hash update for sites that don't support the history api
                        window.location.hash = activatedTab.selector;
                    }
                }

                e.data.tab._ignoreHashChange = true;

                // Check if the activated tab isnt the current one or if its collapsible. If not, do nothing
                if(current !== activatedTab || _this._isCollapisble()) {
                    // The activated tab is either another tab of the current one. If it's the current tab it is collapsible
                    // Either way, the current tab can be closed
                    _this._closeTab(e, current);

                    // Check if the activated tab isnt the current one or if it isnt collapsible
                    if(current !== activatedTab || !_this._isCollapisble()) {
                        _this._openTab(e, activatedTab, false, true);
                    }
                }
            }
        };

        // Loop tabs
        for (var i=0; i<this.tabs.length; i++) {
            // Add activate function to the tab and accordion selection element
            this.tabs[i].anchor.on(_this.options.event, {tab: _this.tabs[i]}, fActivate);
            this.tabs[i].accordionAnchor.on(_this.options.event, {tab: _this.tabs[i]}, fActivate);
        }
    };

    /**
     * This function gets the tab that should be opened at start
     * @returns {Object} Tab object
     */
    ResponsiveTabs.prototype._getStartTab = function() {
        var tabRef = this._getTabRefBySelector(window.location.hash);
        var startTab;

        // Check if the page has a hash set that is linked to a tab
        if(tabRef >= 0 && !this._getTab(tabRef).disabled) {
            // If so, set the current tab to the linked tab
            startTab = this._getTab(tabRef);
        } else if(this.options.active > 0 && !this._getTab(this.options.active).disabled) {
            startTab = this._getTab(this.options.active);
        } else {
            // If not, just get the first one
            startTab = this._getTab(0);
        }

        return startTab;
    };

    /**
     * This function sets the current state of the plugin
     * @param {Event} e - The event that triggers the state change
     */
    ResponsiveTabs.prototype._setState = function(e) {
        var $ul = $('ul:first', this.$element);
        var oldState = this.state;
        var startCollapsedIsState = (typeof this.options.startCollapsed === 'string');
        var startTab;

        // The state is based on the visibility of the tabs list
        if($ul.is(':visible')){
            // Tab list is visible, so the state is 'tabs'
            this.state = 'tabs';
        } else {
            // Tab list is invisible, so the state is 'accordion'
            this.state = 'accordion';
        }

        // If the new state is different from the old state
        if(this.state !== oldState) {
            // If so, the state activate trigger must be called
            this.$element.trigger('tabs-activate-state', {oldState: oldState, newState: this.state});

            // Check if the state switch should open a tab
            if(oldState && startCollapsedIsState && this.options.startCollapsed !== this.state && this._getCurrentTab() === undefined) {
                // Get initial tab
                startTab = this._getStartTab(e);
                // Open the initial tab
                this._openTab(e, startTab); // Open first tab
            }
        }
    };

    /**
     * This function opens a tab
     * @param {Event} e - The event that triggers the tab opening
     * @param {Object} oTab - The tab object that should be opened
     * @param {Boolean} closeCurrent - Defines if the current tab should be closed
     * @param {Boolean} stopRotation - Defines if the tab rotation loop should be stopped
     */
    ResponsiveTabs.prototype._openTab = function(e, oTab, closeCurrent, stopRotation) {
        var _this = this;
        var scrollOffset;

        // Check if the current tab has to be closed
        if(closeCurrent) {
            this._closeTab(e, this._getCurrentTab());
        }

        // Check if the rotation has to be stopped when activated
        if(stopRotation && this.rotateInterval > 0) {
            this.stopRotation();
        }

        // Set this tab to active
        oTab.active = true;
        // Set active classes to the tab button and accordion tab button
        oTab.tab.removeClass(_this.options.classes.stateDefault).addClass(_this.options.classes.stateActive);
        oTab.accordionTab.removeClass(_this.options.classes.stateDefault).addClass(_this.options.classes.stateActive);

        // Run panel transiton
        _this._doTransition(oTab.panel, _this.options.animation, 'open', function() {
            var scrollOnLoad = (e.type !== 'tabs-load' || _this.options.scrollToAccordionOnLoad);

            // When finished, set active class to the panel
            oTab.panel.removeClass(_this.options.classes.stateDefault).addClass(_this.options.classes.stateActive);

            // And if enabled and state is accordion, scroll to the accordion tab
            if(_this.getState() === 'accordion' && _this.options.scrollToAccordion && (!_this._isInView(oTab.accordionTab) || _this.options.animation !== 'default') && scrollOnLoad) {

                // Add offset element's height to scroll position
                scrollOffset = oTab.accordionTab.offset().top - _this.options.scrollToAccordionOffset;

                // Check if the animation option is enabled, and if the duration isn't 0
                if(_this.options.animation !== 'default' && _this.options.duration > 0) {
                    // If so, set scrollTop with animate and use the 'animation' duration
                    $('html, body').animate({
                        scrollTop: scrollOffset
                    }, _this.options.duration);
                } else {
                    //  If not, just set scrollTop
                    $('html, body').scrollTop(scrollOffset);
                }
            }
        });

        this.$element.trigger('tabs-activate', oTab);
    };

    /**
     * This function closes a tab
     * @param {Event} e - The event that is triggered when a tab is closed
     * @param {Object} oTab - The tab object that should be closed
     */
    ResponsiveTabs.prototype._closeTab = function(e, oTab) {
        var _this = this;
        var doQueueOnState = typeof _this.options.animationQueue === 'string';
        var doQueue;

        if(oTab !== undefined) {
            if(doQueueOnState && _this.getState() === _this.options.animationQueue) {
                doQueue = true;
            } else if(doQueueOnState) {
                doQueue = false;
            } else {
                doQueue = _this.options.animationQueue;
            }

            // Deactivate tab
            oTab.active = false;
            // Set default class to the tab button
            oTab.tab.removeClass(_this.options.classes.stateActive).addClass(_this.options.classes.stateDefault);

            // Run panel transition
            _this._doTransition(oTab.panel, _this.options.animation, 'close', function() {
                // Set default class to the accordion tab button and tab panel
                oTab.accordionTab.removeClass(_this.options.classes.stateActive).addClass(_this.options.classes.stateDefault);
                oTab.panel.removeClass(_this.options.classes.stateActive).addClass(_this.options.classes.stateDefault);
            }, !doQueue);

            this.$element.trigger('tabs-deactivate', oTab);
        }
    };

    /**
     * This function runs an effect on a panel
     * @param {Element} panel - The HTML element of the tab panel
     * @param {String} method - The transition method reference
     * @param {String} state - The state (open/closed) that the panel should transition to
     * @param {Function} callback - The callback function that is called after the transition
     * @param {Boolean} dequeue - Defines if the event queue should be dequeued after the transition
     */
    ResponsiveTabs.prototype._doTransition = function(panel, method, state, callback, dequeue) {
        var effect;
        var _this = this;

        // Get effect based on method
        switch(method) {
            case 'slide':
                effect = (state === 'open') ? 'slideDown' : 'slideUp';
                break;
            case 'fade':
                effect = (state === 'open') ? 'fadeIn' : 'fadeOut';
                break;
            default:
                effect = (state === 'open') ? 'show' : 'hide';
                // When default is used, set the duration to 0
                _this.options.duration = 0;
                break;
        }

        // Add the transition to a custom queue
        this.$queue.queue('responsive-tabs',function(next){
            // Run the transition on the panel
            panel[effect]({
                duration: _this.options.duration,
                complete: function() {
                    // Call the callback function
                    callback.call(panel, method, state);
                    // Run the next function in the queue
                    next();
                }
            });
        });

        // When the panel is openend, dequeue everything so the animation starts
        if(state === 'open' || dequeue) {
            this.$queue.dequeue('responsive-tabs');
        }

    };

    /**
     * This function returns the collapsibility of the tab in this state
     * @returns {Boolean} The collapsibility of the tab
     */
    ResponsiveTabs.prototype._isCollapisble = function() {
        return (typeof this.options.collapsible === 'boolean' && this.options.collapsible) || (typeof this.options.collapsible === 'string' && this.options.collapsible === this.getState());
    };

    /**
     * This function returns a tab by numeric reference
     * @param {Integer} numRef - Numeric tab reference
     * @returns {Object} Tab object
     */
    ResponsiveTabs.prototype._getTab = function(numRef) {
        return this.tabs[numRef];
    };

    /**
     * This function returns the numeric tab reference based on a hash selector
     * @param {String} selector - Hash selector
     * @returns {Integer} Numeric tab reference
     */
    ResponsiveTabs.prototype._getTabRefBySelector = function(selector) {
        // Loop all tabs
        for (var i=0; i<this.tabs.length; i++) {
            // Check if the hash selector is equal to the tab selector
            if(this.tabs[i].selector === selector) {
                return i;
            }
        }
        // If none is found return a negative index
        return -1;
    };

    /**
     * This function returns the current tab element
     * @returns {Object} Current tab element
     */
    ResponsiveTabs.prototype._getCurrentTab = function() {
        return this._getTab(this._getCurrentTabRef());
    };

    /**
     * This function returns the next tab's numeric reference
     * @param {Integer} currentTabRef - Current numeric tab reference
     * @returns {Integer} Numeric tab reference
     */
    ResponsiveTabs.prototype._getNextTabRef = function(currentTabRef) {
        var tabRef = (currentTabRef || this._getCurrentTabRef());
        var nextTabRef = (tabRef === this.tabs.length - 1) ? 0 : tabRef + 1;
        return (this._getTab(nextTabRef).disabled) ? this._getNextTabRef(nextTabRef) : nextTabRef;
    };

    /**
     * This function returns the previous tab's numeric reference
     * @returns {Integer} Numeric tab reference
     */
    ResponsiveTabs.prototype._getPreviousTabRef = function() {
        return (this._getCurrentTabRef() === 0) ? this.tabs.length - 1 : this._getCurrentTabRef() - 1;
    };

    /**
     * This function returns the current tab's numeric reference
     * @returns {Integer} Numeric tab reference
     */
    ResponsiveTabs.prototype._getCurrentTabRef = function() {
        // Loop all tabs
        for (var i=0; i<this.tabs.length; i++) {
            // If this tab is active, return it
            if(this.tabs[i].active) {
                return i;
            }
        }
        // No tabs have been found, return negative index
        return -1;
    };

    /**
     * This function gets the tallest tab and applied the height to all tabs
     */
    ResponsiveTabs.prototype._equaliseHeights = function() {
        var maxHeight = 0;

        $.each($.map(this.tabs, function(tab) {
            maxHeight = Math.max(maxHeight, tab.panel.css('minHeight', '').height());
            return tab.panel;
        }), function() {
            this.css('minHeight', maxHeight);
        });
    };

    //
    // HELPER FUNCTIONS
    //

    ResponsiveTabs.prototype._isInView = function($element) {
        var docViewTop = $(window).scrollTop(),
            docViewBottom = docViewTop + $(window).height(),
            elemTop = $element.offset().top,
            elemBottom = elemTop + $element.height();
        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    };

    //
    // PUBLIC FUNCTIONS
    //

    /**
     * This function activates a tab
     * @param {Integer} tabRef - Numeric tab reference
     * @param {Boolean} stopRotation - Defines if the tab rotation should stop after activation
     */
    ResponsiveTabs.prototype.activate = function(tabRef, stopRotation) {
        var e = jQuery.Event('tabs-activate');
        var oTab = this._getTab(tabRef);
        if(!oTab.disabled) {
            this._openTab(e, oTab, true, stopRotation || true);
        }
    };

    /**
     * This function deactivates a tab
     * @param {Integer} tabRef - Numeric tab reference
     */
    ResponsiveTabs.prototype.deactivate = function(tabRef) {
        var e = jQuery.Event('tabs-dectivate');
        var oTab = this._getTab(tabRef);
        if(!oTab.disabled) {
            this._closeTab(e, oTab);
        }
    };

    /**
     * This function enables a tab
     * @param {Integer} tabRef - Numeric tab reference
     */
    ResponsiveTabs.prototype.enable = function(tabRef) {
        var oTab = this._getTab(tabRef);
        if(oTab){
            oTab.disabled = false;
            oTab.tab.addClass(this.options.classes.stateDefault).removeClass(this.options.classes.stateDisabled);
            oTab.accordionTab.addClass(this.options.classes.stateDefault).removeClass(this.options.classes.stateDisabled);
        }
    };

    /**
     * This function disable a tab
     * @param {Integer} tabRef - Numeric tab reference
     */
    ResponsiveTabs.prototype.disable = function(tabRef) {
        var oTab = this._getTab(tabRef);
        if(oTab){
            oTab.disabled = true;
            oTab.tab.removeClass(this.options.classes.stateDefault).addClass(this.options.classes.stateDisabled);
            oTab.accordionTab.removeClass(this.options.classes.stateDefault).addClass(this.options.classes.stateDisabled);
        }
    };

    /**
     * This function gets the current state of the plugin
     * @returns {String} State of the plugin
     */
    ResponsiveTabs.prototype.getState = function() {
        return this.state;
    };

    /**
     * This function starts the rotation of the tabs
     * @param {Integer} speed - The speed of the rotation
     */
    ResponsiveTabs.prototype.startRotation = function(speed) {
        var _this = this;
        // Make sure not all tabs are disabled
        if(this.tabs.length > this.options.disabled.length) {
            this.rotateInterval = setInterval(function(){
                var e = jQuery.Event('rotate');
                _this._openTab(e, _this._getTab(_this._getNextTabRef()), true);
            }, speed || (($.isNumeric(_this.options.rotate)) ? _this.options.rotate : 4000) );
        } else {
            throw new Error("Rotation is not possible if all tabs are disabled");
        }
    };

    /**
     * This function stops the rotation of the tabs
     */
    ResponsiveTabs.prototype.stopRotation = function() {
        window.clearInterval(this.rotateInterval);
        this.rotateInterval = 0;
    };

    /**
     * This function can be used to get/set options
     * @return {any} Option value
     */
    ResponsiveTabs.prototype.option = function(key, value) {
        if(value) {
            this.options[key] = value;
        }
        return this.options[key];
    };

    /** jQuery wrapper */
    $.fn.responsiveTabs = function ( options ) {
        var args = arguments;
        var instance;

        if (options === undefined || typeof options === 'object') {
            return this.each(function () {
                if (!$.data(this, 'responsivetabs')) {
                    $.data(this, 'responsivetabs', new ResponsiveTabs( this, options ));
                }
            });
        } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
            instance = $.data(this[0], 'responsivetabs');

            // Allow instances to be destroyed via the 'destroy' method
            if (options === 'destroy') {
                // TODO: destroy instance classes, etc
                $.data(this, 'responsivetabs', null);
            }

            if (instance instanceof ResponsiveTabs && typeof instance[options] === 'function') {
                return instance[options].apply( instance, Array.prototype.slice.call( args, 1 ) );
            } else {
                return this;
            }
        }
    };

}(jQuery, window));


$(document).ready(function () {
            var $tabs = $('#horizontalTab');
            $tabs.responsiveTabs({
                rotate: false,
                startCollapsed: 'accordion',
                collapsible: 'accordion',
                setHash: true,
                //disabled: [3,4],
                click: function(e, tab) {
                    $('.info').html('Tab <strong>' + tab.id + '</strong> clicked!');
                },
                activate: function(e, tab) {
                    $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
                },
                activateState: function(e, state) {
                    //console.log(state);
                    $('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
                }
            });

        });



$(window).scroll(function()
{
    if( $(window).scrollTop() > 20 )
{
        $('.header').addClass('fixed');
        $('.header_take_place').addClass('take_height');
} 
else 
{
        $('.header').removeClass('fixed');
        $('.header_take_place').removeClass('take_height');
}
});



'use strict';

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/* global $ */

/// This function would create an accordion based on the markup and provided options
// params:
//  options which consist of:
//    parentSelector - selector for HTML element to which a11y accordion markup and functionality will be applied
//    speed - speed of collapsing animation
//    hiddenLinkDescription - some string which will be played by AT once user has a keyboard focus on Show/Hide link
//    showSearch - boolean option which will tell accordion to render search options
//    showOne - boolean option which represents if accordion can uncollapse only 1 row to the user
//    overallSearch - boolean option which will tell search to look not only in headers but within collapsed areas as well
//    onAreaShow - custom callback which will be called after making visible an accordion's area. Argument is jQuery DOM element for an area to become hidden
//    onAreaHide - user defined callback which will be called after hiding an accordion's area. Argument is jQuery DOM element for an area to become shown
//    searchActionType - could be "hide" or "collapse". First option will hide/show accordion rows upon matches, while the second option will collapse/uncollapse them
//

var A11yAccordion = function () {
  function A11yAccordion() {
    var options = arguments.length <= 0 || arguments[0] === undefined ? {} : arguments[0];

    _classCallCheck(this, A11yAccordion);

    var constants = {
      SEARCH_ACTION_TYPE_HIDE: 'hide',
      SEARCH_ACTION_TYPE_COLLAPSE: 'collapse'
    };

    this.collapseRow = this.collapseRow.bind(this);
    this.uncollapseRow = this.uncollapseRow.bind(this);
    this.toggleRow = this.toggleRow.bind(this);
    this.getRowEl = this.getRowEl.bind(this);

    this._render = this._render.bind(this);
    this._renderSearch = this._renderSearch.bind(this);
    this._collapseWork = this._collapseWork.bind(this);
    this._collapseAll = this._collapseAll.bind(this);
    this._collapse = this._collapse.bind(this);
    this._uncollapse = this._uncollapse.bind(this);
    this._getHiddenArea = this._getHiddenArea.bind(this);
    this._traverseChildNodes = this._traverseChildNodes.bind(this);

    // options which will be passed into the components with their default values
    var defaults = {
      constants: constants,
      parentSelector: undefined,
      hideEffectStyle: 'linear',
      speed: 300,
      hiddenLinkDescription: '',
      showSearch: true,
      showOne: true,
      searchActionType: constants.SEARCH_ACTION_TYPE_HIDE,
      overallSearch: false,
      onAreaShow: function onAreaShow() {},
      onAreaHide: function onAreaHide() {},
      classes: {
        headerClass: 'a11yAccordionItemHeader',
        accordionItemClass: 'a11yAccordionItem',
        hiddenAreaClass: 'a11yAccordionHideArea',
        showHeaderLabelClass: 'a11yAccordionItemHeaderLinkShowLabel',
        hideHeaderLabelClass: 'a11yAccordionItemHeaderLinkHideLabel',
        markedTextClass: 'a11yAccordion-markedText',
        visibleAreaClass: 'visiblea11yAccordionItem',
        noResultsDivClass: 'a11yAccordionNoResultsItem',
        searchDivClass: 'a11yAccordionSearchDiv',
        headerLinkClass: 'a11yAccordionItemHeaderLink',
        headerTextClass: 'a11yAccordionItemHeaderText',
        hiddenHeaderLabelDescriptionClass: 'a11yAccordionItemHeaderLinkHiddenLabel',
        toggleClass: 'toggle',
        triangleClass: 'a11yAccordion-triangle',
        searchClass: 'a11yAccordionSearch',
        accordionHeaderClass: 'a11yAccordion-header',
        accordionHideAreaClass: 'a11yAccordion-area'
      },
      labels: {
        showHeaderLabelText: 'Show',
        hideHeaderLabelText: 'Hide',
        searchPlaceholder: 'Search',
        noResultsText: 'No Results Found',
        titleText: 'Type your query to search',
        resultsMessage: 'Number of results found: ',
        leaveBlankMessage: ' Please leave blank to see all the results.'
      },
      ids: {
        noResultsDivID: 'a11yAccordion-noResultsItem',
        searchDivID: 'a11yAccordion-searchPanel',
        rowIdStringPrefix: 'a11yAccordion-row-'
      },
      attributes: {
        hiddenLinkDescription: 'data-a11yAccordion-hiddenLinkDescription'
      }
    };

    options = _extends({}, defaults, options);

    var _options = options;
    var classes = _options.classes;


    options = _extends({}, options, {
      selectors: {
        triangleSelector: '.' + classes.triangleClass,
        visibleAreaSelector: '.' + classes.visibleAreaClass,
        markedTextSelector: '.' + classes.markedTextClass,
        headerLinkSelector: '.' + classes.headerLinkClass,
        headerSelector: '.' + classes.headerClass,
        showHeaderLabelSelector: '.' + classes.showHeaderLabelClass,
        hideHeaderLabelSelector: '.' + classes.hideHeaderLabelClass,
        accordionItemSelector: '.' + classes.accordionItemClass,
        hiddenAreaSelector: '.' + classes.hiddenAreaClass
      }
    });

    this.props = options;

    this._render();
  }

  /// Public functions and variables

  /// Function which will hide hidden area in the row with index = rowIndex
  // params:
  //  rowIndex - integer index of the row
  //


  _createClass(A11yAccordion, [{
    key: 'collapseRow',
    value: function collapseRow(rowIndex) {
      var _collapse = this._collapse;
      var _getHiddenArea = this._getHiddenArea;


      _collapse(_getHiddenArea(rowIndex));
    }

    /// Function which will show hidden area in the row with index = rowIndex
    // params:
    //  rowIndex - integer index of the row
    //

  }, {
    key: 'uncollapseRow',
    value: function uncollapseRow(rowIndex) {
      var _uncollapse = this._uncollapse;
      var _getHiddenArea = this._getHiddenArea;


      _uncollapse(_getHiddenArea(rowIndex));
    }

    /// Function which will hide or show hidden area in the row with index = rowIndex depending on its previous state
    // params:
    //  rowIndex - integer index of the row
    //

  }, {
    key: 'toggleRow',
    value: function toggleRow(rowIndex) {
      var _collapseWork = this._collapseWork;
      var _getHiddenArea = this._getHiddenArea;


      _collapseWork(_getHiddenArea(rowIndex));
    }

    /// Function which will return a jQuery row element with index = rowIndex
    // params:
    //  rowIndex - integer index of the row
    //

  }, {
    key: 'getRowEl',
    value: function getRowEl(rowIndex) {
      var _refs = this.refs;
      var accordionHideAreas = _refs.accordionHideAreas;
      var accordionItems = _refs.accordionItems;


      return rowIndex >= 0 && rowIndex < accordionHideAreas.length ? $(accordionItems[rowIndex]) : undefined;
    }

    /// Function which will make row disabled and immune to the user clicks
    // params:
    //  rowIndex - integer index of the row
    //
    // enableRow(rowIndex) {

    // };

    /// Function which will make row enabled and available for the user clicks
    // params:
    //  rowIndex - integer index of the row
    //
    // disableRow(rowIndex) {

    // };

    /// Private functions and variables

    /// Rendering accordion control
    //

  }, {
    key: '_render',
    value: function _render() {
      var props = this.props;
      var _collapseWork = this._collapseWork;
      var parentSelector = props.parentSelector;
      var hiddenLinkDescription = props.hiddenLinkDescription;
      var onAreaShow = props.onAreaShow;
      var onAreaHide = props.onAreaHide;
      var speed = props.speed;
      var showSearch = props.showSearch;
      var searchActionType = props.searchActionType;
      var classes = props.classes;
      var labels = props.labels;
      var selectors = props.selectors;
      var attributes = props.attributes;
      var constants = props.constants;
      var visibleAreaClass = classes.visibleAreaClass;
      var headerLinkClass = classes.headerLinkClass;
      var headerTextClass = classes.headerTextClass;
      var hiddenHeaderLabelDescriptionClass = classes.hiddenHeaderLabelDescriptionClass;
      var toggleClass = classes.toggleClass;
      var triangleClass = classes.triangleClass;
      var accordionHeaderClass = classes.accordionHeaderClass;
      var accordionHideAreaClass = classes.accordionHideAreaClass;
      var showHeaderLabelClass = classes.showHeaderLabelClass;
      var hideHeaderLabelClass = classes.hideHeaderLabelClass;
      var showHeaderLabelText = labels.showHeaderLabelText;
      var hideHeaderLabelText = labels.hideHeaderLabelText;
      var showHeaderLabelSelector = selectors.showHeaderLabelSelector;
      var hideHeaderLabelSelector = selectors.hideHeaderLabelSelector;
      var headerSelector = selectors.headerSelector;
      var headerLinkSelector = selectors.headerLinkSelector;
      var accordionItemSelector = selectors.accordionItemSelector;
      var hiddenAreaSelector = selectors.hiddenAreaSelector;


      var parentDiv = $(parentSelector);
      var accordionItems = parentDiv.find('> ' + accordionItemSelector);
      var accordionHideAreas = accordionItems.find('> ' + hiddenAreaSelector);
      var headers = accordionItems.find('> ' + headerSelector);

      // store component's DOM elements
      this.refs = {
        el: parentDiv,
        accordionItems: accordionItems,
        accordionHideAreas: accordionHideAreas,
        headers: headers
      };

      // check that our initialization is proper
      if (!parentDiv.length) {
        throw 'a11yAccordion - no element(s) with parentSelector was found';
      } else if (!accordionItems.length) {
        throw 'a11yAccordion - no element(s) with accordionItemSelector was found';
      } else if (!headers.length) {
        throw 'a11yAccordion - no element(s) with headerSelector was found';
      } else if (!accordionHideAreas.length) {
        throw 'a11yAccordion - no element(s) with hiddenAreaSelector was found';
      } else if (searchActionType !== constants.SEARCH_ACTION_TYPE_HIDE && searchActionType !== constants.SEARCH_ACTION_TYPE_COLLAPSE) {
        throw 'a11yAccordion - invalid searchActionType. It can only be: ' + constants.SEARCH_ACTION_TYPE_HIDE + ' or ' + constants.SEARCH_ACTION_TYPE_COLLAPSE;
      }

      // hide all areas by default
      accordionHideAreas.hide();

      // apply color scheme
      headers.addClass(accordionHeaderClass);
      accordionHideAreas.addClass(accordionHideAreaClass);

      // function for show/hide link clicks. We predefine the function not to define it in the loop
      var linkClick = function linkClick(event) {
        event.preventDefault();
        event.stopPropagation();
        var accordionItem = $(event.target).parents(accordionItemSelector).eq(0); // to avoid execution on nested accordions
        _collapseWork(accordionItem.find('> ' + hiddenAreaSelector).eq(0));
        accordionItem.find(headerLinkSelector).eq(0).focus();
      };

      // bind headers to a click event
      headers.click(linkClick);

      // generate assistive links
      $.each(headers, function initHeadersEach(index, header) {
        var spans = [];

        var link = $('<a>', {
          href: '#',
          'class': headerLinkClass
        });

        // Bind the click event to the link
        link.click(linkClick);

        spans.push($('<span>', {
          text: showHeaderLabelText,
          'class': showHeaderLabelClass
        }));

        spans.push($('<span>', {
          text: hideHeaderLabelText,
          style: 'display: none;',
          'class': hideHeaderLabelClass
        }));

        var assistiveLinkDescription = header.getAttribute(attributes.hiddenLinkDescription) || hiddenLinkDescription;

        spans.push($('<span>', {
          text: assistiveLinkDescription,
          'class': hiddenHeaderLabelDescriptionClass
        }));

        spans.push($('<div>', {
          'class': triangleClass
        }));

        // bulk DOM insert for spans
        $(header).wrapInner('<span class="' + headerTextClass + '"></span>');
        link.prepend(spans).appendTo(header);
      });

      // if there is NO search option then return component right away
      if (showSearch) {
        this._renderSearch();
      }
    }

    /// Rendering search DOM
    //

  }, {
    key: '_renderSearch',
    value: function _renderSearch() {
      var refs = this.refs;
      var props = this.props;
      var collapseRow = this.collapseRow;
      var uncollapseRow = this.uncollapseRow;
      var _traverseChildNodes = this._traverseChildNodes;
      var _getHiddenArea = this._getHiddenArea;
      var overallSearch = props.overallSearch;
      var classes = props.classes;
      var ids = props.ids;
      var labels = props.labels;
      var selectors = props.selectors;
      var searchActionType = props.searchActionType;
      var constants = props.constants;
      var el = refs.el;
      var accordionItems = refs.accordionItems;
      var accordionHideAreas = refs.accordionHideAreas;
      var headers = refs.headers;
      var noResultsDivID = ids.noResultsDivID;
      var searchDivID = ids.searchDivID;
      var rowIdStringPrefix = ids.rowIdStringPrefix;
      var markedTextClass = classes.markedTextClass;
      var noResultsDivClass = classes.noResultsDivClass;
      var searchDivClass = classes.searchDivClass;
      var searchClass = classes.searchClass;
      var accordionHeaderClass = classes.accordionHeaderClass;
      var headerClass = classes.headerClass;
      var searchPlaceholder = labels.searchPlaceholder;
      var noResultsText = labels.noResultsText;
      var titleText = labels.titleText;
      var resultsMessage = labels.resultsMessage;
      var leaveBlankMessage = labels.leaveBlankMessage;
      var markedTextSelector = selectors.markedTextSelector;
      var headerSelector = selectors.headerSelector;


      var wrapperDiv = $('<div>', {
        id: searchDivID,
        'class': searchDivClass
      });

      var searchInput = $('<input>', {
        type: 'text',
        placeholder: searchPlaceholder,
        'class': searchClass,
        title: titleText
      }).appendTo(wrapperDiv);

      var wrapperLi = $('<li>', {
        'class': noResultsDivClass,
        id: noResultsDivID,
        style: 'display:none;'
      }).appendTo(el);

      $('<div>', {
        'class': headerClass + ' ' + accordionHeaderClass,
        text: noResultsText
      }).appendTo(wrapperLi);

      // Set an id to each row
      accordionItems.each(function initaccordionItemsEach(index, item) {
        item.setAttribute('id', rowIdStringPrefix + index);
      });

      wrapperDiv.prependTo(el);

      var searchValue = '';

      // Bind search function to input field
      searchInput.keyup(function (event) {
        var value = event.target.value;
        // lowercase search string

        var searchString = value.toLowerCase();

        // if value did not change then nothing to do
        if (searchValue === searchString) {
          return;
        }

        searchValue = searchString;

        // hide no results found <li>
        wrapperLi.hide();

        var regex = new RegExp(searchString, 'ig');

        for (var i = 0, action; i < accordionItems.length; i++) {
          var headerTextNode = headers[i].children[0];

          // remove all markings from the DOM
          $(headerTextNode).find(markedTextSelector).each(function (index, element) {
            return $(element).contents().unwrap();
          });
          headerTextNode.normalize();

          // only if there is something in the input only then perform search
          action = searchString.length ? _traverseChildNodes(headerTextNode, regex, markedTextClass) : true;

          if (overallSearch) {
            var bodyTextNode = accordionHideAreas[i];

            // remove all markings from the DOM
            $(bodyTextNode).find(markedTextSelector).each(function (index, element) {
              return $(element).contents().unwrap();
            });
            bodyTextNode.normalize();

            // only if there is something in the input
            // and only if we could not find matching string in header
            // only then perform search
            action = searchString.length && !action ? _traverseChildNodes(bodyTextNode, regex, markedTextClass) : true;
          }

          // action on the item. Hide or Show
          if (searchActionType === constants.SEARCH_ACTION_TYPE_HIDE) {
            $(accordionItems[i])[action ? 'show' : 'hide']();
          } else if (searchActionType === constants.SEARCH_ACTION_TYPE_COLLAPSE) {
            var hiddenArea = _getHiddenArea(i);
            var hiddenAreaDisplay = hiddenArea[0].style.display;
            if (!searchString.length && hiddenAreaDisplay === 'block') {
              collapseRow(i);
            } else if (hiddenAreaDisplay === 'none' && action) {
              uncollapseRow(i);
            } else if (hiddenAreaDisplay === 'block' && !action) {
              collapseRow(i);
            }
          }
        }

        var results = accordionHideAreas.filter(':visible').length;
        searchInput.attr('title', resultsMessage + results.toString() + leaveBlankMessage);

        if (!results) {
          wrapperLi.show();
        }
      });
    }

    /// Function which is executed upon the link click. It will either hide the related area OR show the area and hide all other ones
    // params:
    //  element - accordion hidden area DOM element which will become hidden or visible depending on its previous state
    //

  }, {
    key: '_collapseWork',
    value: function _collapseWork(element) {
      var classes = this.props.classes;
      var visibleAreaClass = classes.visibleAreaClass;


      if (!element) {
        return;
      }

      this[element.hasClass(visibleAreaClass) ? '_collapse' : '_uncollapse'](element);
    }

    /// Function which will collapse all areas
    //

  }, {
    key: '_collapseAll',
    value: function _collapseAll() {
      var refs = this.refs;
      var props = this.props;
      var _collapse = this._collapse;
      var visibleAreaSelector = props.selectors.visibleAreaSelector;
      var accordionHideAreas = refs.accordionHideAreas;


      var visibleAreas = accordionHideAreas.filter(visibleAreaSelector);

      $.each(visibleAreas, function (index, element) {
        return _collapse(element);
      });
    }

    /// Function which will collapses one element
    // params:
    //  element - accordion hidden area DOM element which will become hidden
    //

  }, {
    key: '_collapse',
    value: function _collapse(element) {
      var props = this.props;
      var onAreaHide = props.onAreaHide;
      var speed = props.speed;
      var classes = props.classes;
      var selectors = props.selectors;
      var hideEffectStyle = props.hideEffectStyle;
      var toggleClass = classes.toggleClass;
      var visibleAreaClass = classes.visibleAreaClass;
      var headerSelector = selectors.headerSelector;
      var showHeaderLabelSelector = selectors.showHeaderLabelSelector;
      var hideHeaderLabelSelector = selectors.hideHeaderLabelSelector;
      var triangleSelector = selectors.triangleSelector;


      element = $(element);

      if (!element.length || !element.hasClass(visibleAreaClass)) {
        return;
      }

      var topRow = element.siblings(headerSelector);

      topRow.find(showHeaderLabelSelector).show();
      topRow.find(hideHeaderLabelSelector).hide();
      topRow.find(triangleSelector).toggleClass(toggleClass);

      element.slideUp(speed, hideEffectStyle, function () {
        element.removeClass(visibleAreaClass);
        element.hide();

        onAreaHide(element);
      });
    }

    /// Function which will show the area and convert from collapsed to be displayed one
    // params:
    //  element - accordion hidden area DOM element which will become visible
    //

  }, {
    key: '_uncollapse',
    value: function _uncollapse(element) {
      var props = this.props;
      var _collapseAll = this._collapseAll;
      var onAreaShow = props.onAreaShow;
      var speed = props.speed;
      var classes = props.classes;
      var selectors = props.selectors;
      var hideEffectStyle = props.hideEffectStyle;
      var showOne = props.showOne;
      var toggleClass = classes.toggleClass;
      var visibleAreaClass = classes.visibleAreaClass;
      var headerSelector = selectors.headerSelector;
      var showHeaderLabelSelector = selectors.showHeaderLabelSelector;
      var hideHeaderLabelSelector = selectors.hideHeaderLabelSelector;
      var triangleSelector = selectors.triangleSelector;


      element = $(element);

      if (!element.length || element.hasClass(visibleAreaClass)) {
        return;
      }

      if (showOne) {
        _collapseAll(element);
      }

      var topRow = element.siblings(headerSelector);

      topRow.find(showHeaderLabelSelector).hide();
      topRow.find(hideHeaderLabelSelector).show();
      topRow.find(triangleSelector).toggleClass(toggleClass);

      element.addClass(visibleAreaClass);
      element.slideDown(speed, hideEffectStyle, function () {
        element.show();

        onAreaShow(element);
      });
    }

    /// Function which returns a jQuery element which represent a hidden area
    // params:
    //  rowIndex - integer index of the row of the hidden area
    //

  }, {
    key: '_getHiddenArea',
    value: function _getHiddenArea(rowIndex) {
      var accordionHideAreas = this.refs.accordionHideAreas;


      return rowIndex >= 0 && rowIndex < accordionHideAreas.length ? $(accordionHideAreas[rowIndex]) : undefined;
    }

    // this function is based on
    // http://james.padolsey.com/javascript/replacing-text-in-the-dom-its-not-that-simple/

  }, {
    key: '_traverseChildNodes',
    value: function _traverseChildNodes(node, regex, markedTextClass) {
      var _this = this;

      // if node is a text node andstring appears in text
      if (node.nodeType === 3 && regex.test(node.data)) {
        if (node.textContent.match(regex)) {
          var temp = document.createElement('div');

          temp.innerHTML = node.data.replace(regex, '<mark class="' + markedTextClass + '">$&</mark>');
          while (temp.firstChild) {
            node.parentNode.insertBefore(temp.firstChild, node);
          }
          node.parentNode.removeChild(node);

          return true;
        }
        return;
      }

      var childNodes = node.childNodes;


      if (!childNodes.length) {
        return;
      }

      var foundMatch = void 0;

      $(childNodes).each(function (index, node) {
        foundMatch = _this._traverseChildNodes(node, regex, markedTextClass) || foundMatch;
      });

      return foundMatch;
    }
  }]);

  return A11yAccordion;
}();




var myAccordion = new A11yAccordion({
  parentSelector: '#example',
  overallSearch: true,
  searchActionType: 'collapse'
});


$(".selectYourCity a").click(function(){
  $(".a11yAccordion").slideToggle();
});

var myAccordion = new A11yAccordion({
    parentSelector: '#example1',
    overallSearch: true,
    searchActionType: 'collapse'
});
