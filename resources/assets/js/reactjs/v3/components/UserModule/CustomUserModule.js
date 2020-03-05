import React, {Component} from 'react';
import PropTypes from 'prop-types';
import toastr from "toastr";
import {render} from "react-dom";
import TermlifeForm from "../Quoter/TermlifeForm";

/** class CustomUserModule */
class CustomUserModule extends Component {
    constructor(props) {
        super(props);
        this.state = {
            output: ''
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
    }

    componentDidMount() {
        this.renderUserModule( this.props.CustomModuleName, this.props.UserId );
    }

    renderUserModule = ( $moduleName, $userId ) => {
        let fd = new FormData();

        let url = '/user/custom_module/' + this.props.UserId + '?module='+$moduleName;
        debugger;

        axios.get(url).then( res => {

            console.log(res);

            if (res.statusText === "OK") {
                debugger;
                console.log(res.data);

                if (res.data.success === true) {

                    let output = <div dangerouslySetInnerHTML={{ __html: res.data.output }} />;

                    this.setState({
                        output: output
                    });

                }
            }
        });
    };

    render() {
        return (
            <div>
                <div className='col-md-4'>
                </div>
                <div className='col-md-4'>
                    { this.state.output }
                </div>
                <div className='col-md-4'>
                </div>
            </div>
        );
    }
}

CustomUserModule.propTypes = {
    CustomModuleName: PropTypes.string.isRequired,
    UserId: PropTypes.number.isRequired
};

CustomUserModule.defaultProps = {
    CustomModuleName: '',
    UserId: 0
};

export default CustomUserModule;
