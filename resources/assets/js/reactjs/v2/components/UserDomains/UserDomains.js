import React, {Component} from 'react';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import {render} from "react-dom";
import UserDomainsTable from "./UserDomainsTable";

/** class UserDomain */
class UserDomains extends Component {
    constructor(props) {
        super(props);

        this.state = {
            domains: [],
            pagination: [],
            actionURL: '',
            ready: false
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
            pagination: this.props.pagination,
            actionURL: this.props.actionURL,
            ready: true
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

    render() {
        return (
            this.state.ready && <UserDomainsTable actionURL={this.state.actionURL} domains={ this.state.domains } pagination={ this.state.pagination } />
       );
    }

}

UserDomains.propTypes = {
    domains: PropTypes.array.isRequired,
    pagination: PropTypes.object.isRequired,
};

UserDomains.defaultProps = {
    domains: [],
    pagination: {}
};

export default UserDomains;

if (document.getElementById('user-domains')) {
    render(
        <UserDomains domains={ domains }  pagination={ pagination } actionURL={ url } />,
        document.getElementById('user-domains')
    );
}
