import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import toastr from "toastr";
import UserInsuranceModule from "../InsuranceModules/UserInsuranceModule";

/** class ChoiceContainer */
class ChoiceContainer extends Component {
    constructor(props) {
        super(props);

        this.state = {
            insureButtonInstances: [],
            insure_module: '',
            insurance_modules: [],
            icon: null,
            fields: {
                state: ''
            },
            classIconTypes: [],
            insureTypes: []
        };

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
        this.onInsureSelected.bind(this);
        this.clearSelectedInsureButtons.bind(this);
        this.getButtonDetails.bind(this);
        this.getIcon.bind(this);
        this.setInsureSelected.bind(this);
        this.setInsureButton.bind(this);
        this.getUserModules.bind(this);

        this.stateOptionsArray = this.props.states.map( item => {
            return {text: item.name, value: item.abbr}
        });

        this.stateOptions = this.stateOptionsArray.map( item => {
            return <option key={item.value+item.text} value={item.value}>{item.text}</option>
        });

        this.stateBlock = (
            <select className="form-control form-control-lg" name="state" id="state" >
                { this.stateOptions }
            </select>
        );

        this.classIconTypes = [
          'fa-home',
          'fa-umbrella'
        ];

        this.insureTypes = {
            underwritten: {
                icon: 'fa-home'
            },
            finalExpense: {
                icon: 'fa-umbrella'
            }
        }

    }

    componentDidMount() {
        debugger;
        this.setState({
            insureButtonInstances: document.querySelectorAll(
                '#underwritten-btn, #final-expense-btn'
            ),
            insureButtons: {
                underwritten: document.querySelectorAll(
                    '#underwritten-btn'
                ),
                finalExpense: document.querySelectorAll(
                    '#final-expense-btn'
                )
            },
            icon: this.getIcon()
        });

        this.getUserModules();

    }

    getUserModules = () => {

        let fd = new FormData();

        let url = '/api/user/custom_modules/47?module_type=insurance_module';

        axios.get(url).then( res => {

            console.log(res);

            if (res.statusText === "OK") {

                let customModules = res.data.customModules;

                this.classIconTypes = [];
                this.insureTypes = {};

        /*
            this.classIconTypes = [
              'fa-home',
              'fa-umbrella'
            ];

            this.insureTypes = {
                underwritten: {
                    icon: 'fa-home'
                },
                finalExpense: {
                    icon: 'fa-umbrella'
                }
            }
            */
                let modules_rendered = customModules.map((customModule) => {
                    debugger;

                    this.insureTypes[ customModule.module.module_name ] = {
                        icon: customModule.config.icon
                    };

                    this.classIconTypes.push(
                        customModule.config.icon
                    );
                    debugger;
                    return <UserInsuranceModule
                                CustomModuleName={ customModule.module.module_name }
                                onClick={this.onInsureSelected}
                                UserId={ customModule.user_id }
                            />;
                });

                this.setState({
                    insurance_modules: modules_rendered
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

    setInsureButton = ( insureType ) => {

        debugger;

        if (insureType === 'termlife_module') {
            this.setIcon( insureType );
            this.clearSelectedInsureButtons();
            this.removeClass( this.state.insureButtons.underwritten, ['selected-insure-type'] ).addClass( this.state.insureButtons.underwritten, ['selected-insure-type'] );

            this.setState({
                insure_module: 'underwritten'
            });

            return true;
        } else if (insureType === 'f') {
            this.setIcon(insureType);
            this.clearSelectedInsureButtons();
            this.removeClass( this.state.insureButtons.finalExpense, ['selected-insure-type'] ).addClass( this.state.insureButtons.finalExpense, ['selected-insure-type'] );

            this.setState({
                insure_module: 'fe'
            });

            return true;
        }

        return false;

    };

    setInsureSelected = ( button ) => {

        let buttonDetails = this.getButtonDetails( button );
        let insureHeader = document.querySelector('.insure-name');

        if (this.setInsureButton(buttonDetails.insureType)) {
            let formLauncher = document.querySelector('.name-form-launcher');
            this.removeClass( formLauncher, ['show'] )
                .addClass( formLauncher, ['show'] );
            insureHeader.innerHTML = buttonDetails.insureName;
        }

    };

    onInsureSelected = (e) => {
        debugger;
        e.preventDefault();
        console.log(e.currentTarget);
        debugger;
        this.setInsureSelected(  e.currentTarget );

        // select-btn
       // $('#term-life-widget').addClass('show');
       // $('.init-form').hide();
    };

    render() {


        {/*<input type="text" id="start_quote_name_lg" className="form-control start_quote_name"
                                                   placeholder="John Doe" />*/}


        return (
            <div className="init-form">

                <form method="POST" action={ '/' + this.state.insure_module }>

                    <input type="hidden" name="_token" value={ this.token } />

                <h1 id="main-header">
                        <span className="text-container">
                            Choose Your Insurance
                        </span>
                </h1>

                <div id="header-items">

                    <img id="pointer-image" src="/templates/landing-pages/v1/images/women_pointing_right.png"
                         alt="Woman pointing right" />

                        <div className="controls-container">
                            <div className="control-select">

                                { this.state.insurance_modules }

                                {/*<div id="underwritten-btn-container" className="btn-container"
                                     data-start-field="#start_quote_name_lg">
                                    <div id="underwritten-btn" className="select-btn" data-insure-type={'u'} data-insure-name={'Underwritten Term'} onClick={this.onInsureSelected}>
                                        <i className="fa fa-home fa-2" aria-hidden="true" />
                                    </div>
                                    <h4>
                                        Term Life
                                    </h4>
                                </div>

                                <div id="final-expense-btn-container" className="btn-container"
                                     data-start-field="#start_quote_name_lg">
                                    <div id="final-expense-btn" className="select-btn" data-insure-type={'f'} data-insure-name={'Final Expense'}  onClick={this.onInsureSelected}>
                                        <i className="fa fa-umbrella fa-2" aria-hidden="true" />
                                    </div>
                                    <h4>
                                        Final Expense
                                    </h4>
                                </div>*/}

                            </div>
                            <div className="control-selected">

                                <div id="selected-insurance-btn-container" className="btn-container">
                                    <div id="selected-insurance-btn" className="selected-btn">
                                        <i className="fa fa-2 selected-icon"  aria-hidden="true" />
                                    </div>
                                    <h4 className="insure-name">
                                        No selection.
                                    </h4>
                                </div>

                            </div>

                            <div className="name-form-launcher name-form-launcher-lg">
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

                        <div className="name-form-launcher name-form-launcher-sm">
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

ChoiceContainer.propTypes = {
    states: PropTypes.array.isRequired
};

ChoiceContainer.defaultProps = {
    states: []
};

export default ChoiceContainer;

if (document.getElementById('choice-widget')) {
    render(
        <ChoiceContainer states={ statesArray } />,
        document.getElementById('choice-widget')
    );
}
