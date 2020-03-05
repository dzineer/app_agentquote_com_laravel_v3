    // https://errorception.com/
    
    (function(_, e, rr, s) {
    	_errs = [s];
    	var c = _.onError;
    	_.onError = function() {
    		var a = arguments;
    		_errs.push(a);
    		c && c.apply(this, a)
    	};
    	var b = function() {
    		var c = e.createElement(rr),
    			b = e.getElementsByTagName(rr)[0];
    		c.src = "//beacon.errorception.com/" + s + ".js";
    		c.async = !0;
    		b.parentNode.insertBefore(c, b)
    	};
    	_.addEventListener ? _.addEventListener("load", b, !1) : _.attachEvent("onload", b)
    })(window, document, "script", "5988cdd3d800d3e4490003a9");
    
    (function(w){
        w._errs.meta = {user_id: '5336912'};
      var ignoredUa = [/Googlebot|YandexBot|YandexMobileBot|AhrefsBot|CasperJS|PhantomJS/, /MSIE ([1-9])\b/];
      var ignoredMsg = [/NS_ERROR_/, /Error: html5 audio formats not supported/];
      var ingoredUrl = [/firebasejs/];
      w._errs.allow = function(error) {
        error = error || {};
        error.message = error.message || '';
        error.url = error.url || '';
        if (ignoredUa.some((function(regex) {
          return regex.test(w.navigator.userAgent);
        })) || ignoredMsg.some((function(regex) {
          return regex.test(error.message);
        })) || ingoredUrl.some((function(regex) {
          return regex.test(error.url);
        }))) {
          return false;
        }
        return true;
      };
    })(this);