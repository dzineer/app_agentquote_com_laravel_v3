import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import toastr from "toastr";
import ButtonGrid from "./ButtonGrid";
import CustomModuleButton from "../InsuranceModules/CustomModuleButton";
import SelectedButton from "./SelectedButton";

/** class NewChoiceContainer */
class NewChoiceContainer extends Component {
    constructor(props) {
        super(props);
// this.state.button_modules_rendered
        this.state = {
            button_modules: {},
            selected_button_module: { module: { module_name: false } },
            button_modules_rendered: [],
            selected_state: 'AL',
            userId: 0,
        };

        console.log("NewChoiceContainer");

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        toastr.options = {
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };

        this.addClass.bind(this);
        this.removeClass.bind(this);
        this.onNewInsureSelected.bind(this);
        this.clearSelectedInsureButtons.bind(this);
        this.getButtonDetails.bind(this);
        this.getIcon.bind(this);
        this.getUserModules.bind(this);
        this.onSelectedState.bind(this);
        this.capitalizeWords.bind(this);

        this.stateOptionsArray = this.props.states.map( item => {
            return {text: item.name, value: item.abbr}
        });

        this.stateOptions = this.stateOptionsArray.map( item => {
            return <option key={item.value+item.text} value={item.value}>{item.text}</option>
        });

        this.stateBlock = (
            <select className="form-control form-control-lg" name="state_list" id="state_list" onChange={ this.onSelectedState } >
                { this.stateOptions }
            </select>
        );

    }

    onSelectedState = (e) => {
        debugger;
        this.setState({
            selected_state: e.currentTarget.value
        });
    };

    componentDidMount() {
        debugger;

        let that = this;

        this.setState({
            userId: this.props.userId
        }, function() {
            that.getUserModules();
        });

    }

    getUserModules = () => {

        debugger;

        let url = '/api/app_module';
        let fd = new FormData();

        let options = {
            'user_id' : this.state.userId,
            'module' : 'page_choice_module'
        };

        fd.append("options" , JSON.stringify(options) );
        fd.append("action" , 'load' );

        this.preloader = $('.preloader');
        this.preloader.removeClass('loaded');

        axios.post(url, fd).then( res => {

            console.log(res);

            if (res.status === 200) {

                    let customModules = res.data.customModules;

                    this.button_modules = {};

                    let button_modules_rendered = Object.keys(customModules).map(i => customModules[i]).map((customModule) => {

                    this.button_modules[ customModule.module.module_name ] = customModule;


                    return <CustomModuleButton
                                CustomModuleName={ customModule.module.module_name }
                                onClick={ this.onNewInsureSelected }
                                UserId={ customModule.user_id }
                                key={ customModule.user_id }
                            />;
                });

                this.setState({
                    button_modules: this.button_modules,
                    button_modules_rendered: button_modules_rendered
                })

                /*                $('html,body').animate({
                                    scrollTop: $("#ads-box-container").offset().top
                                }, 'slow');*/

            }
        });

    };

    addClass = (el, classList) => {

        if (typeof el.classList === 'undefined')
            return this;

        if (classList instanceof Array) {
            classList.forEach((item, index) => {
                if (el.classList.contains(item)) {

                    el.classList.remove(item);
                    el.classList.add(item);

                } else if (el.classList.value.includes(item)) {

                    item.split(" ").forEach((i, index) => {
                        el.classList.remove(i);
                    });

                    item.split(" ").forEach((i, index) => {
                        el.classList.remove(i);
                    });

                } else {
                    item.split(" ").forEach((i, index) => {
                        el.classList.add(i);
                    });
                }

            });
        }

        return this;

    };

    removeClass = (el, classList) => {

        if (typeof el.classList === 'undefined')
            return this;

        if (classList instanceof Array) {
            classList.forEach((item, index) => {
                if (el.classList.contains(item)) {
                    el.classList.remove(item);
                } else if (el.classList.value.includes(item)) {
                    item.split(" ").forEach((i, index) => {
                        el.classList.remove(i);
                    });
                }
            });
        }

        return this;

    };

    clearSelectedInsureButtons = () => {
        this.state.insureButtonInstances.forEach((item, index) => {
            this.removeClass( item, ['selected-insure-type'] )
        });
    };

    getButtonDetails = ( button ) => {
        return {
            insureType: button.getAttribute('data-insure-type'),
            insureName: button.getAttribute('data-insure-name')
        }
    };

    getIcon = () => {
        return document.querySelector('.selected-icon');
    };

    setIcon = ( type ) => {
        debugger;
        this.removeClass( this.state.icon, this.classIconTypes )
            .addClass( this.state.icon, [this.insureTypes[type].icon] );
    };

    capitalizeWords = (text) => {

        let splitStr = text.toLowerCase().split(' ');
        for (let i = 0; i < splitStr.length; i++) {
            // You do not need to check if i is larger than splitStr length, as your for does that for you
            // Assign it back to the array
            splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
        }
        // Directly return the joined string
        return splitStr.join(' ');

    };

    onNewInsureSelected = (e) => {
        e.preventDefault();

        debugger;

        console.log( e.currentTarget.id );
        console.log( this.state.button_modules );
        // @todo: Get button pressed
        // @todo: Get button pressed instance.

        if (this.state.selected_button_module.module.module_name) {
            jQuery('.selected-btn .selected-icon').removeClass(this.state.selected_button_module.config.icon);
        }

        let selectedModule = this.state.button_modules[ e.currentTarget.id ];
        console.log( selectedModule );

        this.setState({
            selected_button_module: selectedModule
        });

        jQuery('.btn-container .select-btn').removeClass('current-selected-button');
        jQuery("#"+ e.currentTarget.id).addClass('current-selected-button');

        if ( jQuery('.selected-btn .selected-icon').hasClass( selectedModule.config.icon ) ) {
            jQuery('.selected-btn .selected-icon').removeClass( selectedModule.config.icon );
        }

        debugger;
        jQuery('.selected-btn .selected-icon').addClass( selectedModule.config.icon );

        let formLauncher = document.querySelector('.your-state-form-launcher');
        this.removeClass( formLauncher, ['show'] )
            .addClass( formLauncher, ['show'] );

        let insureHeader = document.querySelector('.insure-name');
        insureHeader.innerHTML = this.capitalizeWords(selectedModule.config.name);

        // select-btn
        // $('#term-life-widget').addClass('show');
        // $('.init-form').hide();
    };

    getModuleURL = (module_name) => {
        return module_name ? '/' + module_name.replace("_module", "") : '#';
    };


    getModuleUserId = (module_name) => {
        return this.state.selected_button_module ?
               this.state.selected_button_module.user_id : 0;
    };

    render() {

        return  (
            <div className="init-form">

                <form method="POST"
                      action={
                          this.getModuleURL( this.state.selected_button_module.module.module_name )
                      }
                >

                <input type="hidden" name="_token" value={ this.token } />
                <input type="hidden" name="user_id" value={ this.getModuleUserId() } />
                <input type="hidden" name="state" value={ this.state.selected_state } />

                <h1 id="main-header">
                        <span className="text-container">
                            { this.props.title }
                        </span>
                </h1>

                <div id="header-items">

                    <img id="pointer-image" src="/templates/landing-pages/v1/images/women_pointing_right.png"
                         alt="Woman pointing right" />

                        <div className="controls-container">

                            <ButtonGrid parentClass="control-select">
                                { this.state.button_modules_rendered }
                            </ButtonGrid>

                            <div className="control-selected">

                                <SelectedButton containerId="selected-insurance-btn-container" containerClass="btn-container" />

                            </div>

                            <div className="your-state-form-launcher your-state-form-launcher-lg">
                                <div className="get-started-container">
                                    <h3 className="get-started col-md-12">
                                        Get started with your insurance quote by
                                        providing your state below:
                                    </h3>
                                    <div id="get-started-form-lg" className="get-started-form-container">
                                        <div>
                                            { this.stateBlock }
                                        </div>
                                        <div>
                                            <input className="btn btn-primary  start-quote-btn" type="submit" value="Start" />
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div className="your-state-form-launcher your-state-form-launcher-sm">
                            <div>
                                <h3 className="get-started">
                                    Get started with your insurance quote by
                                    providing your state below:
                                </h3>

                                <div className="form-group">
                                    { this.stateBlock }
                                </div>

                                <div className="form-group">
                                    <input className="btn btn-primary w-100 start-quote-btn" type="submit" value="Start" />
                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>
        );
    }
}

NewChoiceContainer.propTypes = {
    states: PropTypes.array.isRequired,
    title: PropTypes.string,
    userId: PropTypes.number,
};

NewChoiceContainer.defaultProps = {
    states: [],
    title: 'Choose Your Insurance',
    userId: 0
};

export default NewChoiceContainer;

if (document.getElementById('choice-widget')) {
    render(
        <NewChoiceContainer states={ statesArray } userId={ user_id } />,
        document.getElementById('choice-widget')
    );
}
