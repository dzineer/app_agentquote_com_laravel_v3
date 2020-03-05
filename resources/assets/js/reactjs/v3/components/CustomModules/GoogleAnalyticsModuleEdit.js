import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import toastr from "toastr";
import DomainValidator from "../../utils/validators/DomainNameValidator";
import GoogleAnalytics from "../../utils/validators/GoogleAnalyticsCodeValidator";


/** class GoogleAnalyticsModuleEdit */
class GoogleAnalyticsModuleEdit extends Component {
    constructor(props) {
        super(props);
        this.state = {
            customModule: null,
            fields: {},
            config: {}
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

        this.onUpdate.bind(this);
        this.onAdd.bind(this);
        this.onFieldChange.bind(this);
        this.onRemove.bind(this);
    }

    componentDidMount() {
        const config = JSON.parse(this.props.customModule.data);
        let fields = [];

        debugger;

        for(let i=0; i < config.length; i++) {
            let domain = { "type": config[i].domain.type, "value" : config[i].domain.value };
            let analytics = { "type": config[i].analytics.type, "value" : config[i].analytics.value };
            fields.push( { domain: config[i].domain, analytics: config[i].analytics } );
        }

        this.setState({
            customModule: this.props.customModule,
            fields: fields,
            domains: this.props.domains,
            config: config
        });

        console.log("config: ", config);
    }

    onAdd = event => {

        event.preventDefault();
        let fields = Object.assign([], this.state.fields );

        let domain = { "type": "text", "value" : "" };
        let analytics = { "type": "text", "value" : "" };

        fields.push( { domain: domain, analytics: analytics } );

        this.setState({
            fields
        }, function() {
            console.log("Config: ", this.state.fields);
        });

    };

    validate = () => {
        const MINIMUM_DOMAIN_LENGTH = 3;
        const GA_ANALYTICS_LENGTH = 5;
        for(let i=0; i < this.state.fields.length; i++) {
            if ( this.state.fields[i].domain.value.length < MINIMUM_DOMAIN_LENGTH || this.state.fields[i].analytics.value.length < GA_ANALYTICS_LENGTH ) {
                return { "success" : false, "message" : "Domain or Analytics tracking code is not correct" };
            }

            debugger;

            if (!DomainValidator.validate(this.state.fields[i].domain.value)) {
                return { "success" : false, "message" : "Domain name invalid!" };
            }

            if (!GoogleAnalytics.validate(this.state.fields[i].analytics.value)) {
                return { "success" : false, "message" : "Google Analytics code invalid!" };
            }
        }
        return { "success" : true };
    };

    onUpdate = event => {

        event.preventDefault();
        let check = this.validate();
        if ( !check.success ) {
            toastr.error(check.message);
            return false;
        }

        let fd = new FormData();

        let url = '/api/user/custom_module/' + this.state.customModule.id;

        fd.append("custom" , 'custom');
        fd.append("config" , JSON.stringify(this.state.fields));

        axios.post(url, fd).then( res => {
            console.log(res);
            debugger;
            if (res.data.success === true) {

                toastr.success(res.data.message);

                debugger;
                let quote_request_response = res.data.message;

                let quote_results_style = {
                    textAlign: 'center'
                };

/*                render(
                    quoteResults,
                    document.getElementById('main-content-area')
                );*/

            } else {
                toastr.error(res.data.message);
            }
        });

    };

    renderModuleImage = () => {
        const haveImage = this.state.customModule.module.module_display_image;
        let content = '';

        if (haveImage) {
            content = <img src={ this.state.customModule.module.module_display_image } alt="Module Image" />
        } else {
            content = <span className="no-image-available">no image available</span>
        }

        return (
                <div className="module-logo-container">
                    { content }
                </div>
        );
    };

    renderModuleBadge = () => {

        return (
            <div className="content-container">
                <div className="title">{ this.state.customModule.module.name }</div>
                <div className="description">{ this.state.customModule.module.description }</div>
                <span className="category">{ this.state.customModule.module.module_type.description }</span>
            </div>
        );

    };

    onFieldChange = (e) => {
      e.preventDefault();
      debugger;
      const fieldName = e.currentTarget.getAttribute('data-field-name');
      const fieldIndex = e.currentTarget.getAttribute('data-field-index');

      let fields = Object.assign([], this.state.fields);

      fields[ fieldIndex ][ fieldName ][ "value"] = e.currentTarget.value;

      this.setState({
          fields
      });

    };

    onRemove = (e) => {
      e.preventDefault();
      debugger;
      const fieldIndex = e.currentTarget.getAttribute('data-field-index');

      let fields = Object.assign([], this.state.fields);

      fields.splice(fieldIndex, 1);

      this.setState({
          fields
      });

    };

    renderDomains = () => {
      return this.state.domains.map( domain => {
          debugger;
          return <option name={domain}>{domain}</option>
      });
    };

    renderFields = () => {
        let n = 0;
        debugger;
       return this.state.fields.map( field => {
                return (

                    <div className="card m-b-20">
                        <div className="card-body">

                            <div className="form-group row p-t-10">
                                <label htmlFor={ "domain_" + n } className="col-sm-3 col-form-label">Domain</label>
                                <div className="col-sm-9">
{/*
                                    <input type="text" className="form-control" data-field-name={ "domain" } data-field-index={n} name={ "domain_" + n } onChange={ this.onFieldChange } placeholder="https://domain.com" value={ field.domain.value }  />
*/}
                                    <select className="form-control" data-field-name={ "domain" } data-field-index={n} name={ "domain_" + n } onChange={ this.onFieldChange } defaultValue={ field.domain.value } >
                                        { this.renderDomains() }
                                    </select>

                                </div>
                            </div>

                            <div className="form-group row p-y-10">
                                <label htmlFor={ "analytics_" + n } className="col-sm-3 col-form-label">Analytics tracking code</label>
                                <div className="col-sm-9">
{/*
                                    <textarea className="form-control" name={ "analytics_" + n } data-field-name={ "analytics" } data-field-index={n} onChange={ this.onFieldChange }>{ field.analytics.value }</textarea>
*/}

                                    <input type="text" className="form-control" data-field-name={ "analytics" } data-field-index={n} name={ "domain_" + n } onChange={ this.onFieldChange } placeholder="UA-XXXXXXXXX-X" value={ field.analytics.value }  />

                                </div>
                            </div>

                            <div className="form-group row">
                                <div className="col-sm-12">
                                    <button className="btn btn-danger btn-add pull-right" data-field-index={n++} onClick={ this.onRemove }>Remove</button>
                                </div>
                            </div>

                        </div>

                    </div>
                );
        });

    };

    renderUpdateBtn = () => {
        return this.state.fields.length > 0 &&
            <div className="form-group row">
                <div className="col-sm-12">
                    <button className="btn btn-success btn-update" onClick={ this.onUpdate }>Update Changes</button>
                </div>
            </div>
    };

    render()
    {
        return this.state.customModule &&
            <div className="row">
                <div className="col-md-12">
                    <div className="app d-flex justify-content-start align-items-start p-40">

                    { this.renderModuleImage() }
                    { this.renderModuleBadge() }

                    </div>
                </div>
                <div className="col-md-12 p-10 p-t-40">

                    <form>

                        <div className="form-group row">
                            <div className="col-sm-12">
                                <button className="btn btn-primary btn-add pull-right m-y-20" onClick={ this.onAdd }>Add Domain</button>
                            </div>
                        </div>

                        { this.renderFields() }

                        { this.renderUpdateBtn() }

                    </form>

                </div>
            </div>

    }
}

GoogleAnalyticsModuleEdit.propTypes = {
    customModule: PropTypes.object.isRequired,
    domains: PropTypes.array.isRequired
    //myProp: PropTypes.string.isRequired
};

GoogleAnalyticsModuleEdit.defaultProps = {
    customModule: {},
    domains: [],
};

export default GoogleAnalyticsModuleEdit;

if (document.getElementById('google-analytics-edit')) {
    render(<GoogleAnalyticsModuleEdit customModule={ customModule } domains={ domains } />,
        document.getElementById('google-analytics-edit')
    );
}
