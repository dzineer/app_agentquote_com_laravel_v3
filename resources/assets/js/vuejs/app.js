require('./bootstrap');
// import router from './routes';

/* new Vue({
    el: '#app',
    router: router
});
 */

/* import MegaMenu from './components/MegaMenu';
import SupportButton from './components/SupportButton'; */
import Question from './components/Question';
import Accordian from './components/Accordian';
import PopperToolTip from 'tooltip.js';
import _ from 'lodash';

"document"in self&&("classList"in document.createElement("_")&&(!document.createElementNS||"classList"in document.createElementNS("http://www.w3.org/2000/svg","g"))||!function(t){"use strict";if("Element"in t){var e="classList",n="prototype",i=t.Element[n],s=Object,r=String[n].trim||function(){return this.replace(/^\s+|\s+$/g,"")},o=Array[n].indexOf||function(t){for(var e=0,n=this.length;n>e;e++)if(e in this&&this[e]===t)return e;return-1},c=function(t,e){this.name=t,this.code=DOMException[t],this.message=e},a=function(t,e){if(""===e)throw new c("SYNTAX_ERR","The token must not be empty.");if(/\s/.test(e))throw new c("INVALID_CHARACTER_ERR","The token must not contain space characters.");return o.call(t,e)},l=function(t){for(var e=r.call(t.getAttribute("class")||""),n=e?e.split(/\s+/):[],i=0,s=n.length;s>i;i++)this.push(n[i]);this._updateClassName=function(){t.setAttribute("class",this.toString())}},u=l[n]=[],h=function(){return new l(this)};if(c[n]=Error[n],u.item=function(t){return this[t]||null},u.contains=function(t){return~a(this,t+"")},u.add=function(){var t,e=arguments,n=0,i=e.length,s=!1;do t=e[n]+"",~a(this,t)||(this.push(t),s=!0);while(++n<i);s&&this._updateClassName()},u.remove=function(){var t,e,n=arguments,i=0,s=n.length,r=!1;do for(t=n[i]+"",e=a(this,t);~e;)this.splice(e,1),r=!0,e=a(this,t);while(++i<s);r&&this._updateClassName()},u.toggle=function(t,e){var n=this.contains(t),i=n?e!==!0&&"remove":e!==!1&&"add";return i&&this[i](t),e===!0||e===!1?e:!n},u.replace=function(t,e){var n=a(t+"");~n&&(this.splice(n,1,e),this._updateClassName())},u.toString=function(){return this.join(" ")},s.defineProperty){var f={get:h,enumerable:!0,configurable:!0};try{s.defineProperty(i,e,f)}catch(p){void 0!==p.number&&-2146823252!==p.number||(f.enumerable=!1,s.defineProperty(i,e,f))}}else s[n].__defineGetter__&&i.__defineGetter__(e,h)}}(self),function(){"use strict";var t=document.createElement("_");if(t.classList.add("c1","c2"),!t.classList.contains("c2")){var e=function(t){var e=DOMTokenList.prototype[t];DOMTokenList.prototype[t]=function(t){var n,i=arguments.length;for(n=0;i>n;n++)t=arguments[n],e.call(this,t)}};e("add"),e("remove")}if(t.classList.toggle("c3",!1),t.classList.contains("c3")){var n=DOMTokenList.prototype.toggle;DOMTokenList.prototype.toggle=function(t,e){return 1 in arguments&&!this.contains(t)==!e?e:n.call(this,t)}}"replace"in document.createElement("_").classList||(DOMTokenList.prototype.replace=function(t,e){var n=this.toString().split(" "),i=n.indexOf(t+"");~i&&(n=n.slice(i),this.remove.apply(this,n),this.add(e),this.add.apply(this,n.slice(1)))}),t=null}());

function onScroll() {

}

/* window.addEventListener('scroll', _.throttle(function() {
    var elementId = 'featured-tips';
    var scrollButton = document.getElementById( 'scrollToTopButton' );
    var position =
                    document.body.scrollTop || document.documentElement.scrollTop;
    let element =
                    document.getElementById( elementId );

    if (position > element.offsetTop) {
        scrollButton.classList.toggle('tw-hidden');
    }
}, 1000)); */

jQuery(function($) {
  setTimeout(function() {

    if (location.hash) {
        if (["#termlife", "#sit", "#fe", "#mortgage"].indexOf( location.hash ) === -1) {
            /* we need to scroll to the top of the window first, because the browser will always jump to the anchor first before JavaScript is ready, thanks Stack Overflow: http://stackoverflow.com/a/3659116 */
            window.scrollTo(0, 0);
            let target = location.hash.split('#');
            smoothScrollTo($('#'+target[1]));
        }
    }

  }, 1);

  // taken from: https://css-tricks.com/snippets/jquery/smooth-scrolling/
  $('a[href*=\\#]:not([href=\\#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      smoothScrollTo($(this.hash));
      return false;
    }
  });

  function smoothScrollTo(ttarget) {
    let target = ttarget.length ? ttarget : $('[name=' + this.hash.slice(1) +']');

    if (target.length) {
      $('html,body').animate({
        scrollTop: target.offset().top - 40
      }, 1000);
    }
  }

}(jQuery));

function scrollToTop() {
    window.scrollTo(0, 0);
/*     let scrollAnimation = null;
    let position =
        document.body.scrollTop || document.documentElement.scrollTop;
    if (position) {
        window.scrollBy(0, -Math.max(1, Math.floor(position / 10)));
        scrollAnimation = setTimeout("scrollToTop()", 5);
    } else clearTimeout(scrollAnimation);
    return false; */
}

window.scrollToTop = scrollToTop;

/* import PortalVue from 'portal-vue';
import VModal from 'vue-js-modal'; */
/*
Vue.use(PortalVue);
Vue.use(VModal);

 */

Vue.directive('tooltip', {
    bind(elem, bindings) {
        console.log(bindings);
        new PopperToolTip(elem, {
            placement: bindings.arg || 'top',
            title: bindings.value
        });
    }
});

Vue.filter('formatAmount', function (a, symbol='') {
    let n = a + "";
    if (n.length) {
        n = parseInt(a);
    }
    n = n.replace(/\$/g, "");
    n = n.replace(/,/g, "");
    n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return symbol + n;
});

Vue.filter('formatMoney', function (amount, decimalCount = 0, decimal = ".", thousands = ",", symbol = "$") {
    try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

        const negativeSign = amount < 0 ? "-" : "";

        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;

        return symbol + negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    } catch (e) {
        console.log(e)
    }
});

import TopBar from './components/TopBar.vue';
Vue.component('top-bar', TopBar);

import ResponsiveMenu from './components/ResponsiveMenu.vue';
Vue.component('responsive-menu', ResponsiveMenu);

import HeaderLogo from './components/HeaderLogo.vue';
Vue.component('header-logo', HeaderLogo);

import HeaderName from './components/HeaderName.vue';
Vue.component('header-name', HeaderName);

import TopMenu from './components/TopMenu.vue';
Vue.component('top-menu', TopMenu);

import SocialMediaBar from './components/SocialMediaBar.vue';
Vue.component('social-media-bar', SocialMediaBar);

import TooltipExamples from './components/TooltipExamples.vue';
Vue.component('tooltip-examples', TooltipExamples);

import Counter from './components/Counter.vue';
Vue.component('counter', Counter);

import ConditionalElement from './components/ConditionalElement.vue';
Vue.component('conditional-element', ConditionalElement);

import Signup from './components/Signup';
// Vue.component('signup-landingpage', Signup);

import ContactUsBanner from './components/ContactUsBanner';
Vue.component('contact-banner', ContactUsBanner);

import NeedsAnalyzerBanner from './components/NeedsAnalyzerBanner';
Vue.component('needs-analyzer-banner', NeedsAnalyzerBanner);

import FixedTopNav from './components/FixedTopNav';
Vue.component('fixed-top-nav', FixedTopNav);

import SecureConfidentialBanner from './components/SecureConfidentialBanner';
Vue.component('secure-confidential-banner', SecureConfidentialBanner);

import NeedsAnalyser from './components/NeedsAnalyser.vue';
// Vue.component('needs-analyser', NeedsAnalyser);

import Quote from './components/Quote';
Vue.component('quote', Quote);

import PageSections from './components/PageSections';
Vue.component('page-sections', PageSections);

import PageSection from './components/PageSection';
Vue.component('page-section', PageSection);

import QuoteItem from './components/QuoteItem';
Vue.component('quote-item', QuoteItem);

import BrandBar from './components/BrandBar';
Vue.component('brand-bar', BrandBar);

import Icon from './components/Icon';
Vue.component('web-icon', Icon);

import SectionView from './components/SectionView';
Vue.component('section-view', SectionView);

import DisplayPhoneNumber from './components/DisplayPhoneNumber';
Vue.component('display-phone-number', DisplayPhoneNumber);

/* let socialMediaIcons = [
    {"name":"facebook", "label": "Visit our Facebook Page", "icon":"fa-facebook","link":"https://facebook.com/agentquoter2"},
    {"name":"twitter","label": "Visit our Twitter Page", "icon":"fa-twitter","link":"https://twitter.com/agentquoter2"},
    {"name":"linkedin","label": "Visit our LinkedIn Page", "icon":"fa-linkedin","link":"https://linkedin.com/agentquoter2"}]
 */
let topMenuItems = [
    { "active": true, "text":"Products", "link":"/products", "target": "_blank" },
    { "active": false ,"text":"Services", "link":"/services", "target": "_blank" },
    { "active": false, "text":"Contact Us", "link":"/contact", "target": "_blank" },
];

const items = [
    { 'text': 'Products', 'link': '/life-insurane/products'},
    { 'text': 'Services', 'link': '/about'},
    { 'text': 'Contact', 'link': '/contact'},
];

let vueEvents = new Vue();
window.vueEvents = vueEvents;

let quote = {
    items: [
        {
            policy: "SBLI 20 Year Term Guaranteed",
            links: [ { text: 'Click Here to Match a rate to your Health Profile', 'href': '#'}, { text: 'View Policy Details', 'href': '#'} ],
            logo: "/images/logos/banner-life-insurance.jpg",
            rateClassificaions: [{ name: 'Preferred Plus', 'premium': '10.11' }, { name: 'Preferred Plus', 'premium': '10.11' }, { name: 'Preferred Plus', 'premium': '10.11' }, { name: 'Preferred Plus', 'premium': '10.11' }]
        },
        {
            policy: "SBLI 20 Year Term Guaranteed",
            links: [ { text: 'Click Here to Match a rate to your Health Profile', 'href': '#'}, { text: 'View Policy Details', 'href': '#'} ],
            logo: "/images/logos/banner-life-insurance.jpg",
            rateClassificaions: [{ name: 'Preferred Plus', 'premium': '10.11' }, { name: 'Preferred Plus', 'premium': '10.11' }, { name: 'Preferred Plus', 'premium': '10.11' }, { name: 'Preferred Plus', 'premium': '10.11' }]
        },
        {
            policy: "SBLI 20 Year Term Guaranteed",
            links: [ { text: 'Click Here to Match a rate to your Health Profile', 'href': '#'}, { text: 'View Policy Details', 'href': '#'} ],
            logo: "/images/logos/banner-life-insurance.jpg",
            rateClassificaions: [{ name: 'Preferred Plus', 'premium': '10.11' }, { name: 'Preferred Plus', 'premium': '10.11' }, { name: 'Preferred Plus', 'premium': '10.11' }, { name: 'Preferred Plus', 'premium': '10.11' }]
        }
    ]
};

let category = 'fe';
let terms = [
    { 'text': '10 Years', 'value': 10 },
    { 'text': '15 Years', 'value': 15 },
    { 'text': '20 Years', 'value': 20 },
    { 'text': '25 Years', 'value': 25 },
    { 'text': '30 Years', 'value': 30 }
];

let benefitLimits = {
    min: 25000, max: 1000000
};

new Vue({
    el: '#app',
    components: { /* MegaMenu, SupportButton,  */Question, Accordian, Signup },
    data() {
       return {
    //       socialMediaIcons: socialMediaIcons,
           topMenuItems: topMenuItems,
           items: items,
           showCalculator: false,
           showSignup: true,
           showQuote: false,
           quote: quote,
           category: category,
           terms: terms,
           benefitLimits: benefitLimits
        }
    },
    mounted() {
        document.querySelectorAll('[data-tooltip]').forEach(elem => {
            new PopperToolTip(elem, {
                placement: elem.dataset.tooltipPlacement || 'top',
                title: elem.dataset.tooltip
            });
        });

       window.vueEvents.$on('showQuote', this.onShowQuote);
    },
    methods: {
        onShowCalculator() {
/*             this.showSignupBar = false;
            this.showCalculator = true; */
        },
        onShowQuote() {
            this.showSignup = false;
            this.showQuote = true;
            window.vueEvents.$on('show-section-views');
        }

     }
});
