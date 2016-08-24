//https://github.com/kevinburke/customize-twitter-1.1
(function ($) {
	"use strict";
var CustomizeTwitterWidget = function(data) {
    // ie hack, http://stackoverflow.com/a/10183573/329700
    if(!(window.console && console.log)) {
      console = {
        log: function(){},
        debug: function(){},
        info: function(){},
        warn: function(){},
        error: function(){}
      };
    }

    var notNumeric = function(n) {
        return isNaN(parseFloat(n)) && isFinite(n);
    };

    var createCssElement = function(doc, url) {
        var link = doc.createElement("link");
        link.href = url;
        link.rel = "stylesheet";
        link.type = "text/css";
        return link;
    };

    var embedCss = function(doc, url) {
        var link = createCssElement(doc, url);
        var head = doc.getElementsByTagName("head")[0];
        head.appendChild(link);
    };

    var contains = function(haystack, needle) {
        for (key in haystack) {
		  if (haystack[key] == needle) {
			return true;
		  }
		}
		return false;
    };

    var isTwitterFrame = function(frame) {
        return  frame.frameElement.className.indexOf('twitter-timeline') >= 0 && frame.document.getElementsByTagName('head')[0].hasChildNodes();
    }

    /**
     * The main event loop - calls itself if we haven't found all of the frames
     * yet.
     */
    var evaluate = function(framesWithStyles, widgetCount, timeoutLength) {
        for (var i = 0; i < frames.length; i++) {
            try {
                if (isTwitterFrame(frames[i]) &&
                    !contains(framesWithStyles, i)
                ) {
                    embedCss(frames[i].document, data.url);
                    embedCss(frames[i].document, data.url2);
                    framesWithStyles.push(i);
                }
            } catch(e) {
                console.log("caught an error");
                console.log(e);
            }
        }
        if (framesWithStyles.length < widgetCount) {
            setTimeout(function() {
                evaluate(framesWithStyles, widgetCount, timeoutLength);
            }, timeoutLength);
        }
    }

    if (data.url === undefined) {
        console.log("need to specify a link to your CSS file. quitting");
        return;
    }
    var widgetCount;
    if (data.widget_count === undefined || notNumeric(data.widget_count)) {
        widgetCount = 1;
    } else {
        widgetCount = data.widget_count;
    }
    var timeoutLength;
    if (data.timeout_length === undefined || notNumeric(data.timeout_length)) {
        timeoutLength = 300;
    } else {
        timeoutLength = data.timeout_length;
    }

    setTimeout(function() {
        evaluate([], widgetCount, timeoutLength);
    }, timeoutLength);
}
$(document).ready(function(){
	CustomizeTwitterWidget({"url": inwaveCfg.themeUrl+"/css/twitter.css","url2": $('#inwave-color-css').attr('href')});
})
})(jQuery);
