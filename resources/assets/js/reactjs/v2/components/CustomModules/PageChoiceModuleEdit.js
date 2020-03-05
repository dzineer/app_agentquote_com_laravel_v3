import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import toastr from "toastr";
import DomainValidator from "../../utils/validators/DomainNameValidator";
import GoogleAnalytics from "../../utils/validators/GoogleAnalyticsCodeValidator";

/** class PageChoiceModuleEdit */
class PageChoiceModuleEdit extends Component {
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
        this.onFieldChange.bind(this);
        this.validate.bind(this);
    }

    componentDidMount() {
        const config = JSON.parse(this.props.customModule.data);
        let fields = [];

        debugger;

        this.props.supportedModules.forEach(function(supportedModule){
            let has = config.indexOf(supportedModule.id) !== -1;
            fields.push( { 'module_id': supportedModule.id, 'name' : supportedModule.name, 'checked' : has } );
        });

        this.setState({
            customModule: this.props.customModule,
            fields: fields,
            config: config
        });

        console.log("config: ", config);
    }

    validate = () => {
        let fields = this.state.fields.filter( field => field.checked );
        return  fields.length > 0 ? { "success" : true } : { "success" : false, "message" : "You must choose at least one module." } ;
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
            } else {
                toastr.error(res.data.message);
            }
        });
    };

    onFieldChange = (e) => {
      debugger;

      let fields = Object.assign([], this.state.fields);
      let module_id = e.currentTarget.getAttribute('data-module-id');

      fields = fields.map( field => {
          if (field.module_id === parseInt(module_id)) {
              field.checked = e.currentTarget.checked;
          }
          return field;
      });

      this.setState({
          fields
      });

    };

    renderFields = () => {
        let n = 0;
        debugger;
        return this.state.fields.map( field => {
            debugger;
            return (

                <div className="form-check">

                    <label className="form-check-label" htmlFor={ field.name } >
                        <input className="form-check-input carriers" type="checkbox" onChange={ this.onFieldChange } name={ field.name } data-module-id={ field.module_id } checked={ field.checked } />
                        { field.name }
                    </label>

                </div>

            );
        });

    };

    renderUpdateBtn = () => {
        return this.state.fields.length > 0 &&
            <div className="form-group row">
                <div className="col-sm-12">
                    <button className="btn btn-success btn-update m-t-10" onClick={ this.onUpdate }>Update Changes</button>
                </div>
            </div>
    };

    render()
    {
        return this.state.customModule &&
            <div className="row">
                <div className="col-md-12 p-10">

                    <p>Choose which Insurance module you support on your landing page.</p>

                    <form>

                        { this.renderFields() }
                        { this.renderUpdateBtn() }

                    </form>

                </div>
            </div>

    }
}

PageChoiceModuleEdit.propTypes = {
    customModule: PropTypes.object.isRequired,
    modulePages: PropTypes.array.isRequired,
    supportedModules: PropTypes.array.isRequired
    //myProp: PropTypes.string.isRequired
};

PageChoiceModuleEdit.defaultProps = {
    customModule: {},
    modulePages: [],
    supportedModules: [],
};

export default PageChoiceModuleEdit;

if (document.getElementById('page-choice-module-edit')) {
    render(<PageChoiceModuleEdit customModule={ customModule } supportedModules={ supportedCustomModules } />,
        document.getElementById('page-choice-module-edit')
    );
}
