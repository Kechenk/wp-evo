!function(t){var i,n={message:"",yes_label:"Yes",no_label:"No"},m={init:function(o){i=t.extend({},n,o),t(this).each(function(){t(this).data("options",i),m.build.apply(t(this),[i]),t(this).click(function(o){var i=t(this).data("options");t("#um_confirm_message").html(i.message),t("#um_confirm_button_yes").html(i.yes_label),t("#um_confirm_button_no").html(i.no_label),m.show.apply(this),o.stopPropagation()})})},build:function(o){m.is_builded.apply(this)||(t('<div id="um_confirm_block"></div>').appendTo("body").html('<div class="um_confirm"><div id="um_confirm_title">Confirmation</div><div id="um_confirm_message"></div><div id="um_confirm_buttons"><div id="um_confirm_button_yes" class="um_confirm_button">Yes</div><div id="um_confirm_button_no" class="um_confirm_button">No</div></div></div><div id="um_confirm_block_back"></div>'),t(document).on("click","#um_confirm_button_yes",function(){var o=t("#um_confirm_block").data("obj");m.yes.apply(o)}),t(document).on("click","#um_confirm_button_no",function(){var o=t("#um_confirm_block").data("obj");m.no.apply(o)}),t(document).on("click","#um_confirm_block_back",function(){var o=t("#um_confirm_block").data("obj");m.close.apply(o)}))},is_builded:function(){return t("#um_confirm_block").length},show:function(){t("#um_confirm_block").data("obj",this).show();var o=t(".um_confirm").width(),i=t(".um_confirm").height();t(".um_confirm").css("margin","-"+i/2+"px 0 0 -"+o/2+"px")},close:function(){var o=t(this).data("options");t("#um_confirm_message").html(""),t("#um_confirm_block").hide(),"function"==typeof o.onClose&&o.onClose.apply(this)},yes:function(){var o=t(this).data("options"),i={};if(t("#um_confirm_block").find("form").length){var n=t("#um_confirm_block").find("form").serializeArray();for(key in n)i[n[key].name]=n[key].value}m.close.apply(this),"function"==typeof o.onYes&&o.onYes.apply(this,[i])},no:function(){var o=t(this).data("options"),i={};if(t("#um_confirm_block").find("form").length){var n=t("#um_confirm_block").find("form").serializeArray();for(key in n)i[n[key].name]=n[key].value}m.close.apply(this),"function"==typeof o.onNo&&o.onNo.apply(this,[i])}};t.fn.um_confirm=function(o){return m[o]?m[o].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof o&&o?void t.error("Method "+o+" does not exist for jQuery.um_confirm plugin"):m.init.apply(this,arguments)},t.um_confirm=function(o){i=t.extend({},n,o),t(o.object).data("options",i),m.build.apply(t(o.object),[i]),i.title&&t("#um_confirm_title").html(i.title),t("#um_confirm_message").html(i.message),t("#um_confirm_button_yes").html(i.yes_label),t("#um_confirm_button_no").html(i.no_label),m.show.apply(o.object)}}(jQuery);
;