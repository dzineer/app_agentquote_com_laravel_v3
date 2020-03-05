// make sure we have jQuery

var $ = jQuery.noConflict();

var DelanoCompanies = (function($) {

    var
        // Define a local copy of DelanoCompanies
        DelanoCompanies = function() {

            // The DelanoCompanies object is actually just the init constructor 'enhanced'
            // Need init if DelanoCompanies is called (just allow error to be thrown if not included)
            return new DelanoCompanies.fn.init();
        };

    window.DelanoCompanies = DelanoCompanies;

    DelanoCompanies.container =  '';
    DelanoCompanies.containerName = '#carousel';
    DelanoCompanies.surl =  '';
    DelanoCompanies.compact =  '';
    DelanoCompanies.scriptPath =  [];
    DelanoCompanies.packagedData =  '';
    DelanoCompanies.companiesData =  '';
    DelanoCompanies.errorCount =  null;
    DelanoCompanies.errorStr =  null;
    DelanoCompanies.messages =  [];
    DelanoCompanies.seperator =  "_";
    DelanoCompanies.jsonObj =  null;
    DelanoCompanies.data =  null;
    DelanoCompanies.me =  null;
    DelanoCompanies.license =  null;
    DelanoCompanies.licenseAttr = 'license';
    DelanoCompanies.script = '#delano-companies';
    DelanoCompanies.scriptPath = 'https://banner.aq2e.com/companiesutils/callback';

    DelanoCompanies.fn = DelanoCompanies.prototype = {
        constructor: DelanoCompanies
    },

    DelanoCompanies.events = [],

    DelanoCompanies.me = this;

    DelanoCompanies.init = function(obj) {
        obj.call(DelanoCompanies);
    };

    DelanoCompanies.extend = function(config) {
        var tmp = Object.create(this);
        for (var key in config) {
            if (config.hasOwnProperty(key)) {
                tmp[key] = config[key];
            }
        }
        return tmp;
    };

    DelanoCompanies.loadCompanies = function(rtndata) {

        DelanoCompanies.companiesData = rtndata.code;
        DelanoCompanies.createScroller();

        return false;
    };

    DelanoCompanies.load = function() {

        // using JSONP
        DelanoCompanies.license = $( DelanoCompanies.script ).attr( DelanoCompanies.licenseAttr );

        if (DelanoCompanies.license.length == 0 || DelanoCompanies.license == "") {
            console.log("license not found");
            return false;
        }

        DelanoCompanies.packagedData = DelanoCompanies.PackageData( DelanoCompanies.license );
        // DelanoCompanies.scriptPath = 'https://banner.aq2e.com/adsutils/callback';
        DelanoCompanies.compact = DelanoCompanies.scriptPath + DelanoCompanies.packagedData;
        DelanoCompanies.surl = DelanoCompanies.scriptPath;

        $.ajax({
            url: DelanoCompanies.surl,
            data: {id: DelanoCompanies.packagedData},
            dataType: "jsonp",
            jsonp : "callback",
            jsonpCallback: "DelanoCompanies.loadCompanies"
        }).error(
            function(XHR, textStatus, errorThrown){
                console.log("ERREUR: " + textStatus);
                console.log("ERREUR: " + errorThrown);
            }
        ).success(
            function() {
                // DelanoCompanies.loadAds.call(DelanoCompanies);
            }
        );
    };

    DelanoCompanies.createScroller = function () {

        if (!DelanoCompanies.container || DelanoCompanies.container.length == 0) {
            DelanoCompanies.container = $(DelanoCompanies.containerName);
        }

        DelanoCompanies.container.append( $(DelanoCompanies.companiesData) );
        var $len = $(DelanoCompanies.companiesData).length;

        if($len > 10) {
            $len = 10;
        }

        $('#carousel').addClass("show");

        var $c = $('#carousel');

        $c.carouFredSel(
            {
                circular: true,            // Determines whether the carousel should be circular.
                responsive: false,
                auto: true,
                infinite: true,
                align: false,
                items: { visible: 10, minimum:7, start:0, width:null, height:150, filter:null },
                scroll: {
                    items: 1,
                    duration: 2100,
                    timeoutDuration: 0,
                    easing: 'linear'
                    /* pauseOnHover: 'immediate' */
                }
            });

    };

    DelanoCompanies.PackageData = function(dataToPackage) {
        var work = dataToPackage;
        var adj = work.length % 3;
        if (adj != 0)
        {
            for (var indx = 0; indx < (3 - adj); indx++) { work = work + ' '; }
        }
        var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        var out = "", c1, c2, c3, e1, e2, e3, e4;
        for (var i = 0; i < work.length; )
        {
            c1 = work.charCodeAt(i++);
            c2 = work.charCodeAt(i++);
            c3 = work.charCodeAt(i++);
            e1 = c1 >> 2;
            e2 = ((c1 & 3) << 4) + (c2 >> 4);
            e3 = ((c2 & 15) << 2) + (c3 >> 6);
            e4 = c3 & 63;
            if (isNaN(c2)) { e3 = e4 = 64; }
            else if (isNaN(c3)) { e4 = 64; }
            out += tab.charAt(e1) + tab.charAt(e2) + tab.charAt(e3) + tab.charAt(e4);
        }
        return out;
    };

    return DelanoCompanies;

}(jQuery));

jQuery(function() {
    DelanoCompanies.init(

        function() {
            DelanoCompanies.container = jQuery("#carousel");
        }

    );

    DelanoCompanies.load();
});