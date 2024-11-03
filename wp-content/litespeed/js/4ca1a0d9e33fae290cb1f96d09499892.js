!function(i){var r={init:function(t){return this.each(function(){this.self=i(this),r.destroy.call(this.self),this.opt=i.extend(!0,{},i.fn.um_raty.defaults,t),r._adjustCallback.call(this),r._adjustNumber.call(this),"img"!==this.opt.starType&&r._adjustStarType.call(this),r._adjustPath.call(this),r._createStars.call(this),this.opt.cancel&&r._createCancel.call(this),this.opt.precision&&r._adjustPrecision.call(this),r._createScore.call(this),r._apply.call(this,this.opt.score),r._target.call(this,this.opt.score),(this.opt.readOnly?r._lock:(this.style.cursor="pointer",r._binds)).call(this),this.self.data("options",this.opt)})},_adjustCallback:function(){for(var t=["number","readOnly","score","scoreName","target"],e=0;e<t.length;e++)"function"==typeof this.opt[t[e]]&&(this.opt[t[e]]=this.opt[t[e]].call(this))},_adjustNumber:function(){this.opt.number=r._between(this.opt.number,1,this.opt.numberMax)},_adjustPath:function(){this.opt.path=this.opt.path||"",this.opt.path&&"/"!==this.opt.path.charAt(this.opt.path.length-1)&&(this.opt.path+="/")},_adjustPrecision:function(){this.opt.half=!0,this.opt.targetType="score"},_adjustStarType:function(){this.opt.path="";for(var t=["cancelOff","cancelOn","starHalf","starOff","starOn"],e=0;e<t.length;e++)this.opt[t[e]]=this.opt[t[e]].replace(".","-")},_apply:function(t){r._fill.call(this,t),t&&(0<t&&this.score.val(r._between(t,0,this.opt.number)),r._roundStars.call(this,t))},_between:function(t,e,a){return Math.min(Math.max(parseFloat(t),e),a)},_binds:function(){this.cancel&&(r._bindOverCancel.call(this),r._bindClickCancel.call(this),r._bindOutCancel.call(this)),r._bindOver.call(this),r._bindClick.call(this),r._bindOut.call(this)},_bindClick:function(){var a=this;a.stars.on("click.um_raty",function(t){var e=i(this);a.score.val(a.opt.half||a.opt.precision?a.self.data("score"):this.alt||e.data("alt")),a.opt.click&&a.opt.click.call(a,+a.score.val(),t)})},_bindClickCancel:function(){var e=this;e.cancel.on("click.um_raty",function(t){e.score.removeAttr("value"),e.opt.click&&e.opt.click.call(e,null,t)})},_bindOut:function(){var a=this;a.self.on("mouseleave.um_raty",function(t){var e=+a.score.val()||void 0;r._apply.call(a,e),r._target.call(a,e,t),a.opt.mouseout&&a.opt.mouseout.call(a,e,t)})},_bindOutCancel:function(){var a=this;a.cancel.on("mouseleave.um_raty",function(t){var e=a.opt.cancelOff;"img"!==a.opt.starType&&(e=a.opt.cancelClass+" "+e),r._setIcon.call(a,this,e),a.opt.mouseout&&(e=+a.score.val()||void 0,a.opt.mouseout.call(a,e,t))})},_bindOver:function(){var a=this,t=a.opt.half?"mousemove.um_raty":"mouseover.um_raty";a.stars.on(t,function(t){var e=r._getScoreByPosition.call(a,t,this);r._fill.call(a,e),a.opt.half&&(r._roundStars.call(a,e),a.self.data("score",e)),r._target.call(a,e,t),a.opt.mouseover&&a.opt.mouseover.call(a,e,t)})},_bindOverCancel:function(){var s=this;s.cancel.on("mouseover.um_raty",function(t){var e=s.opt.path+s.opt.starOff,a=s.opt.cancelOn;"img"===s.opt.starType?s.stars.attr("src",e):(a=s.opt.cancelClass+" "+a,s.stars.attr("class",e)),r._setIcon.call(s,this,a),r._target.call(s,null,t),s.opt.mouseover&&s.opt.mouseover.call(s,null)})},_buildScoreField:function(){return i("<input />",{name:this.opt.scoreName,type:"hidden"}).appendTo(this)},_createCancel:function(){var t=this.opt.path+this.opt.cancelOff,e=i("<"+this.opt.starType+" />",{title:this.opt.cancelHint,class:this.opt.cancelClass});"img"===this.opt.starType?e.attr({src:t,alt:"x"}):e.attr("data-alt","x").addClass(t),"left"===this.opt.cancelPlace?this.self.prepend("&#160;").prepend(e):this.self.append("&#160;").append(e),this.cancel=e},_createScore:function(){var t=i(this.opt.targetScore);this.score=t.length?t:r._buildScoreField.call(this)},_createStars:function(){for(var t=1;t<=this.opt.number;t++){var e=r._nameForIndex.call(this,t),e={alt:t,src:this.opt.path+this.opt[e]};(e="img"!==this.opt.starType?{"data-alt":t,class:e.src}:e).title=r._getHint.call(this,t),i("<"+this.opt.starType+" />",e).appendTo(this),this.opt.space&&this.self.append(t<this.opt.number?"&#160;":"")}this.stars=this.self.children(this.opt.starType)},_error:function(t){i(this).text(t),i.error(t)},_fill:function(t){for(var e=0,a=1;a<=this.stars.length;a++){var s,i,o=this.stars[a-1],n=r._turnOn.call(this,a,t);this.opt.iconRange&&this.opt.iconRange.length>e?(s=this.opt.iconRange[e],i=r._getRangeIcon.call(this,s,n),a<=s.range&&r._setIcon.call(this,o,i),a===s.range&&e++):(i=this.opt[n?"starOn":"starOff"],r._setIcon.call(this,o,i))}},_getRangeIcon:function(t,e){return e?t.on||this.opt.starOn:t.off||this.opt.starOff},_getScoreByPosition:function(t,e){var a,s=parseInt(e.alt||e.getAttribute("data-alt"),10);return this.opt.half&&(a=r._getSize.call(this),t=parseFloat((t.pageX-i(e).offset().left)/a),s=this.opt.precision?s-1+t:s-1+(.5<t?1:.5)),s},_getSize:function(){var t="img"===this.opt.starType?this.stars[0].width:parseFloat(this.stars.eq(0).css("font-size"));return t||r._error.call(this,"Could not be possible get the icon size!"),t},_turnOn:function(t,e){return this.opt.single?t===e:t<=e},_getHint:function(t){var e=this.opt.hints[t-1];return""===e?"":e||t},_lock:function(){var t=parseInt(this.score.val(),10),t=t?r._getHint.call(this,t):this.opt.noRatedMsg;this.style.cursor="",this.title=t,this.score.prop("readonly",!0),this.stars.prop("title",t),this.cancel&&this.cancel.hide(),this.self.data("readonly",!0)},_nameForIndex:function(t){return this.opt.score&&this.opt.score>=t?"starOn":"starOff"},_roundStars:function(t){var e,a=(t%1).toFixed(2);a>this.opt.round.down&&(e="starOn",this.opt.halfShow&&a<this.opt.round.up?e="starHalf":a<this.opt.round.full&&(e="starOff"),a=this.opt[e],e=this.stars[Math.ceil(t)-1],r._setIcon.call(this,e,a))},_setIcon:function(t,e){t["img"===this.opt.starType?"src":"className"]=this.opt.path+e},_setTarget:function(t,e){e=e&&this.opt.targetFormat.toString().replace("{score}",e),t.is(":input")?t.val(e):t.html(e)},_target:function(t,e){var a,s;this.opt.target&&((a=i(this.opt.target)).length||r._error.call(this,"Target selector invalid or missing!"),s=e&&"mouseover"===e.type,void 0===t?t=this.opt.targetText:null===t?t=s?this.opt.cancelHint:this.opt.targetText:("hint"===this.opt.targetType?t=r._getHint.call(this,Math.ceil(t)):this.opt.precision&&(t=parseFloat(t).toFixed(1)),e=e&&"mousemove"===e.type,s||e||this.opt.targetKeep||(t=this.opt.targetText)),r._setTarget.call(this,a,t))},_unlock:function(){this.style.cursor="pointer",this.removeAttribute("title"),this.score.removeAttr("readonly"),this.self.data("readonly",!1);for(var t=0;t<this.opt.number;t++)this.stars[t].title=r._getHint.call(this,t+1);this.cancel&&this.cancel.css("display","")},cancel:function(e){return this.each(function(){var t=i(this);!0!==t.data("readonly")&&(r[e?"click":"score"].call(t,null),this.score.removeAttr("value"))})},click:function(t){return this.each(function(){!0!==i(this).data("readonly")&&(r._apply.call(this,t),this.opt.click&&this.opt.click.call(this,t,i.Event("click")),r._target.call(this,t))})},destroy:function(){return this.each(function(){var t=i(this),e=t.data("raw");e?t.off(".um_raty").empty().css({cursor:e.style.cursor}).removeData("readonly"):t.data("raw",t.clone()[0])})},getScore:function(){var t,e=[];return this.each(function(){t=this.score.val(),e.push(t?+t:void 0)}),1<e.length?e:e[0]},move:function(s){return this.each(function(){var t=parseInt(s,10),e=i(this).data("options"),a=(+s).toFixed(1).split(".")[1];t>=e.number&&(t=e.number-1,a=10);e=r._getSize.call(this)/10,t=i(this.stars[t]),e=t.offset().left+e*parseInt(a,10),a=i.Event("mousemove",{pageX:e});t.trigger(a)})},readOnly:function(e){return this.each(function(){var t=i(this);t.data("readonly")!==e&&((e?(t.off(".um_raty").children("img").off(".um_raty"),r._lock):(r._binds.call(this),r._unlock)).call(this),t.data("readonly",e))})},reload:function(){return r.set.call(this,{})},score:function(){var t=i(this);return arguments.length?r.setScore.apply(t,arguments):r.getScore.call(t)},set:function(a){return this.each(function(){var t=i(this),e=t.data("options"),e=i.extend({},e,a);t.um_raty(e)})},setScore:function(t){return this.each(function(){!0!==i(this).data("readonly")&&(r._apply.call(this,t),r._target.call(this,t))})}};i.fn.um_raty=function(t){return r[t]?r[t].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof t&&t?void i.error("Method "+t+" does not exist!"):r.init.apply(this,arguments)},i.fn.um_raty.defaults={cancel:!1,cancelClass:"raty-cancel",cancelHint:wp.i18n.__("Cancel this rating!","ultimate-member"),cancelOff:"cancel-off.png",cancelOn:"cancel-on.png",cancelPlace:"left",click:void 0,half:!1,halfShow:!0,hints:["bad","poor","regular","good","gorgeous"],iconRange:void 0,mouseout:void 0,mouseover:void 0,noRatedMsg:wp.i18n.__("Not rated yet!","ultimate-member"),number:5,numberMax:20,path:void 0,precision:!1,readOnly:!1,round:{down:.25,full:.6,up:.76},score:void 0,scoreName:"score",single:!1,space:!0,starHalf:"star-half.png",starOff:"star-off.png",starOn:"star-on.png",starType:"img",target:void 0,targetFormat:"{score}",targetKeep:!1,targetScore:void 0,targetText:"",targetType:"hint"}}(jQuery);
;