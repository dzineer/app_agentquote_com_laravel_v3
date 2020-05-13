import React, {Component} from 'react';
import PropTypes from 'prop-types';
import toastr from "toastr";
import {render} from "react-dom";
import TermlifeForm from "../Quoter/TermlifeForm";

/** class UserInsuranceModule */
class UserInsuranceModule extends Component {
    constructor(props) {
        super(props);
        this.state = {
            userModule: null,
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

        this.onClick.bind(this);
        this.renderModule.bind(this);
    }

    componentDidMount() {
        debugger;
        this.renderModule( this.props.CustomModuleName, this.props.UserId );
    }

    onClick = (e) => {
        e.preventDefault();
        return this.props.onClick(e);
    };

    renderModule = ( $moduleName, $userId ) => {
        let fd = new FormData();

        let url = '/api/user/custom_module/' + this.props.UserId + '?module='+$moduleName;
        debugger;

        axios.get(url).then( res => {

            console.log(res);

            if (res.status === 200) {
                debugger;
                console.log(res.data);
                debugger;
                if (res.data.success === true) {
                    debugger;

                    // @todo: build the module here

                    const userModule = res.data.data.userModule;
                    const config = res.data.data.config;

                    debugger;

                    // let output = <div dangerouslySetInnerHTML={{ __html: res.data.output }}  />;

                    this.setState({
                        userModule,
                        config
                    });

                }
            }
        });
    };

    render() {

        debugger;
        return this.state.userModule &&
            <div id={ this.state.userModule.module.module_name + '-btn-container'} className="btn-container">
                <div id={ this.state.userModule.module.module_name} className="select-btn" data-insure-type={ this.state.userModule.module.module_name }
                     onClick={ (e) => { this.props.onClick(e) } }>
                    <i className={'dz-fa ' + this.state.config.icon } aria-hidden="true"></i>
                </div>
                <h4>{ this.state.config.name }</h4>
            </div>
    }
}

UserInsuranceModule.propTypes = {
    CustomModuleName: PropTypes.string.isRequired,
    UserId: PropTypes.number.isRequired,
    onClick: PropTypes.func.isRequired
};

UserInsuranceModule.defaultProps = {
    CustomModuleName: '',
    UserId: 0,
    onClick: () => {}
};

export default UserInsuranceModule;
