import React, { Component } from 'react';
import ReactDom from "react-dom";
import PropTypes from 'prop-types';
import toastr from 'toastr';

class CustomModuleTest extends Component {
    constructor(props) {
        super(props);

        this.state = {
            moduleData: {},
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

    componentDidMount() {
        console.log("Component Did Mount");
        this.getData();
    }

    genURL = () => {
        return '/m/mod/' + this.props.moduleName + "?id=" + this.props.id;
    };

    getData = () => {
        axios.get(this.genURL()).then( res => {
            this.setState({
                moduleData: res.data
            });
            // debugger;
        }).catch( error => {
            console.log(error);
            this.setState({
                error: error
            });
        });
    };

    updateData = () => {
        axios.post(this.genURL()).then( res => {
            this.setState({
                moduleData: res.data
            });
            // debugger;
        }).catch( error => {
            console.log(error);
            this.setState({
                error: error
            });
        });
    };

    render() {
        return (
            <div>
                <form>
                    <div className="form-row align-items-center">
                        <div className="col-auto">
                            <label className="sr-only" htmlFor="inlineFormInput">URL</label>
                            <input type="text" className="form-control mb-2" id="inlineFormInput"
                                   placeholder="https://somewhere.com/myprofile/83943" value={ this.moduleData.url ? this.moduleData.url : ''} />
                        </div>
                        <div className="col-auto">
                            <button type="submit" className="btn btn-primary mb-2" onClick={ this.updateData }>{ this.props.ButtonCaption }</button>
                        </div>
                    </div>
                </form>
            </div>
        );
    }
}

CustomModuleTest.propTypes = {
    moduleName: PropTypes.string.isRequired,
    id: PropTypes.number.isRequired,
    ButtonCaption: PropTypes.string
};

CustomModuleTest.defaultProps = {
    moduleName: '',
    id: 0,
    ButtonCaption: 'Update'
};

export default CustomModuleTest;
/*
if (document.getElementById('custom-module-test')) {
    ReactDom.render(<CustomModuleTest />,
        document.getElementById('custom-module-test')
    );
}*/
