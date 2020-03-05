import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import TermLifeBanner from './TermLifeBanner';
import SitBanner from "./SitBanner";
import SiwlBanner from "./SiwlBanner";
import GULBanner from "./GulBanner";

/** function: BannerContainer */
class BannerContainer extends Component {
    constructor(props) {
        super(props);
        this.banner = '';
        this.eventArray = [];
        this.resultsContainer = '#quote-results';
        this.state = {
            loading: false,
            quoteContainer: '',
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

    }

    componentDidMount() {
        console.log('[Component Did Mount]', 'I mounted');

        if (this.props.bannerType === 'termlife') {
            this.setState({ quoteContainer: <TermLifeBanner statesArr={this.stateOptions} /> });
        } else if (this.props.bannerType === 'sit') {
            this.setState({ quoteContainer: <SitBanner statesArr={this.stateOptions} /> });
        } else if (this.props.bannerType === 'siwl') {
            this.setState({ quoteContainer: <SiwlBanner statesArr={this.stateOptions} /> });
        } /*else if (this.props.bannerType === 'gul') {
            this.setState({ quoteContainer: <GULBanner statesArr={this.stateOptions} /> });
        }*/

        addEventListener("menuOnClick", this.onMenuClick);
        setTimeout(() => this.setState({ loading: false }), 1500); // simulates an async action, and hides the spinner
    }

    onMenuClick = event => {
        switch( event.target.name ) {
            case 'termlife_menu_item':
               this.setState({ quoteContainer: <TermLifeBanner statesArr={this.stateOptions} /> });
               break;
            case 'sit_menu_item':
                this.setState({ quoteContainer: <SitBanner statesArr={this.stateOptions} /> });
                break;
            case 'siwl_menu_item':
                this.setState({ quoteContainer: <SiwlBanner statesArr={this.stateOptions} /> });
                break;
            case 'gul_menu_item':
                this.setState({ quoteContainer: <GULBanner statesArr={this.stateOptions} /> });
                break;

            default:
        }
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
            <div>
                { this.state.quoteContainer }
            </div>
        );
    }
}

BannerContainer.propTypes = {
    bannerType: PropTypes.string.isRequired
};

BannerContainer.defaultProps = {
  bannerType: 'termlife'
};

export default BannerContainer;

if (document.getElementById('banner')) {
    render(
        <BannerContainer />,
        document.getElementById('banner')
    );
}

