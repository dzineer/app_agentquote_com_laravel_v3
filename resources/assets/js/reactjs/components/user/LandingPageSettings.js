import React, { Component } from 'react';
import PropTypes from 'prop-types';
import TextInput from '../TextInput';
import SelectInput from '../SelectInput';
import LogoField from './LogoField';
import PortraitField from './PortraitField';
import MultiContentForm from "../common/MultiContentForm";
import AccountInfo from "./AccountInfo";
import ReactDom from "react-dom";
import toastr from 'toastr';
import Portrait from "../Portrait";
import Logo from "../Logo";
import Header from "../Header";

/** function: LandingPageSettings */
class LandingPageSettings extends Component {

    constructor(props) {
        super(props);
        this.state = {
            error: "",

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
    }

    onSelectedHandler = event => {
        debugger;
        console.log(event.target.value);
        let newState = Object.assign({}, this.state.profile);
        newState[event.target.name] = event.target.value;
        this.setState({ profile: newState });
    };

    onFileAddedHandler = event => {
        debugger;
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

    getProfile = () => {
        axios.get('/landing-page/user/' + this.userId + '/profile').then( res => {
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
    }

    updateProfile = event => {
        console.log(event);
        event.preventDefault();
        const fd = new FormData();

        if (typeof this.state.profile.logo !== 'string') {
            fd.append('logo', this.state.profile.logo, this.state.profile.logo.name);
        }

/*        if (typeof this.state.profile.portrait !== 'string') {
            fd.append('portrait', this.state.profile.portrait, this.state.profile.portrait.name);
        }*/

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
                    toastr.warning("some issue!");
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
                toastr.error("something went wrong");
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
                                    <h3>Site Identity</h3>
                                </div>

                                <div className="col-md-6 p-y-4">
                                    <img name="profile-logo" src={ displayLogo } style={this.styles.logo.for.image} alt='[Website Logo]' />
                                    <LogoField errors={this.errors} onChange={this.onFileAddedHandler} style={this.style} />
                                </div>

                                <div className="col-md-6 p-y-4">
                                    <img onChange={this.onSelectedHandler} style={this.styles.portrait.for.image} alt='[Profile portrait]'/>
                                    <PortraitField errors={this.errors} onChange={this.onFileAddedHandler} style={this.style} />
                                </div>

                            </div>

                        </div>

                        <div className="col-md-12">

                            <div className="row">

                                <div className="col-md-12 p-y-4">
                                    <h3>Social Media Links</h3>
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

                </div>

            </MultiContentForm>


        );
    }
}

LandingPageSettings.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

LandingPageSettings.defaultProps = {
    //myProp: val
};

export default LandingPageSettings;

if (document.getElementById('landing-page-profile')) {
    ReactDom.render(<LandingPageSettings />,
        document.getElementById('landing-page-profile')
    );
}
