import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import toastr from "toastr";


/** class FeModuleEdit */
class FeModuleEdit extends Component {

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
        this.renderFields.bind(this);
        this.onFieldChange.bind(this);
        this.onRemove.bind(this);
    }

    componentDidMount() {
        const config = JSON.parse(this.props.customModule.data);
        let fields = [];

        debugger;

        fields.landing_page_domain = config.landing_page_domain;

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

        this.setState({
            fields
        }, function() {
            console.log("Config: ", this.state.fields);
        });

    };

    validate = () => {
        return { "success" : true };
    };

    onUpdate = event => {

        event.preventDefault();

        let fd = new FormData();

        let url = '/api/user/custom_module/' + this.state.customModule.id;

        fd.append("custom" , 'custom');
        let customFields = {
            landing_page_domain:this.state.fields.landing_page_domain
        };

        fd.append("config" , JSON.stringify(customFields));

        axios.post(url, fd).then( res => {
            console.log(res);
            debugger;
            if (res.data.success === true) {
                toastr.success(res.data.message);

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

      let fields = Object.assign([], this.state.fields);

      fields[ e.currentTarget.name ] = e.currentTarget.value;

      debugger;

      this.setState({
          fields
      });

    };

    renderDomains = () => {
      return this.state.domains.map( domain => {
          return <option name={domain}>{domain}</option>
      });
    };

    onRemove = (e) => {
        e.preventDefault();
        debugger;

        let fields = Object.assign([], this.state.fields);

        fields.landing_page_domain = '';

        this.setState({
            fields
        });

    };

    renderFields = () => {
        let n = 0;
        debugger;
       return <div className="m-b-20">

               <div className="form-group row p-t-10">
                   <label htmlFor={ "landing_page_domain" } className="col-sm-3 col-form-label">Domain</label>
                   <div className="col-sm-9">

                       <select className="form-control" name={ "landing_page_domain" } onChange={ this.onFieldChange } defaultValue={ this.state.fields.landing_page_domain } >
                           <option value="">No domain</option>
                           { this.renderDomains() }
                       </select>

                   </div>
               </div>

{/*               <div className="form-group row">
                   <div className="col-sm-12">
                       <button className="btn btn-danger btn-add pull-right" onClick={ this.onRemove }>Disassocite</button>
                   </div>
               </div>*/}

       </div>

    };

    renderUpdateBtn = () => {
        return (
            <div className="form-group row">
                <div className="col-sm-12">
                    <button className="btn btn-success btn-update" onClick={ this.onUpdate }>Update Changes</button>
                </div>
            </div>
        );
    };

    render()
    {
        return this.state.customModule &&
            <div className="row">
                <div className="col-xs-12 col-md-6">
                    <div className="app d-flex justify-content-start align-items-start p-40">

                    { this.renderModuleImage() }
                    { this.renderModuleBadge() }

                    </div>
                </div>
                <div className="col-xs-12 col-md-6 p-10 p-t-40">

                    <form>

                        {
                            this.renderFields()
                        }

                        { this.renderUpdateBtn() }

                    </form>

                </div>
            </div>

    }
}

FeModuleEdit.propTypes = {
    customModule: PropTypes.object.isRequired,
    domains: PropTypes.array.isRequired
    //myProp: PropTypes.string.isRequired
};

FeModuleEdit.defaultProps = {
    customModule: {},
    domains: [],
};

export default FeModuleEdit;

if (document.getElementById('fe-settings-edit')) {
    render(<FeModuleEdit customModule={ customModule } domains={ domains } />,
        document.getElementById('fe-settings-edit')
    );
}
