import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import TermlifeForm from './TermlifeForm';
import CustomerDetails from "./CustomerDetails";
import SitForm from "./SitForm";
import SiwlForm from "./SiwlForm";

/** function: QuoterContainer */
class QuoterContainer extends Component {
    constructor(props) {
        super(props);
        this.banner = '';
        this.eventArray = [];
        this.resultsContainer = '#quote-results';
        this.state = {
            loading: false,
            quoteContainer: '',
            menu: {
                active: 'btn-primary',
                notActive: 'btn-secondary',
                settings: 'btn-secondary',
                term: 'btn-primary',
                sit: 'btn-secondary',
                siwl: 'btn-secondary'
            },
            quoteModuleState: {
                capturedState: {
                    termlife: null,
                    fe: null,
                    si: null
                }
            },
            capturedState: null
        };

        this.statesArray = [
            {
                "name": "Alabama",
                "abbr": "AL"
            },
            {
                "name": "Alaska",
                "abbr": "AK"
            },
            {
                "name": "Arizona",
                "abbr": "AZ"
            },
            {
                "name": "Arkansas",
                "abbr": "AR"
            },
            {
                "name": "California",
                "abbr": "CA"
            },
            {
                "name": "Colorado",
                "abbr": "CO"
            },
            {
                "name": "Connecticut",
                "abbr": "CT"
            },
            {
                "name": "Delaware",
                "abbr": "DE"
            },
            {
                "name": "District Of Columbia",
                "abbr": "DC"
            },
            {
                "name": "Federated States Of Micronesia",
                "abbr": "FM"
            },
            {
                "name": "Florida",
                "abbr": "FL"
            },
            {
                "name": "Georgia",
                "abbr": "GA"
            },
            {
                "name": "Guam",
                "abbr": "GU"
            },
            {
                "name": "Hawaii",
                "abbr": "HI"
            },
            {
                "name": "Idaho",
                "abbr": "ID"
            },
            {
                "name": "Illinois",
                "abbr": "IL"
            },
            {
                "name": "Indiana",
                "abbr": "IN"
            },
            {
                "name": "Iowa",
                "abbr": "IA"
            },
            {
                "name": "Kansas",
                "abbr": "KS"
            },
            {
                "name": "Kentucky",
                "abbr": "KY"
            },
            {
                "name": "Louisiana",
                "abbr": "LA"
            },
            {
                "name": "Maine",
                "abbr": "ME"
            },
            {
                "name": "Maryland",
                "abbr": "MD"
            },
            {
                "name": "Massachusetts",
                "abbr": "MA"
            },
            {
                "name": "Michigan",
                "abbr": "MI"
            },
            {
                "name": "Minnesota",
                "abbr": "MN"
            },
            {
                "name": "Mississippi",
                "abbr": "MS"
            },
            {
                "name": "Missouri",
                "abbr": "MO"
            },
            {
                "name": "Montana",
                "abbr": "MT"
            },
            {
                "name": "Nebraska",
                "abbr": "NE"
            },
            {
                "name": "Nevada",
                "abbr": "NV"
            },
            {
                "name": "New Hampshire",
                "abbr": "NH"
            },
            {
                "name": "New Jersey",
                "abbr": "NJ"
            },
            {
                "name": "New Mexico",
                "abbr": "NM"
            },
            {
                "name": "New York",
                "abbr": "NY"
            },
            {
                "name": "North Carolina",
                "abbr": "NC"
            },
            {
                "name": "North Dakota",
                "abbr": "ND"
            },
            {
                "name": "Northern Mariana Islands",
                "abbr": "MP"
            },
            {
                "name": "Ohio",
                "abbr": "OH"
            },
            {
                "name": "Oklahoma",
                "abbr": "OK"
            },
            {
                "name": "Oregon",
                "abbr": "OR"
            },
            {
                "name": "Pennsylvania",
                "abbr": "PA"
            },
            {
                "name": "Puerto Rico",
                "abbr": "PR"
            },
            {
                "name": "Rhode Island",
                "abbr": "RI"
            },
            {
                "name": "South Carolina",
                "abbr": "SC"
            },
            {
                "name": "South Dakota",
                "abbr": "SD"
            },
            {
                "name": "Tennessee",
                "abbr": "TN"
            },
            {
                "name": "Texas",
                "abbr": "TX"
            },
            {
                "name": "Utah",
                "abbr": "UT"
            },
            {
                "name": "Vermont",
                "abbr": "VT"
            },
            {
                "name": "Virgin Islands",
                "abbr": "VI"
            },
            {
                "name": "Virginia",
                "abbr": "VA"
            },
            {
                "name": "Washington",
                "abbr": "WA"
            },
            {
                "name": "West Virginia",
                "abbr": "WV"
            },
            {
                "name": "Wisconsin",
                "abbr": "WI"
            },
            { "name": "Wyoming", "abbr": "WY" }
        ];

        this.stateOptions = this.statesArray.map( item => {
            return {text: item.name, value: item.abbr}
        });

        console.log("State Options: ", this.stateOptions);

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        this.axios_instance = axios.create();
        delete this.axios_instance.defaults.headers.common['X-CSRF-TOKEN'];

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };

        this.setCapturedState.bind(this);

    }

    componentDidMount() {
        console.log('[Component Did Mount]', 'I mounted');
        let newState = Object.assign({}, this.state);
        newState.quoteContainer = <TermlifeForm statesArr={this.stateOptions} capturedState={ this.state.capturedState } onStateChange={ this.setCapturedState } />;
        this.setState(newState);
        addEventListener("menuOnClick", this.onMenuClick);//
//        setTimeout(() => this.setState({ loading: false }), 1500); // simulates an async action, and hides the spinner
    }

    setCapturedState = (mod, cs) => {

      let quoteModuleState = Object.assign({}, this.state.quoteModuleState );
      quoteModuleState[ mod ] = cs;
      this.setState({
          quoteModuleState
      }, function() {
          console.log( this.state.quoteModuleState );
      });
    };

    onMenuClick = event => {

        let newState = Object.assign({}, this.state);
        newState.menu.term = this.state.menu.notActive;
        newState.menu.sit = this.state.menu.notActive;
        newState.menu.siwl = this.state.menu.notActive;

        switch( event.target.name ) {
            case 'termlife_menu_item':
                newState.quoteContainer = <TermlifeForm statesArr={this.stateOptions} capturedState={ this.state.quoteModuleState.termlife } onStateChange={ this.setCapturedState } />;
                newState.menu.term = this.state.menu.active;
                $('.quote-results').hide();
                $('#termlife-quote-results').show();
                break;
            case 'sit_menu_item':
                newState.quoteContainer = <SitForm statesArr={this.stateOptions} capturedState={ this.state.quoteModuleState.sit } onStateChange={ this.setCapturedState } />;
                newState.menu.sit = this.state.menu.active;
                $('.quote-results').hide();
                $('#sit-quote-results').show();
                break;
            case 'siwl_menu_item':
                newState.quoteContainer = <SiwlForm statesArr={this.stateOptions} capturedState={ this.state.quoteModuleState.fe } onStateChange={ this.setCapturedState } />;
                newState.menu.siwl = this.state.menu.active;
                $('.quote-results').hide();
                $('#fe-quote-results').show();
                break;
/*            case 'gul_menu_item':
                this.setState({ quoteContainer:  <TermlifeForm statesArr={this.stateOptions} capturedState={ this.state.capturedState } onStateChange={ this.setCapturedState } /> });
                $('.quote-results').hide();
                $('#gul-quote-results').show();
                break;*/

            default:
        }

        this.setState(newState);
    };

    render() {
        const { loading } = this.state;
        if(loading) { // if your component doesn't have to wait for an async action, remove this block
            return null; // render null when app is not ready
        }

        if (this.state.quoteContainer === '') {
            return null;
        }

        return (
            <div className="row">

                <div className="col-md-12 quote-menu mb-3">
                    {/*                    <div className="btn-group float-left" role="group" aria-label="Insurance Category Settings">
                        <a className={"nav-link btn " + this.state.menu.settings } name="termlife_menu_item_settings" id="termlife_menu_item_settings" href="#" data-toggle="active" onClick={this.onMenuClick}>Settings</a>
                    </div>*/}
                    <div className="btn-group float-right" role="group" aria-label="Insurance Categories">
                        <a className={"nav-link btn " + this.state.menu.term } name="termlife_menu_item" id="termlife_menu_item" href="#" data-toggle="active" onClick={this.onMenuClick}>Term Life</a>
                        <a className={"nav-link btn " + this.state.menu.sit} name="sit_menu_item" id="sit_menu_item" href="#" data-toggle="active" onClick={this.onMenuClick}>SI Term</a>
                        <a className={"nav-link btn " + this.state.menu.siwl} name="siwl_menu_item" id="siwl_menu_item" href="#" data-toggle="active" onClick={this.onMenuClick}>FE/SIWL</a>
                    </div>
                </div>

                {/*                <div className="col-md-6 mb-3">
                    <div className="card">
                        <div className="card-body">
                            <CustomerDetails />
                        </div>
                    </div>
                </div>*/}

                <div className="col-lg-5 col-md-12 col-xs-12 quote-box-container mb-3">
                    <div className="card">
                        <div className="card-body">
                            { this.state.quoteContainer }
                        </div>
                    </div>
                </div>

{/*                <div id="ads-box-container" className="col-md-12 quote-box-container mb-3">
                    <div className="card">
                        <div className="card-body">
                            <div id="ad-container"></div>
                        </div>
                    </div>ß
                </div>*/}

                <div id="quote-results-container" className="col-lg-7 col-md-12 col-sm-12 quote-box-container mb-3">
                    <div className="card">
                        <div className="card-body quote-body-results-container">
                            <h4 className="heading-info" style={{ marginBottom: '20px' }}>Quote Results</h4>
                            <div id="termlife-quote-results" className="quote-results"></div>
                            <div id="sit-quote-results" className="quote-results"></div>
                            <div id="fe-quote-results" className="quote-results"></div>
                        </div>
                    </div>
                </div>

            </div>
        );
    }
}

QuoterContainer.propTypes = {
    bannerType: PropTypes.string.isRequired
};

QuoterContainer.defaultProps = {
    bannerType: 'termlife'
};

export default QuoterContainer;

if (document.getElementById('quoter-container')) {
    render(
        <QuoterContainer />,
        document.getElementById('quoter-container')
    );
}
