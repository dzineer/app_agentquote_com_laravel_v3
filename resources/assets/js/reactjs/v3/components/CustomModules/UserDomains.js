import React, {Component} from 'react';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import {render} from "react-dom";

/** class UserDomain */
class UserDomains extends Component {
    constructor(props) {
        super(props);

        this.state = {
            domains: [],
            actionURL: '',
            showList: false,
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

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
        this.addDomain.bind(this);
    }

    componentDidMount() {
        console.log(this.props.items);

        this.setState({
            domains: this.props.domains,
            actionURL: this.props.actionURL,
            showList: this.props.domains.length
        });

    }

    addDomain = (e) => {

        let fd = new FormData();

        let options = {
        };

        fd.append("options", JSON.stringify( options ));
        fd.append("action", "add");

        axios.post(url, fd).then( res => {
            console.log(res);
            debugger;
            if (res.data.success === true) {
                toastr.success('Position updated');
            } else {
                toastr.error(res.data.message);
            }
        });

    };


    renderUserDomains = () => {

        const domains = this.state.domains.map( domain => {
            debugger;
            return (
                <tr>
                    <td scope="row">{ domain["user"].email }</td>
                    <td>{ domain.domain }</td>
                </tr>
            )
        });

        return (
            <div>
                <table className="table">
                    <thead>
                    <th className="sheader" scope="col">USER</th>
                    <th className="sheader" scope="col">DOMAIN</th>
                    </thead>

                    <tbody>
                    { domains }
                    </tbody>
                </table>
            </div>
        );
    };

    render() {

        let output = <div className="text-center">No domains</div>;

        if (this.state.showList) {
            output = this.renderUserDomains();
        }

        debugger;

        return (
            <div>
                <h5 className="heading-info">Domains</h5>

                <div className="row">
                    <div className="col-md-12">
                        <a href="#" className="btn btn-secondary my-20">+ Add
                            Domain
                        </a>
                    </div>
                </div>

                <div className="row">
                    <div className="col-md-12">
                        { output }
                    </div>
                </div>

            </div>
       );
    }

}

UserDomains.propTypes = {
    domains: PropTypes.array.isRequired,
};

UserDomains.defaultProps = {
    domains: [],
};

export default UserDomains;

if (document.getElementById('user-domains')) {
    render(
        <UserDomains domains={ domains } actionURL={ url } />,
        document.getElementById('user-domains')
    );
}
