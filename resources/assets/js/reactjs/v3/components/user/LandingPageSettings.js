import React, { Component } from 'react';
import PropTypes from 'prop-types';
import TextInput from '../TextInput';
import SelectInput from '../SelectInput';
import LogoField from './LogoField';
import LogoFieldWithImage from './LogoFieldWithImage';
import PortraitField from './PortraitField';
import MultiContentForm from "../common/MultiContentForm";
import AccountInfo from "./AccountInfo";
import ReactDom from "react-dom";
import toastr from 'toastr';
import Portrait from "../Portrait";
import Logo from "../Logo";
import Header from "../Header";
import TextArea from "../TextArea";

/** function: LandingPageSettings */
class LandingPageSettings extends Component {

    constructor(props) {
        super(props);
        this.state = {
            error: "",
            product: {
                product_category: 1
            },
            analytics: {
                ga_code: ''
            },
            profile: {
                logo: null,
                portrait: null,
                company: '',
                position_title: '',
                contact_email: '',
                contact_phone: '',
                contact_addr1: '',
                contact_addr2: '',
                contact_city: '',
                contact_state: '',
                contact_zipcode: '',
                facebook_link: '',
                twitter_link: '',
                youtube_link: '',
                linkedin_link: '',
                instagram_link: ''
            },
            submit: {
                disabled: false,
                caption: 'Save',
                normal: 'Save',
                onSave: 'Saving...'
            }
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

        this.selectedState = this.stateOptions.filter( item => {
           return item.value === this.state.profile.contact_state
        });

        this.pageCategoryOptions = [];
        this.currentPageCategory = {};

        this.userId = user_id;
        this.token = jQuery('meta[name="csrf-token"]').attr('content');
        this.errors = {};
        this.style = {
            for: {
                image: {border: "none" },
            }
        };
        this.styles = {
            portrait: {
                for: {
                    image: {
                        width: "168px", maxWidth: '100%'
                    }
                }
            },
            logo: {
                for: {
                    image: {
                        width: "168px", maxWidth: '100%'
                    }
                }
            }
        };

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };

        this.onRemoveLogo.bind(this);
        this.onAnalyticsChange.bind(this);
        this.onRemovePortrait.bind(this);
        this.onSelectedDefaultProductHandler.bind(this);

    }

    onSelectedHandler = event => {
        debugger;
        console.log(event.target.value);
        let newState = Object.assign({}, this.state.profile);
        newState[event.target.name] = event.target.value;
        this.setState({ profile: newState });
    };

    onSelectedDefaultProductHandler = event => {
        debugger;
        console.log(event.target.value);
/*         let newState = Object.assign({}, this.state.product);
        newState[event.target.name] = event.target.value; */
        this.setState({ product: { product_category: event.target.value } });
    };

    onRemoveLogo = event => {
        event.preventDefault();

        let profile = Object.assign({}, this.state.profile );
        profile.logo = null;

        this.setState({ profile });

    };

    onRemovePortrait= event => {
        event.preventDefault();

        let profile = Object.assign({}, this.state.profile );
        profile.portrait = null;

        this.setState({ profile });

    };

    onFileAddedHandler = event => {
        console.log(event.target.value);
        let newState = Object.assign({}, this.state.profile);
        newState[event.target.name] = event.target.files[0];
        this.setState({ profile: newState });

    };

    onChange = event => {
        let newState = Object.assign({}, this.state.profile);
        newState[event.target.name] = event.target.value;
        this.setState({ profile: newState });
    };

    onAnalyticsChange = event => {
        let newState = Object.assign({}, this.state);
        debugger;
        newState.analytics.ga_code = event.target.value;
        this.setState(newState);
    };

    getProfile = () => {
        axios.get('/landing-page/user/' + this.userId + '/profile').then( res => {
            console.log("data: ", res);
            this.setState({
                profile: res.data
            });
            // debugger;
        }).catch( error => {
            console.log(error);
            this.setState({
                error: error
            });
        });
    };

    componentDidMount() {
        console.log("Component Did Mount");
        this.getProfile();
        this.pageCategoryOptions = this.props.pageCategories.map( item => {
            debugger;
            return  {text: item.category, value: item.id }
        });
        this.currentPageCategory = this.props.currentPageCategory;
        let newState = Object.assign({}, this.state);
        newState.product_category =  this.currentPageCategory.category_id;
        newState.analytics.ga_code = this.props.ga_code;

        this.setState(newState);
    }

    updateProfileDetails = () => {

        const fd = new FormData();

        if (this.state.profile.logo !== null && typeof this.state.profile.logo !== 'string') {
            fd.append('logo', this.state.profile.logo, this.state.profile.logo.name);
        }
        else { // if it is not a logo it is an empty string which means it has been removed.
            fd.append('logo', this.state.profile.logo);
        }

        if (this.state.profile.portrait !== null && typeof this.state.profile.portrait !== 'string') {
            fd.append('portrait', this.state.profile.portrait, this.state.profile.portrait.name);
        }
        else { // if it is not a logo it is an empty string which means it has been removed.
            fd.append('portrait', this.state.profile.portrait);
        }

/*        if (! (this.state.profile.logo || this.state.profile.portrait)) {
            toastr.error('You must provide either a logo or a portrait file to update');
            return;
        }*/

        if (this.state.profile.company && this.state.profile.company) {
            fd.append('company', this.state.profile.company);
        }

        if (this.state.profile.position_title && this.state.profile.position_title.length) {
            fd.append('position_title', this.state.profile.position_title);
        }

        if (!this.state.profile.contact_email.length) {
            toastr.error('You must provide an email address');
            return;
        } else {
            fd.append('contact_email', this.state.profile.contact_email);
        }

        if (this.state.profile.contact_phone && this.state.profile.contact_phone.length) {
            fd.append('contact_phone', this.state.profile.contact_phone);
        }

        if (this.state.profile.contact_addr1 && this.state.profile.contact_addr1.length) {
            fd.append('contact_addr1', this.state.profile.contact_addr1);
        }

        if (this.state.profile.contact_addr2 && this.state.profile.contact_addr2.length) {
            fd.append('contact_addr2', this.state.profile.contact_addr2);
        }

        if (this.state.profile.contact_city && this.state.profile.contact_city.length) {
            fd.append('contact_city', this.state.profile.contact_city);
        }

        if (this.state.profile.contact_state && this.state.profile.contact_state.length) {
            fd.append('contact_state', this.state.profile.contact_state);
        }

        if (this.state.profile.contact_zipcode && this.state.profile.contact_zipcode.length) {
            fd.append('contact_zipcode', this.state.profile.contact_zipcode);
        }

        debugger;

        fd.append('facebook_link', this.state.profile.facebook_link);
        fd.append('twitter_link', this.state.profile.twitter_link);
        fd.append('youtube_link', this.state.profile.youtube_link);
        fd.append('linkedin_link', this.state.profile.linkedin_link);
        fd.append('instagram_link', this.state.profile.instagram_link);

        fd.append('product_category', this.state.product.product_category);
        fd.append('ga_code', this.state.analytics.ga_code);

        if (this.state.profile.contact_state.length) {
            // already exists
            fd.append('_method', 'PUT');
            this.setState({
                submit: Object.assign({}, this.state.submit, {caption: this.state.submit.onSave, disabled: true})
            });

            axios.post('/landing-page/user/' + this.userId + '/profile', fd).then( res => {
                console.log(res);

                setTimeout(
                    function() {
                        this.setState({
                            submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                        });
                        window.location.reload();
                    }
                        .bind(this),
                    1200
                );

                if (res.data.success) {
                    toastr.success(res.data.message);
                } else {
                    toastr.error(res.data.message);
                }
            }).catch( error => {
                setTimeout(
                    function() {
                        this.setState({
                            submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                        });


                    }
                        .bind(this),

                    1200
                );
                console.log(error);
                toastr.error(error);
            });
        } else {
            this.setState({
                submit: Object.assign({}, this.state.submit, {caption: this.state.submit.onSave, disabled: true})
            });
            axios.post('/user/' + this.userId + '/profile', fd).then( res => {
                setTimeout(
                    function() {

                        this.setState({
                            submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                        });

                        window.location.reload();

                    }
                        .bind(this),
                    1200
                );
                console.log(res);
            }).catch( error => {
                setTimeout(
                    function() {
                        this.setState({
                            submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                        });
                    }
                        .bind(this),
                    1200
                );
                console.log(error);
            });
        }

    };

    updateProfile = event => {
        console.log(event);
        event.preventDefault();
        this.updateProfileDetails();
    };

    render() {

        const styles = {
            for: {
                field: {
                    spacing: {
                        marginBottom: '20px'
                    }
                }
            }
        };

        debugger;

        let displayLogo = typeof this.state.profile.logo !== 'undefined' && this.state.profile.logo !== null ? this.state.profile.logo : '/storage/landing-pages/defaults/no-logo.png';
        let displayPortrait = typeof this.state.profile.portrait !== 'undefined' && this.state.profile.portrait !== null ? this.state.profile.portrait : '/storage/landing-pages/defaults/no-portrait.png';

        return (

                <MultiContentForm name="landing-page-profile-form" onClick={this.updateProfile} buttonCaption={this.state.submit.caption} buttonState={this.state.submit.disabled} >

                    <div className="row">

                        <div className="col-md-12">

                            <div className="row">

                                <div className="col-md-12 p-y-4">
                                    <h3>Basic Profile</h3>
                                </div>

                                <div className="col-md-3 p-y-4">

                                    <TextInput
                                        name="company"
                                        label="Company"
                                        value={this.state.profile.company}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />

                                </div>

                                <div className="col-md-3 p-y-4">
                                    <TextInput
                                        name="position_title"
                                        label="Position"
                                        value={this.state.profile.position_title}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                                <div className="col-md-3 p-y-4">
                                    <TextInput
                                        name="contact_email"
                                        label="Email"
                                        value={this.state.profile.contact_email}
                                        required={true}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                                <div className="col-md-3 p-y-4">
                                    <TextInput
                                        name="contact_phone"
                                        label="Phone"
                                        value={this.state.profile.contact_phone}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                                <div className="col-md-3 p-y-4">
                                    <TextInput
                                        name="contact_addr1"
                                        label="Address 1"
                                        value={this.state.profile.contact_addr1}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                                <div className="col-md-3 p-y-4">
                                    <TextInput
                                        name="contact_addr2"
                                        label="Address 2"
                                        value={this.state.profile.contact_addr2}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                                <div className="col-md-3 p-y-4">
                                    <TextInput
                                        name="contact_city"
                                        label="City"
                                        value={this.state.profile.contact_city}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                                <div className="col-md-3 p-y-4">
                                    <SelectInput
                                        name="contact_state"
                                        label="State"
                                        defaultValue={this.state.profile.contact_state}
                                        required
                                        options={this.stateOptions}
                                        onChange={this.onSelectedHandler}
                                    />
                                </div>

                                <div className="col-md-3 p-y-4">
                                    <TextInput
                                        name="contact_zipcode"
                                        label="Zip code"
                                        value={this.state.profile.contact_zipcode}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                            </div>

                        </div>

                        <div className="col-md-12">

                            <div className="row">

                                <div className="col-md-12 p-y-4">
                                    <h4>Defaults</h4>
                                </div>

                                <div className="col-md-4 p-y-4">
                                    <SelectInput
                                        name="product_category"
                                        label="Display as default home page"
                                        defaultValue={this.state.product.product_category}
                                        required
                                        options={this.pageCategoryOptions}
                                        onChange={this.onSelectedDefaultProductHandler}
                                    />
                                </div>


                            </div>

                        </div>

                        <div className="col-md-12">

                            <div className="row">

                                <div className="col-md-12 p-y-6">
                                    <h4>Logo / Portrait</h4>
                                </div>

                                <div className="col-md-4 p-y-4">

                                    <LogoFieldWithImage name="logo" error="" label="Logo" dimensions={{height: '100px', width: '200px'}} onChange={this.onFileAddedHandler} style={this.style} path={ displayLogo } onRemoveImage={ this.onRemoveLogo } using={ this.state.profile.logo !== null } note="Image should be no more than 60 pixels high and 200 pixels wide." />

                                </div>

                                <div className="col-md-4 p-y-4">

                                    <LogoFieldWithImage name="portrait" error="" label="Portrait" dimensions={{height: '100px', width: '100px'}} onChange={this.onFileAddedHandler} style={this.style} path={ displayPortrait } onRemoveImage={ this.onRemovePortrait } using={ this.state.profile.portrait !== null } note="Image should be no more than 100 pixels high and 200 pixels wide." />

                                </div>

                            </div>

                        </div>

                        <div className="col-md-12">

                            <div className="row">

                                <div className="col-md-12 p-y-4">
                                    <h4>Social Media Links</h4>
                                </div>

                                <div className="col-md-4 p-y-4">
                                    <TextInput
                                        name="facebook_link"
                                        label="Facebook"
                                        value={this.state.profile.facebook_link}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                                <div className="col-md-4 p-y-4">
                                    <TextInput
                                        name="twitter_link"
                                        label="Twitter"
                                        value={this.state.profile.twitter_link}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                                <div className="col-md-4 p-y-4">
                                    <TextInput
                                        name="youtube_link"
                                        label="YouTube"
                                        value={this.state.profile.youtube_link}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                                <div className="col-md-4 p-y-4">
                                    <TextInput
                                        name="linkedin_link"
                                        label="LinkedIn"
                                        value={this.state.profile.linkedin_link}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                                <div className="col-md-4 p-y-4">
                                    <TextInput
                                        name="instagram_link"
                                        label="Instagram"
                                        value={this.state.profile.instagram_link}
                                        required={false}
                                        onChange={this.onChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>

                            </div>
                        </div>


                        <div className="col-md-12">

                            <div className="row">

                                <div className="col-md-12 p-y-4">
                                    <h4>Search Engine Optimization</h4>
                                </div>

                                <div className="col-md-4 p-y-4">
                                    <TextInput
                                        name="ga_code"
                                        label="Google Analytic's Tracking ID"
                                        value={this.state.analytics.ga_code}
                                        required={false}
                                        onChange={this.onAnalyticsChange}
                                        styles={styles.for.field.spacing}
                                    />
                                </div>


                            </div>
                        </div>


                </div>

            </MultiContentForm>


        );
    }
}

LandingPageSettings.propTypes = {
    pageCategories: PropTypes.array.isRequired,
    currentPageCategory: PropTypes.object.isRequired,
    ga_code: PropTypes.string
};

LandingPageSettings.defaultProps = {
    pageCategories: [],
    currentPageCategory: {},
    ga_code: ''
};

export default LandingPageSettings;

if (document.getElementById('landing-page-profile')) {
    ReactDom.render(<LandingPageSettings pageCategories={pageCategories} currentPageCategory={currentPageCategory} ga_code={ga_code} />,
        document.getElementById('landing-page-profile')
    );
}
