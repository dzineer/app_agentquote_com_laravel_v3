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

/* import PortalVue from 'portal-vue';
import VModal from 'vue-js-modal'; */
/*
Vue.use(PortalVue);
Vue.use(VModal);

 */

Vue.directive('tooltip', {
    bind(elem, bindings) {
        // console.log(bindings);
        new PopperToolTip(elem, {
            placement: bindings.arg || 'top',
            title: bindings.value
        });
    }
})

import TopBar from './components/TopBar.vue';
Vue.component('top-bar', TopBar);

import ResponsiveMenu from './components/ResponsiveMenu.vue';
Vue.component('responsive-menu', ResponsiveMenu);

import HeaderLogo from './components/HeaderLogo.vue';
Vue.component('header-logo', HeaderLogo);

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

let socialMediaIcons = [{"name":"facebook","icon":"fa-facebook","link":"https://facebook.com/agentquoter2"},{"name":"facebook","icon":"fa-twitter","link":"https://twitter.com/agentquoter2"},{"name":"facebook","icon":"fa-linkedin","link":"https://instagram.com/agentquoter2"}]

let topMenuItems = [
    { "active": true, "text":"Products", "link":"/products", "target": "_blank" },
    { "active": false ,"text":"Services", "link":"/services", "target": "_blank" },
    { "active": false, "text":"Contact Us", "link":"/contact", "target": "_blank" },
];

const items = [
    { 'text': 'Home', 'link': '/home'},
    { 'text': 'About', 'link': '/about'},
    { 'text': 'Needs Analyser', 'link': '/needs-analyzer'},
];

/* let vueEvents = new Vue();
window.vueEvents = vueEvents; */
import _ from "lodash";

new Vue({
    el: '#app',
    components: { /* MegaMenu, SupportButton,  */FixedTopNav, Question, Accordian, Signup },
    data() {
       return {
           socialMediaIcons: socialMediaIcons,
           topMenuItems: topMenuItems,
           items: items,
           showCalculator: false,
           showSignupBar: true,
           classesList: [
               'tw-w-full',
               'tw-h-8',
               'tw-mt-4',
           ],
           classes: '',
           selectedElement: { classList: '' },
           elements: [],
           builderHTML: '',
           container: null,
           selectedElementProperties: null,
           selectedElementType: '',
           elementsList: [
               { elment: 'div', properties: [
                   { prop: 'id' }
               ] },
               { elment: 'img', properties: [
                { prop: 'id' }
               ] },
               { elment: 'a', properties: [
                { prop: 'id' }
               ] },
               { elment: 'p', properties: [
                { prop: 'id' }
               ] },
               { elment: 'span', properties: [
                { prop: 'id' }
               ] },
               { elment: 'ul', properties: [
                { prop: 'id' }
               ] },
               { elment: 'li', properties: [
                { prop: 'id' }
               ] }
           ]
        }
    },
    mounted() {
        document.querySelectorAll('[data-tooltip]').forEach(elem => {
            new PopperToolTip(elem, {
                placement: elem.dataset.tooltipPlacement || 'top',
                title: elem.dataset.tooltip
            });
        });

        this.container = document.getElementById("builder-container");
        this.selectedElement = this.container;
        this.builderHTML = this.container.innerHTML;
       // window.vueEvents.$on('onShowCalculator', this.onShowCalculator);
    },
    methods: {
        onShowCalculator() {
/*             this.showSignupBar = false;
            this.showCalculator = true; */
        },
        removeElement() {
            this.selectedElement = this.selectedElement.parentNode;
            this.selectedElement.parentNode.removeChild( this.selectedElement );
            this.updateScreen();
        },
        updateScreen() {
            this.builderHTML = this.container.innerHTML;
        },
        onSelected(e) {
            debugger;

            this.selectedElement.classList.remove('tw-border-dashed');
            this.selectedElement.classList.remove('tw-border-red-800');
            this.selectedElement.classList.remove('tw-border-dashed');

            this.selectedElement = e.target;
            this.selectedElement.classList.add('tw-border');
            this.selectedElement.classList.add('tw-border-red-800');
            this.selectedElement.classList.add('tw-border-dashed');

            this.selectedElement.setAttribute("v-model", this.selectedElement.classList);

            // console.log('onSelected', this.selectedElement);
            this.updateScreen();

            this.selectedElementProperties = [];
            for (let prop of Object.keys( this.selectedElement )) {
                this.selectedElementProperties.push(
                    { key: prop, value: this.selectedElement[prop] }
                );
            }

        },
        selectedActionButton(e) {
            // selectedElementType
            this.selectedElement = e.currentTarget.name;
        },
        getSelectedProperties() {
            /*
           elementsList: [
               { elment: 'div', properties: [
                   { prop: 'id' }
               ] },

            */
            return _.find(this.elementsList, { element:  this.selectedElement }).properties;
        },
        addDiv() {
            this.selectedElement.classList.remove('tw-border-dashed');
            this.selectedElement.classList.remove('tw-border-red-800');
            this.selectedElement.classList.remove('tw-border-dashed');

            let newItem = document.createElement("div");
            debugger;
            newItem.classList = this.classes;
            newItem.innerHTML = 'New Item';
            this.selectedElement.appendChild( newItem );
            this.elements.push( newItem );
            this.$on( newItem, this.onSelected);
            this.updateScreen();
            this.classes = '';
        }
     },
     computed: {
         elementProperties() {
             debugger;
             if (this.selectedElementType.length > 0) {
                let data =  _.find(this.elementsList, { element:  this.selectedElementType }).properties;
                debugger;
                return data;
             }
             else {
                 return [];
             }
         }
     }
});
